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
     * @return Response
     */
    public function show(Request $request, Response $response)
    {
        $pluginModel = new PluginsModel($this->container);

        $datas['title'] = 'Ressources - PluXml.org';
        $datas['activeTab'] = 1;

        // View call
        return $this->render($response, 'pages/home.php', $datas);
    }
}
?>