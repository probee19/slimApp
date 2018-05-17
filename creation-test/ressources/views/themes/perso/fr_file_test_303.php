
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Lobster|Courgette" rel="stylesheet">
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

#jauge{position:absolute; z-index:1; left:125px; top:25px;  max-width:800px; height:300px; }
#percent{z-index:1;font-family: 'Lobster', cursive; position: absolute; left: 145px; top: 235px; color:#FFF; font-size:28px; width:80px ; height:80px ;  display:flex; align-items:center; justify-content:center; text-align:center;}

#fb_id_user{position: absolute; z-index:2; right:125px; top: 25px; width:300px ; border-radius:300px; }
#name_user{position:absolute; z-index:1; left: 0px; top: 0px; font-size:30px; color:#000;} 

#t_footer{z-index:1;font-family: 'Courgette', cursive; position: absolute; left: 0px; bottom: 0px; color:#FFF; font-size:35px; display:flex; align-items:center; justify-content:center; width:800px ; height:70px ; background:#C62828; text-align:center; }
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
          $percent = mt_rand(85,100);
?>
<!DOCTYPE HTML>
<img src="https://creation.funizi.com/images-theme-perso/1519985789.png" id="jauge"> 

<div class="texte" id="percent"> <?=$percent;?>% </div>

<img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="fb_id_user">
<div class="name texte" id="name_user" ></div>

<div class="texte" id="t_footer"> <?php echo urldecode($_GET['user_name']); ?>,  tu es honnête à  <?=$percent;?> % !</div>


        </div>
        
        </body>
        </html>
      