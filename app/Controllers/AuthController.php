<?php
/**
 * AuthController
 */
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Facades\AuthFacade;
use Respect\Validation\Validator;

class AuthController extends Controller
{

    /**
     *
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function showAuth(Request $request, Response $response)
    {
        return $this->render($response, 'pages/backoffice/auth.php', $datas);
    }

    /**
     *
     * @param Request $request
     * @param Response $response
     * @param Array $args
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function showSignup(Request $request, Response $response, $args)
    {
        // $datas = AuthFacade::getTheme($this->container, $args['name']);
        return $this->render($response, 'pages/theme.php', $datas);
    }

    /**
     *
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function login(Request $request, Response $response)
    {
        $namedRoute = 'auth';
        $msg = 'Wrong username or password';
        $post = $request->getParsedBody();

        $validUsername = Validator::notEmpty()->alnum()
            ->noWhitespace()
            ->validate($post['username']);
        $validPassword = Validator::notEmpty()->validate($post['password']);

        if ($validUsername and $validPassword) {
            $result = AuthFacade::authentificateUser($this->container, $post['username'], $post['password']);
            if (! $result) {
                $this->messageService->addMessage('error', $msg);
            } else {
                $namedRoute = 'backoffice';
            }
        } else {
            $this->messageService->addMessage('error', $msg);
        }

        return $this->redirect($response, $namedRoute);
    }

    /**
     *
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function logout(Request $request, Response $response)
    {
        $datas = AuthFacade::getAllThemes($this->container);
        return $this->render($response, 'pages/themes.php', $datas);
    }
}