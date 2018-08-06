
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

.club{position:absolute; z-index:1; right:240px;   width:80px; height:80px; }
.name_club{position:absolute; font-family: 'Exo 2', sans-serif; color:#f1c40f; font-weight:700; z-index:1; left:570px; width:210px; height:80px; color:#fff; font-size:30px; display:flex; align-items:center;}
.overlay{position:absolute; z-index:1; left:0; top:0; background:#000; opacity:0.7; width:800px; height:420px; }
#club_1,#club_1_name{bottom:230px;}
#club_2,#club_2_name{bottom:130px;}
#club_3,#club_3_name{bottom:30px;}
#back{position:absolute; z-index:1; left:0; top:0;  max-width:800px; max-height:420px; }

#fb_id_user{position: absolute; z-index:1; left: 50px; top: 50px; width:200px ;  height:200px ; object-fit: cover; object-position: 50% 10%; border-radius:200px; max-width:800px; max-height:420px;}
.texte{z-index:1;font-family: 'Exo 2', sans-serif; position: absolute; left: 30px;  color:#fff; font-size:30px; width:600px ; height:40px ;  text-align:left; }
#joueur{bottom:110px;}
#cout{bottom: 50px; line-height:35px;}
#head_club{top:50px; left:500px;  text-transform:uppercase;}


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
          $clubs = array('1533121539'=>'PSG','1533121607'=>'Barcelone','1533125790'=>'Real Madrid','1533125753'=>'Juventus','1533121730'=>'Chelsea','1533121755'=>'Bayern Munich','1533565210'=>'Marseille');
          $logo = array('1533121539','1533121607','1533125790','1533125753','1533121730','1533121755','1533565210');
          $couts = mt_rand(180,232);
          shuffle($logo);
?>
<!DOCTYPE HTML>
<img src="https://creation.funizi.com/images-theme-perso/1533563635.jpg" id="back"> 
<div class="overlay"></div>

<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user">

<div class="texte" id="head_club"> النوادي المهتمة :</div>
<img src="https://creation.funizi.com/images-theme-perso/<?=$logo[0]?>.png" id="club_1" class="club"> 
<div class="name_club" id="club_1_name"><?=$clubs[$logo[0]]?></div>
<img src="https://creation.funizi.com/images-theme-perso/<?=$logo[1]?>.png" id="club_2" class="club"> 
<div class="name_club" id="club_2_name"><?=$clubs[$logo[1]]?></div>
<img src="https://creation.funizi.com/images-theme-perso/<?=$logo[2]?>.png" id="club_3" class="club"> 
<div class="name_club" id="club_3_name"><?=$clubs[$logo[2]]?></div>


<div class="texte" id="joueur"><?php echo $_GET['full_user_name']; ?> </div>
<div class="texte" id="cout"> كلفة : <span style="color:#f1c40f; font-weight:700"><?=$couts?> M€</span> <?php if($couts>220) echo "<br><span style='color:#e74c3c; font-weight:700;text-transform:uppercase'> الرقم القياسي العالمي</span> ";?> </div>




        </div>
        
        </body>
        </html>
      