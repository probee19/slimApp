
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Dancing+Script:700" rel="stylesheet">
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
.overlay{position:absolute; z-index:1; left:0; top:0;  width:800px; height:420px; background:#000; opacity:0.5; }
#texte{z-index:1; font-family: 'Dancing Script', cursive; position: absolute; right: 30px; top: 30px; color:#fff; font-size:50px; line-height:60px;  width:450px ; height:300px ;  display:flex; align-items:center; justify-content:center; text-align:center;  }
#name_user{position:absolute; font-family: 'Dancing Script', cursive;  z-index:1; bottom: 30px; right: 30px; font-size:40px; color:#FFF;} 
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
          $mots = array('عيد ام سعيد. أفكر فيك بالكثير من الحب والرقة!',
          'عيد ميلاد سعيد لأم أكثر رهيبة عرفها التاريخ!',
          'شكرا لك انا انا! <br> شكرا لك ... عيد ميلاد سعيد.','عيد ميلاد سعيد لأمي ، يا ملاكي ، يا صديقي!',
          'لا يمكن لأي لغة التعبير عن جمال وقوة الأم. <br> عيد ميلاد سعيد يا أمي.'
          );
          shuffle($mots);
?>
<!DOCTYPE HTML>

<img src="https://creation.funizi.com/images-theme-perso/1527355954.png" id="back"> 
<div class="overlay"></div> 
<div class="texte" id="texte"><?=$mots[0]?></div>
 <div class="name texte" id="name_user" ><?php echo $_GET['user_name']; ?></div>
 

        </div>
        
        </body>
        </html>
      