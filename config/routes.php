<?php
/**
 * SLIM4 routes creation
 */
use App\Controllers\PagesController;

$app->get('/', PagesController::class . ':show');
$app->get('/test', PagesController::class . ':test')->setName('test');
$app->post('/test', PagesController::class . ':testPost');