
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
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

#fb_id_user{position: absolute; z-index:1; left: 0px; top: 0px; width:420px ;  max-height:420px;}
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
                    $amour = array(' Marié ',' Marié, 2 enfants ',' Marié, 3 enfants ',' Marié, 2 jumeaux ',' Marié, 1 enfant ');
                    $carriere = array(' Scientifique ',' Agent de stars ',' Vloggeur célèbre ',' Photographe des stars ',' Poète célèbre ');
                    $argent = array(' 2 comptes bancaires avec des miilions de dollars ',' 2 000 000 $ par an ',' 2 500 000 $ par an ',' Propriétaire de 3 maisons de fortune ',' Millionnaire. Propriétaire de 5 grandes villas.  ');
                    $accomplissement = array(' Titulaire d\'un doctorat ',' Création de sa propre société ',' Aide de nombreuses oeuvres caritatives ',' Propriètaire d\'une grande marque automobile ',' Ami des célèbrités ',' Propriétaire d\'une boite de nuit glamour ');
          }
          else{
                    $amour = array(' Mariée ',' Mariée, 2 enfants ',' Mariée, 3 enfants ',' Mariée, 2 jumeaux ',' Mariée, 1 enfant ');
                    $carriere = array(' Scientifique ',' Agent de stars ',' Vloggeuse célèbre ',' Photographe des stars ',' Poète célèbre ');
                    $argent = array(' 2 comptes bancaires avec des miilions de dollars ',' 2 000 000 $ par an ',' 2 500 000 $ par an ',' Propriétaire de 3 maisons de fortune ',' Millionnaire. Propriétaire de 5 grandes villas.  ');
                    $accomplissement = array(' Titulaire d\'un doctorat ',' Création de sa propre société ',' Aide de nombreuses oeuvres caritatives ',' Propriètaire d\'une grande marque automobile ',' Amie des célèbrités ',' Propriétaire d\'une boite de nuit glamour ');
          
          
          }
        
          shuffle($amour); shuffle($carriere); shuffle($argent); shuffle($accomplissement);
?>
<!DOCTYPE HTML>

<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user">

<div class="texte box" id="box_heart">  Amour  </div>
<img src="http://creation.funizi.com/images-theme-perso/1519302793.png" class="img_ico" id="heart"> 
<div class="texte res" id="res_love"> <?php echo $amour[0]; ?> </div>

<div class="texte box" id="box_job">  Carrière  </div>
<img src="http://creation.funizi.com/images-theme-perso/1519303023.png" class="img_ico" id="briefcase">  
<div class="texte res" id="res_job"> <?php echo $carriere[0]; ?> </div>

<div class="texte box" id="box_money">  Argent  </div>
<img src="http://creation.funizi.com/images-theme-perso/1519303423.png" class="img_ico" id="money">  
<div class="texte res" id="res_money"> <?php echo $argent[0]; ?> </div>

<div class="texte box" id="box_done">  Accomplissement  </div>
<img src="http://creation.funizi.com/images-theme-perso/1519303519.png" class="img_ico" id="done">  
<div class="texte res" id="res_done_1"> - <?php echo $accomplissement[0]; ?> </div> 
<div class="texte res" id="res_done_2"> - <?php echo $accomplissement[1]; ?> </div> 
<div class="texte res" id="res_done_3"> - <?php echo $accomplissement[2]; ?> </div>



        </div>
        
        </body>
        </html>
      