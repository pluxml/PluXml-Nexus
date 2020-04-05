<?php
/**
 * SLIM4 routes creation
 */
use App\Controllers\HomeController;
use App\Controllers\PluginsController;

$app->get('/', HomeController::class . ':show')->setName('homepage');
$app->get('/plugins', PluginsController::class . ':show');
$app->get('/plugins/{pluginName}', PluginsController::class . ':showPlugin');
//$app->get('/test', PagesController::class . ':test')->setName('test');
//$app->post('/test', PagesController::class . ':testPost');