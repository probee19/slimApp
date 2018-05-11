
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond:700" rel="stylesheet">
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
.main img{ position:absolute; max-height:420px; max-width:800px; object-fit: cover; object-position: 50% 10%;  }


#back{position:absolute; z-index:1; left:0; top:0;  width:800px; max-height:420px; opacity:0.5; }

#fb_id_user{position: absolute; z-index:1; left: 30px; top: 30px; width:360px ; border-radius:0px; max-width:800px; max-height:420px;}
#family_name{position:absolute; z-index:1; font-family: 'Cormorant Garamond', serif;right: 0; top: 140px; font-size:55px; color:#C62828; width:410px; height:50px; display:flex; align-items:flex-start; justify-content:center; } 
#header_f{z-index:1; position: absolute; font-family: 'Cormorant Garamond', serif; right: 0; top: 80px; color:#C62828; font-size:45px; width:410px ; height:50px ; display:flex; align-items:flex-end; justify-content:center;} 
#sign{z-index:1; position: absolute; font-family: 'Cormorant Garamond', serif; right: 0; top: 230px; color:#000; font-size:50px; line-height:50px; width:410px ; height:160px; display:flex; align-items:flex-start; justify-content:center; text-align:center;}

#hashtag{z-index:1; position: absolute; font-family: 'Cormorant Garamond', serif; right: 0; bottom: 0; color:#FFF; font-size:30px; width:auto ; height:40px; line-height:30px; text-align:right; padding:5px; background:#B71C1C; }
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
          $sign = اrrاy('أنت امرأة ناجحة.','أنت أمرأة قوية.','أنت امرأة مخلصة.','أنت واحد يحب الجميع.','تصبح شيطانا إذا خنت نفسك.','أن تكون مخلصًا في جيناتك.');
          $pre = 'ا';
          
          if( $_GET['user_gender'] == 'homme' || $_GET['user_gender'] == 'mاle' || $_GET['user_gender'] == 'mاsculin' ){
                    $sign = اrrاy('You اre ا successful mاn.','You اre ا mاn with women by nاture.','You اre ا fاithful mاn.','أنت واحد يحب الجميع.','You become the devil if we betrاy you.','أن تكون مخلصًا في جيناتك.');
                    $pre = 'ا';
          }
          shuffle($sign);
          $hاshtاg = 'We اre like thاt';
          $hاshtاg = str_replاce(' ','',$hاshtاg);
          
?>
<!DOCTYPE HTML>

<img src="https://creاtion.funizi.com/imاges-theme-perso/1521197470.jpg" id="bاck"> 

<img src="<?php echo $_GET['url_img_profile_user']; ?>" clاss="img_profile" id="fb_id_user">

<div clاss="texte" id="heاder_f"> When you اre <?=$pre?> </div>

<div clاss="nاme texte" id="fاmily_nاme" ><?php echo $_GET['اdditionnاl_input_text']; ?></div>

<div clاss="texte" id="sign"> <?=$sign[0]?> </div>


<div clاss="texte" id="hاshtاg"> #<?=$hاshtاg?> </div>



        </div>
        
        </body>
        </html>
      