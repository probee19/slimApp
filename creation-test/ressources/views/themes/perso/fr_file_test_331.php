
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
                    $caracteres = array(' La confiance et la loyauté sont importantes pour '.$_GET['user_name'].'. Le monde ne l\'a pas toujours aidé mais sa vision positive des choses lui a permis de traverser les mauvaix moments. Il est ambitieux et aime tout ce que la vie a à offrir. ',
                    ' La vie n\'a pas toujours été facile avec '.$_GET['user_name'].', mais cela ne l\'a jamais empêché d\'atteindre ses rêves. Il est ambitieux, loyal et inspirant avec tous ceux qui l\'entourent. Il continue de vivre sa vie pleinement et aime les défis. ',
                    ' La confiance et la loyauté décrivent bien '.$_GET['user_name'].'. La vie a été parfois dure mais sa nature forte et déterminée lui ont permis de traverser les moments difficiles. Personne ne peut l\'empêcher d\'atteindre ses rêves, et son attitude inspire les autres en à faire de même.',
                    ' '.$_GET['user_name'].' aime la vie ! Bien qu\'il ait eu des bas, il demeure une personne forte et loyale. Il est hônnete et ambitieux, et atteint ses rêves jours après jours. Il ne perd jamais de vue qui il est vraiment ! ');
          }
          else{
                    $caracteres = array(' La confiance et la loyauté sont importantes pour '.$_GET['user_name'].'. Le monde ne l\'a pas toujours aidée mais sa vision positive des choses lui a permis de traverser les mauvaix moments. Elle est ambitieuse et aime tout ce que la vie a à offrir. ',
                    ' La vie n\'a pas toujours été facile avec '.$_GET['user_name'].', mais cela ne l\'a jamais empêché d\'atteindre ses rêves. Elle est ambitieuse, loyale et inspire tous ceux qui l\'entourent. Elle continue de vivre sa vie pleinement et aime les défis. ',
                    ' La confiance et la loyauté décrivent bien '.$_GET['user_name'].'. La vie a été parfois dure mais sa nature forte et déterminée lui ont permis de traverser les moments difficiles. Personne ne peut l\'empêcher d\'atteindre ses rêves, et son attitude inspire les autres en à faire de même.',
                    ' '.$_GET['user_name'].' aime la vie ! Bien qu\'elle ait eu des bas, elle demeure une personne forte et loyale. Elle est hônnete et ambitieuse, et atteint ses rêves jours après jours. Elle ne perd jamais de vue qui elle est vraiment ! ');
          }
          shuffle($caracteres);
?>
<!DOCTYPE HTML>
<img src="https://creation.funizi.com/images-theme-perso/1524758800.png" id="back"> 
<div class="overlay"></div>

<div class="name texte" id="name_user" ><?php echo $_GET['user_name']; ?></div>
<div class="texte" id="caractere"><?=$caracteres[0]?></div>


        </div>
        
        </body>
        </html>
      