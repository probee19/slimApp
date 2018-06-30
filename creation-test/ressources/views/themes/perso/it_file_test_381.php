
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">
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
 
.flag_team{z-index:1; position: absolute; left:150px; top:175px;   text-align:center; width:150px;   }
#fb_id_user{position: absolute; z-index:1; left: 30px; top: 20px; width:200px ;  height:200px ; object-fit: cover; object-position: 50% 10%; border-radius:200px;border:10px solid #fff;}
.text{ position:absolute;font-family: 'Titillium Web', sans-serif; text-transform:uppercase;z-index:1; left:200px; top: 300px; font-size:25px;line-height:25px; color:#FFF; width:400px; height:40px; text-align:center;} 

#personne{ position:absolute;font-family: 'Exo 2', sans-serif; text-transform:uppercase;z-index:1; left:30px; top: 250px; font-size:45px; font-weight:700; line-height:45px; color:#FFF; width:400px; height:40px; text-align:left;} 
#poste{ position:absolute;font-family: 'Exo 2', sans-serif; z-index:1; left:30px; top: 350px;font-size:35px;line-height:40px; color:#FFF; width:400px; height:40px; text-align:left;} 
#country{ position:absolute;font-family: 'Exo 2', sans-serif; text-transform:uppercase; z-index:1; left:30px; top: 305px;font-size:25px;line-height:30px;opacity:0.8; color:#FFF; width:400px; height:40px; text-align:left;} 

#player{position:absolute; z-index:1; right:30px; bottom:20px; border-radius:200px;border:10px solid #fff; width:200px; height:200px; }
.player{display:block; font-size:45px; color:#f1c40f;}
#role{z-index:1; position: absolute; right: 20px; top: 20px; font-family: 'Exo 2', sans-serif; color:#fff; font-size:40px; line-height:50px; width:470px ; height:150px ; text-align:right; max-width:800px; max-height:420px;}





#tag{display:none; z-index:1; position: absolute;font-family: 'Titillium Web', sans-serif; font-style:italic; left: 120px; bottom: 20px; color:#fff; font-size:24px; width:200px ; height:50px ;  text-align:center; }



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
          $postes = array('centrocampista');
          $img = array('eng'=>'1530296934','bra'=>'1530297951','rus'=>'1530298193','bel'=>'1530298255','arg'=>'1530298443','esp'=>'1530298580','che'=>'1530299378','fra'=>'1530299514','mex'=>'1530299708','swe'=>'1530299763','ury'=>'1530305094','hrv'=>'1530305164','jpn'=>'1530305256','prt'=>'1530305364','dnk'=>'1530305477','col'=>'1530313628');
          $players = array('eng'=>'Harry Kane','bra'=>'Neymar Jr','rus'=>'Artem Dzyuba','bel'=>'Lukaku','arg'=>'Lionel Messi','esp'=>'Diego Costa','che'=>'Josip Drmić','fra'=>'Griezmann','mex'=>'J. Hernandez','swe'=>'Ola Toivonen','ury'=>'Luis Suarez','hrv'=>'Mario Mandzukic','jpn'=>'Osako','prt'=>'Cristiano Ronaldo','dnk'=>'Poulsen','col'=>'Falcao');
          $cc = $_GET['cc'];
          $ind = mt_rand(0,15);
          shuffle($postes);
?>
<!DOCTYPE HTML>
<img src="https://creation.funizi.com/images-theme-perso/1530101863.jpg" id="back"> 

<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user"> 
 
<img src="https://s3.us-east-2.amazonaws.com/funiziuploads/api/flags_big/<?=$cc?>.png" id="" class="flag_team"> 



<div class="texte" id="role"> Effectue des passes décisives à <span class="player"><?=$players[$cc]?></span> </div>
 
<div class="texte" id="personne"><?php echo $_GET['user_name']; ?></div>
<div class="texte" id="country"><?php echo $_GET['cn']; ?></div>
<div class="texte" id="poste"><?=$postes[0]?></div>

<div class="texte" id="tag">#funizi</div>


<img src="https://creation.funizi.com/images-theme-perso/<?=$img[$cc]?>.jpg" id="player"> 
 

        </div>
        
        </body>
        </html>
      