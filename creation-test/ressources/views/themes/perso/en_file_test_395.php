
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Dosis|Exo+2" rel="stylesheet">
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

.compet{position:absolute; z-index:1; right:125px;  top: 70px; width:130px; height:130px; }
.name_compet{position:absolute; font-family: 'Exo 2', sans-serif; color:#f1c40f; font-weight:700; z-index:1; right:20px; bottom:155px; width:340px;height:40px ; color:#fff; font-size:30px; text-align:center;}
.overlay{position:absolute; z-index:1; left:0; top:0; background:#000; opacity:0.7; width:800px; height:420px; }
#compet_1,#compet_1_name{}
#back{position:absolute; z-index:1; left:0; top:0;  max-width:800px; max-height:420px; }

#fb_id_user{position: absolute; z-index:1; left: 125px; top: 70px; width:130px ;  height:130px ; object-fit: cover; object-position: 50% 10%; border-radius:130px; }
.texte{z-index:1;font-family: 'Exo 2', sans-serif; position: absolute;  color:#fff; font-size:30px; width:600px ; height:40px ;  text-align:center; }
#joueur{left:20px; bottom:155px; width:360px;}
#details{bottom: 30px; left:50px; width:700px; height: 100px; line-height:40px;}
#title{top: 0; left:0; width:800px; height: 50px; font-size:25px; line-height:40px; background-color:#f1c40f; color:#000; font-weight:700;}

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
          $compet = array('1533566733'=>'La Liga','1533566549'=>'Ligue 1','1533566068'=>'Serie A','1533566091'=>'Premier League');
          $logo = array('1533566733','1533566549','1533566068','1533566091');
          $details = array('1533566733'=>array('Avec ses qualités impréssionnantes, <span style="color:#f1c40f; font-weight:700">'.$_GET['user_name'].'</span> est le rival de taille pour <span style="color:#f1c40f; font-weight:700">Messi</span>.','<span style="color:#f1c40f; font-weight:700">'.$_GET['user_name'].'</span> est le coéquipier parfait que <span style="color:#f1c40f; font-weight:700">Messi</span> cherche !'),
          '1533566549'=>array('<span style="color:#f1c40f; font-weight:700">'.$_GET['user_name'].'</span> et <span style="color:#f1c40f; font-weight:700">Neymar</span> feront un duo de choc cette saison.'),
          '1533566068'=>array('<span style="color:#f1c40f; font-weight:700">Ronaldo</span> a besoin des passes magiques de <span style="color:#f1c40f; font-weight:700">'.$_GET['user_name'].'</span> pour être le meilleur buteur de cette saison.','Avec ses talents hors norme, <span style="color:#f1c40f; font-weight:700">'.$_GET['user_name'].'</span> sera le rival idéal de <span style="color:#f1c40f; font-weight:700">Ronaldo</span> cette saison.'),
          '1533566091'=>array('<span style="color:#f1c40f; font-weight:700">'.$_GET['user_name'].'</span> sera le meilleur buteur de cette saison avec <span style="color:#f1c40f; font-weight:700">Kevin De Bruyne</span> comme coéquipier.'));
          shuffle($logo); 
          $details = $details[$logo[0]];
          shuffle($details);
?>
<!DOCTYPE HTML>
<img src="https://creation.funizi.com/images-theme-perso/1533569261.jpg" id="back"> 
<div class="overlay"></div>

<div class="texte" id="title"> Dans quel championnat devrais-tu jouer cette saison ?  </div>
<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user">

<img src="https://creation.funizi.com/images-theme-perso/<?=$logo[0]?>.png" id="compet_1" class="compet"> 
<div class="name_compet" id="compet_1_name"><?=$compet[$logo[0]]?></div>


<div class="texte" id="joueur"><?php echo $_GET['full_user_name']; ?> </div>
<div class="texte" id="details"> <?=$details[0]?>  </div>




        </div>
        
        </body>
        </html>
      