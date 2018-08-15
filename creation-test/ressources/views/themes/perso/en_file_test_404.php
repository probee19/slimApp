
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">
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

#back{position:absolute; z-index:1; left:0; top:0;  max-width:800px; max-height:420px; }
.overlay{position:absolute;z-index:1; left:0; top:0; background-color:#000;  width:800px; height:420px; opacity:0.3;}

#message{z-index:1;font-family: 'Bree Serif', serif; position: absolute; left: 50px; top: 70px; color:#fff; font-size:40px; line-height:50px; width:700px ; height:250px ; display:flex; align-items:center; justify-content:center; text-align:center;}

#fb_id_user{position: absolute; z-index:1; left: 360px; bottom: 10px; width:80px ; border-radius:80px;  height:80px ; object-fit: cover; object-position: 50% 10%; }

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
      
<?php 
          $messages = array('Solidarity with our Italian brothers. Thoughts moved for the victims and their loved ones.','Full solidarity with the victims, their families and all our Italian friends ...',
          'My most saddened thoughts to the Italian people after the Genoa disaster.');
          shuffle($messages);
?>
<!DOCTYPE HTML>

<img src="https://creation.funizi.com/images-theme-perso/1534270685.jpg" id="back"> 

<div class="overlay"></div>
<div class="texte" id="message"><?=$messages[0]?></div>

<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user">


        </div>
        
        </body>
        </html>
      