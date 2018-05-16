
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Acme" rel="stylesheet">
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

#fb_id_user{position: absolute; z-index:1; left: -60px; top: 0px; width:420px ;  height:420px ; object-fit: cover; object-position: 50% 10%;  }
#back_white{position:absolute; z-index:1; right: 0; top: 0; width:500px; height:420px; background:#FFF; }
.back{position:absolute; font-family: 'Acme', sans-serif; font-size:40px; line-height:55px; color:#FFF; text-align:center; z-index:1; right: 0;  width:490px; height:205px;}
#back_blue{top: 0; background:#2962FF; }
#back_red{bottom: 0;  background:#D50000; }
.res{position:absolute;font-family: 'Acme', sans-serif; text-transform:capitalize; font-size:55px; left:0; top:80px; width:100%; text-align:center;}

#like{position:absolute; z-index:1; left:250px; top:42px; transform:rotate(-20deg);  }
#dislike{position:absolute; z-index:1; left:250px; bottom:42px; transform:rotate(-20deg);  }
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
          $qualites = array('amable','agradable','sociable','digno','modesto','eficaz','integrado','gracioso');
          $defauts = array('Demasiado sensible',' tropamable');
          shuffle($qualites); shuffle($defauts);
?>
<!DOCTYPE HTML>

<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user"> 
<div id="back_white" ></div>
<div class="back" id="back_blue" > Mejor calidad : <span class="res" id="qualite"><?=$qualites[0]?></span></div>
<div class="back" id="back_red" > El peor defecto : <span class="res" id="defaut"><?=$defauts[0]?></span></div> 

<img src="https://creation.funizi.com/images-theme-perso/1525691289.png" id="like"> 

<img src="https://creation.funizi.com/images-theme-perso/1525691337.png" id="dislike"> 
 



        </div>
        
        </body>
        </html>
      