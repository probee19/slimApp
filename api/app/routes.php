<?php

//$app->get('/start/{ref}', 'StartController:index');
// GET
$app->get('/', 'HomeController:index');
$app->get('/chunk', 'HomeController:index');
$app->get('/footbot', 'FootBotController:index');
$app->get('/share/footbot', 'ShareApiController:index');




// POST
$app->post('/start/{ref}', 'StartController:index');
$app->post('/match', 'HomeController:createPicMatch');
$app->get('/gameday', 'HomeController:createGameDays');
