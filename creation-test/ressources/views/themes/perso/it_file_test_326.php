
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Orbitron|Yanone+Kaffeesatz" rel="stylesheet">
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
              .main{ padding:0;margin:0;width: 800px;height:420px;position: relative;overflow: hidden; background: #3b5998;}
.main img{ position:absolute; max-height:420px; max-width:800px; }

#head{z-index:1; position: absolute; font-family: 'Yanone Kaffeesatz', sans-serif; left: 0; top: 0; color:#fff; font-size:34px; width:800px ; height:50px ; background:transparent; border-bottom: 2px solid #fff;display:flex; justify-content:center; align-items:center;}

#fb_id_user{position: absolute; z-index:1; left: 30px; top:100px; width:210px ;  height:210px ; object-fit: cover; object-position: 50% 10%; border-radius:200px; max-width:800px; max-height:420px;}
#name_user{position:absolute; z-index:1; left: 0px; top: 100px; font-size:30px; color:#FFF;} 

#eye{position:absolute; z-index:1;  max-width:800px; max-height:420px; }
#visite{z-index:1; position: absolute; right: 30px; top: 170px; color:#000; font-size:14px; width:480px ; height:80px ; background:#FFF;  border-radius:10px; display:flex; align-items:center; }

#compteur{z-index:1; position: absolute;font-family: 'Orbitron', sans-serif; right: 10px; top:10px; color:#fff; font-size:55px; line-height:55px; width:260px ; height:60px ; background:#3b5998;  border-radius:10px;  display:flex; align-items:flex-end; padding-left:40px;  }
#lab_compteur{z-index:1; position: absolute;font-family: 'Orbitron', sans-serif; right: 30px; bottom: 10px; color:#fff; font-size:20px; line-height:20px; width:100px ; height:40px ; display:flex; align-items:flex-end;  }
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

<div class="texte" id="head"> Quante persone hanno visitato il tuo profilo oggi? </div>
<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user">
<div class="name texte" id="name_user" ></div>
 
<div class="texte" id="visite">
          <img src="https://creation.funizi.com/images-theme-perso/1524320502.png" id="eye"> 
          <div class="texte" id="compteur"> <?=mt_rand(75,204)?> <div class="texte" id="lab_compteur"> visite</div> </div>
</div>


        </div>
        
        </body>
        </html>
      