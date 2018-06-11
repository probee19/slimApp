
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Oxygen|Quicksand" rel="stylesheet">
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
              .main{ padding:0;margin:0;width: 800px;height:420px;position: relative;overflow: hidden; background: #3e4980; }
.main img{ position:absolute; max-height:420px; max-width:800px; }

#sde{position:absolute; z-index:1; right:0; bottom:0;  max-width:800px; height:420px; }

#texte{z-index:1; font-family: 'Oxygen', sans-serif; position: absolute; left: 0px; top: 170px; color:#FFF; font-size:35px; line-height:45px; width:440px ; height:220px ; display:flex; justify-content:center; align-items:center; text-align:center;}

#fb_id_user{position: absolute; z-index:1; left: 160px; top: 40px; width:130px ;  height:130px ; object-fit: cover; object-position: 50% 10%; border-radius:130px; }

#hashtag{z-index:1; font-family: 'Quicksand', sans-serif; font-weight:700; position: absolute; right: 10px; bottom: 5px; color:#000; font-size:20px; line-height:20px; width:200px ; height:30px ; text-align:right;   }

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
          $textes = array(''.$_GET['user_name'].' a marre d\'attendre l\'eau jusqu\'à 03h du matin.', 
                    ''.$_GET['user_name'].' a marre de faire le tour des quartiers pour avoir de l\'eau.',
                    ''.$_GET['user_name'].' réclame la disponiblité de l\'eau toute la journée.',
                    ''.$_GET['user_name'].' dit NON aux longues périodes de pénurie d\'eau'
                    );
          shuffle($textes);
?>
<!DOCTYPE HTML>

<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user"> 

<img src="https://creation.funizi.com/images-theme-perso/1528719986.jpg" id="sde"> 
 
<div class="texte" id="texte"> <?=$textes[0]?> </div>

<div class="texte" id="hashtag">#dafadoy</div>
 
 

        </div>
        
        </body>
        </html>
      