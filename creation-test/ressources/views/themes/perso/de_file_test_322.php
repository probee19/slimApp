
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              
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

#fb_id_user{position: absolute; z-index:1; left: 60px; top: 60px; width:300px ;  height:300px ; object-fit: cover; object-position: 50% 10%; border-radius:0px; max-width:800px; max-height:420px;}
#name_user{position:absolute; z-index:1; left: 0px; top: 0px; font-size:30px; color:#FFF;} 


.box{z-index:1; font-family: 'Ubuntu', sans-serif; font-weight:100; position: absolute; right: 0px;color:#000; font-size:25px; width:370px ; height:30px ;  border-bottom:2px solid #000; text-align:left;}
#box_heart{ top: 10px; }
#box_job{ top: 100px; }
#box_money{ top: 180px; }
#box_done{ top: 270px; }

.res{z-index:1; font-family: 'Ubuntu', sans-serif; font-weight:700; position: absolute; right: 0px;color:#000;  width:370px ; height:30px ;  text-align:left;}
#res_love{ top: 50px; font-size:20px; }
#res_job{ top: 140px; font-size:20px;}
#res_money{ top: 220px; font-size:20px; line-height:20px;}
#res_done_1{ top: 310px; font-size:16px;}
#res_done_2{ top: 340px; font-size:16px;}
#res_done_3{ top: 370px; font-size:16px;}

.img_ico{position:absolute; z-index:1; right:10px; max-width:800px; max-height:420px; }
#heart{top:10px;}
#briefcase{top:100px;}
#money{top:180px;}
#done{top:270px;}

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
                    $amour = array('5 Kinder, 18 Enkelkinder','45 Enkelkinder','4 Kinder, 21 Enkelkinder','7 Kinder, 28 Enkelkinder');
                    $carriere = array('Wissenschaftler','Pilot','Berühmter Dichter');
                    $argent = array('2 Bankkonten mit Millionen von Dollar','$ 15.000.000','$ 12.500.000','Eigentümer von 3 behelfsmäßigen Häusern','Millionär. Besitzer von 5 großen Villen. ');
                    $accomplissement = array('Erstellen Sie Ihre eigene Firma','Hilfe vieler Wohltätigkeitsorganisationen','Inhaber einer großen Automobilmarke','Berater des Präsidenten der Republik');
          }
        
          shuffle($amour); shuffle($carriere); shuffle($argent); shuffle($accomplissement);
?>
<!DOCTYPE HTML>

<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user">



<div class="texte box" id="box_heart"> Familie </div>
<img src="http://creation.funizi.com/images-theme-perso/1519302793.png" class="img_ico" id="heart"> 
<div class="texte res" id="res_love"> <?php echo $amour[0]; ?> </div>

<div class="texte box" id="box_job"> Werdegang </div>
<img src="http://creation.funizi.com/images-theme-perso/1519303023.png" class="img_ico" id="briefcase">  
<div class="texte res" id="res_job"> <?php echo $carriere[0]; ?> </div>

<div class="texte box" id="box_money"> Vermögen </div>
<img src="http://creation.funizi.com/images-theme-perso/1519303423.png" class="img_ico" id="money">  
<div class="texte res" id="res_money"> <?php echo $argent[0]; ?> </div>

<div class="texte box" id="box_done"> Leistung </div>
<img src="http://creation.funizi.com/images-theme-perso/1519303519.png" class="img_ico" id="done">  
<div class="texte res" id="res_done_1"> - <?php echo $accomplissement[0]; ?> </div> 
<div class="texte res" id="res_done_2"> - <?php echo $accomplissement[1]; ?> </div> 
<div class="texte res" id="res_done_3"> - <?php echo $accomplissement[2]; ?> </div>




        </div>
        
        </body>
        </html>
      