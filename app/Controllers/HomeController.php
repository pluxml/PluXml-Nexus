<?php
/**
 * PagesController
 */
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Respect\Validation\Validator;
use App\Models\PluginsModel;

class HomeController extends Controller
{

    /**
     *
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function show(Request $request, Response $response)
    {
        $pluginModel = new PluginsModel($this->container);

        $datas['title'] = 'Ressources - PluXml.org';
        $datas['plugins'] = $pluginModel->plugins;

        // View call
        return $this->render($response, 'pages/home.php', $datas);
    }

    /**
     *
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function testPost(Request $request, Response $response)
    {
        $errors = [];
        $post = $request->getParsedBody();
        Validator::notEmpty()->alnum()
            ->noWhitespace()
            ->length(1, 100)
            ->validate($post['name']) || $errors['name'] = 'name invalide';
        Validator::notEmpty()->validate($post['email']) || $errors['email'] = 'email can not be null';
        if (empty($errors)) {
            $this->messageService->addMessage('success', 'Message de succès');
            $status = 302;
        } else {
            $this->messageService->addMessage('error', 'Message d\'erreur');
            foreach ($errors as $key => $message) {
                $this->messageService->addMessage('error', $message);
            }
            $status = 400;
        }
        return $this->redirect($response, 'test', $status);
    }
}
?>