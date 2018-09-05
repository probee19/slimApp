
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=PT+Serif|Courgette" rel="stylesheet">
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
#nom{z-index:1; font-family: 'PT Serif', serif;text-transform:uppercase; position: absolute; left: 0; top: 70px; color:#000; font-size:45px; width:800px ; height:50px ; text-align:center; }
#annee{z-index:1; font-family: 'PT Serif', serif; position: absolute; text-transform:uppercase; left: 0; top: 120px; color:#000; font-size:25px; width:800px ; height:50px ; text-align:center; }
#origine{z-index:1; font-family: 'Courgette', cursive; position: absolute;  left: 130px; top: 160px; color:#000; font-size:30px; line-height:35px; width:580px ; height:230px ; text-align:center; }
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
          $origines = array(''.$_GET['additionnal_input_text'].' est synonyme d\'intelligence, de pureté et de courage. Ceux qui portent ce nom sont les descendants d\'une ancienne prestigieuse lignée. Les '.$_GET['additionnal_input_text'].' sont connues pour leur sagesse. ',
          ''.$_GET['additionnal_input_text'].' est synonyme de créativité, de passion et de courage. Ceux qui portent ce nom sont les descendants d\'une ancienne prestigieuse lignée. Les '.$_GET['additionnal_input_text'].' sont connues pour leur créativité.',
          'Il n\'y a pas si longtemps que ça, ta famille était connue pour son sens profond de la responsabilité, en effet, la seule mention du nom '.$_GET['additionnal_input_text'].' inspirait à la fois respect et confiance. Ta famille n\'a jamais failli à un engagement et a toujours assumé ses responsabilités envers la communité.',
          'Dans certaines cultures anciennes, le mot '.$_GET['additionnal_input_text'].' était synonyme de force. Ceux qui se distinguaient par leur force physique, mentale ou de caractère, se voyaient attribuer le nom '.$_GET['additionnal_input_text'].'. Ces gens transmettaient ce nom à leurs enfants en espérant qu’il leur donnera force.',
          ''.$_GET['additionnal_input_text'].' est synonyme de générosité, de sagesse et de perspicacité. Ceux qui portent ce nom sont d\'une ligné rare et estimée. Les '.$_GET['additionnal_input_text'].' inspirent le courage à tous.',
          'Les membres de ta famille sont bien connus pour leur fiabilité et leur droiture ; ils ont toujours été fidèles à leur parole. Ceux qui portent le nom '.$_GET['additionnal_input_text'].' ne sont pas seulement connus pour être des travailleurs acharnés. Ils sont aussi connus pour leur fidélité et leur fiabilité, c’est pourquoi tout le monde aimerait avoir un '.$_GET['additionnal_input_text'].' comme ami.');
          shuffle($origines);
?>
<!DOCTYPE HTML>
<img src="https://creation.funizi.com/images-theme-perso/1536154589.jpg" id="back"> 

<div class="texte" id="nom"> <?php echo $_GET['additionnal_input_text']; ?> </div>
<div class="texte" id="annee">Depuis <?=mt_rand(1204,1438)?> </div>
<div class="texte" id="origine"><?=$origines[0]?> </div>


        </div>
        
        </body>
        </html>
      