
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Lobster+Two" rel="stylesheet">
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
.img_profile{position: absolute; z-index:1; bottom: 70px; width:220px ; border:15px solid #FF5722; -webkit-box-shadow: 0 -16px 27px -5px rgba(0,0,0,1); -moz-box-shadow: 0 -16px 27px -5px rgba(0,0,0,1); box-shadow: 0 -16px 27px -5px rgba(0,0,0,1);}
.name{position:absolute; font-family: 'Lobster Two', cursive; z-index:2;  width:250px; height:50px; bottom: 20px; font-size:25px; color:#FFF; text-align:center; background:#FF5722; -webkit-box-shadow: 0 16px 27px -5px rgba(0,0,0,1); -moz-box-shadow: 0 16px 27px -5px rgba(0,0,0,1); box-shadow: 0 16px 27px -5px rgba(0,0,0,1);}
#fb_id_user{left: 100px;}
#name_user{left: 100px; } 
#title{position:absolute; font-family: 'Lobster Two', cursive;z-index:2; width:800px; left:0; height:70px;font-size:40px; line-height:50px; color:#FFF;text-align:center;background:#FF5722; }
#background{position:absolute; z-index:1; left:0; bottom:0;  width:800px; }
#fb_id_friend_1{ right: 100px; }
#name_friend_1{right: 100px; } 

#arrow{position:absolute; z-index:1; left:372px; top:230px;   }
#ball{position:absolute; z-index:1; left:372px; top:130px;   }
#ball2{position:absolute; z-index:1; left:372px; top:340px;   }
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
<div id="title"> Wer ist dein bester Freund? </div>
<img src="http://creation.funizi.com/images-theme-perso/1514391096.jpg" id="background"> 

<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user">
<div class="name texte" id="name_user" ><?php echo $_GET['full_user_name']; ?></div>

<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_1']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_friend_1">
<div class="name texte" id="name_friend_1" ><?php echo $_GET['friend_name_1']; ?></div>


<img src="http://creation.funizi.com/images-theme-perso/1514392448.png" id="arrow"> 

<img src="http://creation.funizi.com/images-theme-perso/1514393282.png" id="ball"> 

<img src="http://creation.funizi.com/images-theme-perso/1514393459.png" id="ball2"> 

        </div>
        
        </body>
        </html>
      