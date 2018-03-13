
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Courgette" rel="stylesheet">
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

#backgound{position:absolute; z-index:1; left:0; top:0;  width:800px; max-height:420px; }

#attente{z-index:1; font-family: 'Courgette', cursive; position: absolute; left: 50px; top: 100px; color:#FFF; font-size:40px; line-height:50px; width:700px ; height:300px ; background:transparent; border:0; border-radius:0px;  padding:0px; text-align:center; max-width:800px; max-height:420px;}

#fb_id_user{position: absolute; z-index:1; left: 365px; top: 10px; width:70px ; border-radius:70px; max-width:800px; max-height:420px;}

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
          if( $_GET['user_gender'] == 'homme' || $_GET['user_gender'] == 'male' || $_GET['user_gender'] == 'masculin' )
                    $attentes = array(''.$_GET['user_name'].', 2018 será um dos seus melhores anos! Você sempre esteve presente para seus entes queridos e você será preenchido com recompensas.',
                              ''.$_GET['user_name'].', você fez muitos sacrifícios até agora. 2018 será um ano de realização de todos os seus projetos. Um ano de felicidade para você.',
                              ''.$_GET['user_name'].', seus entes queridos estão realmente orgulhosos de você neste ano. 2018 será para você um espumante ano de felicidade, humor explosivo e saúde resplandecente.');
          else
                     $attentes = array(''.$_GET['user_name'].', 2018 será um dos seus melhores anos! Você sempre esteve presente para seus entes queridos e você será preenchido com recompensas.',
                              ''.$_GET['user_name'].', você fez muitos sacrifícios até agora. 2018 será um ano de realização de todos os seus projetos. Um ano de felicidade para você.',
                              ''.$_GET['user_name'].', seus entes queridos estão realmente orgulhosos de você neste ano. 2018 será para você um espumante ano de felicidade, humor explosivo e saúde resplandecente.');
          
          shuffle($attentes);
?>
<!DOCTYPE HTML>

<img src="http://creation.funizi.com/images-theme-perso/1514282076.jpg" id="backgound"> 

<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
<div class="name texte" id="name_user" ><?php echo $_GET['user_name']; ?></div>

<div class="texte" id="attente"> <?php echo $attentes[0]; ?> </div>


        </div>
        
        </body>
        </html>
      