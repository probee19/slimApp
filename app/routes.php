<?php
// Get links
$app->get('/', 'HomeController:index')->setName('accueil');
$app->get('/uds', 'DailyStatsController:index');
$app->get('/dev', 'HomeController:devEnv')->setName('dev');
$app->get('/privacy-policy', 'HomeController:privacyPolicy')->setName('privacypolicy');
$app->get('/page/{pageid}', 'HomeController:index')->setName('paginatation');
$app->get('/test/{name}/{id}', 'TestController:index')->setName('single');
$app->get('/test/{name}/{id}/{from}', 'TestController:index')->setName('singledis');
$app->get('/test/{name}/{id}/ref/{code}', 'TestController:index')->setName('shareduri');
$app->get('/start', 'StartController:index')->setName('start');
$app->get('/start/{ref}', 'StartController:index')->setName('startlang');
$app->get('/grabzit/{theme}/{fb_id}/{name}/{title}/{img_url}', 'GrabzitController:index')->setName('grabzit');
$app->get('/result/{name}/{code}', 'ResultController:index')->setName('resultat');
$app->get('/resultat/{code}', 'ResultController:index')->setName('result');
$app->get('/result/{name}/{code}/{new}', 'ResultController:index')->setName('has_shared');
$app->get('/logout', 'HomeController:logout')->setName('logout');
$app->get('/connect_user2', 'ConnectController:connexionForTest');
$app->get('/connect_user_test', 'ConnectController:test');
$app->get('/click/{btn}', 'ClickController:index');
$app->get('/rubrique/{name}/{rubrique}', 'RubriqueController:index');
$app->get('/rubrique/{name}/{rubrique}/page/{pageid}', 'RubriqueController:index');

//post links
$app->post('/login', 'HomeController:login')->setName('login');
$app->post('/share/{btn}', 'ShareController:index');
$app->post('/share/{btn}/{lang}', 'ShareController:index');
$app->post('/grabimage', 'GrabzitController:getImageFromUrl');
$app->post('/setsession', 'HomeController:createSession');
$app->post('/connect_user', 'ConnectController:index');
$app->post('/chunk/loadMore/{bloc}', 'HomeController:chunk2');



// chunk
$app->get('/json', 'HomeController:setTestsJSON');
$app->get('/chunk', 'HomeController:chunk');
$app->get('/chunk/page/{pageid}', 'HomeController:chunk');
//$app->get('/chunk/{name}/{id}', 'HomeController:chunk');
