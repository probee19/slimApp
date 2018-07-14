
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Chicle" rel="stylesheet">
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

#back{position:absolute; z-index:1; left:0; top:0;  width:800px;  }

#fb_id_user{position: absolute; z-index:1; right: 20px; top: 20px; width:100px ;  height:100px ; object-fit: cover; object-position: 50% 10%; border-radius:100px; max-width:800px; max-height:420px;}
#name_user{left: 205px; top: 120px; color:#D32F2F; align-items:flex-end; justify-content:center;  font-size:40px; line-height:35px; width:600px ; height:90px ; } 

.texte{z-index:1; font-family: 'Chicle', cursive;text-transform:uppercase; display:flex; position: absolute; background:transparent; text-align:center;}
#texte1{left: 205px; top: 200px; color:#D32F2F; align-items:flex-end; justify-content:center;  font-size:40px; line-height:35px; width:600px ; height:90px ; }
#texte2{left: 200px; top: 310px; color:#D32F2F; align-items:center; justify-content:center; font-size:60px; line-height:30px; letter-spacing:1.3px; width:600px ; height:50px ; }
#texte3{left: 200px; top: 470px; color:#D32F2F; align-items:center; justify-content:center; font-size:40px; line-height:40px; letter-spacing:1.7px;width:600px ; height:50px ; }
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
      
<!DOCTYPE HTML>

<img src="https://creation.funizi.com/images-theme-perso/1531574134.jpg" id="back"> 

<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user">

<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user">

<div class="name texte" id="name_user" ><?php echo $_GET['user_name']; ?></div>
<div class="texte" id="texte1"> vous souhaite une Joyeuse  </div>

<div class="texte" id="texte2"> Fête de la nation </div>

        </div>
        
        </body>
        </html>
      