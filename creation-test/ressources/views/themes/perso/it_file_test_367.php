
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">
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

#fb_id_user{display:none; position: absolute; z-index:1; right: 30px; bottom: 30px; width:230px ;  height:230px ; object-fit: cover; object-position: 50% 10%; border-radius:230px;}
#name_user{position:absolute; z-index:1; left: 0px; top: 0px; font-size:30px; color:#FFF;} 

#ask{z-index:1;font-family: 'Play', sans-serif; position: absolute; left: 275px; top: 40px; color:#000; font-size:30px; width:320px ; height:60px ; display:flex; align-items:center; justify-content:center; text-align:center;display:none; }

#answer{z-index:1;font-family: 'Play', sans-serif; position: absolute; left: 225px; top: 55px; color:#000; font-size:40px; line-height:55px; width:530px ; height:200px ; flex-direction:column; align-items:center; justify-content:center; text-align:center; }
.relief{font-size:55px; color:#520121; }
.relief2{font-size:50px; }
.new_line{display:block}
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
          $end = "ème";
          if($_GET['rank'] == 1) $end = "er";
          if($_GET['score'] >= 2) $ss = "s";
                    
?>
<img src="https://creation.funizi.com/images-theme-perso/1529600902.jpg" id="back"> 
 
<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user"> 
 
 
<div class="texte" id="ask"> Quel est mon score ? </div>


<div class="texte" id="answer"> <span class="relief2 new_line"><?php echo $_GET['user_name']; ?></span> occupe la <span class="relief"><?php echo $_GET['rank']; ?></span><sup><?=$end?></sup> place avec <span class="relief new_line"><?php echo $_GET['score']; ?> point<?=$ss?> !</span>  </div>


        </div>
        
        </body>
        </html>
      