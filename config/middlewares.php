<?php
/**
 * SLIM4 middleware creation
 */
use App\Middlewares\FormOldValuesMiddleware;
use App\Middlewares\CsrfTokenMiddleware;
use App\Middlewares\RouterViewMiddleware;

// Get services from PHP-DI container
$viewService = $container->get('view');
$csrfService = $container->get('csrf');
$routerService = $container->get('router');

/**
 * Middleware creation
 * The last to be added is the first to be executed
 *
 * FormOldValuesMiddleware store in $_SESSION the form values
 * CsrfTokenMiddleware SLIM 4 CSRF tokens generation
 * csrf SLIM 4 CSRF engine add from PHP-DI container
 */
$app->add(new FormOldValuesMiddleware($viewService));
$app->add(new RouterViewMiddleware($viewService, $routerService));
$app->add(new CsrfTokenMiddleware($viewService, $csrfService));
$app->add('csrf');

// SLIM4 ErrorMiddleware
$app->addErrorMiddleware(true, false, false);