
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Ropa+Sans" rel="stylesheet">
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

.fb_id_user{position: absolute; z-index:1; top: 0px; width:260px ;  height:320px ; object-fit: cover; object-position: 50% 10%; border-radius:0px; max-width:800px; max-height:420px;}
#fb_id_user_1{left: 0; -webkit-filter: sepia(70%); filter:  sepia(70%);}
#fb_id_user_2{left: 270px; }
#fb_id_user_3{right: 0; -webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */filter: grayscale(100%);}


.couleur{z-index:2; font-family: 'Ropa Sans', sans-serif; text-transform:capitalize; position: absolute; bottom: 0; color:#fff; font-size:40px; width:260px ; height:100px ; display:flex; align-items:center; justify-content:center; text-align:center; }
#couleur_1{left: 0; }
#couleur_2{left: 270px;}
#couleur_3{right: 0; }





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

if( $_GET['user_gender'] == 'homme' || $_GET['user_gender'] == 'male' || $_GET['user_gender'] == 'masculin' ){
          $mots = array('loyal','correct','gentil','créatif','ambitieux','aimant','adorable');
}
else{
          $mots = array('loyale','correcte','gentille','créative','ambitieuse','belle','adorable');
}
          $colors = array('#A3CB38','#B53471','#9980FA','#009432','#EA2027','#1B1464','#0652DD','#5758BB','#F79F1F');
          shuffle($colors);  shuffle($mots);
?>
<!DOCTYPE HTML>

<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile fb_id_user" id="fb_id_user_1">
<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile fb_id_user" id="fb_id_user_2">
<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile fb_id_user" id="fb_id_user_3">

<div class="texte couleur" id="couleur_1" style="background-color:<?=$colors[0]?>" > <?=$mots[0]?> </div>
<div class="texte couleur" id="couleur_2" style="background-color:<?=$colors[1]?>" > <?=$mots[1]?> </div>
<div class="texte couleur" id="couleur_3" style="background-color:<?=$colors[2]?>" > <?=$mots[2]?> </div>



        </div>
        
        </body>
        </html>
      