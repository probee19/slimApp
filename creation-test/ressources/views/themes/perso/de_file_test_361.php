
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
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
.overlay{position:absolute; z-index:1; left:0; top:0;  width:800px; height:420px; background-color:#000; opacity:0.6;}

#fb_id_user{position: absolute; z-index:1; left: 26px; top:86px; width:250px ;  height:250px ;border-radius:250px;  object-fit: cover; object-position: 50% 10%;border:10px solid #16a085;  opacity:0.7;}
#name_user{position:absolute; z-index:1; left: 0px; top: 0px; font-size:30px; color:#FFF;} 

.label_r{z-index:1; font-family: 'Titillium Web', sans-serif;position: absolute; left: 310px;  color:#FFF; font-size:35px; width:200px ; height:35px ;   text-align:left; }
#position{ top: 30px;}
#role{ top: 90px;}
#force{ top: 150px;}
#faiblesse{ bottom: 175px;}
#tactique{  bottom: 115px;}
#devise{ bottom: 60px; width:480px; line-height:40px; text-align:justify;}


.result{z-index:1;font-family: 'Titillium Web', sans-serif; position: absolute; right: 20px;line-height:35px;  color:#f1c40f; font-size:35px; width:350px ; height:35px ;   text-align:right; }
.result_r{color:#f1c40f;}
#position_r{top: 30px;}
#role_r{ top: 95px;}
#force_r{ top: 150px;}
#faiblesse_r{ bottom: 175px;}
#tactique_r{ bottom: 115px;}
#devise_r{ width:430px ;bottom: 25px; height:55px ;}


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
          $positions = array('Torschütze');
          $roles = array('Führer','Held','Kapitän');
          $forces = array('Niemals verlieren!','Harte Arbeit!','Teamgeist !');
          $faiblesses = array('Altruistisch','Versteht zu viel');
          $tactiques = array('Suchen und zerstören!','Markiere und feiere!');
          $devises = array('Im Leben geht es nicht darum zu gewinnen, aber nicht zu verlieren!','Der beste deiner Spieler ist der schlimmste von meinen!');
          shuffle($positions);shuffle($roles);shuffle($forces);shuffle($faiblesses);shuffle($tactiques);shuffle($devises);
?>
<!DOCTYPE HTML>

<img src="https://creation.funizi.com/images-theme-perso/1528941715.jpg" id="back"> 
<div class="overlay"></div>

<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user"> 

<div class="texte label_r" id="position"> Position : </div>
<div class="texte label_r" id="role"> Rolle : </div>
<div class="texte label_r" id="force"> Stärke : </div>
<div class="texte label_r" id="faiblesse"> Die Schwäche : </div>
<div class="texte label_r" id="tactique"> Taktisch : </div>
<div class="texte label_r" id="devise"> Motto : <span class="result_r">"<?=$devises[0]?>"</span>   </div>
 
 
<div class="texte result" id="position_r"> <?=$positions[0]?> </div>
<div class="texte result" id="role_r"> <?=$roles[0]?> </div>
<div class="texte result" id="force_r"> <?=$forces[0]?> </div>
<div class="texte result" id="faiblesse_r"> <?=$faiblesses[0]?> </div>
<div class="texte result" id="tactique_r"> <?=$tactiques[0]?> </div>
<div class="texte result" id="devise_r"></div>
 
 

        </div>
        
        </body>
        </html>
      