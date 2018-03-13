
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Kavivanar" rel="stylesheet">
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

#back{position:absolute; z-index:1; left:0; top:0;  width:800px; max-height:420px; opacity:0.6; }
#fb_id_user{position: absolute; z-index:1; left: 20px; top: 35px; width:300px ; border-radius:300px; border:3px solid #0D47A1; }
#name_user{position:absolute; z-index:1; left: 0px; top: 0px; font-size:30px; color:#FFF;} 

#force{z-index:1;font-family: 'Kavivanar', cursive; color:#FFF; position: absolute; right: 20px; top: 20px;  width:420px ; height:380px; padding:5px;  }

#force_1,#force_2{z-index:1; position: absolute; right: 0;  width:420px ;  display:flex; justify-content:center; text-align:center;}
#force_1{ top: 0; height:175px; font-size:45px; line-height:50px; align-items:flex-end; }
#force_2{ top: 195px; height:100px;font-size:50px; line-height:55px;align-items:flex-top; font-weight:700; }

#texte_bottom{z-index:1;font-family: 'Kavivanar',  cursive; position: absolute; bottom: 0; left: 0; color:#FFF; font-size:30px; width:800px ; height:50px ; background:#0D47A1; display:flex; justify-content:center;align-items:center;}

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
          $forces = array(' son courage ',' son intelligence ',' sa gentillesse ',' son sang froid ',' sa façon de parler ',' son sens du respect ',' son sens du devoir ');
          shuffle($forces);
?>
<!DOCTYPE HTML>

<img src="https://creation.funizi.com/images-theme-perso/1519645150.jpg" id="back"> 

<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">

<div class="texte" id="force">  
          <div  id="force_1">  La force principale de <?php echo $_GET['user_name']; ?> est  </div>
          <div  id="force_2"> <?= $forces[0];?>  </div>
</div>

<div class="texte" id="texte_bottom"> Quelle est ta plus grande force? </div>


        </div>
        
        </body>
        </html>
      