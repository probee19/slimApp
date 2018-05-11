
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Sarala" rel="stylesheet">
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

#backg{position:absolute; z-index:1; left:0; top:0;  max-width:800px; max-height:420px; }

#loi{z-index:1; position: absolute; font-family: 'Sarala', cursive;   left: 515px; top: 170px; display:flex; align-items:center; color:#000; font-size:18px; line-height:25px; width:170px ; height:160px ; transform:rotate(6deg);}
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
          $lois = array(' '.$_GET['user_name'].' est nommé chef de l\'Etat Major. ',
          ' Jusqu\'au 31 mai 2020, '.$_GET['friend_first_name_1'].' devra payer le loyer de '.$_GET['user_name'].'.  ',
          ' '.$_GET['user_name'].' est trop génial, j\'ordonne qu\'il reçoive une promotion. ',
          ' J\'ordonne par la présente que le salaire de '.$_GET['user_name'].' soit doublé. ',
          ' Je déclare cette journée fériée en l\'honneur de '.$_GET['user_name'].'. ');
else 
       $lois = array(' '.$_GET['user_name'].' est nommé chef de l\'Etat Major ',
          ' Jusqu\'au 31 mai 2020, '.$_GET['friend_first_name_1'].' devra payer le loyer de '.$_GET['user_name'].'.  ',
          ' '.$_GET['user_name'].' est trop géniale, j\'ordonne qu\'elle reçoive une promotion. ',
          ' J\'ordonne par la présente que le salaire de '.$_GET['user_name'].' soit doublé. ',
          ' Je déclare cette journée fériée en l\'honneur de '.$_GET['user_name'].'. ');   
          
          shuffle($lois);
?>
<!DOCTYPE HTML>
<img src="http://creation.funizi.com/images-theme-perso/1518692863.png" id="backg"> 

<div class="texte" id="loi"> <?php echo $lois[0]; ?> </div>


        </div>
        
        </body>
        </html>
      