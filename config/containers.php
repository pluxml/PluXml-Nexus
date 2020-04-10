<?php
/**
 * SLIM 4 PHP-DI container creation
 */
use Slim\Csrf\Guard;
use Slim\Views\PhpRenderer;
use Slim\Flash\Messages;
use App\Services\PdoService;
use App\Services\MailService;

/**
 * Services creation inside the SLIM 4 container
 *
 * router SLIM 4 named routes resolver
 * view SLIM4 PHP View
 * csrf SLIM 4 CSRF (Guard)
 * pdo instance of PdoService class
 * flash instance of SLIM 4 Messages library
 * mail instance of MailService wich use the PhpMailer library
 */
$container->set('router', function () use ($app) {
    return $app->getRouteCollector()->getRouteParser();
});

$container->set('csrf', function () use ($app) {
    $guard = new Guard($app->getResponseFactory());
    // $guard->setPersistentTokenMode(true);
    return $guard;
});

$container->set('view', function () use ($app) {
    $dir = dirname(__DIR__);
    $view = new PhpRenderer($dir . '/views');
    $view->setLayout("layout.php");
    return $view;
});

$container->set('pdo', function () {
    return new PdoService();
});

$container->set('flash', function () {
    return new Messages();
});

$container->set('mail', function () {
    return new MailService();
});