
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <!-- Ces lignes seront placées entre les balises HEAD de la page à capturer -->
<link href="https://fonts.googleapis.com/css?family=Architects+Daughter" rel="stylesheet">
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
#titre_test{position:absolute; z-index:1; left:0; top:0;  width:800px; background:#2693FF; text-align:center; font-size:2em; color:#fff; padding-top:15px;padding-bottom:15px; }
#fb_id_user{position: absolute; z-index:1; left: 50px; top: 80px; width:280px ; max-width:800px; max-height:420px;;}
#name_user{position:absolute; z-index:1; left: 0px; top: 380px; font-size:30px; color:#FFF; text-align:center; width:380px;}
#name_user span{padding:5px; background:#000 ; color:#FFF;border-radius:10px; font-size:0.7em;}
#resultat{position:absolute; z-index:1; left: 380px; top: 120px; font-size:50px; color:#000; width:400px; height:200px;line-height:45px; text-align:center;font-family: 'Architects Daughter', cursive;}
#mot1{position:absolute; z-index:1; left: 0px; top: 0px; }
#mot2{position:absolute; z-index:1; left: 0px; top: 80px;}
#mot3{position:absolute; z-index:1; left: 0px; top: 160px;}
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
   if( $_GET['user_gender'] == 'homme' || $_GET['user_gender'] == 'male' || $_GET['user_gender'] == 'masculin' ){
		 $mot = array('ذكي','وظيفة','Famille','صادق','حنون','حالم','جدي','صداقة');
   }
   else{
		 $mot = array('ذكي','وظيفة','أسرة','صادق','حنون','حالم','جدي','صداقة');
   }
	 
      shuffle($mot);
  ?>
  
  <img src="http://creation.funizi.com/images-theme-perso/1508526452.jpg" id='background'>
      <div id='titre_test'>ما هي الكلمات الثلاث التي تصفك؟</div>
      <img src='<?php echo $_GET['url_img_profile_user']; ?>'class='img_profile' id='fb_id_user'>
      <div class='name texte' id='name_user' ><span><?php echo $_GET['user_name']; ?> </span></div>
      <div id='resultat' ><span id='mot1'><?php echo $mot[0]; ?></span>
      <span id='mot2'><?php echo $mot[1]; ?></span>
      <span id='mot3'><?php echo $mot[2]; ?></span>
      </div>


        </div>
        <!-- Ces lignes seront placées dans le footer de la page à capturer -->
        </body>
        </html>
      