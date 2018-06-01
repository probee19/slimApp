
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
.bloc{z-index:1; position: absolute;  color:#000; width:218px ; height:50px ;font-family: 'Play', sans-serif;  }
.bloc .title{ width:100%; height:45px;font-size:23px;  display:flex; justify-content:center; align-items:flex-end;margin-bottom:10px;  }
.bloc .body{ width:100%; height:45px; font-size:27px; font-weight:700;  display:flex; justify-content:center; align-items:flex-start;  }
#bloc1{left: 292px; top: 20px; }
#bloc2{left: 16px; top: 75px; }
#bloc3{right: 16px; top: 75px; }
#bloc4{left: 16px; top: 267px; }
#bloc5{right: 16px; top: 265px; }

#fb_id_user{position: absolute; z-index:1; left: 317px; top: 187px; width:168px ;  height:168px ; object-fit: cover; object-position: 50% 10%; border-radius:200px; max-width:800px; max-height:420px;}

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
          $couleurs = array('Gelb','Grün','Weiß','rot','Blau');
          $aimes = array('Umarmungen','Reise','lesen','Ferien','die Musik','schlafen');
          $detestes = array('Die Lüge','Heuchelei','der Verrat','Verzögerungen');
          $forces = array('Weisheit','Mut','Großzügigkeit','angenehmes Lächeln','großes Herz','Humor');
          $faiblesses = array('empfindlich','Perfektionist');
          shuffle($couleurs); shuffle($aimes); shuffle($detestes); shuffle($forces); shuffle($faiblesses); 
?>
<!DOCTYPE HTML>
<img src="https://creation.funizi.com/images-theme-perso/1524487058.png" id="back"> 

<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user">
 
<div class="texte bloc" id="bloc1"><span class="title">Farbe</span><span class="body"><?=ucfirst($couleurs[0])?></span></div>
<div class="texte bloc" id="bloc2"><span class="title">Du magst</span><span class="body"><?=$aimes[0]?></span></div>
<div class="texte bloc" id="bloc3"><span class="title">Du hasst</span><span class="body"><?=$detestes[0]?></span></div>
<div class="texte bloc" id="bloc4"><span class="title">Deine Stärke</span><span class="body"><?=ucfirst($forces[0])?></span></div>
<div class="texte bloc" id="bloc5"><span class="title">Deine Schwäche</span><span class="body"><?=ucfirst($faiblesses[0])?></span></div>


        </div>
        
        </body>
        </html>
      