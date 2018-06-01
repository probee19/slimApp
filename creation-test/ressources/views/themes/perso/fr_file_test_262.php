
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
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

#profile_img{position: absolute; z-index:1; left:0; top: 0; border-right:1px solid #FFF; width:250px; height:350px; overflow: hidden;}
#fb_id_user{left: 50%; top: 50%; height: 100%; width: auto; -webkit-transform: translate(-50%,-50%); -ms-transform: translate(-50%,-50%); transform: translate(-50%,-50%);}

#house{position:absolute; z-index:1; right:0; top:0;  width:550px; height:350px; }
#footer{position:absolute; z-index:1; left: 0px; bottom: 0px; font-size:30px; color:#FFF; width:800px; height:70px; background:#C2185B;
          display:flex; justify-content:center; align-items:center;
          font-family: 'Titillium Web', sans-serif;
} 
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
          $files = array('1515406266','1515407961','1515407984','1515408000','1515408016','1515408034','1515408047','1515409292','1515409307','1515409328');
          shuffle($files);
?>
<div id="profile_img"><img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="fb_id_user"></div>
<img src="http://creation.funizi.com/images-theme-perso/<?php echo $files[0]; ?>.jpg" id="house"> 
<div id="footer"> Voici la future maison de <?php echo urldecode($_GET['user_name']); ?></div>



        </div>
        
        </body>
        </html>
      