<?php

namespace App\Controllers;

use App\Facades\UsersFacade;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Respect\Validation\Validator;

/**
 * Class BackofficeProfileController
 * @package App\Controllers
 */
class BackofficeProfileController extends Controller
{
    private const MSG_SUCCESS_EDITPROFILE = 'Profile updated with success.';
    private const MSG_ERROR_EDITPROFILE = 'Profile can not be updated, see errors below.';
    private const MSG_ERROR_EDITPROFILE_PASSWORD = 'Current password incorrect or new passwords do not match';

    /**
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function showEditProfile(Request $request, Response $response): Response
    {
        $datas = array();
        $datas['title'] = 'Backoffice Ressources - PluXml.org';
        $datas['h2'] = 'Backoffice';
        $datas['h3'] = 'My profile';
        $datas = array_merge($datas, UsersFacade::getProfile($this->container, $this->currentUser));

        return $this->render($response, 'pages/backoffice/editProfile.php', $datas);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return Response
     */
    public function edit(Request $request, Response $response, $args): Response
    {
        $namedRoute = self::NAMED_ROUTE_BACKOFFICE;
        $post = $request->getParsedBody();
        $errors = array();

        Validator::notEmpty()->email()->validate($post['email']) || $errors['email'] = self::MSG_VALID_EMAIL;
        Validator::url()->length(1, 99)->validate($post['website']) || $errors['website'] = self::MSG_VALID_URL;

        if (empty($errors)) {
            if (UsersFacade::editUser($this->container, $post)) {
                $this->messageService->addMessage('success', self::MSG_SUCCESS_EDITPROFILE);
                $namedRoute = self::NAMED_ROUTE_BACKOFFICE;
            } else {
                $this->messageService->addMessage('error', self::MSG_ERROR_TECHNICAL);
            }
        } else {
            $this->messageService->addMessage('error', self::MSG_ERROR_EDITPROFILE);
            foreach ($errors as $key => $message) {
                $this->messageService->addMessage($key, $message);
            }
        }

        return $this->redirect($response, $namedRoute, $args);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return Response
     */
    public function password(Request $request, Response $response, $args): Response
    {
        $namedRoute = self::NAMED_ROUTE_BACKOFFICE;
        $post = $request->getParsedBody();

        if (UsersFacade::changeUserPassword($this->container, $post)) {
            $this->messageService->addMessage('success', self::MSG_SUCCESS_EDITPROFILE);
        }
        else {
            $this->messageService->addMessage('error', self::MSG_ERROR_EDITPROFILE_PASSWORD);
            $namedRoute = self::NAMED_ROUTE_BACKOFFICE_PROFILE;
        }

        return $this->redirect($response, $namedRoute, $args);
    }
}
