
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Boogaloo" rel="stylesheet">
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


#back{position:absolute; z-index:1; left:0; top:0; opacity:0.6; max-width:800px; max-height:420px; }
 
#fb_id_user{position: absolute; z-index:1; left: 20px; top: 30px; width:340px ;  height:340px ; object-fit: cover; object-position: 50% 10%; border:10px solid #FFF;}
 
.qualite{z-index:1; position: absolute; font-family: 'Boogaloo', cursive; right: 20px; color:#FFF; font-size:50px; line-height:40px; width:350px ; height:80px ; background:#D50000; border:10px solid #FFF; border-radius:0;  padding-left:15px; display:flex; align-items:center;  }
#qualite1{top:30px;}
#qualite2{top:160px;}
#qualite3{top:290px;}

#star{position:absolute; z-index:1; left:170px; bottom:10px;  }

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
          $qualites = array('Deine Tapferkeit','Ihre Eloquenz','Ihre Ausstrahlung','Dein Charme','Deine Entschlossenheit','Deine Ehrlichkeit','Dein Mut','Deine Loyalität','Ihr Vertrauen');
          shuffle($qualites);
?>
<!DOCTYPE HTML>

<img src="https://creation.funizi.com/images-theme-perso/1525017015.png" id="back"> 
 
<img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="fb_id_user"> 

<img src="https://creation.funizi.com/images-theme-perso/1525019913.png" id="star"> 
 
<div class="texte qualite" id="qualite1"><?=$qualites[0]?> </div>
<div class="texte qualite" id="qualite2"><?=$qualites[1]?> </div>
<div class="texte qualite" id="qualite3"><?=$qualites[2]?> </div>
 
 

        </div>
        
        </body>
        </html>
      