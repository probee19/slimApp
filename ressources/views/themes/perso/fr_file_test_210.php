
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Paytone+One" rel="stylesheet">
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
#background{position:absolute; z-index:2; right:0; top:0;  width:500px; height:420px; background:#D80A1D;}
#ilsdisent{position:absolute; z-index:2; right:0; top:40px; width:500px; height:40px;color:#FBFF08; text-align:center; font-size:30px;}
#fb_id_user{position: absolute; z-index:1; left: -100px; top: 0px; width:420px ; border-radius:0px; max-width:800px; max-height:420px;}
#message{position:absolute; z-index:2; right:25px; top:20px; width:450px; height:420px; font-size:50px; line-height:50px;font-family: 'Paytone One', sans-serif; text-align:center;color:#FFF;display: flex;
justify-content: center; /* align horizontal */
align-items: center; /* align vertical */ }
#cadeau{position:absolute; z-index:2; left:260px; top:140px;  max-width:800px; max-height:420px; }
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
      if( $_GET['user_gender'] == 'homme' || $_GET['user_gender'] == 'male' || $_GET['user_gender'] == 'masculin' )
            {
               $message = array('Beaucoup d\'argent','Un iPhone X','Un Samsung S8','Une nouvelle voiture','beaucoup d\'amour');          }
            else{ 
               $message = array('Beaucoup d\'argent','Un iPhone X','Un Samsung S8','Une nouvelle voiture','beaucoup d\'amour');     
            }

shuffle($message);
?>
<div id="background"></div> 
<div id="ilsdisent">Le Père Noël t'apportera:</div> 
<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user">
<div id="message"> <?php echo $message[0]; ?>
</div>
<img src="http://creation.funizi.com/images-theme-perso/1511006992.png" id="cadeau"> 



        </div>
        
        </body>
        </html>
      