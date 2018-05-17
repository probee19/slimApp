
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Chicle" rel="stylesheet">

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
              .main{ padding:0;margin:0;width: 800px;height:420px;position: relative;overflow: hidden; background: #000;}
.main img{ position:absolute; max-height:420px; max-width:800px; }

#fb_id_user_act,#fb_id_user{position: absolute; z-index:1;  width:400px ;  height:400px ; object-fit: cover; object-position: 50% 10%; }

#fb_id_user_act{ left: 0; top: 0;  }
#fb_id_user{ right: 0; top: 0;  }
#name_user1, #name_user2{position:absolute; z-index:1;font-family: 'Chicle', cursive;  bottom: 0; width:400px; height:50px; font-size:30px; display:flex; align-items:center; justify-content:center; color:#FFF;} 
#name_user1{left:0; background:#E53935;}
#name_user2{right:0; background:#1565C0;}

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
          $texte = array('50% de ta mère', '50% de ton père','50/50 de tes parents');
          shuffle($texte);
?>
<!DOCTYPE HTML>
<img src="<?php echo $_GET['url_img_profile_user0']; ?>" class="img_profile" id="fb_id_user_act">
<img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="fb_id_user">
<div class="name texte" id="name_user1" ><?php echo urldecode($_GET['user_name']); ?> maintenant</div>

<div class="name texte" id="name_user2" ><?=$texte[0];?></div>



        </div>
        
        </body>
        </html>
      