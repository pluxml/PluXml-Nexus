<?php
/**
 * PagesController
 */
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Respect\Validation\Validator;
use App\Models\TestModel;

class PagesController extends Controller
{

    /**
     *
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function show(Request $request, Response $response)
    {
        return $this->render($response, 'pages/home.php', [
            "title" => "Hello - My App"
        ]);
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

    /**
     *
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function test(Request $request, Response $response)
    {
        // Model instance with a DB SQL request
        $test = new TestModel($this->container);
        // Store the result into the "datas" array for the view
        $datas['result'] = $test->test;
        // View call
        return $this->render($response, 'pages/test.php', $datas);
    }
}
?>