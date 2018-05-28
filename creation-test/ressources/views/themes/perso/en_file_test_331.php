
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Kalam|Sacramento" rel="stylesheet">
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

#back{position:absolute; z-index:1; left:0; top:0;  }
#caractere{z-index:1; font-family: 'Kalam', cursive; position: absolute; left: 50px; bottom: 30px; color:#FFF; font-size:33px; line-height:48px; width:700px ; height:310px ; display:flex; align-items:center; justify-content:center; text-align:center;  }
.overlay{position:absolute; z-index:1; left:0; top:0; width:800px; height:420px; background:#000; opacity:0.5;}

#name_user{position:absolute; z-index:1; left: 0; top: 30px;font-family: 'Sacramento', cursive; font-size:50px; line-height:50px; text-align:center; width:800px; height:40px; color:#FFF;} 
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
          if( $_GET['user_gender'] == 'homme' || $_GET['user_gender'] == 'male' || $_GET['user_gender'] == 'masculin' ){
                    $caracteres = array('Trust and loyalty are important for '.urldecode($_GET['user_name']).'. The world has not always helped him, but his positive outlook allowed him to get through the bad times. He is ambitious and loves all that life has to offer.',
                    'Life has not always been easy with '.urldecode($_GET['user_name']).', But that has never stopped her from reaching her dreams. He is ambitious, loyal and inspiring with everyone around him. He continues to live his life fully and loves challenges.',
                    'Trust and loyalty describe well '.urldecode($_GET['user_name']).'. Life was sometimes harsh but her strong and determined nature allowed her to go through difficult times. No one can stop him from reaching his dreams, and his attitude inspires others to do the same.',
                    ''.urldecode($_GET['user_name']).' love life! Although he had stockings, he remains a strong and loyal person. He is honest and ambitious, and reaches his dreams day after day. He never loses sight of who he really is!');
          }
          else{
                    $caracteres = array('Trust and loyalty are important for '.urldecode($_GET['user_name']).'. The world has not always helped her, but her positive outlook has allowed her to get through the bad times. She is ambitious and loves all that life has to offer.',
                    'Life has not always been easy with '.urldecode($_GET['user_name']).', But that has never stopped her from reaching her dreams. She is ambitious, loyal and inspires everyone around her. She continues to live a full life and loves challenges.',
                    'Trust and loyalty describe well '.urldecode($_GET['user_name']).'. Life was sometimes harsh but her strong and determined nature allowed her to go through difficult times. No one can stop him from reaching his dreams, and his attitude inspires others to do the same.',
                    ''.urldecode($_GET['user_name']).' love life! Although she had stockings, she remains a strong and loyal person. She is ambitious and ambitious, and achieves her dreams day after day. She never loses sight of who she really is!');
          }
          shuffle($caracteres);
?>
<!DOCTYPE HTML>
<img src="https://creation.funizi.com/images-theme-perso/1524758800.png" id="back"> 
<div class="overlay"></div>

<div class="name texte" id="name_user" ><?php echo urldecode($_GET['user_name']); ?></div>
<div class="texte" id="caractere"><?=$caracteres[0]?></div>


        </div>
        
        </body>
        </html>
      