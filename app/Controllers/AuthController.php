<?php
/**
 * AuthController
 */
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Facades\AuthFacade;
use Respect\Validation\Validator;
use App\Facades\UsersFacade;

class AuthController extends Controller
{

    private const NAMED_ROUTE_HOME = 'homepage';

    private const NAMED_ROUTE_AUTH = 'auth';

    private const NAMED_ROUTE_SIGNUP = 'signup';

    private const NAMED_ROUTE_BACKOFFICE = 'backoffice';

    private const PAGE_AUTH = 'pages/backoffice/auth.php';

    private const PAGE_SIGNUP = 'pages/backoffice/signup.php';

    private const MSG_ERROR = 'Wrong username or password';

    private const MSG_LOGOUT = 'Log out successful';

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
            $response = $this->render($response, self::PAGE_AUTH);
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
    public function showSignup(Request $request, Response $response)
    {
        if (AuthFacade::isLogged()) {
            $response = $this->redirect($response, self::NAMED_ROUTE_BACKOFFICE);
        } else {
            $response = $this->render($response, self::PAGE_SIGNUP);
        }

        return $response;
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

    /**
     *
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function signup(Request $request, Response $response)
    {
        $errors = [];
        $namedRoute = self::NAMED_ROUTE_SIGNUP;
        $post = $request->getParsedBody();

        Validator::notEmpty()->noWhitespace()
            ->alnum()
            ->length(1, 99)
            ->validate($post['username']) || $errors['username'] = 'Must be alphanumeric with no whitespace';
        Validator::notEmpty()->length(1, 99)->validate($post['password']) || $errors['password'] = 'Lengh must be inferior to 100 characters';
        Validator::notEmpty()->equals($post['password'])->validate($post['password2']) || $errors['password2'] = 'Password does not match';
        Validator::notEmpty()->email()->validate($post['email']) || $errors['email'] = 'Invalid email address';
        Validator::url()->length(1, 99)->validate($post['website']) || $errors['website'] = 'Invalid url';

        if (empty($errors)) {
            if (UsersFacade::addUser($this->container, $post)) {
                $this->messageService->addMessage('success', 'Signup successful, please confirm your email address to be able to login');
                $namedRoute = self::NAMED_ROUTE_AUTH;
            }
            else {
                $this->messageService->addMessage('error', 'Signup technical error');
            }
        } else {
            $this->messageService->addMessage('error', 'Signup error, please see below');
            foreach ($errors as $key => $message) {
                $this->messageService->addMessage($key, $message);
            }
        }

        return $this->redirect($response, $namedRoute);
    }
}