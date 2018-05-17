
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
              .main{ padding:0;margin:0;width: 800px;height:420px;position: relative;overflow: hidden; background: #F9F9F9;}
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
               $message = array('Our son has a seductive face, we&#39;ll call him '.urldecode($_GET['user_name']).''
               ,'Our son has a clever face, we will call him '.urldecode($_GET['user_name']).''
               ,'Our son has an angelic face, we will call him '.urldecode($_GET['user_name']).''
               ,'Our son has an angelic smile, we will call him '.urldecode($_GET['user_name']).''
               ,'Our son is too adorable, we&#39;ll call him '.urldecode($_GET['user_name']).''
               ,'Our son is too cute, we&#39;ll call him '.urldecode($_GET['user_name']).''
               ,'Our son is magic, we will call him '.urldecode($_GET['user_name']).''
               ,'Our son has a pure soul, we will call him '.urldecode($_GET['user_name']).'');  }
            else{ 
              $message = array('Our daughter has a beautiful face, we will call her '.urldecode($_GET['user_name']).''
              ,'Our daughter has a smart face, we&#39;ll call her '.urldecode($_GET['user_name']).''
               ,'Our daughter has an angel face, we will call her '.urldecode($_GET['user_name']).''
               ,'Our daughter has an angelic smile, we&#39;ll call her '.urldecode($_GET['user_name']).''
               ,'Our daughter is too adorable, we will call her '.urldecode($_GET['user_name']).''
               ,'Our daughter is too cute, we will call her '.urldecode($_GET['user_name']).''
               ,'Our daughter is magic, we will call her '.urldecode($_GET['user_name']).''
               ,'Our daughter has a pure soul, we will call her '.urldecode($_GET['user_name']).'');
            }

shuffle($message);

?>

<div id="message"> <?php echo $message[0]; ?></div>

        </div>
        
        </body>
        </html>
      