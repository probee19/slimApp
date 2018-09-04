
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Kaushan+Script|Merienda" rel="stylesheet">
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

#back{position:absolute; z-index:1; left:20px; top:0;  max-width:800px; max-height:420px;  }
#fb_id_user{z-index:0;position: absolute;  left: 0px; top: 0px; width:300px ;  height:420px ; object-fit: cover; object-position: 50% 10%; border-radius:0px; max-width:800px; max-height:420px;}
.qualites{z-index:1; font-family: 'Merienda', cursive; position: absolute; right: 30px;  width:470px ; height:150px ; display:flex;  text-align:center;} 
#qualites_entete{top: 0; color:#000; font-size:35px; line-height:50px; align-items:flex-end; }
#qualites_corps{font-family: 'Kaushan Script', cursive; top: 200px; color:#273c75; font-size:45px; line-height:55px; text-transform:uppercase; align-items:flex-start; justify-content:center; text-align:center; }

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
 $qualites = array(' sa loyauté ',' son honnêteté ',' sa sincérité ',' sa franchise ',' sa fidélité ', ' son authenticité ',' sa patience ',' son courage ', ' sa sensibilité ',' sa générosité ',' sa sagesse ');
 shuffle($qualites);
?>
<!DOCTYPE HTML>
<img src="https://creation.funizi.com/images-theme-perso/1535970692.png" id="back"> 

<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user">

<div class="texte qualites" id="qualites_entete">  Les deux plus grandes qualités de <?php echo $_GET['user_name']; ?>  :</div>

<div class="texte qualites" id="qualites_corps"><?=$qualites[0]?><br>et<br><?=$qualites[1]?></div>


        </div>
        
        </body>
        </html>
      