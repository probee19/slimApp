
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">
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

#back{position:absolute; z-index:1; left:0; top:0;  width:800px; max-height:420px; }

#fb_id_user{position: absolute; z-index:2; left: 300px; top: 110px; width:200px ; border-radius:300px; max-width:800px; max-height:420px;}

#t_footer{z-index:1;font-family: 'Dosis', sans-serif; position: absolute; display:flex; align-items:center; justify-content:center; left: 50px; bottom: 10px; color:#FFF; font-size:35px; width:700px ; height:50px ; background:#3F51B5; border-radius:4px; }

#arrow1{position:absolute; z-index:1; left:180px; top:170px;  width:150px; height:100px; }
#arrow2{position:absolute; z-index:1; left:430px; top:120px;  width:150px; height:100px; }
#arrow3{position:absolute; z-index:1; left:350px; top:260px;  width:180px; height:100px; }

#rev1,#rev2,#rev3{ z-index:1; font-family: 'Dosis', sans-serif; position: absolute; display:flex; align-items:flex-end; justify-content:center; text-align:center;  color:#FFF; font-size:40px; line-height:45px; width:280px ; height:130px ; }
#rev1{left: 10px; top: 50px;}

#rev2{right: 10px; top: 10px; }

#rev3{right: 10px; bottom: 80px;  width:250px ; height:130px ; }



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
          $rev = array('Eres tranquilidad en persona.','Tú encarnas la sabiduría.','Usted es confiable.','Tienes un gran coraje',
          'Siempre podemos confiar en ti.','Tienes el espíritu creativo.','Tienes un buen corazón.','Usted tiene un alto sentido de lealtad.','Tienes hermosos ojos.','Lograrás grandes cosas.');
          shuffle($rev);
?>
<!DOCTYPE HTML>
<img src="https://creation.funizi.com/images-theme-perso/1520361060.jpg" id="back"> 
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
<div class="texte" id="t_footer">¿Qué revela tu foto de perfil sobre ti?</div>
<img src="https://creation.funizi.com/images-theme-perso/1520417407.png" id="arrow1"> 
<img src="https://creation.funizi.com/images-theme-perso/1520418225.png" id="arrow2">
<img src="https://creation.funizi.com/images-theme-perso/1520418817.png" id="arrow3"> 

<div class="texte" id="rev1"><?=$rev[0];?></div>
<div class="texte" id="rev2"><?=$rev[1];?></div>
<div class="texte" id="rev3"><?=$rev[3];?></div>


        </div>
        
        </body>
        </html>
      