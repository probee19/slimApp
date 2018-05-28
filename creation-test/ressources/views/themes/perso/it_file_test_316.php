
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
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
.main img{ position:absolute; max-height:420px; max-width:800px; object-fit: cover; object-position: 50% 10%;  }

#header_t{z-index:1; font-family: 'Oswald', sans-serif; position: absolute; left: 0; top: 0; color:#FFF; font-size:30px; width:800px ; height:60px ; text-transform:uppercase; background:#283593; display:flex; align-items:center;justify-content:center;}
.title_block{display:block;color:#000; font-size:25px; width:100%; text-transform:uppercase;text-align:center; margin-bottom:10px; margin-top:10px;}
.content_block{display:block;color:#000; font-size:22px; width:100%; text-transform:uppercase;text-align:center; color:#283593;}
#verite1, #verite2, #verite3, #verite4, #verite5, #verite6{z-index:1;  font-family: 'Oswald', sans-serif; position: absolute; width:260px ; height:100px ; border:4px solid #000; border-radius:10px;   }
#verite1{left: 10px; top: 70px; }
#verite2{left: 10px; top: 180px; }
#verite3{left: 10px; top: 290px; }
#verite4{right: 10px; top: 70px; }
#verite5{right: 10px; top: 180px; }
#verite6{right: 10px; top: 290px; }

#fb_id_user{position: absolute; z-index:2; left: 295px; top: 90px; width:200px ; height:200px ; border-radius:200px; border:5px solid #000; max-width:800px; max-height:420px;}
#name_user{position:absolute; z-index:2; left: 290px; bottom: 50px; width:220px ; height:50px ; font-size:20px; color:#FFF; display:flex; align-items:center; justify-content:center; background:#283593;} 

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
          if( $_GET['user_gender'] == 'homme' || $_GET['user_gender'] == 'male' || $_GET['user_gender'] == 'masculin'){
                    $personnalites = array('Capo','forte','innovatore','ispiratore','Virtuoso','Avventuriero');
                    $adore = array('Le sorprese','Ridere','Viaggio','Imparare');
                    $deteste = array('Pettegolezzo','Crudeltà','Bugiardi','L\'infedele');
                    $animaux = array('Leone','Tigre','Leopardoo','Antilope','Ghepardo');
                    $forces = array('Onesto al 100%','persuasivo','autonomo');
                    $faiblesses = array('Dare troppo','È troppo comprensivo?');
          }
          else{
                    $personnalites = array('Capo','Forte','innovativo','ispiratore','Virtuoso','avventuriera');
                    $adore = array('Le sorprese','Ridere','Viaggio','Imparare');
                    $deteste = array('Pettegolezzo','Crudeltà','Les menteurs','Les infidèles');
                    $animaux = array('Leone','Tigre','Leopardoo','Antilope','Ghepardo');
                    $forces = array('Onesto al 100%','Empatizzare','persuasivo','autonomo');
                    $faiblesses = array('Dare troppo','È troppo comprensivo?');
          }
          shuffle($adore); shuffle($deteste); shuffle($animaux); shuffle($personnalites); shuffle($forces); shuffle($faiblesses);
 ?>
<!DOCTYPE HTML>

<div class="texte" id="header_t"> Le 6 verità che riassumono la tua vita: </div>

<div class="texte" id="verite1"> <span class="title_block">Tu adori</span> <span class="content_block"> <?=$adore[0]; ?> </span> </div>
<div class="texte" id="verite2"> <span class="title_block">Tu odi</span> <span class="content_block"> <?=$deteste[0]; ?> </span> </div>
<div class="texte" id="verite3"> <span class="title_block">Il tuo animale spirituale</span> <span class="content_block"> <?=$animaux[0]; ?> </span> </div>
<div class="texte" id="verite4"> <span class="title_block">Personalità</span> <span class="content_block"> <?=$personnalites[0]; ?> </span> </div>
<div class="texte" id="verite5"> <span class="title_block">Forza</span> <span class="content_block"> <?=$forces[0]; ?> </span> </div>
<div class="texte" id="verite6"> <span class="title_block">Debolezza</span> <span class="content_block"> <?=$faiblesses[0]; ?> </span> </div>


<img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="fb_id_user">
<div class="name texte" id="name_user" ><?php echo urldecode($_GET['user_name']); ?></div>





        </div>
        
        </body>
        </html>
      