
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Sacramento|Merienda" rel="stylesheet">
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

#name{z-index:1; font-family: 'Merienda', cursive; position: absolute; left: 175px; top: 120px; transform:rotate(-6deg); color:#283593; font-size:34px; line-height:44px; width:400px ; height:80px ; text-align:center; }

#mean{z-index:1; position: absolute;  left: 180px; top: 185px; transform:rotate(-6deg); color:#000; font-size:34px; width:400px ; height:50px ;  text-align:center;  }

#signification{z-index:1; font-family: 'Sacramento', cursive; font-weight:500; text-transform:capitalize; position: absolute; left: 188px; top: 240px; transform:rotate(-6deg); color:#283593; font-size:74px; line-height:74px; width:400px ; height:50px ;  text-align:center;  }
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
          $significations = array('loyalty','love','joy','peace','honesty','trust','respect');
          shuffle($significations);
?>
<!DOCTYPE HTML>
<img src="https://creation.funizi.com/images-theme-perso/1525038725.jpg" id="back"> 
 
<div class="texte" id="name"> <?php echo urldecode($_GET['user_name']); ?>  </div>

<div class="texte" id="mean"> means </div>

<div class="texte" id="signification"> <?=$significations[0]?> </div>
 

        </div>
        
        </body>
        </html>
      