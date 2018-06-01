
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">
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
#background { position:absolute; height:420px; width:800px; background:#FF4000; }
#fb_id_user{position: absolute; z-index:1; left: 30px; top: 20px; width:80px ; border-radius:100px; max-width:800px; max-height:420px;}
#name_user{position:absolute; z-index:1; left: 0px; top: 0px; font-size:30px; color:#FFF;} 
#titretest{position:absolute; z-index:1; left: 150px; width:600px; height:150px; top: 20px; font-size:30px; line-height:35px; color:#FFFF00;font-family: 'Bree Serif', serif;} 
ol{position:absolute; z-index:1; left: 50px; width:600px; height:150px; top: 120px; font-size:30px; line-height:25px; color:#FFF;font-family: 'Bree Serif', serif;} 
ol li{height:55px;} 
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
 if( $_GET['user_gender'] == 'homme' || $_GET['user_gender'] == 'male' || $_GET['user_gender'] == 'masculin' )
 {
       $texte = array(" Quand on le double dans une file d'attente ! "," Quand son téléphone n'a plus de batterie ! ",
" Quand son coiffeur fait des catastrophes ! ", " Quand sa mère l'appelle 10 fois par jour ! ", " Quand un moustique l'empêche de dormir "
," Quand il pleut et qu'il n'a pas de parapluie ! "," Quand les gens parlent dans son dos ! "," Quand les gens chuchotent au cinéma ! ");    
 }
 else
 {
           $texte = array(" Quand on la double dans une file d'attente ! "," Quand son téléphone n'a plus de batterie ! ",
" Quand sa coiffeuse fait des catastrophes ! ", " Quand sa mère l'appelle 10 fois par jour ! ", " Quand un moustique l'empêche de dormir "
," Quand il pleut et qu'elle n'a pas de parapluie ! "," Quand les gens parlent dans son dos ! "," Quand les gens chuchotent au cinéma !  ");
 }

 shuffle($texte);
?>
<div id="background" ></div>
<img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="fb_id_user">
<div class="name texte" id="name_user" ></div>
<div id="titretest" > Quelles sont les 5 choses que <?php echo urldecode($_GET['user_name']); ?> déteste le plus ? </div>
<div class="name texte" id="name_user" ></div>

<ol>
<li><?php echo $texte[0]; ?> </li> 
<li><?php echo $texte[1]; ?> </li> 
<li><?php echo $texte[2]; ?> </li> 
<li> <?php echo $texte[3]; ?> </li> 
<li><?php echo $texte[4]; ?> </li> 
</ol>


        </div>
        
        </body>
        </html>
      