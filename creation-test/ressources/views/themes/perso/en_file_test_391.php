
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Exo:900" rel="stylesheet">

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
#background_1{position:absolute; z-index:1; left:0; top:0;  max-width:800px; max-height:420px; }
#background_2{position:absolute; z-index:1; right:0; top:0;  max-width:800px; max-height:420px; }
#result_container{position:absolute; z-index:1;top:0;  width:400px; height:420px; background:#000;opacity: 0.7; }
#nom_vainqueur{position:absolute; z-index:2;top:90px; left:5px;  width:400px; height:420px; font-family: 'Exo', sans-serif; color:#FFF; text-align:center; font-size:50px; }
#action{position:absolute; z-index:2;top:160px;  width:390px; height:420px; font-family: 'Exo', sans-serif; color:#FFFF00; text-align:center; font-size:30px; line-height:30px; }
#time{position:absolute; z-index:3;top:240px;  width:400px; height:420px; font-family: 'Exo', sans-serif; color:#FFF; text-align:center; font-size:30px; line-height:30px; }

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
          $result_container_position = array('0','400');
          $nom_vainqueur = array('Bombardier', 'Eumeu Sene');
          $action = array('gagne grâce à un crochet du droit', 'Vainqueur par KO','terrasse son adversaire','Renverse son adversaire');
          $timing = array('à la 32ie seconde','aprés 1m30 de combat','à la 15ie seconde','aprés 1m55 de combat');
          $id = mt_rand(0,1);
          $id2 = mt_rand(0,3);
          
?>

<img src="http://creation.funizi.com/images-theme-perso/1532620091.jpg" id="background_1"> 
<img src="http://creation.funizi.com/images-theme-perso/1532620107.jpg" id="background_2"> 
<div id='result_container' style="left:<?php echo $result_container_position[$id] ?>px"></div>
<div id='nom_vainqueur' style="left:<?php echo $result_container_position[$id] ?>px"><?php echo $nom_vainqueur[$id] ?></div>
<div id='action' style="left:<?php echo $result_container_position[$id] ?>px"><?php echo $action[$id2] ?></div>
<div id='time' style="left:<?php echo $result_container_position[$id] ?>px"><?php echo $timing[$id2] ?></div>



        </div>
        
        </body>
        </html>
      