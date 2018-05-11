
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Kavivanar" rel="stylesheet">
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

#fb_id_user{position: absolute; z-index:0; left: 31px; top: 70px; width:249px ; border:1px solid #000; border-radius:300px; max-width:800px; max-height:420px;}
#name_user{position:absolute; z-index:1; left: 0px; top: 0px; font-size:30px; color:#FFF;} 
.texte{z-index:1; font-family: 'Kavivanar', cursive; position: absolute;   padding:5px; }
#phrase{left: 410px; top: 90px; color:#000;display:flex; align-items:center; justify-content:center; text-align:center; font-size:40px; line-height:45px; width:340px ; height:300px ;}
#head_temp{left: 0px; top: 0px; color:#FFF; font-size:30px; line-height:35px; width:800px ; height:80px ;text-align:center;}
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
          $phrases = array('Glück begünstigt den gut vorbereiteten Geist','Sie werden Ihren Job verlassen und Sie werden das ganze Jahr reisen',
          'Vertraue dir selbst, du bist fähig zu mehr.',
          'Eine Gelegenheit wird bald kommen, nimm deine Chance!','Liebe ist näher an dem, was du denkst, lass dich begehren.',
          'Sie werden bald eine schöne Romanze mit jemandem beginnen, der Ihr Herz erfreuen wird',
          'Dein Leben wird aufblühen, eine neue Welt wird dir entgegenkommen.',
          'Du wirst endlich diese Person treffen, die dir so sehr in sozialen Netzwerken folgt.');
          
          shuffle($phrases);
?>
<!DOCTYPE HTML>
<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user">
<img src="http://creation.funizi.com/images-theme-perso/1518796079.png" id="backg"> 

<div class="texte" id="head_temp"> Was sagt dein chinesischer Keks?</div>

<div class="texte" id="phrase"><?php echo $phrases[0]; ?></div>



        </div>
        
        </body>
        </html>
      