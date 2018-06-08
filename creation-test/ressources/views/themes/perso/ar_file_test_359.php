
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
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

.team_name{z-index:1; font-family: 'Titillium Web', sans-serif; position: absolute; bottom: 65px; color:#FFF; font-size:27px; line-height:35px; width:330px ; height:50px; display:flex; align-items:center; }
#team_a{ left: 0;  justify-content:flex-end ;}
#team_b{ right: 0;  justify-content:left;}

.flag_team{z-index:1; position: absolute;  bottom:62px; width:90px ; height:47px ; text-align:center;   }
#flag_tema_a{left: 37px;}
#flag_tema_b{right: 37px;}

#pronostic{z-index:1; z-index:1; font-family: 'Titillium Web', sans-serif;  position: absolute; left: 180px; top: 80px; color:#fff; font-size:35px; line-height:40px; width:415px ; height:100px ;   text-align:center; }

#fb_id_user{position: absolute; z-index:1; left: 370px; bottom: 140px; width:60px ; border-radius:60px; }

.yes{position:absolute; z-index:1; }
#yes_a{left:350px; bottom:70px; }
#yes_b{right:355px; bottom:70px; }
#yes_ab{display:none; }





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
         //$pr  = eamuser_ps'];
         $pr = 'b';
         if( $pr ==  'a'){
                   $class_no = 'yes_b';
                   $class_yes = 'yes_a'; 
                   $team = eam_a_name'];
                   $ph = 'a pronostiqué la victoire du <span style="color:#FF3369">'.$team.'</span>.';
         }
         elseif( $pr ==  'b'){
                   $class_no = 'yes_a';
                   $class_yes = 'yes_b';   
                   $team = eam_b_name'];
                   $ph = 'a pronostiqué la victoire du <span style="color:#FF3369">'.$team.'</span>.';
         }
         else{
                   $class_no = 'yes_ab';
                   $class_yes = 'yes_ab';  
                   $ph = 'a pronostiqué un match nul.';
         }
          
          $adv = 'du'; 
          
                    
?>

<img src="https://creation.funizi.com/images-theme-perso/1528471357.jpg" id="back"> 

<div class="texte" id="pronostic"> <span style="color:#03D7DC"><?php echo $_GET['user_name']; ?></span><?=$ph;?> </div>

<img src="https://s3.us-east-2.amazonaws.com/funiziuploads/api/flags/sen.png" id="flag_tema_a" class="flag_team"> 
<div class="texte team_name" id="team_a"><?php echo $_GET['team_a_name']; ?></div>

<img src="https://s3.us-east-2.amazonaws.com/funiziuploads/api/flags/eng.png" id="flag_tema_b" class="flag_team"> 
<div class="texte team_name" id="team_b"><?php echo $_GET['team_b_name']; ?></div>

<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user"> 
 
<img src="https://creation.funizi.com/images-theme-perso/1528476005.png" class="yes" id="<?=$class_no;?>"> 

<img src="https://creation.funizi.com/images-theme-perso/1528472617.png" class="yes" id="<?=$class_yes;?>"> 
 

        </div>
        
        </body>
        </html>
      