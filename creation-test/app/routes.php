<?php
//get
$app->post('/start/{ref}', 'StartController:index')->setName('api');

$app->get('/', 'HomeController:index')->setName('accueil');
$app->get('/logout', 'HomeController:logout')->setName('logout');
$app->get('/choosetheme', 'CreateTestController:index');
$app->get('/tests', 'AllTestsController:index')->setName('alltests');
$app->get('/citations', 'AllCitationsController:citationsToTable')->setName('alltcitations');
$app->get('/lang', 'LangController:index');
$app->get('/notifications', 'NotificationPushController:index');
$app->get('/tests/showmore', 'AllTestsController:showMoreTests')->setName('moretests');
$app->get('/results', 'AllResultsController:index');
$app->get('/tests/new/{theme}', 'CreateTestController:createTest');
$app->get('/tests/{test}/edit', 'CreateTestController:editTest');
$app->get('/test/{test}', 'TestController:index');
$app->get('/test/load/stats', 'LoadStatsController:loadStatDetail');

$app->get('/citations/new', 'CreateCitationController:createCitation');
$app->get('/citations/{citation}/edit', 'CreateCitationController:editCitation');

$app->get('/load/loadstatforthisrange', 'LoadStatsController:loadstatforthisrange');
$app->get('/load/loadTopTests', 'LoadStatsController:loadTopTests');
$app->get('/load/loadStatsForSomeTests', 'LoadStatsController:loadStatsForSomeTests');
$app->get('/load/loadBestTests', 'LoadStatsController:loadBestTests');
$app->get('/load/loadTopContries', 'LoadStatsController:loadTopContries');
$app->get('/load/loadTopUsers', 'LoadStatsController:loadTopUsers');
$app->get('/load/loadTestForUser', 'LoadStatsController:loadTestForUser');

$app->get('/cron/uds', 'CronController:updateDailyStat');
$app->get('/cron/udspt', 'CronController:updateDailyStatPerTest');
$app->get('/cron/uspr', 'CronController:updateStatPerResult');
$app->get('/cron/uws', 'CronController:updateWeeklyStat');

$app->get('/action/deleteTest', 'ActionTestController:DeleteTest');
$app->get('/action/deleteCitation', 'ActionTestController:DeleteCitation');
$app->get('/action/activeTest', 'ActionTestController:ActiveTest');
$app->get('/action/activeCitation', 'ActionTestController:ActiveCitation');
$app->get('/action/desactiveTest', 'ActionTestController:DesactiveTest');
$app->get('/action/desactiveCitation', 'ActionTestController:DesactiveCitation');
$app->get('/action/highlight', 'ActionTestController:HighlightTest');
$app->get('/action/moveHighlight', 'ActionTestController:RemoveHighlightTest');
$app->get('/action/deleteResult', 'ActionTestController:DeleteResultTest');
$app->get('/action/changeTheme', 'ActionTestController:ChangeThemeTest');
$app->get('/action/showmoreresults', 'ActionTestController:ShowMoreResult');
$app->get('/action/updatejsonalltests', 'JsonController:setTestsJSON');
$app->get('/action/updatejsonhighlightedtests', 'JsonController:setHighlightsJSON');


$app->get('/load/days', 'LoadStatsController:loadStatForDays');
$app->get('/load/linechart', 'LoadStatsController:lineChart');
$app->get('/load/days/cron', 'CronController:updateDailyGlobalStat');

$app->get('/config/lang/showUi', 'LangController:showUi');

$app->get('/maj/jsonlovedtests', 'JsonController:setLovedTestJSON');
$app->get('/maj/jsonhighlightedtests', 'JsonController:setHighlightsJSON');



//post
$app->post('/load/loadStatForThisTestForCountries', 'LoadStatsController:loadStatForThisTestForCountries');
$app->post('/setcookies', 'HomeController:createCookies');
$app->post('/tests/new/save', 'CreateTestController:addTest');
$app->post('/tests/edit/save', 'CreateTestController:updateTest');
$app->post('/tests/{test}/action/updateTestPerso', 'ActionTestController:UpdateTestPerso');
$app->post('/tests/{test}/action/loadCodeTestPersoLang', 'ActionTestController:loadCodeTestPersoLang');
$app->post('/tests/{test}/action/loadInfoTestLang', 'ActionTestController:loadInfoTestLang');
$app->post('/tests/new/grabImageForCropit', 'CreateTestController:grabImageForCropit');
$app->post('/tests/new/action/executephp', 'ActionTestController:ExecutePhpForPreviewTest');
$app->post('/tests/{test}/action/executephp', 'ActionTestController:ExecutePhpForPreviewTest');
$app->post('/tests/new/action/saveTestPerso', 'ActionTestController:SaveTestPerso');
$app->post('/tests/new/action/uploadImageThemePerso', 'ActionTestController:uploadImageThemePerso');
$app->post('/tests/{test}/action/uploadImageThemePerso', 'ActionTestController:uploadImageThemePerso');

$app->post('/citations/save', 'CreateCitationController:addCitation');
$app->post('/citations/edit/save', 'CreateCitationController:updateCitation');
$app->post('/citations/{citation}/edit/save', 'CreateCitationController:updateCitation');
$app->post('/citations/action/executephp', 'ActionTestController:ExecutePhpForPreviewTest');
$app->post('/citations/{citation}/action/executephp', 'ActionTestController:ExecutePhpForPreviewTest');
$app->post('/citations/action/uploadImageThemePerso', 'ActionTestController:uploadImageThemePerso');
$app->post('/citations/{citation}/action/uploadImageThemePerso', 'ActionTestController:uploadImageThemePerso');
$app->post('/citations/{citation}/action/loadInfoCitation', 'ActionTestController:loadInfoCitation');

$app->post('/config/lang/update', 'LangController:updateLangConfig');
$app->post('/config/lang/translations/update', 'LangController:updateTranslations');
$app->post('/config/lang/ui/add', 'LangController:addUi');

$app->post('/notification/send-campaign', 'NotificationPushController:sendCampaign');
$app->post('/notification/send-campaign-test', 'NotificationPushController:sendToAdmin');
$app->post('/notification/get-info-test', 'NotificationPushController:getInfoTest');
$app->post('/notification/save-stats-campaign', 'NotificationPushController:saveStatsCampaign');



// chunk and upgrade router
$app->get('/upgrade', 'ActionTestController:upgrade');
$app->get('/chunk', 'HomeController:chunk');
$app->get('/upgradelang', 'LangController:upgradeLang');
$app->get('/upgradejsonfile', 'LangController:UpgradeJsonFile');
$app->get('/chunk/jsonalltests', 'JsonController:setTestsJSON');
$app->get('/chunk/updatevar', 'HomeController:updateVarTestFile');
$app->get('/some/disable', 'HomeController:desableTestWhitFriends');
$app->get('/some/enable', 'HomeController:desableTestWhitFriends');
