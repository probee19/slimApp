
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Kalam|Sacramento" rel="stylesheet">
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

#back{position:absolute; z-index:1; left:0; top:0;  }
#caractere{z-index:1; font-family: 'Kalam', cursive; position: absolute; left: 50px; bottom: 30px; color:#FFF; font-size:33px; line-height:48px; width:700px ; height:310px ; display:flex; align-items:center; justify-content:center; text-align:center;  }
.overlay{position:absolute; z-index:1; left:0; top:0; width:800px; height:420px; background:#000; opacity:0.5;}

#name_user{position:absolute; z-index:1; left: 0; top: 30px;font-family: 'Sacramento', cursive; font-size:50px; line-height:50px; text-align:center; width:800px; height:40px; color:#FFF;} 
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
                    $caracteres = array('Vertrauen und Loyalität sind wichtig für '.$_GET['Nutzername'].'. Die Welt hat ihm nicht immer geholfen, aber seine positive Einstellung hat ihm erlaubt, die schlechten Zeiten zu überstehen. Er ist ehrgeizig und liebt alles, was das Leben zu bieten hat.',
                    'Das Leben war nicht immer einfach mit '.urldecode($_GET['user_name']).', Aber das hat sie nie davon abgehalten, ihre Träume zu erreichen. Er ist ehrgeizig, loyal und inspirierend mit allen um ihn herum. Er lebt weiterhin sein Leben voll und liebt Herausforderungen.',
                    'Vertrauen und Loyalität beschreiben gut '.$_GET['Nutzername'].'. Das Leben war manchmal hart, aber ihre starke und entschlossene Natur erlaubte ihr schwierige Zeiten durchzustehen. Niemand kann ihn daran hindern, seine Träume zu erreichen, und seine Einstellung inspiriert andere dazu, dasselbe zu tun.',
                    ''.urldecode($_GET['user_name']).' Liebesleben! Obwohl er Strümpfe hat, bleibt er eine starke und loyale Person. Er ist ehrlich und ehrgeizig und erreicht seine Träume Tag für Tag. Er verliert nie aus den Augen, wer er wirklich ist!');
          }
          else{
                    $caracteres = array('Vertrauen und Loyalität sind wichtig für '.$_GET['Nutzername'].'. Die Welt hat ihr nicht immer geholfen, aber ihre positive Einstellung hat es ihr ermöglicht, die schlechten Zeiten zu überstehen. Sie ist ehrgeizig und liebt alles, was das Leben zu bieten hat.',
                    'Das Leben war nicht immer einfach mit '.urldecode($_GET['user_name']).', Aber das hat sie nie davon abgehalten, ihre Träume zu erreichen. Sie ist ehrgeizig, loyal und inspiriert jeden um sie herum. Sie lebt weiterhin ein volles Leben und liebt Herausforderungen.',
                    'Vertrauen und Loyalität beschreiben gut '.$_GET['Nutzername'].'. Das Leben war manchmal hart, aber ihre starke und entschlossene Natur erlaubte ihr schwierige Zeiten durchzustehen. Niemand kann ihn daran hindern, seine Träume zu erreichen, und seine Einstellung inspiriert andere dazu, dasselbe zu tun.',
                    ''.urldecode($_GET['user_name']).' Liebesleben! Obwohl sie Strümpfe hat, bleibt sie eine starke und loyale Person. Sie ist ehrgeizig und ehrgeizig und erreicht ihre Träume Tag für Tag. Sie verliert nie aus den Augen, wer sie wirklich ist!');
          }
          shuffle($caracteres);
?>
<!DOCTYPE HTML>
<img src="https://creation.funizi.com/images-theme-perso/1524758800.png" id="back"> 
<div class="overlay"></div>

<div class="name texte" id="name_user" ><?php echo urldecode($_GET['user_name']); ?></div>
<div class="texte" id="caractere"><?=$caracteres[0]?></div>


        </div>
        
        </body>
        </html>
      