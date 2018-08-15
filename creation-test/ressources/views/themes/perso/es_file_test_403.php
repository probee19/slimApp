
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Boogaloo" rel="stylesheet">
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
.overlay{position:absolute;z-index:1; left:0; top:0; background-color:#000;  width:800px; height:420px; opacity:0.6;}
#fb_id_user{position: absolute; z-index:1; left: 350px; top: 30px; width:100px ;  height:100px ; object-fit: cover; object-position: 50% 10%; border:10px solid #FFF;}
 
.qualite{z-index:1; position: absolute; font-family: 'Boogaloo', cursive; left: 20px; color:#fff; font-size:36px; line-height:40px; width:760px ; height:80px ; background:transparent;  padding-left:15px; display:flex; align-items:center; }
#qualite1{top:150px;}
#qualite2{top:220px;}
#qualite3{top:290px;}

#flag{position:absolute; z-index:1; left:435px; top:120px;  }



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
          $qualites = array('Tenemos a Jacques Brel, Stromae, Selah Sue, Loïc ...','Tenemos a Tintín, a Lucky Luke!','En cada pueblo, puedes encontrar un gran festival.',
          'Somos realmente buenos en el lenguaje ...','¡Tenemos excelentes bebidas de lúpulo!','Tenemos los mejores chocolates del mundo?','Tenemos a Jean-Claude Van Damme?','¡Tenemos las mejores papas fritas del mundo!');
          shuffle($qualites);
?>
<!DOCTYPE HTML>

<img src="https://creation.funizi.com/images-theme-perso/1534266273.jpg" id="back">

<div class="overlay"></div>
 
<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user"> 

<img src="https://creation.funizi.com/images-theme-perso/1534268544.png" id="flag"> 

<div class="texte qualite" id="qualite1">1. <?=$qualites[0]?> </div>
<div class="texte qualite" id="qualite2">2. <?=$qualites[1]?> </div>
<div class="texte qualite" id="qualite3">3. <?=$qualites[2]?> </div>
 
 

        </div>
        
        </body>
        </html>
      