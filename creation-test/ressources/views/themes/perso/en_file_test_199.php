
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Merienda:700|Raleway:700" rel="stylesheet">
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
#fb_id_user{position: absolute; z-index:1; left: 80px; top: 116px; width:190px ; border-radius:100px; max-width:800px; max-height:420px;}
#name_user{position:absolute; z-index:2; left: 420px; width:360px; top: 50px; font-size:30px; color:#FFBF00; text-align:center; font-family: 'Raleway', sans-serif;} 
#nouvelle{position:absolute; z-index:2; left: 400px; width:400px; top: 150px; font-size:40px; color:#FFF; text-align:center; line-height:50px;font-family: 'Merienda', cursive;} 
#nouvelle_bottom{position:absolute; z-index:2; left: 420px; width:360px; bottom: 50px; font-size:30px; color:#FFBF00;line-height:30px; text-align:center; font-family: 'Raleway', sans-serif;} 

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

        
                $message_1 = array('"New encounters"','"Serenity"','"The wealth"','"Projects"','"Renewal"');
                $message_2 = array('You will never be alone.','You will find inner peace!','Your bank account will thank you.','Seize the opportunities!','You will not leave anything to chance!');
            //    $message_3 = array('Il est trop mystérieux...', 'C\'est vrai. C\'est une vrai star', ' S\'il y\'a un VIP dans notre groupe, c\'est bien '.$_GET['user_name'].' !','Il y\'a des gens qui me demandent s\'il est célibataire',' Il est de plus en plus mystérieux...','Personne ne pouvait le quitter des yeux. Une vraie star.');
           
            $max_key = 4; $key = mt_rand(0,$max_key); setlocale(LC_ALL, 'fr_FR'); $min_1 = mt_rand(10,32); $min_2 = $min_1 + 11; $min_3 = $min_1 + 17;
            ?>
<img src="http://creation.funizi.com/images-theme-perso/1509666315.png" id="background">
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
<div class="name texte" id="name_user" >The year of<?php echo $_GET['user_name']; ?> :</div>
<div class="" id="nouvelle" ><?php echo $message_1[$key]; ?></div>
<div class="" id="nouvelle_bottom" ><?php echo $message_2[$key]; ?></div>

        </div>
        
        </body>
        </html>
      