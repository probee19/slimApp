
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              
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
                          .main{ padding:0;margin:0;width: 800px;height:420px;position: relative;overflow: hidden; background: #000000;}
            .main img{ position:absolute; max-height:420px; max-width:800px; }
            #fb_id_user{position: absolute; z-index:1; left: 0px; top: 0px; width:400px ; border-right:2px solid #000000; border-radius:0px;}
            #fb_id_user_right{position: absolute; z-index:1; right: 0px; top: 0px; width:400px ; border-radius:0px; max-width:800px; max-height:420px;}
            #name_user{position:absolute; z-index:1; left: 0px; top: 0px; width:800px; font-size:30px; padding-top:20px; text-align:center;}
            #name_user span{ font-size:25px; color:#FFF; background:#000000;padding:5px;  text-align:center;}
            .flip { -moz-transform: scaleX(-1);-o-transform: scaleX(-1);-webkit-transform: scaleX(-1);
                transform: scaleX(-1);
                filter: FlipH;
                -ms-filter: "FlipH";
            }
            #honnete{position: absolute; z-index:1; left: 0px; bottom: 0px; width:400px ;height:100px; background:#00B200; color:#FFF;border-right:2px solid #000000; text-align:center;padding-top:40px;}
            #malhonnete{position: absolute; z-index:1; right: 0px; bottom: 0px; width:400px ;height:100px; background:#FF0000; color:#FFF; text-align:center;padding-top:40px;}

            .result {color:#FFFFFF; font-size:3.5em;margin-top:45px;font-weight:bold;}
        
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
                  // JAVASCRIPT

                  });
              </script>
          </head>
          <body style='width: 800px; height:420px; margin:0; padding:0; overflow: hidden;'>
          <div class='main'>
      
<!DOCTYPE HTML>
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=400&height=400" class="img_profile" id="fb_id_user">
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=400&height=400" class="img_profile flip" id="fb_id_user_right">
<div class="name texte" id="name_user" ><span><?php echo $_GET['user_name']; ?></span></div>
<div id="honnete"><span class="result"><?php $pourcentageH=rand(92,100); echo $pourcentageH;?>%</span><span style="font-size:23px">onesto</span></div>
<div id="malhonnete"><span class="result"><?php echo 100-$pourcentageH;?>%</span><span style="font-size:23px">disonesto</span></div>


        </div>
        
        </body>
        </html>
      