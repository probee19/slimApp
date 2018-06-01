
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

#message0{position:absolute; z-index:2; right:30px; top:80px; width:740px; height:50px; font-size:45px; line-height:35px;font-family: 'Paytone One', sans-serif; text-align:center;color:#666;display: flex;
justify-content: center; /* align horizontal */
align-items: center; /* align vertical */ 
         
}
#message{position:absolute; z-index:2; right:30px; top:130px; width:740px; height:220px; font-size:65px; line-height:95px;font-family: 'Paytone One', sans-serif; text-align:center;color:#000;display: flex;
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

$message = array('Coraggioso','Ammirevole','Adorabile','Onesto','Stabile','Tenero','Unico','volontario','superbo','Buona','Eroico');  
shuffle($message);

?>
<div id="message0"> <?php echo ''.$_GET['user_name'].'' ?></div>
<div id="message"> <?php echo 'La tua migliore qualità:<br>- '.$message[0].' -'; ?></div>

        </div>
        
        </body>
        </html>
      