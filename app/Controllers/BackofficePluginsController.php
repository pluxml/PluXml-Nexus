<?php

namespace App\Controllers;

use Exception;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Facades\PluginsFacade;
use Respect\Validation\Validator;

/**
 * Class BackofficePluginsController
 * @package App\Controllers
 */
class BackofficePluginsController extends Controller
{

    private const NAMED_ROUTE_BOPLUGINS = 'boplugins';

    private const NAMED_ROUTE_BOEDITPLUGIN = 'boeditplugin';

    private const NAMED_ROUTE_SAVEPLUGIN = 'boaddplugin';

    private const MSG_VALID_NAME = 'Must be alphanumeric with no whitespace';

    private const MSG_VALID_TOLONG250 = 'To long (250 characters max)';

    private const MSG_VALID_TOLONG100 = 'To long (100 characters max)';

    private const MSG_VALID_FILE = 'Invalid file (extension must be zip and size inferior to 10MB';

    private const MSG_SUCCESS_EDITPLUGIN = 'Plugin saved with success';

    private const MSG_SUCCESS_DELETEPLUGIN = 'Plugin deleted with success';

    private const MSG_ERROR_TECHNICAL_PLUGINS = 'Technical error or plugin name already exist';

    /**
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function show(Request $request, Response $response)
    {
        $datas['title'] = 'Backoffice Ressources - PluXml.org';
        $datas['h2'] = 'Backoffice';
        $datas['h3'] = 'Plugins';
        $datas['plugins'] = PluginsFacade::getAllPlugins($this->container, $this->currentUser);

        return $this->render($response, 'pages/backoffice/plugins.php', $datas);
    }

    /**
     *
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return Response
     */
    public function showPlugin(Request $request, Response $response, $args)
    {
        $datas['title'] = 'Backoffice Ressources - PluXml.org';
        $datas['h2'] = 'Backoffice';
        $datas['h3'] = 'Edit plugin ' . $args['name'];
        $datas['plugin'] = PluginsFacade::getPlugin($this->container, $args['name']);

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
        $datas['h2'] = 'Backoffice';
        $datas['h3'] = 'New plugin';

        return $this->render($response, 'pages/backoffice/addPlugin.php', $datas);
    }

    /**
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     * @throws Exception
     */
    public function edit(Request $request, Response $response, $args)
    {
        $dirPlugins = $_SERVER['DOCUMENT_ROOT'] . DIR_PLUGINS;
        $dirTmpPlugin = $_SERVER['DOCUMENT_ROOT'] . DIR_TMP;

        $post = $request->getParsedBody();

        if (!empty($request->getUploadedFiles())) {
            $errors = self::pluginValidator($request, false, true);
        } else {
            $errors = self::pluginValidator($request);
        }

        if (empty($errors)) {
            if (PluginsFacade::editPlugin($this->container, $post)) {
                $filename = $post['name'] . '.zip';
                $result = rename($dirTmpPlugin . DIRECTORY_SEPARATOR . $filename, $dirPlugins . DIRECTORY_SEPARATOR . $filename);
                if ($result) {
                    $this->messageService->addMessage('success', self::MSG_SUCCESS_EDITPLUGIN);
                } else {
                    $errors['error'] = self::MSG_ERROR_TECHNICAL_PLUGINS;
                }
            } else {
                $this->messageService->addMessage('error', self::MSG_ERROR_TECHNICAL);
            }
        } else {
            $this->messageService->addMessage('error', self::MSG_ERROR_TECHNICAL);
            foreach ($errors as $key => $message) {
                $this->messageService->addMessage($key, $message);
            }
        }

        return $this->redirect($response, self::NAMED_ROUTE_BOPLUGINS, $args);
    }

    /**
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws Exception
     */
    public function save(Request $request, Response $response)
    {
        $namedRoute = self::NAMED_ROUTE_BOPLUGINS;
        $dirPlugins = $_SERVER['DOCUMENT_ROOT'] . DIR_PLUGINS;
        $dirTmpPlugin = $_SERVER['DOCUMENT_ROOT'] . DIR_TMP;

        $post = $request->getParsedBody();
        $errors = self::pluginValidator($request, true);

        // Validator error and plugin does not exist
        if (empty($errors) && empty(PluginsFacade::getPlugin($this->container, $post['name']))) {
            if (PluginsFacade::savePlugin($this->container, $post)) {
                $filename = $post['name'] . '.zip';
                if (!file_exists($dirPlugins . DIRECTORY_SEPARATOR . $filename)) {
                    $result = rename($dirTmpPlugin . DIRECTORY_SEPARATOR . $filename, $dirPlugins . DIRECTORY_SEPARATOR . $filename);
                    if ($result) {
                        $this->messageService->addMessage('success', self::MSG_SUCCESS_EDITPLUGIN);
                    } else {
                        $errors['error'] = self::MSG_ERROR_TECHNICAL_PLUGINS;
                    }
                } else {
                    $errors['error'] = self::MSG_ERROR_TECHNICAL_PLUGINS;
                }
            } else {
                $errors['error'] = self::MSG_ERROR_TECHNICAL_PLUGINS;
            }
        } else {
            $errors['error'] = self::MSG_ERROR_TECHNICAL_PLUGINS;
        }

        if (!empty($errors)) {
            foreach ($errors as $key => $message) {
                $this->messageService->addMessage($key, $message);
            }
            $namedRoute = self::NAMED_ROUTE_SAVEPLUGIN;
        }

        return $this->redirect($response, $namedRoute);
    }

    /**
     *
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return Response
     */
    public function delete(Request $request, Response $response, $args)
    {
        $namedRoute = self::NAMED_ROUTE_BOPLUGINS;

        if (PluginsFacade::deletePlugin($this->container, $args['name'])) {
            $this->messageService->addMessage('success', self::MSG_SUCCESS_DELETEPLUGIN);
        } else {
            $this->messageService->addMessage('error', self::MSG_ERROR_TECHNICAL);
        }

        return $this->redirect($response, $namedRoute);
    }

    /**
     * Validate request body for a plugin save or edit
     *
     * @param Request $request
     * @param bool $newPlugin
     * @param bool $newFile
     * @return array
     * @throws Exception
     */
    private function pluginValidator(Request $request, bool $newPlugin = false, bool $newFile = false)
    {
        $errors = [];
        $post = $request->getParsedBody();
        $dirTmpPlugin = $_SERVER['DOCUMENT_ROOT'] . DIR_TMP;
        $uploadedFiles = $request->getUploadedFiles();
        if (empty($uploadedFiles['file'])) {
            throw new Exception('No file has been send');
        }

        Validator::alnum(' ')->length(1, 249)->validate($post['description']) || $errors['description'] = self::MSG_VALID_TOLONG250;
        Validator::alnum('. , - _')->length(1, 99)->validate($post['versionPlugin']) || $errors['versionPlugin'] = self::MSG_VALID_TOLONG100;
        Validator::alnum('.')->length(1, 99)->validate($post['versionPluxml']) || $errors['versionPluxml'] = self::MSG_VALID_TOLONG100;
        Validator::url()->length(1, 99)->validate($post['link']) || $errors['link'] = self::MSG_VALID_URL;

        if ($newPlugin) {
            Validator::notEmpty()->alnum()
                ->noWhitespace()
                ->length(1, 99)
                ->validate($post['name']) || $errors['name'] = self::MSG_VALID_NAME;
        }
        if ($newPlugin || $newFile) {
            // Uploaded file move, rename and validation
            $uploadedFile = $uploadedFiles['file'];
            if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
                $filename = $post['name'] . '.zip';
                $uploadedFile->moveTo($dirTmpPlugin . DIRECTORY_SEPARATOR . $filename);
                Validator::notEmpty()->extension('zip')
                    ->size(NULL, PLUGINS_MAX_SIZE)
                    ->validate($dirTmpPlugin . DIRECTORY_SEPARATOR . $filename) || $errors['file'] = self::MSG_VALID_FILE;
            } else {
                $errors['error'] = self::MSG_ERROR_TECHNICAL_PLUGINS;
            }
        }

        return $errors;
    }
}