
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Concert+One" rel="stylesheet">
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
#fb_id_user{position: absolute; z-index:1; right: -60px; top: 0px; width:420px ;  height:420px ; object-fit: cover; object-position: 50% 10%;  }
.back{position:absolute; font-family: 'Concert One', cursive; font-size:25px; line-height:30px; color:#FFF; z-index:1; left: 0;  width:490px; height:84px;border-radius: 0px 400px 400px 0px;}
#back_blue{top: 0; background:#2962FF; }
#back_orange{top: 84px; background:#D84315; }
#back_red{top: 168px; background:#B71C1C; }
#back_grey{top: 252px; background:#1B5E20; }
#back_purple{top: 336px; background:#4A148C; }
.res{position:absolute; left:10px; top:0; height:100%; width:470px; display:flex; align-items:center; text-align:left; }

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
          $textes = array(''.urldecode($_GET['user_name']).' always gives advice.',''.urldecode($_GET['user_name']).' shows his love to everyone.',''.urldecode($_GET['user_name']).' loves unconditionally.',''.urldecode($_GET['user_name']).' would do anything for his family.',
          ''.urldecode($_GET['user_name']).' is always a model for others.',''.urldecode($_GET['user_name']).' would go to the end of the world with his friends.',''.urldecode($_GET['user_name']).' spreads joy and happiness',''.urldecode($_GET['user_name']).' never give up.',
          ''.urldecode($_GET['user_name']).' is always courageous.',''.urldecode($_GET['user_name']).' is still optimistic.',''.urldecode($_GET['user_name']).' knows how to forgive.',''.urldecode($_GET['user_name']).' will never deceive his friends.');
          shuffle($textes);
?>
<!DOCTYPE HTML>
<img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="fb_id_user"> 
<div class="back" id="back_blue" ><span class="res" id="qualite1"><?=$textes[0]?></span></div>
<div class="back" id="back_orange" ><span class="res" id="qualite2"><?=$textes[1]?></span></div>
<div class="back" id="back_red" ><span class="res" id="qualite3"><?=$textes[2]?></span></div>
<div class="back" id="back_grey" ><span class="res" id="qualite4"><?=$textes[3]?></span></div>
<div class="back" id="back_purple" ><span class="res" id="qualite5"><?=$textes[4]?></span></div>


        </div>
        
        </body>
        </html>
      