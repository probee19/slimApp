<?php

//$app->get('/start/{ref}', 'StartController:index');
$app->get('/', 'ClickController:index');
$app->get('/chunk', 'HomeController:index');
$app->post('/start/{ref}', 'StartController:index');
$app->post('/match', 'HomeController:createPicMatch');
