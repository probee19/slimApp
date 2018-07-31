
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Basic" rel="stylesheet">
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

#fb_id_user{position: absolute; z-index:1; left: 271px; top: 53px; width:250px ;  height:250px ; object-fit: cover; object-position: 50% 10%; border-radius:250px; max-width:800px; max-height:420px;}

#aime,#deteste,#phrase {z-index:1; font-family: 'Basic', sans-serif; letter-spacing: -1px; position: absolute; top: 170px; color:#fff; font-size:40px; width:250px ; height:80px ; display:flex; align-items:center; justify-content:center; text-align:center; }

#deteste{ right: 0;  }

#aime{ left: 0; }

#phrase{right:50px; top:330px; width:700px; line-height:42px; color:#000;}


              </style>
              <script src='https://code.jquery.com/jquery-1.12.0.min.js'></script>
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
          $aimes = array('amor','Amistad','La familia','Niños','Los amigos');
          $detestes = array(\'Mentirosos','Los infieles','Hipócritas','Los engañadores','Errores');
          shuffle($aimes); shuffle($detestes);
?>
<!DOCTYPE HTML>

<img src="https://creation.funizi.com/images-theme-perso/1532950283.jpg" id="back"> 

<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user">

<div class="texte" id="aime"><?=$detestes[0]?></div>

<div class="texte" id="deteste"><?=$aimes[0]?></div>

<div class="texte" id="phrase"><?php echo $_GET['user_name']; ?> sabe qué es bueno y qué no es bueno en su vida</div>
 


        </div>
        
        </body>
        </html>
      