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
        $datas = AuthFacade::getAllThemes($this->container);
        return $this->render($response, 'pages/themes.php', $datas);
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
        $datas = AuthFacade::getTheme($this->container, $args['name']);
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
        $datas = AuthFacade::getAllThemes($this->container);
        return $this->render($response, 'pages/themes.php', $datas);
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