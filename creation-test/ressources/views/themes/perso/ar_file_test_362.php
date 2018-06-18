
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Acme" rel="stylesheet">
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
#cadre{position:absolute; z-index:1; left:0; top:0;  max-width:800px; max-height:420px; }
#back{position:absolute; z-index:1; left:0; top:0;  max-width:800px; max-height:420px; }

#fb_id_user{position: absolute; z-index:1; left: 35px; top: 56px; width:280px ;  height:280px ; object-fit: cover; object-position: 50% 10%; border-radius:280px; border:1px solid #000;}

#player{position:absolute; z-index:1; right: 35px; top: 56px; width:280px ;border-radius:280px;  height:280px ;  }

.qualite{z-index:1; position: absolute; text-transform:uppercase; left: 250px; color:#000; font-size:30px;  width:300px ; height:50px ; background-color:#f1c40f;  border-radius:50px; display:flex; align-items:center; justify-content:center;  text-align:center; }
#qualite1{top: 100px;}
#qualite2{top: 170px;}
#qualite3{top: 240px;}
.green{color:#3498db;}
.red{color:#c0392b;}
.overlay{position:absolute; z-index:1; left:0; top:0;  width:800px; height:420px; background-color:#000; opacity:0.7;}
#foot{z-index:1; position: absolute; font-family: 'Acme', sans-serif; left: 0px; bottom: 10px; color:#fff; font-size:34px; width:800px ; height:60px ;display:flex; align-items:center; justify-content:center; text-align:center;}

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
          $joeurs = array('Messi','Ronaldo','Benzema','Griezmann','S. Mané','M. Salah','Neymar','Neuer');
          $img = array('1529166924','1529168199','1529168262','1529168289','1529168307','1529168327','1529168347','1529168368');
          $qualites = array('بسرعة','تقني','تكتيكي','ذكي','رياضي','هدوء','ذكي');
          $ind = mt_rand(0,7); shuffle($qualites);
?>
<!DOCTYPE HTML>
<img src="https://creation.funizi.com/images-theme-perso/1529161162.jpg" id="back"> 
<div class="overlay"></div>
<img src="https://creation.funizi.com/images-theme-perso/1529160988.png" id="cadre"> 

<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user"> 

<img src="https://creation.funizi.com/images-theme-perso/<?=$img[$ind]?>.jpg" id="player"> 

<div class="texte qualite" id="qualite1"><?=$qualites[0]?></div>
<div class="texte qualite" id="qualite2"><?=$qualites[1]?></div>
<div class="texte qualite" id="qualite3"><?=$qualites[2]?></div>
 
 
<div class="texte" id="foot"><span class="green"><?php echo $_GET['user_name']; ?></span> يشبه  <span class="red"><?=$joeurs[$ind]?></span> </div>
 
 

        </div>
        
        </body>
        </html>
      