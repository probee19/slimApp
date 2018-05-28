
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Itim|Kaushan+Script" rel="stylesheet">
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
#background{position:absolute; z-index:1; left:0; top:0;  max-width:800px; max-height:420px; }
#signature{position:absolute; z-index:2; right:0; bottom:20px; width:500px; height:40px;color:#000; text-align:center; font-size:30px;font-family: 'Kaushan Script', cursive;}
#message{position:absolute; z-index:2; right:25px; top:20px; width:450px; height:380px; font-size:30px; font-family: 'Itim', cursive;; line-height:35px; text-align:center;color:#333;display: flex;
justify-content: center; /* align horizontal */
align-items: center; /* align vertical */ }
#fb_id_user{position: absolute; z-index:1; left: 80px; top: 100px; width:200px ; border-radius:100px; max-width:800px; max-height:420px;}

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
$message = array('Não vou lutar para fazer parte da vida de alguém. Quando as pessoas me conhecem, eles me fazem seu próprio lugar. Compreender o verdadeiro valor de alguém é a chave para a felicidade',
'Lorque je doute de moi, j\'essaye de me rappeler tout le chemin que j\'ai parcouru. Je me souviens de toutes les difficultés que j\'ai dû affronter, de toutes les batailles que j\'ai gagné et de toutes les peurs que j\'ai vaincu.',
'Quero uma vida simples sem estresse. Eu não preciso muito. Eu só preciso da minha família e amigos',
'Não me subestime. Eu sei mais do que parece, acho mais frequentemente do que eu falo e percebo muitas coisas sem que você saiba. É melhor ter-me como aliado do que como inimigo.');

shuffle($message);
?>
<img src="http://creation.funizi.com/images-theme-perso/1513345516.jpg" id="background"> 
<img src="https://res.cloudinary.com/funizi/image/facebook/e_art:red_rock/<?php echo $_GET['fb_id_user']; ?>.jpg" class="img_profile" id="fb_id_user">
<div id="message"> <?php echo $message[0]; ?></div>
<div id="signature">- <?php echo urldecode($_GET['user_name']); ?> -</div> 


        </div>
        
        </body>
        </html>
      