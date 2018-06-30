
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
#fb_id_user{position: absolute; z-index:1; left: 75px; top: 26px; width:250px ;  height:250px ; object-fit: cover; object-position: 50% 10%; border-radius:280px; border:1px solid #000;}
#player{position:absolute; z-index:1; right: 75px; top: 26px; width:250px ;border-radius:250px;  height:250px ;  }

#arrow{display:none; position:absolute; z-index:1; left:388px; top:292px;  max-width:800px; max-height:420px; }
.nom{z-index:1; position: absolute; text-transform:uppercase; top: 290px; color:#000; font-size:25px;  width:250px ; height:30px ; background-color:#f1c40f;  border-radius:50px; display:flex; align-items:center; justify-content:center;  text-align:center; }
#nom1{left: 75px; font-size:22px;}
#nom2{right: 75px;}
#qualite3{top: 240px;}
.green{color:#3498db;}
.red{color:#c0392b;}
.overlay{position:absolute; z-index:1; left:0; top:0;  width:800px; height:420px; background-color:#000; opacity:0.7;}
#foot{z-index:1; position: absolute; font-family: 'Acme', sans-serif; left: 0px; bottom: 20px; color:#fff; font-size:28px; width:800px ; height:60px ;display:flex; align-items:center; justify-content:center; text-align:center;}

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
          $personnages = array('Tom','Franklin','San Goku','Lucky Luke','Jerry','Oggy','Naruto','Père Castor','Dora');
          $img = array('1530285448','1530285541','1530285875','1530285912','1530285961','1530285982','1530286009','1530286029','1530292283');
          $qualites = array('لا تستسلم أبدًا مثل توم.','هو شخص بيتي يفكر في أصدقائه أولاً وقبل كل شيء.',
                    'لديه قوى كبيرة مثل جوكو','لا تزال تحارب الظلم مثل Lucky Luke.','يعرف دائما كيفية التعامل مع مثل جيري.',
                    'هو شخص هادئ ونظيف ومنظم.','لديه شخصية سعيدة وحازمة مثل ناروتو.','aime raconter des histoires aux enfants.',
                    'aime faire apprendre tout en amusant et en faisant rire.');
          $ind = mt_rand(0,8); 
?>
<!DOCTYPE HTML>
<img src="https://creation.funizi.com/images-theme-perso/1530291375.jpg" id="back"> 
<div class="overlay"></div>

<img src="https://creation.funizi.com/images-theme-perso/1530293925.png" id="arrow"> 
 
<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user"> 

<img src="https://creation.funizi.com/images-theme-perso/<?=$img[$ind]?>.jpg" id="player">

<div class="texte nom" id="nom1"><?php echo $_GET['user_name']; ?></div>
<div class="texte nom" id="nom2"><?=$personnages[$ind]?></div>
 
<div class="texte" id="foot"><span class="green"><?php echo $_GET['user_name']; ?></span>  <?=$qualites[$ind]?> </div>
 
 

        </div>
        
        </body>
        </html>
      