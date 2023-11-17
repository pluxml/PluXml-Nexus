<?php

namespace App\Controllers;

use App\Facades\AuthFacade;
use App\Facades\UsersFacade;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Class BackofficeUsersController
 * @package App\Controllers
 */
class BackofficeUsersController extends Controller
{
    const VIEW_BO_USERS = 'pages/backoffice/users.php';

    /**
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function showUsers(Request $request, Response $response): Response
    {
        $datas = [];
        $view = self::VIEW_BO_USERS;

        if (AuthFacade::isAdmin($this->container, $this->currentUser)) {
            $datas['title'] = 'Backoffice Ressources - PluXml.org';
            $datas['h2'] = 'Backoffice';
            $datas['h3'] = 'Users';
            $datas = array_merge($datas, UsersFacade::getAllProfilesWithAndWithoutPlugins($this->container));
        } else {
            $view = parent::VIEW_BO_USERS;
        }

        return $this->render($response, $view, $datas);
    }

    /**
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function removeUsers(Request $request, Response $response, array $args): Response
    {
        if (AuthFacade::isAdmin($this->container, $this->currentUser)) {
            UsersFacade::removeUser($this->container, $args['username']);
        }
        return $this->redirect($response, self::NAMED_ROUTE_BACKOFFICE, $args);

    }
}
