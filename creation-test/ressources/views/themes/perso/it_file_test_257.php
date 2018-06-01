
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Cookie" rel="stylesheet">
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

#back{position:absolute; z-index:1; left:0; top:0;  width:800px; max-height:420px; opacity:0.7; }

#fb_id_user{position: absolute; z-index:1; left:125px; top: 110px; width:150px ; border-radius:0px; }
#name_user{position:absolute;font-family: 'Cookie', cursive; z-index:1; left: 80px; top: 55px; width:240px ; text-align:center; font-size:40px; color:#FFF;} 
#p{position:absolute;font-family: 'Cookie', cursive; z-index:2; left: 70px; bottom: 110px; width:260px ; text-align:center; font-size:35px; color:#FFF;} 
#don{position:absolute; font-family: 'Cookie', cursive;z-index:2; left: 70px; bottom: 40px; width:260px ; text-align:center; font-size:70px; color:#FFF;} 

#diagramme{position:absolute; z-index:1; right:30px; top:30px;  width:360px;  }
.qualite{position:absolute; z-index:1;  width:170px; text-align:center; font-size:45px; line-height:40px; font-family: 'Cookie', cursive;}
#qualite1{left:410px; top:170px; transform:rotate(-30deg);}
#qualite2{left:600px; top:180px; transform:rotate(30deg);}
#qualite3{right:125px; bottom:80px;}
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
      
<!DOCTYPE HTML>
<?php
          $dons = array('speranza', 'calma', 'fortuna', 'sincerità', 'coraggio', 'forza', 'la leadership');
          $qualites = array('sensibilità','coraggio','avvertimento','fascino','assicurazione','individualità','altruismo','forza of character','lealtà','imparzialità','flessibilità');
          shuffle($qualites);
          shuffle($dons);
?>
<img src="http://creation.funizi.com/images-theme-perso/1514468994.png" id="back"> 

<img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="fb_id_user">
<div class="name texte" id="name_user" ><?php echo urldecode($_GET['user_name']); ?></div>

<div id="p" >Stai irradiando </div>
<div id="don" ><?php echo $dons[0]; ?></div>


<img src="http://creation.funizi.com/images-theme-perso/1514475113.png" id="diagramme"> 
<div class="qualite" id="qualite1"><?php echo mt_rand(80,99).' % '.$qualites[0]; ?> </div>
<div class="qualite" id="qualite2"><?php echo mt_rand(80,99).' % '.$qualites[1]; ?> </div>
<div class="qualite" id="qualite3"><?php echo mt_rand(80,99).' % '.$qualites[2]; ?> </div>




        </div>
        
        </body>
        </html>
      