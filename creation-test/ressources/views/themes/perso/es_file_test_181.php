
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
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
#background{position:absolute; z-index:2; left:0; top:0;  max-width:800px; max-height:420px; }
#ilsdisent{position:absolute; z-index:2; right:0; top:40px; width:500px; height:40px;color:#666; text-align:center; font-size:20px; font-weight:bold;font-family:'time new roman';}
#fb_id_user{position: absolute; z-index:1; left: -60px; top: 0px; width:420px ; border-radius:0px; max-width:800px; max-height:420px;}
#message{position:absolute; z-index:2; right:25px; top:80px; width:450px; height:200px; font-size:50px; line-height:50px;font-family: 'Pacifico', cursive;; text-align:center;color:#666;
justify-content: center; /* align horizontal */
align-items: center; /* align vertical */ }
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

 $jour = array('28','15','17','11','13','22','19');
 $mois = array('diciembre','abril','Mayo','julio','octubre');
 $an = date(Y)+rand(1,3);
 shuffle($jour);shuffle($mois);
?> 
<img src="http://creation.funizi.com/images-theme-perso/1509106743.png" id="background"> 

<div id="ilsdisent">Tu matrimonio será:</div> 
<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user">
<div id="message"> 
<div id="jour" style="font-size:100px"><?php echo $jour[0] ?></div>
<div id="mois" style="font-size:80px; margin-top:55px;"><?php echo $mois[0] ?></div>
<div id="an" style="font-size:80px; margin-top:55px;"><?php echo $an ?></div>
</div>



        </div>
        
        </body>
        </html>
      