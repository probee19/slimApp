
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">
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

#philosophie{z-index:1;font-family: 'Satisfy', cursive; position: absolute; left: 100px; top: 110px; color:#FFF; display:flex; align-items:center; justify-content:center; text-align:center; font-size:40px; line-height:45px; width:600px ; height:250px ; }

#fb_id_user{position: absolute; z-index:1; left: 350px; top: 10px; width:100px ;  height:100px ; object-fit: cover; object-position: 50% 10%; border-radius:100px; }
#name_user{position:absolute;font-family: 'Satisfy', cursive; z-index:1; left: 0; bottom: 10px; font-size:30px; line-height:30px; color:#FFF; width:800px; height:30px; text-align:center; } 
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
          $philosophie = array(' Le temps est précieux, je ne dois pas le perdre pour des futilités. 
          Je me concentre tout le temps sur l\'essentiel. ',
          ' Le bonheur se trouve dans ces petits moments que nous offre la vie. Je profite de chaque petit instant aves ma famille, mes amis et mes collègues. ',
          ' La célébrité ou la richesse ne sont guère importantes. Ce qui est important , c\'est une vie sans stress, sans soucis et remplie de bonheurs. ',
          ' Je ne regrette aucune connaissance dans la vie. Les bonnes personnes seront toujours là et les mauvaises me laisseront des expériences qui me feront avancer. ');
          shuffle($philosophie);
?>
<!DOCTYPE HTML>

<img src="https://creation.funizi.com/images-theme-perso/1524499433.jpg" id="back"> 

<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user">
<div class="name texte" id="name_user" ><?php echo $_GET['user_name']; ?></div>
 
<div class="texte" id="philosophie">"<?=$philosophie[0];?>"</div>


        </div>
        
        </body>
        </html>
      