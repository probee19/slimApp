
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Paytone+One" rel="stylesheet">
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

#message{position:absolute; z-index:2; right:30px; top:0px; width:740px; height:420px; font-size:65px; line-height:65px;font-family: 'Paytone One', sans-serif; text-align:center;color:#000;display: flex;
justify-content: center; /* align horizontal */
align-items: center; /* align vertical */ 
         
}
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

               $message = array(''.urldecode($_GET['full_user_name']).' Notre fils a un visage de séducteur, on va l\'appeler '.urldecode($_GET['full_user_name']).''
               ,''.urldecode($_GET['full_user_name']).' Notre fils a un visage intelligent, on va l\'appeler '.urldecode($_GET['full_user_name']).'');  }

            else{ 

              $message = array('Notre fille a un visage de séducteur, on va l\'appeler '.urldecode($_GET['full_user_name']).''
              ,'Nuestra hija tiene una cara inteligente, la llamaremos '.urldecode($_GET['full_user_name']).'');

            }



shuffle($message);

?>

<div id="message"> <?php echo $message[0]; ?></div>

        </div>
        
        </body>
        </html>
      