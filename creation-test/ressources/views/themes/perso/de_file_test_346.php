
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

#fb_id_user{position: absolute; z-index:1; left: -10px; top: 0px; width:420px ;  height:420px ; object-fit: cover; object-position: 50% 10%; border-radius:0px; max-width:800px; max-height:420px;}
.back{position:absolute;font-family: 'Satisfy', cursive; font-size:45px; line-height:45px; color:#FFF; z-index:1; right: 0;  width:390px; height:84px;}
#back_blue{top: 0; background:#2962FF; } 
#back_blue .triangle{border-right: 40px solid #2962FF ;}
#back_orange{top: 84px; background:#D84315; }
#back_orange .triangle{border-right: 40px solid #D84315 ;}
#back_red{top: 168px; background:#B71C1C; }
#back_red .triangle{border-right: 40px solid #B71C1C ;}
#back_grey{top: 252px; background:#1B5E20; }
#back_grey .triangle{border-right: 40px solid #1B5E20 ;}
#back_purple{top: 336px; background:#4A148C; }
#back_purple .triangle{border-right: 40px solid #4A148C ;}
.res{position:absolute; left:20px; top:0; height:100%; width:470px; display:flex; align-items:center; text-align:left; }
.triangle {position:absolute; left:-40px; width: 0; height: 0; border-top: 42px solid transparent; border-bottom: 42px solid transparent; }

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
          $mots = array('Ambition','Strenge','Schönheit','Loyalität','Weichheit','Humor','Charisma','Ernst','Freundlichkeit','Motivation','Stärke','Eleganz','Ausdauer','Vertrauen','Glück');
          shuffle($mots);
?>
<!DOCTYPE HTML> 
<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user"> 
<div class="back" id="back_blue" ><span class="res" id="mot1"><?=$mots[0]?></span><span class="triangle"></span></div>
<div class="back" id="back_orange" ><span class="res" id="mot2"><?=$mots[1]?></span><span class="triangle"></span></div>
<div class="back" id="back_red" ><span class="res" id="mot3"><?=$mots[2]?></span><span class="triangle"></span></div>
<div class="back" id="back_grey" ><span class="res" id="mot4"><?=$mots[3]?></span><span class="triangle"></span></div>
<div class="back" id="back_purple" ><span class="res" id="mot5"><?=$mots[4]?></span><span class="triangle"></span></div>
 

        </div>
        
        </body>
        </html>
      