
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Kalam|Nanum+Pen+Script" rel="stylesheet">
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
#background{position:absolute; z-index:1; left:0; top:0;  max-width:800px; max-height:420px; }
.titre{position:absolute;  z-index:2; top: 0; left: 0;width:100%; padding-top:10px; padding-bottom:10px; background:#FFF; text-align:center; font-size:35px; color: #E2005A;font-family: 'Nanum Pen Script', cursive; }
#fb_id_user{position: absolute; z-index:1; left: 60px; top: 100px; width:200px ; border-radius:100px; border:4px solid #E2005A; max-width:800px; max-height:420px;}
#name_user{position:absolute; z-index:2; left: 0px; top: 320px; font-size:30px; color:#FFF; text-align:center; width:320px; font-weight:400px;font-family: 'Kalam', cursive;} 
#result_image{position: absolute; z-index:1; right: 60px; top: 100px; width:200px ; border-radius:100px; border:4px solid #E2005A;max-width:800px; max-height:420px;}
#name_friend_1{position:absolute; z-index:2; right: 0px; top: 320px; font-size:30px; color:#FFF; text-align:center; width:320px; font-weight:400px;font-family: 'Kalam', cursive;} 
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
                   $partenaire = array('Halle Berry','Monica Belluci','Adriana Lima');
          $img = array('1518277400','1518277502','1518277550');
              
          $id = mt_rand(0,2);          }
            else{ 
              $partenaire = array('Zac Efron','Brad Pitt','Jesse Williams');
          $img = array('1518276258','1518276355','1518276440');
          $id = mt_rand(0,2);
            } 
         
         
          
?>

<img src="http://creation.funizi.com/images-theme-perso/1518277974.png" id="background">
<div id="titre" class="titre">Wer wird am 14. Februar Ihr Partner sein?</div>
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
<div class="name texte" id="name_user" ><?php echo $_GET['user_name']; ?></div>
<img src="http://creation.funizi.com/images-theme-perso/<?php echo $img[$id]; ?>.jpg" class="img" id="result_image">
<div class="name texte" id="name_friend_1" ><?php echo $partenaire[$id] ?></div>


        </div>
        
        </body>
        </html>
      