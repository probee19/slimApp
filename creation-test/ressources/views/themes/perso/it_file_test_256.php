
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
              .main{ padding:0;margin:0;width: 800px;height:420px;position: relative;overflow: hidden; background: #000;}
.main img{ position:absolute; max-height:420px; max-width:800px; }

#fb_id_user{position: absolute; z-index:1; left: 30px; top: 60px; width:280px ; border-radius:30px; max-width:800px; max-height:420px;}
#name_user{position:absolute; font-family: 'Satisfy', cursive; z-index:1; right: 30px; top: 350px; font-size:30px; width:410px; text-align:center; color:#FFF; } 
#phrase{position:absolute; z-index:1; right: 30px; top: 60px; width:410px; height:270px; 
display:flex; align-items:center; justify-content:center; text-align:center;
font-size:37px; line-height:42px; color:#FFF; font-family: 'Satisfy', cursive; }

#background{position:absolute; z-index:1; left:0; top:0;  width:800px; opacity:0.6;  }
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
          $phrases = array('Mi sono reso conto che non dovevo aver paura di difendere le cose in cui credo, anche se dovevo combattere per questo da solo.',
                    'Mi sono reso conto che non dovevo combattere per un posto nella vita degli altri. Quelli che mi stimano davvero mi terranno sempre un posto nei loro cuori',
                    'Ho capito che non dovrei dubitare delle mie capacità. Devo solo ricordare la strada percorsa, gli ostacoli frnachis, le battaglie vinte e le paure superate.',
                    'Mi sono reso conto che non potevo cambiare il modo in cui la gente mi vedeva. Non valeva nemmeno la pena di provarci. Voglio solo vivere la mia vita ed essere felice.');
          shuffle($phrases);
?>

<img src="http://creation.funizi.com/images-theme-perso/1514398615.jpg" id="background"> 
<img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="fb_id_user">
<div class="name texte" id="name_user" >~ <?php echo urldecode($_GET['user_name']); ?> ~</div>
<div id="phrase"><?php echo $phrases[0]; ?></div>

        </div>
        
        </body>
        </html>
      