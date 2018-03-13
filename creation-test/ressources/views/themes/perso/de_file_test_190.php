
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:700" rel="stylesheet">
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
#fb_id_user{position: absolute; z-index:1; right: 50px; top: 60px; width:300px ; border-radius:300px; border: 3px solid #333; max-width:800px; max-height:420px;}
#name_user{position:absolute; z-index:1; left: 0px; top: 100px; font-size:45px; color:#EE1716; width:400px; text-align:center;font-family: 'Roboto Condensed', sans-serif;} 
#fidele{position:absolute; z-index:1; left: 0px; top: 160px; font-size:40px; color:#355BA5; width:400px; text-align:center;font-family: 'Roboto Condensed', sans-serif;} 
#fidele1{position:absolute; z-index:1; left: 0px; top: 310px; font-size:40px;color:#355BA5; width:400px; text-align:center;font-family: 'Roboto Condensed', sans-serif;} 
#pourcentage{position:absolute; z-index:1; left: 100px; top: 210px; font-size:60px;color:#FFF; background:#EE1716; width:200px; padding-top:10px; padding-bottom:10px; text-align:center;font-family: 'Roboto Condensed', sans-serif;} 
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
      
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
<div class="name texte" id="name_user" ><?php echo $_GET['user_name']; ?></div>
<div id="fidele" >ist immer</div>
<div id="pourcentage" ><?php echo mt_rand(100,130)?>%</div>
<div id="fidele1" >treu</div>


        </div>
        
        </body>
        </html>
      