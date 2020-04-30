<?php
/**
 * BackofficePluginsController
 */

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Facades\PluginsFacade;
use Respect\Validation\Validator;

class BackofficePluginsController extends Controller
{

    private const NAMED_ROUTE_BACKOFFICE = 'backoffice';

    private const NAMED_ROUTE_BOEDITPLUGIN = 'boeditplugin';

    private const NAMED_ROUTE_SAVEPLUGIN = 'boaddplugin';

    private const MSG_VALID_NAME = 'Must be alphanumeric with no whitespace';

    private const MSG_VALID_TOLONG250 = 'To long (250 characters max)';

    private const MSG_VALID_TOLONG100 = 'To long (100 characters max)';

    private const MSG_VALID_URL = 'Invalid url';

    private const MSG_VALID_FILE = 'Invalid file (extension must be zip and size inferior to 10MB';

    private const MSG_SUCCESS_EDITPLUGIN = 'Plugin saved with success';

    private const MSG_ERROR_TECHNICAL = 'Technical error or plugin name already exist';

    /**
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function show(Request $request, Response $response)
    {
        $datas['title'] = 'Backoffice Ressources - PluXml.org';
        $datas['h1'] = 'Backoffice';
        $datas['h2'] = 'Plugins';
        $datas = array_merge($datas, PluginsFacade::getAllPlugins($this->container, $this->currentUser));

        return $this->render($response, 'pages/backoffice/plugins.php', $datas);
    }

    /**
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function showPlugin(Request $request, Response $response, $args)
    {
        $datas['title'] = 'Backoffice Ressources - PluXml.org';
        $datas['h1'] = 'Backoffice';
        $datas['h2'] = 'Edit plugin ' . $args['name'];
        $datas += PluginsFacade::getPlugin($this->container, $args['name']);

        return $this->render($response, 'pages/backoffice/editPlugin.php', $datas);
    }

    /**
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function showAddPlugin(Request $request, Response $response)
    {
        $datas['title'] = 'Backoffice Ressources - PluXml.org';
        $datas['h1'] = 'Backoffice';
        $datas['h2'] = 'New plugin';

        return $this->render($response, 'pages/backoffice/addPlugin.php', $datas);
    }

    /**
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function edit(Request $request, Response $response, $args)
    {
        $namedRoute = self::NAMED_ROUTE_BOEDITPLUGIN;
        $post = $request->getParsedBody();

        $errors = self::pluginValidator($post);

        if (empty($errors)) {
            if (PluginsFacade::editPlugin($this->container, $post)) {
                $this->messageService->addMessage('success', self::MSG_SUCCESS_EDITPLUGIN);
                $namedRoute = self::NAMED_ROUTE_BACKOFFICE;
            } else {
                $this->messageService->addMessage('error', self::MSG_ERROR_TECHNICAL);
            }
        } else {
            $this->messageService->addMessage('error', self::MSG_ERROR_TECHNICAL);
            foreach ($errors as $key => $message) {
                $this->messageService->addMessage($key, $message);
            }
        }

        return $this->redirect($response, $namedRoute, $args);
    }

    /**
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function save(Request $request, Response $response)
    {
        $techError = false;
        $filename = '';
        $dirTmpPlugin = $_SERVER['DOCUMENT_ROOT'] . DIR_TMP;
        $dirPlugins = $_SERVER['DOCUMENT_ROOT'] . DIR_PLUGINS;
        $namedRoute = self::NAMED_ROUTE_SAVEPLUGIN;
        $post = $request->getParsedBody();
        $uploadedFiles = $request->getUploadedFiles();

        $errors = self::pluginValidator($post);
        Validator::notEmpty()->alnum()
            ->noWhitespace()
            ->length(1, 99)
            ->validate($post['name']) || $errors['name'] = self::MSG_VALID_NAME;

        // Uploaded file move, rename and validation
        $uploadedFile = $uploadedFiles['file'];
        if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
            $filename = $post['name'] . '.zip';
            $uploadedFile->moveTo($dirTmpPlugin . DIRECTORY_SEPARATOR . $filename);
            Validator::notEmpty()->extension('zip')
                ->size(NULL, '10MB')
                ->validate($dirTmpPlugin . DIRECTORY_SEPARATOR . $filename) || $errors['file'] = self::MSG_VALID_FILE;
        } else {
            $this->messageService->addMessage('error', self::MSG_ERROR_TECHNICAL);
        }

        // Any validator error and plugin does not exist
        if (empty($errors) && empty(PluginsFacade::getPlugin($this->container, $post['name']))) {
            if (PluginsFacade::savePlugin($this->container, $post)) {
                if (!file_exists($dirPlugins . DIRECTORY_SEPARATOR . $filename)) {
                    rename($dirTmpPlugin . DIRECTORY_SEPARATOR . $filename, $dirPlugins . DIRECTORY_SEPARATOR . $filename);
                    $this->messageService->addMessage('success', self::MSG_SUCCESS_EDITPLUGIN);
                    $namedRoute = self::NAMED_ROUTE_BACKOFFICE;
                }
                else {
                    $techError = true;
                }
            } else {
                $techError = true;
            }
        } else {
            $techError = true;
        }

        if ($techError) {
            $this->messageService->addMessage('error', self::MSG_ERROR_TECHNICAL);
            foreach ($errors as $key => $message) {
                $this->messageService->addMessage($key, $message);
            }
        }

        return $this->redirect($response, $namedRoute);
    }

    /**
     * @param array $post
     * @return array
     */
    private function pluginValidator(array $post)
    {
        $errors = [];

        Validator::alnum(' ')->length(1, 249)->validate($post['description']) || $errors['description'] = self::MSG_VALID_TOLONG250;
        Validator::alnum('.', ',', '-', '_')->length(1, 99)->validate($post['versionPlugin']) || $errors['versionPlugin'] = self::MSG_VALID_TOLONG100;
        Validator::alnum('.')->length(1, 99)->validate($post['versionPluxml']) || $errors['versionPluxml'] = self::MSG_VALID_TOLONG100;
        Validator::url()->length(1, 99)->validate($post['link']) || $errors['link'] = self::MSG_VALID_URL;

        return $errors;
    }
}

?>