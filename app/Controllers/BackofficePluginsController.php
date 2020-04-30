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

    private const MSG_ERROR_TECHNICAL = 'Technical error';

    /**
     *
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function show(Request $request, Response $response)
    {
        $datas['title'] = 'Backoffice Ressources - PluXml.org';
        $datas['h1'] = 'Backoffice';
        $datas['h2'] = 'Plugins';
        $datas += PluginsFacade::getAllPlugins($this->container, $this->currentUser);

        return $this->render($response, 'pages/backoffice/plugins.php', $datas);
    }

    /**
     *
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
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
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function showAddPlugin(Request $request, Response $response)
    {
        $datas['title'] = 'Backoffice Ressources - PluXml.org';
        $datas['h1'] = 'Backoffice';
        $datas['h2'] = 'Add a plugin';

        return $this->render($response, 'pages/backoffice/addPlugin.php', $datas);
    }

    /**
     *
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function edit(Request $request, Response $response, $args)
    {
        $errors = [];
        $namedRoute = self::NAMED_ROUTE_BOEDITPLUGIN;
        $post = $request->getParsedBody();

        Validator::alnum(' ')->length(1, 249)->validate($post['description']) || $errors['description'] = self::MSG_VALID_TOLONG250;
        Validator::alnum('.', ',', '-', '_')->length(1, 99)->validate($post['versionPlugin']) || $errors['versionPlugin'] = self::MSG_VALID_TOLONG100;
        Validator::alnum('.')->length(1, 99)->validate($post['versionPluxml']) || $errors['versionPluxml'] = self::MSG_VALID_TOLONG100;
        Validator::url()->length(1, 99)->validate($post['link']) || $errors['link'] = self::MSG_VALID_URL;

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
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function save(Request $request, Response $response)
    {
        $errors = [];
        $namedRoute = self::NAMED_ROUTE_SAVEPLUGIN;
        $post = $request->getParsedBody();
        $uploadedFiles = $request->getUploadedFiles();

        $uploadedFile = $uploadedFiles['file'];
        if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
            $filename = PluginsFacade::moveUploadedFile($_SERVER['DOCUMENT_ROOT'] . DIR_TMP, $uploadedFiles['file']);
        }

        Validator::notEmpty()->alnum()
            ->noWhitespace()
            ->length(1, 99)
            ->validate($post['name']) || $errors['name'] = self::MSG_VALID_NAME;
        Validator::alnum(' ')->length(1, 249)->validate($post['description']) || $errors['description'] = self::MSG_VALID_TOLONG250;
        Validator::alnum('.', ',', '-', '_')->length(1, 99)->validate($post['versionPlugin']) || $errors['versionPlugin'] = self::MSG_VALID_TOLONG100;
        Validator::alnum('.')->length(1, 99)->validate($post['versionPluxml']) || $errors['versionPluxml'] = self::MSG_VALID_TOLONG100;
        Validator::url()->length(1, 99)->validate($post['link']) || $errors['link'] = self::MSG_VALID_URL;
        Validator::notEmpty()->extension('zip')
            ->size(NULL, '10MB')
            ->validate($_SERVER['DOCUMENT_ROOT'] . DIR_TMP . '/' . $filename) || $errors['file'] = self::MSG_VALID_FILE;

        if (empty($errors)) {
            // TODO verify if plugin already exist
            if (PluginsFacade::savePlugin($this->container, $post)) {
                //TODO move tmp file to plugins folder
                //TODO rename uploaded file by $post['name']
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

        return $this->redirect($response, $namedRoute);
    }
}
?>