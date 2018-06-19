
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
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
.overlay{position:absolute; z-index:1; left:0; top:0;  width:800px; height:420px; background-color:#000; opacity:0.3;}
#fb_id_user{position: absolute; z-index:1; left: 350px; bottom: 20px; width:100px ;  height:100px ; object-fit: cover; object-position: 50% 10%; border-radius:100px; max-width:800px; max-height:420px;}
#name_user{position:absolute; z-index:1; left: 0px; top: 0px; font-size:30px; color:#FFF;} 

#message{z-index:1;font-family: 'Kanit', sans-serif; position: absolute; left: 20px; top: 10px; color:#fff; font-size:60px; line-height:65px; width:760px ; height:280px ; display:flex; justify-content:center; align-items:center; text-align:center; }
.hashtag{z-index:1;font-family: 'Kanit', sans-serif; position: absolute; bottom: 10px; color:#fff; font-size:20px; line-height:20px; width:auto ; height:20px ;}
#hashtag_1{left: 30px; }
#hashtag_2{right: 30px; text-align:right; }
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
          $texte = array('My thoughts to the victims of the torrential rains in Abidjan','Yako to my Ivorian friends. Wholeheartedly with Ivory Coast.');
          shuffle($texte);
?>
<!DOCTYPE HTML>
<img src="https://creation.funizi.com/images-theme-perso/1529446449.jpg" id="back"> 
 <div class="overlay"></div>
<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user">
<div class="name texte" id="name_user" ></div>
 
<div class="texte" id="message"> <?=$texte[0]?> </div>

<div class="texte hashtag" id="hashtag_1"> #Yako </div>

<div class="texte hashtag" id="hashtag_2"> #YakoAbidjan </div>
 

        </div>
        
        </body>
        </html>
      