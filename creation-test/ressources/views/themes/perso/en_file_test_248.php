
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Righteous|Tangerine:700" rel="stylesheet">
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

#fb_id_user{position: absolute; z-index:1; left: 20px; top: 30px; width:296px ; border:2px solid #B71C1C; max-width:800px; max-height:420px;}
#name_user{position:absolute; font-family: 'Righteous', cursive; z-index:1; left: 20px; top: 330px; width:300px; font-size:25px; height:60px; color:#FFF; background:#B71C1C; display:flex; align-items:center; justify-content:center;} 
#entete{position:absolute; font-family: 'Righteous', cursive; z-index:1; right: 20px; top: 30px; width:440px; font-size:40px; height:60px; color:#FFF; background:#B71C1C; display:flex; align-items:center; justify-content:center;} 
#prix{position:absolute; font-family: 'Tangerine', cursive; z-index:1; right: 20px; top: 90px; width:400px; font-size:65px; line-height:70px; padding:20px;height:260px; color:#FFF; background:#01579B; display:flex; align-items:center; text-align:center;} 
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
          if( $_GET['user_gender'] == 'homme' || $_GET['user_gender'] == 'male' || $_GET['user_gender'] == 'masculin' )
                    $prix = array('The most discreet man of the year', 'The most seductive man of the year', 'The gentleman of the year', 'The funniest man of the year', 'The most sensual man of the year ');
          else
                    $prix = array('The most discreet woman of the year ', 'The most seductive woman of the year', 'The funniest woman of the year', 'The most sensual woman of the year');
          
          shuffle($prix);
?>
<!DOCTYPE HTML>
<img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="fb_id_user">
<div class="name texte" id="name_user" ><?php echo urldecode($_GET['user_name']); ?></div>
<div id="entete"> 2017 price</div>
<div id="prix"><?php echo $prix[0]; ?> </div>

        </div>
        
        </body>
        </html>
      