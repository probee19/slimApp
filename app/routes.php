<?php
// Get links
$app->get('/', 'HomeController:index')->setName('accueil');
$app->get('/uds', 'DailyStatsController:index');
$app->get('/dev', 'HomeController:devEnv')->setName('dev');
$app->get('/games', 'HomeController:games')->setName('games');
$app->get('/discover', 'RubriqueController:discover')->setName('discover');
$app->get('/quizz', 'PlayBuzzController:index');
$app->get('/quizz/page/{pageid}', 'PlayBuzzController:index');
$app->get('/quizz/{name}/{id}', 'PlayBuzzController:onePlaybuzz')->setName('singleplaybuzz');
$app->get('/privacy-policy', 'HomeController:privacyPolicy')->setName('privacypolicy');
$app->get('/page/{pageid}', 'HomeController:index')->setName('paginatation');
$app->get('/test/{name}/{id}', 'TestController:index')->setName('single');
$app->get('/citation/{name}/{id}', 'CitationsController:oneQuote')->setName('singlecitation');
$app->get('/citations', 'CitationsController:index')->setName('citations');
$app->get('/citations/ref/{id}', 'CitationsController:index')->setName('sharedcitation');
$app->get('/citations/page/{pageid}', 'CitationsController:index');
$app->get('/test/{name}/{id}/{from}', 'TestController:index')->setName('singledis');
$app->get('/test/{name}/{id}/ref/{code}', 'TestController:index')->setName('shareduri');
//$app->get('/start', 'StartController:index')->setName('start');
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
$app->get('/start/1/{id}', 'AdditionnalInfoController:index');
$app->get('/get-notification', 'NotificationPushController:getNotification');
$app->get('/devsystemi', 'DevtestController:uploadToS3');
$app->get('/phantomtest', 'DevtestController:phantomTest');

//Thum.io
$app->get('/thumcallback/{code}', 'StartController:thumCallBack');


//post links
$app->post('/login', 'HomeController:login')->setName('login');
$app->post('/share/{btn}', 'ShareController:index');
$app->post('/share/{btn}/{lang}', 'ShareController:index');
$app->post('/shareCitation/{btn}', 'ShareController:shareQuote');
$app->post('/shareCitation/{btn}/{lang}', 'ShareController:shareQuote');
$app->post('/grabimage', 'GrabzitController:getImageFromUrl');
$app->post('/setsession', 'HomeController:createSession');
$app->post('/connect_user', 'ConnectController:index');
$app->post('/setSessionVar', 'HomeController:setSessionVar');
$app->post('/setSessionVarCDM', 'HomeController:setSessionVarCDM');
$app->post('/register-to-notification', 'NotificationPushController:registerToNotification');
$app->post('/save-error-notification', 'NotificationPushController:saveErrorNotification');
$app->post('/save-subscription-to-newsletter', 'HomeController:saveSubNewsletter');


// chunk
$app->get('/chunk/data', 'HomeController:chunkData');
$app->get('/json', 'HomeController:setTestsJSON');
$app->get('/chunk/{name}/{id}', 'HomeController:chunk');
$app->get('/chunkresult/{name}/{code}', 'HomeController:chunk');
$app->get('/chunkstart/{ref}', 'StartController:indexChunk');
$app->get('/chunktest/{name}/{id}', 'TestController:indexChunk');
$app->get('/chunktest/{name}/{id}/ref/{code}', 'TestController:indexChunk');
$app->get('/chunkconnect_user2', 'ConnectController:connexionForTestChunk');
$app->get('/chunkconnect_user_test', 'ConnectController:testChunk');
//$app->get('/chunk/{name}/{id}', 'HomeController:chunk');
//$app->get('/chunk/{method}', 'HomeController:chunk');
//$app->post('/chunk/loadMore/{bloc}', 'HomeController:chunk2');
//$app->get('/chunk/page/{pageid}', 'HomeController:chunk');
//$app->get('/chunk/{name}/{id}', 'HomeController:chunk');
