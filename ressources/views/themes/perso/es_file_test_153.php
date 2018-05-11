
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
#fb_id_user{position: absolute; z-index:1; left: 120px; top: 0px; width:130px ; border-radius:0px; max-width:800px; max-height:420px;}
#name_user{position:absolute; z-index:2; left: 260px; top: 40px; font-size:50px; color:#666666;} 
#zone_search{position:absolute; z-index:2; left: 155px; top: 144px; font-size:17px; color:#777777;}
#result1{position:absolute; z-index:2; left: 155px; top: 190px; font-size:18px; color:#333;}
#result2{position:absolute; z-index:2; left: 155px; top: 220px; font-size:18px; color:#333;}
#result3{position:absolute; z-index:2; left: 155px; top: 250px; font-size:18px; color:#333;}
#result4{position:absolute; z-index:2; left: 155px; top: 280px; font-size:18px; color:#333;}


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
            {
                      $recherche = array('Por que '.$_GET['User_name'].' ¿Nunca te ríes de mis bofetadas?','Por que es '.$_GET['¿User_name'].' Más hermoso que yo?'
                ,'Por que es '.$_GET['User_name'].' ¿Tan rico?','Por qué '.$_GET['User_name'].' ¿Es el más inteligente?'
                ,'Por qué '.$_GET['User_name'].' ¿Es tan majestuoso?','Por qué '.$_GET['¿User_name'].' Conoce al presidente Obama?'
                ,'Por qué '.$_GET['User_name'].' ¿Tiene tanta suerte?');
                }
            else{ 
                $recherche = array('Por que '.$_GET['User_name'].' ¿Nunca te ríes de mis bromas?','Por que es '.$_GET['¿User_name'].' Más hermoso que yo?'
                ,'Por que '.$_GET['User_name'].' ¿Tienes tanta clase?','Por qué '.$_GET['User_name'].' ¿Es el más inteligente?'
                ,'Por qué '.$_GET['User_name'].' ¿Es tan majestuoso?','Por qué '.$_GET['¿User_name'].' ¿Conoce a Michelle Obama?'
                ,'Por qué '.$_GET['User_name'].' ¿Tiene tanta suerte?');
               
            }
               
                
                shuffle($recherche);
            ?>
<img src="http://creation.funizi.com/images-theme-perso/1508544962.png" id="background"> 
<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user">
<div class="name texte" id="name_user" ><?php echo $_GET['user_name']; ?></div>
<div  id="zone_search" >Por qué <?php echo $_GET['user_name']; ?> es ...</div>
<div  id="result1" ><?php echo $recherche[0] ?></div>
<div  id="result2" ><?php echo $recherche[1] ?></div>
<div  id="result3" ><?php echo $recherche[2] ?></div>
<div  id="result4" ><?php echo $recherche[3] ?></div>

        </div>
        <!-- Ces lignes seront placées dans le footer de la page à capturer -->
        </body>
        </html>
      