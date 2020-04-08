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

    const NAMED_ROUTE_HOME = 'homepage';

    const NAMED_ROUTE_AUTH = 'auth';

    const NAMED_ROUTE_BACKOFFICE = 'backoffice';

    const PAGE_AUTH = 'pages/backoffice/auth.php';

    const PAGE_SIGNUP = 'pages/signup.php';

    const MSG_ERROR = 'Wrong username or password';
    
    const MSG_LOGOUT = 'Log out successful';

    /**
     *
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function showAuth(Request $request, Response $response)
    {
        if (AuthFacade::isLogged()) {
            $response = $this->redirect($response, self::NAMED_ROUTE_BACKOFFICE);
        } else {
            $response = $this->render($response, self::PAGE_AUTH, $datas);
        }

        return $response;
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
        return $this->render($response, self::PAGE_SIGNUP, $datas);
    }

    /**
     *
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function login(Request $request, Response $response)
    {
        $namedRoute = self::NAMED_ROUTE_AUTH;
        $post = $request->getParsedBody();

        $validUsername = Validator::notEmpty()->alnum()
            ->noWhitespace()
            ->validate($post['username']);
        $validPassword = Validator::notEmpty()->validate($post['password']);

        if ($validUsername and $validPassword) {
            $result = AuthFacade::authentificateUser($this->container, $post['username'], $post['password']);
            if (! $result) {
                $this->messageService->addMessage('error', self::MSG_ERROR);
            } else {
                $namedRoute = self::NAMED_ROUTE_BACKOFFICE;
            }
        } else {
            $this->messageService->addMessage('error', self::MSG_ERROR);
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
        AuthFacade::logout();
        $this->messageService->addMessage('success', 'Logout successful');
        return $this->redirect($response, self::NAMED_ROUTE_HOME);
    }
}