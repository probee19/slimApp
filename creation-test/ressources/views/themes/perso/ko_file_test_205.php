
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
              .main{ padding:0;margin:0;width: 800px;height:420px;position: relative;overflow: hidden; background: #FFF;}
.main img{ position:absolute; max-height:420px; max-width:800px; }
#background{position:absolute; z-index:1; left:0; top:0;  max-width:800px; max-height:420px; }
#fb_id_user{position: absolute; z-index:1; left: 30px; top: 20px; width:80px ; border-radius:100px; border:4px solid #666; max-width:800px; max-height:420px;}
#name_user{position:absolute; z-index:1; left: 0px; top: 0px; font-size:30px; color:#FFF;} 
#titretest{position:absolute; z-index:1; left: 150px; width:650px; height:150px; top: 20px; font-size:33px; line-height:35px; color:#000;font-family: 'Bree Serif', serif;} 
ol{position:absolute; z-index:1; left: 50px; width:700px; height:150px; top: 120px; font-size:23px; line-height:25px; color:#000;font-family: 'Bree Serif', serif;} 
ol li{height:55px;} 
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
            $texte = array(''.$_GET['user_name'].'은 훌륭한 아버지가 될 것입니다!', ''.$_GET['User_name'].' 우리는 지루해하지 않습니다!', ''.$_GET['user_name'].'은 단순히 이상적인 사람입니다!', ''.$_GET['user_name'].' 사랑에 모든 것을 줄 수 있습니다!',
            ''.$_GET['user_name'].' 좋은 아이입니다!', ''.$_GET['user_name'].' 놀라운 놀라움을 준비합니다!',''.$_GET['user_name'].' 인생을 더 아름답게 만드는 방법을 알고 있습니다!', ''.$_GET['user_name'].'은 돌이킬 수없는 충성입니다!',''.$_GET['user_name'].'은 재미 있고 똑똑합니다.');
  }
            else{ 
          $texte = array(''.$_GET['user_name'].' 훌륭한 엄마가 될 것입니다!', ''.$_GET['User_name'].' 우리는 지루해하지 않습니다!', ''.$_GET['user_name'].'은 단순히 이상적인 여성입니다!', ''.$_GET['user_name'].' 사랑에 모든 것을 줄 수 있습니다!',
            ''.$_GET['user_name'].' 아름다움입니다!', ''.$_GET['user_name'].' 놀라운 놀라움을 준비합니다!',''.$_GET['user_name'].' 인생을 더 아름답게 만드는 방법을 알고 있습니다!', ''.$_GET['user_name'].'은 돌이킬 수없는 충성입니다!',''.$_GET['user_name'].'은 재미 있고 똑똑합니다.');
  }
shuffle($texte);
?>
<img src="http://creation.funizi.com/images-theme-perso/1510165729.png" id="background"> 

<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
<div id="titretest" >그만큼 <span style="color:#D90000">5 가지 이유</span> 결혼하다 <br><?php echo $_GET['full_user_name']; ?></div>

<ol>
<li><?php echo $texte[0]; ?> </li> 
<li><?php echo $texte[1]; ?> </li> 
<li style="color:#D90000"><?php echo $texte[2]; ?> </li> 
<li><?php echo $texte[3]; ?> </li> 
<li><?php echo $texte[4]; ?> </li> 
</ol>


        </div>
        
        </body>
        </html>
      