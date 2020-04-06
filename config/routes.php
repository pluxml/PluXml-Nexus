<?php
/**
 * SLIM4 routes creation
 */
use App\Controllers\HomeController;
use App\Controllers\PluginsController;
use App\Controllers\ProfilesController;
use App\Controllers\ThemesController;

$app->get('/', HomeController::class . ':show')->setName('homepage');

$app->get('/plugins', PluginsController::class . ':show')->setName('plugins');
$app->get('/plugins/{name}', PluginsController::class . ':showPlugin');

$app->get('/themes', ThemesController::class . ':show')->setName('themes');
$app->get('/themes/{name}', ThemesController::class . ':showTheme');

$app->get('/profiles', ProfilesController::class . ':show')->setName('profiles');
$app->get('/profiles/{username}', ProfilesController::class . ':showProfile');


//$app->get('/test', PagesController::class . ':test')->setName('test');
//$app->post('/test', PagesController::class . ':testPost');