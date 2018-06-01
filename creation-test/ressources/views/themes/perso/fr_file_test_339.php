
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Caveat+Brush|Merienda" rel="stylesheet">
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
#head{z-index:1; font-family: 'Merienda', cursive; position: absolute; left: 0px; top: 0px; color:#FFF; font-size:30px; line-height:45px; width:800px ; height:50px ; background:#673AB7;   text-align:center; }

#fb_id_user{position: absolute; z-index:0; left: 280px; top: 110px; width:250px ;  height:250px ; object-fit: cover; object-position: 50% 10%; border-radius:0px; max-width:800px; max-height:420px;}
#name_user{position: absolute; z-index:1; font-family: 'Caveat Brush', cursive; left: 275px; top: 60px; font-size:30px; width:250px ;  height:40px;  display:flex; align-items:center; justify-content:center; color:#AD1457;} 

.entete{z-index:1; position: absolute; font-family: 'Merienda', cursive;  color:#AD1457;  font-size:30px; line-height:30px; width:220px ; height:40px ; text-align:center; }
#entete1{left:20px; top:70px;}
#entete2{left:20px; top:180px;}
#entete3{left:20px; top:290px;}
#entete4{right:20px; top:70px;}
#entete5{right:20px; top:180px;}
#entete6{right:20px; top:290px;}

#coeur1{left:20px; top:110px;}
#coeur2{left:20px; top:220px;}
#coeur3{left:20px; top:330px;}
#coeur4{right:20px; top:110px;}
#coeur5{right:20px; top:220px;}
#coeur6{right:20px; top:330px;}

.coeur{z-index:1; position: absolute; font-family: 'Caveat Brush', cursive; color:#673AB7;  font-size:43px; line-height:30px; width:220px ; height:40px ; text-align:center; }

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
          $coeurs = array('amoureux','pur','heureux','fort','fiable','sans peur','honnête','incassable','magnifique','courageux','brave');
          shuffle($coeurs);
?>

<!DOCTYPE HTML>
<img src="https://creation.funizi.com/images-theme-perso/1525139038.png" id="back"> 

<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user">
<div class="name texte" id="name_user" ><?php echo $_GET['user_name']; ?></div>
 

<div class="texte" id="head"> En quoi ton cœur est-il unique ? </div>

<div class="texte entete" id="entete1"> Ton coeur est... </div>
<div class="texte coeur" id="coeur1"> <?=$coeurs[0]?> </div>

<div class="texte entete" id="entete2"> Ton coeur est... </div>
<div class="texte coeur" id="coeur2"> <?=$coeurs[1]?> </div>

<div class="texte entete" id="entete3"> Ton coeur est... </div>
<div class="texte coeur" id="coeur3"> <?=$coeurs[2]?> </div>

<div class="texte entete" id="entete4"> Ton coeur est... </div>
<div class="texte coeur" id="coeur4"> <?=$coeurs[3]?> </div>

<div class="texte entete" id="entete5"> Ton coeur est... </div>
<div class="texte coeur" id="coeur5"> <?=$coeurs[4]?> </div>

<div class="texte entete" id="entete6"> Ton coeur est... </div>
<div class="texte coeur" id="coeur6"> <?=$coeurs[5]?> </div>

 

        </div>
        
        </body>
        </html>
      