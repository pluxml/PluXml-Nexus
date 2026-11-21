<?php

namespace App\Controllers;

use App\Facades\AuthFacade;
use App\Facades\ThemesFacade;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Respect\Validation\Validator;

/**
 * Class BackofficeThemesController
 * @package App\Controllers
 */
class BackofficeThemesController extends Controller
{

    private const NAMED_ROUTE_BOTHEMES = 'bothemes';

    private const NAMED_ROUTE_SAVETHEME = 'boaddtheme';

    private const NAMED_ROUTE_EDITTHEME = 'boedittheme';

    private const MSG_VALID_NAME = 'Must be alphanumeric with no whitespace';

    private const MSG_VALID_TOLONG250 = 'Invalid or to long (250 characters max)';

    private const MSG_VALID_TOLONG100 = 'Invalid or to long (100 characters max)';

    private const MSG_VALID_FILE = 'Invalid file (extension must be zip and size inferior to 10MB)';

    private const MSG_VALID_FILE_TOO_LARGE = 'File too large, the server accepts files up to %s';

    private const MSG_SUCCESS_EDITTHEME = 'Theme saved with success';

    private const MSG_SUCCESS_DELETETHEME = 'Theme deleted with success';

    private const MSG_ERROR_TECHNICAL_THEMES = 'Technical error or theme name already exist';

    private const MSG_ERROR_FORBIDDEN_THEME = 'Theme not found or you are not allowed to manage it';

    /**
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function show(Request $request, Response $response): Response
    {
        $datas['title'] = 'Backoffice Ressources - PluXml.org';
        $datas['h2'] = 'Backoffice';
        $datas['h3'] = 'Themes';
        $datas['themes'] = ThemesFacade::getAllThemes($this->container, $this->currentUser);

        return $this->render($response, 'pages/backoffice/themes.php', $datas);
    }

    /**
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function showAddTheme(Request $request, Response $response): Response
    {
        $datas['title'] = 'Backoffice Ressources - PluXml.org';
        $datas['h2'] = 'Backoffice';
        $datas['h3'] = 'New theme';

        return $this->render($response, 'pages/backoffice/addTheme.php', $datas);
    }

    /**
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function showTheme(Request $request, Response $response, array $args): Response
    {
        $datas['title'] = 'Backoffice Ressources - PluXml.org';
        $datas['h2'] = 'Backoffice';
        $datas['h3'] = 'Edit theme ' . $args['name'];
        $datas['theme'] = $this->getManageableTheme($args['name']);
        if (empty($datas['theme'])) {
            $this->messageService->addMessage('error', self::MSG_ERROR_FORBIDDEN_THEME);
            return $this->redirect($response, self::NAMED_ROUTE_BOTHEMES);
        }

        return $this->render($response, 'pages/backoffice/editTheme.php', $datas);
    }

    /**
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     * @throws Exception
     */
    public function edit(Request $request, Response $response, array $args): Response
    {
        $dirThemes = $_SERVER['DOCUMENT_ROOT'] . DIR_THEMES;
        $dirTmp = $_SERVER['DOCUMENT_ROOT'] . DIR_TMP;

        $theme = $this->getManageableTheme($args['name']);
        if (empty($theme)) {
            $this->messageService->addMessage('error', self::MSG_ERROR_FORBIDDEN_THEME);
            return $this->redirect($response, self::NAMED_ROUTE_BOTHEMES);
        }

        $post = $request->getParsedBody();
        $post['name'] = $theme['name'];
        $post['author'] = $theme['author'];
        $uploadedFile = $request->getUploadedFiles()['file'] ?? null;
        $newFile = !empty($uploadedFile) && $uploadedFile->getError() !== UPLOAD_ERR_NO_FILE;

        $errors = self::themeValidator($request, $post, false, $newFile);

        if (empty($errors)) {
            if (ThemesFacade::editTheme($this->container, $post)) {
                $result = true;
                if ($newFile) {
                    $filename = $post['name'] . '.zip';
                    if (!is_dir($dirThemes)) {
                        mkdir($dirThemes, 0755, true);
                    }
                    $result = rename($dirTmp . DIRECTORY_SEPARATOR . $filename, $dirThemes . DIRECTORY_SEPARATOR . $filename);
                }
                if ($result) {
                    $this->messageService->addMessage('success', self::MSG_SUCCESS_EDITTHEME);
                } else {
                    $errors['error'] = self::MSG_ERROR_TECHNICAL_THEMES;
                }
            } else {
                $this->messageService->addMessage('error', self::MSG_ERROR_TECHNICAL);
            }
        } else {
            $this->messageService->addMessage('error', self::MSG_ERROR_TECHNICAL);
            foreach ($errors as $key => $message) {
                $this->messageService->addMessage($key, $message);
            }
            return $this->redirect($response, self::NAMED_ROUTE_EDITTHEME, ['name' => $theme['name']]);
        }

        return $this->redirect($response, self::NAMED_ROUTE_BOTHEMES, $args);
    }

    /**
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws Exception
     */
    public function save(Request $request, Response $response): Response
    {
        $namedRoute = self::NAMED_ROUTE_BOTHEMES;
        $dirThemes = $_SERVER['DOCUMENT_ROOT'] . DIR_THEMES;
        $dirTmp = $_SERVER['DOCUMENT_ROOT'] . DIR_TMP;

        $post = $request->getParsedBody();
        $post['author'] = $this->currentUser;
        $errors = self::themeValidator($request, $post, true);

        if (empty($errors) && empty(ThemesFacade::getTheme($this->container, $post['name']))) {
            if (ThemesFacade::saveTheme($this->container, $post)) {
                $filename = $post['name'] . '.zip';
                if (!is_dir($dirThemes)) {
                    mkdir($dirThemes, 0755, true);
                }
                $target = $dirThemes . DIRECTORY_SEPARATOR . $filename;
                if (!file_exists($target)) {
                    $result = rename($dirTmp . DIRECTORY_SEPARATOR . $filename, $target);
                    if ($result) {
                        $this->messageService->addMessage('success', self::MSG_SUCCESS_EDITTHEME);
                    } else {
                        $errors['error'] = self::MSG_ERROR_TECHNICAL_THEMES;
                    }
                } else {
                    $errors['error'] = self::MSG_ERROR_TECHNICAL_THEMES;
                }
            } else {
                $errors['error'] = self::MSG_ERROR_TECHNICAL_THEMES;
            }
        } else {
            $errors['error'] = self::MSG_ERROR_TECHNICAL_THEMES;
        }

        if (!empty($errors)) {
            foreach ($errors as $key => $message) {
                $this->messageService->addMessage($key, $message);
            }
            $namedRoute = self::NAMED_ROUTE_SAVETHEME;
        }

        return $this->redirect($response, $namedRoute);
    }

    /**
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function delete(Request $request, Response $response, array $args): Response
    {
        $namedRoute = self::NAMED_ROUTE_BOTHEMES;

        if (empty($this->getManageableTheme($args['name']))) {
            $this->messageService->addMessage('error', self::MSG_ERROR_FORBIDDEN_THEME);
        } elseif (ThemesFacade::deleteTheme($this->container, $args['name'])) {
            $this->messageService->addMessage('success', self::MSG_SUCCESS_DELETETHEME);
        } else {
            $this->messageService->addMessage('error', self::MSG_ERROR_TECHNICAL);
        }

        return $this->redirect($response, $namedRoute);
    }

    /**
     * Validate request body for a theme save or edit
     *
     * @param Request $request
     * @param array $post request body, with the name and author set by the controller
     * @param bool $newTheme
     * @param bool $newFile
     * @return array
     * @throws Exception
     */
    private function themeValidator(Request $request, array $post, bool $newTheme = false, bool $newFile = false): array
    {
        $errors = [];
        $dirTmp = $_SERVER['DOCUMENT_ROOT'] . DIR_TMP;
        $uploadedFiles = $request->getUploadedFiles();

        if (!empty($post['description'])) {
            Validator::length(1, 250)->validate($post['description']) || $errors['description'] = self::MSG_VALID_TOLONG250;
        }
        if (!empty($post['versionTheme'])) {
            Validator::alnum('. , - _')->length(1, 99)->validate($post['versionTheme']) || $errors['versionTheme'] = self::MSG_VALID_TOLONG100;
        }
        if (!empty($post['versionPluxml'])) {
            Validator::alnum('.')->length(1, 99)->validate($post['versionPluxml']) || $errors['versionPluxml'] = self::MSG_VALID_TOLONG100;
        }
        if (!empty($post['link'])) {
            Validator::url()->regex('#^https?://[^\s"\'<>]+$#i')->length(1, 99)->validate($post['link']) || $errors['link'] = self::MSG_VALID_URL;
        }

        if ($newTheme) {
            Validator::notEmpty()->alnum()
                ->noWhitespace()
                ->length(1, 99)
                ->validate($post['name']) || $errors['name'] = self::MSG_VALID_NAME;
        }

        if ($newTheme || $newFile) {
            if (empty($uploadedFiles['file'])) {
                throw new Exception('No file has been send');
            }
            $uploadedFile = $uploadedFiles['file'];
            if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
                $filename = $post['name'] . '.zip';
                if (!is_dir($dirTmp)) {
                    mkdir($dirTmp, 0755, true);
                }
                $uploadedFile->moveTo($dirTmp . DIRECTORY_SEPARATOR . $filename);
                $maxSize = defined('THEMES_MAX_SIZE') ? THEMES_MAX_SIZE : PLUGINS_MAX_SIZE;
                Validator::notEmpty()->extension('zip')
                    ->size(null, $maxSize)
                    ->validate($dirTmp . DIRECTORY_SEPARATOR . $filename) || $errors['file'] = self::MSG_VALID_FILE;
            } elseif (in_array($uploadedFile->getError(), [UPLOAD_ERR_INI_SIZE, UPLOAD_ERR_FORM_SIZE], true)) {
                $errors['file'] = sprintf(self::MSG_VALID_FILE_TOO_LARGE, ini_get('upload_max_filesize'));
            } else {
                $errors['error'] = self::MSG_ERROR_TECHNICAL_THEMES;
            }
        }

        return $errors;
    }

    /**
     * Return the theme if the logged in user is its author or an admin
     *
     * @param string $name
     * @return array empty if the theme does not exist or can not be managed by the logged in user
     */
    private function getManageableTheme(string $name): array
    {
        $theme = ThemesFacade::getTheme($this->container, $name);
        if (!empty($theme) && ($theme['author'] === $this->currentUser || AuthFacade::isAdmin($this->container, $this->currentUser))) {
            return $theme;
        }
        return [];
    }
}