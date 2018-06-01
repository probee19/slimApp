
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">
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

#background{position:absolute; z-index:1; left:0; top:0; width:100%; max-width:800px; max-height:420px; }

#fb_id_user{position: absolute; z-index:1; left: 100px; bottom: 30px; width:250px ; border-radius:250px; border:5px solid #880E4F; max-width:800px; max-height:420px;}
#texte_surprise{position:absolute; font-family: 'Satisfy', cursive; z-index:1; left: 20px; top: 20px; width:760px; height:120px; display:flex; justify-content:center; align-items:center; text-align:center; font-size:45px; line-height:50px; color:#FFF;} 

#surprise{position:absolute; bottom:30px; right:100px; z-index:1; width:250px; border-radius:250px; border:5px solid #880E4F; height:250px; max-width:800px; max-height:420px; }

#fleche{position:absolute; z-index:1; left:350px; top:230px; width:100px; max-width:800px; max-height:420px; }
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
          $surprises = array('terá um novo emprego.', 'terá um aumento.', 'vai se casar.', 'terá um novo filho.', 'vai fazer um encontro que mudará sua vida.', 'vai se envolver.');
          $images = array('1513880456.jpg','1513880456.jpg','1513880473.jpg','1513880473.jpg','1513880576.png','1513880576.png');
          $index = mt_rand(0,5);
          //shuffle($surprises);
?>
<!DOCTYPE HTML>

<img src="http://creation.funizi.com/images-theme-perso/1513874780.jpg" id="background"> 

<img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="fb_id_user">
<div id="texte_surprise" >Durante o ano de 2018, <?php echo urldecode($_GET['user_name']); ?> <?php echo $surprises[$index]; ?></div>

<img src="http://creation.funizi.com/images-theme-perso/<?php echo $images[$index]; ?>" id="surprise"> 

<img src="http://creation.funizi.com/images-theme-perso/1513880814.png" id="fleche"> 



        </div>
        
        </body>
        </html>
      