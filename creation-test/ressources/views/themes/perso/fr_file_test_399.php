
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">
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
.overlay{position:absolute; z-index:1; left:0; top:0; background:#000; opacity:0.6; width:800px; height:420px; }

#fb_id_user{position: absolute; z-index:1; left:50px; bottom:110px; width:250px ;  height:250px ; object-fit: cover; object-position: 50% 10%; border-radius:250px;border:10px solid #fff;}
#player{position:absolute; z-index:1; right:50px; bottom:110px; border-radius:250px;border:10px solid #fff; width:250px; height:250px; }

.name{z-index:1; position: absolute; text-transform:uppercase; bottom: 40px; font-family: 'Play', sans-serif; color:#fff; font-size:30px; line-height:40px; width:310px ; height:50px ; text-align:center;}
#player_name{right: 20px; }
#user{left: 20px; }
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
          $img = array('1533917167','1533917167','1533917290','1533919454','1533921713','1533921918','1533921777','1533921777','1533919549','1533919549','1533919567','1533921513','1533921530');
          $players = array('1533917167'=>'Basile Boli','1533917290'=>'Abedi A. Pelé','1533919454'=>'Rudi Völler','1533921713'=>'Didier Drogba','1533921918'=>'Mamadou Niang','1533921777'=>'Jean-Pierre Papin',
          '1533919549'=>'Didier Deschamps','1533919567'=>'Marcel Desailly','1533921513'=>'Chris Waddle','1533921530'=>'Marius Trésor');
          shuffle($img);
?>
<!DOCTYPE HTML>
<img src="https://creation.funizi.com/images-theme-perso/1533922563.jpg" id="back"> 
<div class="overlay"></div>
<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user"> 
 
<div class="texte name" id="player_name"><?=$players[$img[0]]?> </div>
 
<div class="texte name" id="user"><?php echo $_GET['user_name']; ?></div>

<img src="https://creation.funizi.com/images-theme-perso/<?=$img[0]?>.jpg" id="player">



        </div>
        
        </body>
        </html>
      