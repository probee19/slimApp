
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Mina" rel="stylesheet">
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
              .main{ padding:0;margin:0;width: 800px;height:420px;position: relative;overflow: hidden; background: #E8EAF6;}
.main img{ position:absolute; max-height:420px; max-width:800px; }

#head{z-index:1; font-family: 'Mina', sans-serif; position: absolute; left: 0px; top: 0px; color:#FFF; font-size:30px; line-height:45px; width:800px ; height:50px ; background:#3949AB; border:0; border-radius:0px;  padding:0px; text-align:center; max-width:800px; max-height:420px;}

#fb_id_user{position: absolute; z-index:1; left: 45px; top: 95px; width:280px ; border:10px solid #FFF; height:280px ; object-fit: cover; object-position: 50% 10%;  }

#heart{position:absolute; z-index:1; left:368px; top:203px;   max-width:800px; max-height:420px; }

#letter{z-index:1; font-family: 'Mina', sans-serif; position: absolute; right: 45px; top: 95px; color:#3949AB; font-size:180px; width:280px ; height:280px ; background:#FFF; display:flex; align-items:center; justify-content:center; text-align:center; }
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
          $lettres = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','R','S','T','V','Y');
          shuffle($lettres);
?>
<!DOCTYPE HTML>

<div class="texte" id="head"> الحرف الأول من حبك الكبير هو ... </div>

 
<img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="fb_id_user"> 

<img src="https://creation.funizi.com/images-theme-perso/1525097350.png" id="heart"> 


<div class="texte" id="letter"><?=$lettres[0]?></div>
 
 

        </div>
        
        </body>
        </html>
      