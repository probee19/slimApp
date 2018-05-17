
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <!-- Ces lignes seront placées entre les balises HEAD de la page à capturer -->
              <title>Theme 4</title>
              <style>
                  body{font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;}
                  .main{
                      padding:0;
                      margin:0;
                      width: 800px;
                      height:420px;
                      position: relative;
                      overflow: hidden;
                  }
              .texte2{
                width: 200px;
              }
              .main{ padding:0;margin:0;width: 800px;height:420px;position: relative;overflow: hidden; background: #FFF;}
.main img{ position:absolute; max-height:420px; max-width:800px; }
#background{position:absolute; z-index:2; left:0; top:0;  max-width:800px; max-height:420px; }
#fb_id_user{position: absolute; z-index:1; left: 86px; top: 6px; width:60px ; border-radius:0px; max-width:800px; max-height:420px;}
#name_user{position:absolute; z-index:2; left: 150px; top: 0px; font-size:30px; color:#425B9B;} 
#statut{position:absolute; z-index:2; left: 86px; top: 70px; font-size:22px; color:#000;} 
#like{position:absolute; z-index:3; left: 120px; top: 193px; font-size:17px; color:#455A85; font-weight:400;} 
              </style>
              <script src='../../../src/js/jquery.js'></script>
              <script>
                  $(document).ready(function(){
                var autoSizeText;
                autoSizeText = function() {
                  var el, elements, _i, _len, _results;
                  elements = $('.texte2');
                  console.log(elements);
                  if (elements.length < 0) {
                    return;
                  }
                  _results = [];
                  for (_i = 0, _len = elements.length; _i < _len; _i++) {
                    el = elements[_i];
                    _results.push((function(el) {
                      var resizeText, _results1;
                      resizeText = function() {
                        var elNewFontSize;
                        elNewFontSize = (parseInt($(el).css('font-size').slice(0, -2)) - 1) + 'px';
                        return $(el).css('font-size', elNewFontSize);
                      };
                      _results1 = [];
                      while (el.scrollHeight > el.offsetHeight) {
                        _results1.push(resizeText());
                      }
                      return _results1;
                    })(el));
                  }
                  return _results;
                };
                autoSizeText();
                  //JavaScript

                  });
              </script>
          </head>
          <body style='width: 800px; height:420px; margin:0; padding:0; overflow: hidden;'>
          <div class='main'>
      
<?php
$message_1 = array('Wer hat Babykleidung?<br> Wir warten auf kleine Zwillinge !!! :)', 'Mama, Papa, ich muss leider verkünden, dass Sie GROSSELTERN sein werden!');
$message_2 = array('Was !!!!:)','Ich habe etwas vermutet! <3 Herzliche Glückwünsche!');
$message_3 = array('Herzlichen Glückwunsch an Sie 2 !!! ich kann es nicht glauben','Es ist gut, es ist bestätigt? Du wirst wunderbare Eltern machen!');
$date = array('22. Dezember um 22:53 Uhr','11. März um 20.03 Uhr','13. Juni um 21:43 Uhr');shuffle($date);
$max_key = 1; $key = mt_rand(0,$max_key); setlocale(LC_ALL, 'fr_FR'); $min_1 = mt_rand(10,32); $min_2 = $min_1 + 11; $min_3 = $min_1 + 17;
            ?>
<img src="http://creation.funizi.com/images-theme-perso/1508635181.png" id="background"> 
<img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="fb_id_user">
<div class="name texte" id="name_user" ><?php echo urldecode($_GET['full_user_name']); ?></div>
<div class="" id="date" style="position:absolute; z-index:2; left: 150px; top: 40px;font-size:15px; color:#999"  ><?php echo $date[0]; ?></div>
<div  id="statut"><?php echo $message_1[$key]; ?></div>
<div  id="like">Toi, <?php echo substr(urldecode($_GET['friend_name_1']), 0, strpos(urldecode($_GET['friend_name_1']), ' ')); ?>, <?php echo substr(urldecode($_GET['friend_name_2']), 0, strpos(urldecode($_GET['friend_name_2']), ' ')); ?>  et 364 autres</div>
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_3']; ?>/picture/?width=275&height=275" class="img_profile" style="position:absolute; left:86px; top:237px; z-index:1; width:48px">
<div style="position:absolute; left:146px; top:242px; z-index:2; width:48px; color:#425B9B; font-size:17px; width:300px;"><?php echo urldecode($_GET['friend_name_3']); ?></div>
<div  style="position:absolute; left:146px; top:262px; z-index:2; width:48px; color:#000; font-size:16px; width:450px;" id="comment1"><?php echo $message_2[$key]; ?></div>
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_4']; ?>/picture/?width=275&height=275" class="img_profile" style="position:absolute; left:86px; top:318px; z-index:1; width:48px">
<div style="position:absolute; left:146px; top:323px; z-index:2; width:48px; color:#425B9B; font-size:17px; width:200px;"><?php echo urldecode($_GET['friend_name_4']); ?></div>
<div  style="position:absolute; left:146px; top:343px; z-index:2; width:48px; color:#000; font-size:16px; width:450px;" id="comment2"> <?php echo $message_3[$key]; ?></div>

        </div>
        <!-- Ces lignes seront placées dans le footer de la page à capturer -->
        </body>
        </html>
      