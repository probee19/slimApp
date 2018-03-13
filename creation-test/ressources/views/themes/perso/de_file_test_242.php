
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Nunito|Russo+One" rel="stylesheet">
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

#fb_id_user{position: absolute; border:1px solid #000; z-index:0; left: 190px; top: 0px; width:420px ; max-width:800px; max-height:420px;}
#name_user{position:absolute; z-index:3;font-family: 'Russo One', sans-serif; left: 285px; bottom: 0; width:220px; text-align:center; font-size:35px; color:#c0392b; text-shadow: 2px 0 0 #fff, -2px 0 0 #fff, 0 2px 0 #fff, 0 -2px 0 #fff, 1px 1px #fff, -1px -1px 0 #fff, 1px -1px 0 #fff, -1px 1px 0 #fff;margin: 0 auto; border:5px solid #c0392b; padding: 10px 0 ;} 
.img_profile_friend{ position: absolute; z-index:1; width:135px ;border:1px solid #000; border-radius:0px; max-width:800px; max-height:420px;}
.texte{font-family: 'Nunito', sans-serif; z-index:2; position: absolute;color:#FFF; font-size:22px; width:160px ; height:135px ; background:#34495e;  display: flex; justify-content:center; align-items: center;  text-align:center;  padding:5px;  }

#background_white_left{position:absolute; z-index:1; margin-top:1px; left:0;top:0; width:275px; height:418px; background:#FFF;}
#background_white_right{position:absolute; z-index:1; margin-top:1px; right:0;top:0; width:275px; height:418px; background:#FFF;}

#fb_id_friend_1{ left: -20px; top: 0; }
#texte1{ left: 110px; top: 0; }

#fb_id_friend_2{ left: -20px; top: 142px;}
#texte2{ left: 110px; top: 142px; background:#e74c3c;}

#fb_id_friend_3{ left: -20px; bottom: 0px;}
#texte3{ left: 110px; bottom: 0;}

#fb_id_friend_4{ right: -20px; top: 0px;}
#texte4{ right: 110px; top: 0px; background:#e74c3c;}

#fb_id_friend_5{ right: -20px; top: 142px;}
#texte5{ right: 110px; top: 142px;}

#fb_id_friend_6{ right: -20px; bottom: 0px;}
#texte6{ right: 110px; bottom: 0px; background:#e74c3c;}
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
          $actions = array('bei dir einziehen','weinen jeden Moment','stehlen Sie Ihren Computer','stehlen Sie alle Lebensmittel in Ihrem Kühlschrank','engagiere Derrick, um dich zu finden',
          'passen Sie auf Ihre Familie auf','stehlen Sie alle Ihre Kleider','Holen Sie sich Ihr Bankkonto');
          shuffle($actions);
          if( $_GET['user_gender'] == 'homme' || $_GET['user_gender'] == 'male' || $_GET['user_gender'] == 'masculin' )
                    $adject = "VERBLASST";
          else
                    $adject = "Vermisst";
?>
<!DOCTYPE HTML>
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
<div class="name" id="name_user" ><?php echo $adject; ?></div>
<div id="background_white_left"></div>
<div id="background_white_right"></div>
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_1']; ?>/picture/?width=275&height=275" class="img_profile img_profile_friend" id="fb_id_friend_1">
<div class="texte" id="texte1"> <?php echo $_GET['friend_name_1']; ?> <?php echo $actions[0];?> </div>

<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_2']; ?>/picture/?width=275&height=275" class="img_profile img_profile_friend" id="fb_id_friend_2">
<div class="texte" id="texte2"> <?php echo $_GET['friend_name_2']; ?> <?php echo $actions[1];?> </div>

<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_3']; ?>/picture/?width=275&height=275" class="img_profile img_profile_friend" id="fb_id_friend_3">
<div class="texte" id="texte3"> <?php echo $_GET['friend_name_3']; ?> <?php echo $actions[2];?> </div>

<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_4']; ?>/picture/?width=275&height=275" class="img_profile img_profile_friend" id="fb_id_friend_4">
<div class="texte" id="texte4"> <?php echo $_GET['friend_name_4']; ?> <?php echo $actions[3];?> </div>

<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_5']; ?>/picture/?width=275&height=275" class="img_profile img_profile_friend" id="fb_id_friend_5">
<div class="texte" id="texte5"> <?php echo $_GET['friend_name_5']; ?> <?php echo $actions[4];?> </div>

<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_6']; ?>/picture/?width=275&height=275" class="img_profile img_profile_friend" id="fb_id_friend_6">
<div class="texte" id="texte6"> <?php echo $_GET['friend_name_6']; ?> <?php echo $actions[5];?> </div>


        </div>
        
        </body>
        </html>
      