
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">
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
              .main{ padding:0;margin:0;width: 800px;height:420px;position: relative;overflow: hidden; background: #000;}
.main img{ position:absolute; max-height:420px; max-width:800px; }

#fb_id_user{position: absolute; z-index:1; left: 30px; top: 60px; width:280px ; border-radius:30px; max-width:800px; max-height:420px;}
#name_user{position:absolute; font-family: 'Satisfy', cursive; z-index:1; right: 30px; top: 350px; font-size:30px; width:410px; text-align:center; color:#FFF; } 
#phrase{position:absolute; z-index:1; right: 30px; top: 60px; width:410px; height:270px; 
display:flex; align-items:center; justify-content:center; text-align:center;
font-size:37px; line-height:42px; color:#FFF; font-family: 'Satisfy', cursive; }

#background{position:absolute; z-index:1; left:0; top:0;  width:800px; opacity:0.6;  }
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
      
<!DOCTYPE HTML>
<?php 
          $phrases = array('J&#39;ai réalisé que je ne devais pas avoir peur de défendre les choses en moi je crois, même si je devais moi battre tout seul pour cela.',
                    'J&#39;ai composé que je n&#39;avais pas à moi battre pour une place dans la vie des autres. Ceux qui m&#39;estiment vraiment me garderont toujours une place dans leur coeur',
                    'J&#39;ai compris je ne devais pas douter de mes capacités. Je n&#39;ai qu&#39;à me rappeler le chemin parcouru, des obstacles frnachis, des batailles gagnées et des peurs surmontées.',
                    'J&#39;ai réalisé que je ne chante pas la façon dont les gens me voyaient. Ce n&#39;était même pas la peine d&#39;essayer. Je vais simplement vivre ma vie et être heureux.');
          shuffle($phrases);
?>

<img src="http://creation.funizi.com/images-theme-perso/1514398615.jpg" id="background"> 
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
<div class="name texte" id="name_user" >~ <?php echo $_GET['user_name']; ?> ~</div>
<div id="phrase"><?php echo $phrases[0]; ?></div>

        </div>
        
        </body>
        </html>
      