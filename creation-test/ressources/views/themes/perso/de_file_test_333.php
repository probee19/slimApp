
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Do+Hyeon" rel="stylesheet">

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
 
#back{position:absolute; z-index:1; left:0; top:0;  max-width:800px; max-height:420px; }
.overlay{position:absolute; z-index:1; left:0; top:0;  width:800px; height:420px; background:#000; opacity:0.4;}

#fb_id_user{position: absolute; z-index:1; left: 350px; top: 30px; width:100px ;  height:100px ; object-fit: cover; object-position: 50% 10%; border-radius:100px; -webkit-mask-image: linear-gradient( transparent 8%, black 25%);mask-image: linear-gradient(to right, transparent 8%, black 25%);}
#peur{z-index:1; position: absolute; font-family: 'Do Hyeon', sans-serif;left: 50px; bottom: 20px; color:#FFF; font-size:34px; line-height:40px; width:700px ; height:250px ;display:flex; align-items:center; justify-content:center; text-align:center; max-width:800px; max-height:420px;}
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
                    $peurs = array('Die Vorstellung, von deiner Familie weg zu sein, erschreckt dich. Du liebst sie so sehr, dass du immer mit ihr zusammen sein willst.',
                    'Deine größte Angst ist es nicht, deinen Freunden und deiner Familie zu sagen, wie sehr du sie jeden Tag liebst.',
                    'Deine Familie liebt dich so sehr und du hast so stark argumentiert, dass die Idee, sie zu enttäuschen, dein Herz bricht. Sie wollen nur ein Lächeln auf ihren Gesichtern sehen.',
                    'Deine Familie ist großartig. Du teilst alles und du kannst dich gegenseitig unterstützen. Du wirst ohne sie verloren sein.',
                    'Deine größte Angst ist es, von deinem besten Freund getrennt zu sein. Du bist fast Zwillinge!',
                    'Du liebst deine Familie mehr als alles andere auf der Welt. Du hast Angst, sie zu verlieren. Dies sind die wichtigsten Menschen in Ihrem Leben',
                    'Deine Familie ist deine Quelle der Freude. Sie sind nicht nur Menschen, mit denen Sie Blut teilen, sie sind Ihre besten Freunde und Ihre beste Unterstützung.');
          }
          else{
                    $peurs = array('Die Vorstellung, von deiner Familie weg zu sein, erschreckt dich. Du liebst sie so sehr, dass du immer mit ihr zusammen sein willst.',
                    'Deine größte Angst ist es nicht, deinen Freunden und deiner Familie zu sagen, wie sehr du sie jeden Tag liebst.',
                    'Deine Familie liebt dich so sehr und du hast so stark argumentiert, dass die Idee, sie zu enttäuschen, dein Herz bricht. Sie wollen nur ein Lächeln auf ihren Gesichtern sehen.',
                    'Deine Familie ist großartig. Du teilst alles und du kannst dich gegenseitig unterstützen. Du wirst ohne sie verloren sein.',
                    'Deine größte Angst ist es, von deinem besten Freund getrennt zu sein. Du bist fast Zwillinge!',
                    'Du liebst deine Familie mehr als alles andere auf der Welt. Du hast Angst, sie zu verlieren. Dies sind die wichtigsten Menschen in Ihrem Leben',
                    'Deine Familie ist deine Quelle der Freude. Sie sind nicht nur Menschen, mit denen Sie Blut teilen, sie sind Ihre besten Freunde und Ihre beste Unterstützung.');
                    
          }
          shuffle($peurs);
?>
<!DOCTYPE HTML>

<img src="https://creation.funizi.com/images-theme-perso/1524925262.jpg" id="back"> 
<div class="overlay"></div>
  
<img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="fb_id_user"> 
<div class="texte" id="peur"><?=$peurs[0]?></div>
 

        </div>
        
        </body>
        </html>
      