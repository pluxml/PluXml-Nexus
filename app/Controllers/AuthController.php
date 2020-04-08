<?php
/**
 * AuthController
 */
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Facades\AuthFacade;

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
        $post = $request->getParsedBody();
        $namedRoute = 'auth';

        if (! empty($post['username']) and ! empty($post['password'])) {
            $result = AuthFacade::authentificateUser($this->container, $post['username'], $post['password']);
            if (! $result) {
                $this->messageService->addMessage('error', 'Wrong username or password');
            } else {
                $namedRoute = 'backoffice';
            }
        } else {
            $this->messageService->addMessage('error', 'Username and password are required');
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