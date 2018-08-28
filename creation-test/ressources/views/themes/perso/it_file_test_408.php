
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Quattrocento+Sans" rel="stylesheet">
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

#message{font-family: 'Quattrocento Sans', sans-serif;z-index:1; position: absolute; left: 160px; top: 160px; color:#000; font-size:34px; line-height:40px; width:420px ; height:140px ; }


#day{font-family: 'Quattrocento Sans', sans-serif; text-transform:uppercase; z-index:1; position: absolute; left: 330px; top: 89px; color:#000; font-size:15px; width:180px ; height:30px ; text-align:center; max-width:800px; max-height:420px;}
#heure{font-family: 'Quattrocento Sans', sans-serif;z-index:1; position: absolute; right: 230px; top: 290px; color:#000; font-size:17px; width:200px ; height:50px ; text-align:right; }
#begin_message{font-family: 'Quattrocento Sans', sans-serif; z-index:1; position: absolute; left: 200px; bottom:11px; color:#000; font-size:18px; width:180px ; height:30px ; }

.heart{position:absolute; z-index:1; top:21px;  max-width:800px; max-height:420px; }
#heart_1{left:240px; }#heart_2{left:270px; }


              </style>
              <script src='https://code.jquery.com/jquery-1.12.0.min.js'></script>
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
         $messages = array('Je veux vivre dans tes yeux, mourir dans tes bras et être enterrée dans ton coeur.','C\'est fou comment un simple câlin de toi peut rendre ma vie plus belle. ',
          'L\'amour est un secret entre deux coeurs, un mystère entre deux âmes.','Mon bonheur à moi, ce sont nos moments à nous !','Je veux tout de toi... tes bras... tes bisous... tes câlins...');
 }
 else{
          $messages = array('Je veux vivre dans tes yeux, mourir dans tes bras et être enterré dans ton coeur.','C\'est fou comment un simple câlin de toi peut rendre ma vie plus belle. ',
          'L\'amour est un secret entre deux coeurs, un mystère entre deux âmes.','Mon bonheur à moi, ce sont nos moments à nous !');
 }
          
          shuffle($messages);
          
?>
<!DOCTYPE HTML>
<img src="https://creation.funizi.com/images-theme-perso/1535375724.jpg" id="back"> 

<img src="https://creation.funizi.com/images-theme-perso/1535377770.png" class="heart" id="heart_1"> 
<img src="https://creation.funizi.com/images-theme-perso/1535377770.png" class="heart" id="heart_2"> 

<div class="texte" id="day"> Oggi </div>

<div class="texte" id="message"> <?=$messages[0]?> </div>

<div class="texte" id="heure"> <?=date('H:i')?> </div>

<div class="texte" id="begin_message"> Scrivi un messaggio </div>


        </div>
        
        </body>
        </html>
      