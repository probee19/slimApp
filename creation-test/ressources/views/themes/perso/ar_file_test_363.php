
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
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
.main{ padding:0;margin:0;width: 800px;height:420px;position: relative;overflow: hidden; background: #FFF;}
.main img{ position:absolute; max-height:420px; max-width:800px; }

#back{position:absolute; z-index:1; left:0; top:0;  max-width:800px; max-height:420px; }

#coupe{position:absolute; z-index:1; left:345px; top:110px;   height:200px; }

.flag_team{z-index:1; position: absolute; right:75px; top:128px;   text-align:center; width:250px;   }

#fb_id_user{position: absolute; z-index:1; left: 125px; top: 30px; width:150px ;  height:150px ; object-fit: cover; object-position: 50% 10%; border-radius:150px; border:5px solid #FFF;}
#support{position:absolute; z-index:1;font-family: 'Kaushan Script', cursive; left: 0px; top: 180px; font-size:45px; line-height:55px; color:#FFF; width:400px; height:200px;  display:flex; flex-direction:column;align-items:center; justify-content:center; text-align:center;} 
.team{color:#f1c40f; text-transform:uppercase;}

#slog{z-index:1; position: absolute; font-family: 'Kaushan Script', cursive; right:0px; bottom: 80px; font-weight:700; color:#FFF; font-size:30px; text-transform:uppercase; width:400px ; height:50px ;  text-align:center;}



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
<img src="https://creation.funizi.com/images-theme-perso/1529368399.jpg" id="back"> 
 
<img src="https://creation.funizi.com/images-theme-perso/1529368950.png" id="coupe"> 
<img src="https://s3.us-east-2.amazonaws.com/funiziuploads/api/flags_big/sen.png" id="" class="flag_team"> 
                                       
 
<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user">
<div class="name texte" id="support" ><?php echo $_GET['user_name']; ?> supporte le <span class="team">Sénégal</span></div>

<div class="texte" id="slog">الفائزون دائما </div>
 

        </div>
        
        </body>
        </html>
      