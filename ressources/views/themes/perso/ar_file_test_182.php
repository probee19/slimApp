
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Merienda+One" rel="stylesheet">
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
#titre { position:absolute;height:200px; width:400px; top:50px; left:200px; text-align:center; font-size:50px; line-height:60px; font-family: 'Merienda One', cursive; }
#boys { position:absolute;z-index:2;height:80px; width:400px; bottom:0; left:0; text-align:center; font-size:50px; line-height:50px; color:#FFF;font-family: 'Merienda One', cursive; }
#girls { position:absolute;z-index:2;height:80px; width:400px; bottom:0; right:0; text-align:center; font-size:50px; line-height:50px; color:#FFF; font-family: 'Merienda One', cursive;}

#top_image{position:absolute; z-index:2; left:0; top:0; width:800px;height:9px; }
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
 $nb_enfants=rand(1,5);
 $fille=rand(1,$nb_enfants);
 $garcon= $nb_enfants-$fille;
?>
<img src="http://creation.funizi.com/images-theme-perso/1509119642.jpg" id="bacground"> 
<img src="http://creation.funizi.com/images-theme-perso/1509121676.jpg" id="top_image"> 
<div id='titre'><span style="font-size:40px;"><?php echo $_GET['user_name']; ?>,</span><br>ستملك <br><?php echo $nb_enfants;?> الأطفال)</div>
<div id='boys'><?php echo $garcon ?>أولاد)</div>
<div id='girls'><?php echo $fille?> ابنة (ابنة)</div>

        </div>
        
        </body>
        </html>
      