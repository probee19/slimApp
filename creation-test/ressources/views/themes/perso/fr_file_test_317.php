
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Cagliostro|Kalam:700" rel="stylesheet">
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
.main img{ position:absolute; max-height:420px; max-width:800px; object-fit: cover; object-position: 50% 10%;  }

#header_t{font-family: 'Cagliostro', sans-serif; z-index:1; position: absolute; left: 0; top: 0; color:#FFF; font-size:25px; width:800px ; height:50px ; background:#880E4F; display:flex; align-items:center; justify-content:center;}

#fb_id_user{position: absolute; z-index:1; left: 35px; top: 85px; width:300px ;  height:300px ;border:10px solid #880E4F; border-radius:30px; max-width:800px; max-height:420px;}


#mot_1, #mot_2{font-family: 'Kalam', cursive;z-index:1;  position: absolute; right: 20px;  color:#FFF; font-size:75px; line-height:35px; width:400px ; height:110px ; display:flex; justify-content:center; text-transform:uppercase;}
#mot_1{top: 95px; align-items:flex-end;  }
#mot_2{top: 265px; align-items:flex-start;  }
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
          if( $_GET['user_gender'] == 'homme' || $_GET['user_gender'] == 'male' || $_GET['user_gender'] == 'masculin'){
                    $mots_1 = array(' Jamais ',' Toujours ',' Toujours ',' Pas ',' Grand ',' Vrai ',' Toujours ');
                    $mots_2 = array(' Fatigué ',' Prêt ',' Aimable ',' Stupide ',' Coeur ',' Meneur ',' Souriant ');
          }
          else{
                    $mots_1 = array(' Jamais ',' Toujours ',' Toujours ',' Pas ',' Grand ',' Vrai ',' Toujours ');
                    $mots_2 = array(' Fatiguée ',' Prête ',' Aimable ',' Stupide ',' Coeur ',' Meneuse ',' Souriante ');
          }
          $ind = mt_rand(0,6);
?>
<!DOCTYPE HTML>

<div class="texte" id="header_t">  Quels sont les deux mots qui décrivent le mieux ta personnalité ?  </div>

<img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="fb_id_user">

<div class="texte" id="mot_1"><?=$mots_1[$ind];?></div>
<div class="texte" id="mot_2"><?=$mots_2[$ind];?></div>



        </div>
        
        </body>
        </html>
      