
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Cookie" rel="stylesheet">
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
.star_left{position:absolute; z-index:1;left:40px; width:30px; }
.star_right{position:absolute; z-index:1;right:40px; width:30px; }
#star1{top:110px; }
#star2{top:210px; }
#star3{top:310px; }


#fb_id_user{position: absolute; z-index:1; left: 295px; top: 60px; width:200px ;  height:310px ; object-fit: cover; object-position: 50% 10%; border:5px solid #fff; max-width:800px; max-height:420px;}

.trait_left{z-index:1;font-family: 'Cookie', cursive; position: absolute; left: 30px; color:#fff; font-size:43px; width:240px ;  height:50px ; background-color:#000;display:flex; align-items:center; justify-content:center; text-align:center;}
.trait_right{z-index:1; font-family: 'Cookie', cursive;position: absolute; right: 30px; color:#fff; font-size:43px; width:240px ;  height:50px ; background-color:#000;display:flex; align-items:center; justify-content:center; text-align:center;}
#trait_1{ top: 100px;}
#trait_2{ top: 200px;}
#trait_3{ top: 300px;}
.triangle_left {position:absolute; top:0; right:-25px; width: 0; height: 0; border-top: 25px solid transparent; border-bottom: 25px solid transparent; border-right: 25px solid #fff ;}

.triangle_right {position:absolute; top:0; left:-25px; width: 0; height: 0; border-top: 25px solid transparent; border-bottom: 25px solid transparent; border-left: 25px solid #fff ;}


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
                   $traits = array('Hônnete','Sensible','Fidèle','Calme','Beau','Mignon','Objectif','Bienveillant','Charmeur','Tombeur','Courageux');
           }
           else{
                  $traits = array('Hônnete','Sensible','Fidèle','Calme','Belle','Mignonne','Objective','Rêveuse','Attentionnée');
          }
 
          shuffle($traits);
          
?>
<!DOCTYPE HTML>
<img src="https://creation.funizi.com/images-theme-perso/1535366310.jpg" id="back">

<div class="texte trait_left" id="trait_1"> <?=$traits[0]?> <span class="triangle_left"></span></div>
<div class="texte trait_left" id="trait_2"> <?=$traits[1]?> <span class="triangle_left"></span></div>
<div class="texte trait_left" id="trait_3"> <?=$traits[2]?> <span class="triangle_left"></span></div>
<div class="texte trait_right" id="trait_1"> <?=$traits[3]?> <span class="triangle_right"></span></div>
<div class="texte trait_right" id="trait_2"> <?=$traits[4]?> <span class="triangle_right"></span></div>
<div class="texte trait_right" id="trait_3"> <?=$traits[5]?> <span class="triangle_right"></span></div>
<img class="star_left" src="https://creation.funizi.com/images-theme-perso/1525019913.png" id="star1">
<img class="star_left" src="https://creation.funizi.com/images-theme-perso/1525019913.png" id="star2">
<img class="star_left" src="https://creation.funizi.com/images-theme-perso/1525019913.png" id="star3">


<img class="star_right" src="https://creation.funizi.com/images-theme-perso/1525019913.png" id="star1">
<img class="star_right" src="https://creation.funizi.com/images-theme-perso/1525019913.png" id="star2">
<img class="star_right" src="https://creation.funizi.com/images-theme-perso/1525019913.png" id="star3">


<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user">



        </div>
        
        </body>
        </html>
      