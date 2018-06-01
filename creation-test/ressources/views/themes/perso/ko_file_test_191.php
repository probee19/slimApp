
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">
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
#fb_id_user{position: absolute; z-index:1; left: 30px; top: 20px; width:80px ; border-radius:100px; max-width:800px; max-height:420px;}
#name_user{position:absolute; z-index:1; left: 0px; top: 0px; font-size:30px; color:#FFF;} 
#titretest{position:absolute; z-index:1; left: 150px; width:630px; height:150px; top: 20px; font-size:33px; line-height:35px; color:#000;font-family: 'Bree Serif', serif;} 
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
            $texte = array(''.urldecode($_GET['user_name']).' 우수한 평판을 유지하고자합니다.',''.urldecode($_GET['user_name']).'은 성실하고 관대하며 충직합니다.',''.urldecode($_GET['user_name']).'은 여전히 ​​약속을 지키고 있습니다.',
''.urldecode($_GET['user_name']).' 비밀을 밝히지 않았습니다.',''.urldecode($_GET['user_name']).' 절대로 사랑하는 사람을 실망 시키려하지 않습니다.','
'.urldecode($_GET['user_name']).'은 우정으로 사랑에 충실합니다.',''.urldecode($_GET['user_name']).'은 취소 할 수 없습니다.',''.urldecode($_GET['user_name']).'은 그가 사랑하는 사람을 기쁘게합니다.',
''.urldecode($_GET['user_name']).' 다른 사람들에 대한 나쁜 것들을 말하지 않습니다.',''.urldecode($_GET['user_name']).'은 아무도 배신하지 않았습니다.', ''.urldecode($_GET['user_name']).'은 자신의 앞에 다른 사람들의 욕구를 둔다.');
  }
            else{ 
             $texte = array(''.urldecode($_GET['user_name']).' 우수한 평판을 유지하고자합니다.',''.urldecode($_GET['user_name']).'은 성실하고 관대하며 충직합니다.',''.urldecode($_GET['user_name']).'은 여전히 ​​약속을 지키고 있습니다.',
''.urldecode($_GET['user_name']).' 비밀을 밝히지 않았습니다.',''.urldecode($_GET['user_name']).' 절대로 사랑하는 사람을 실망 시키려하지 않습니다.','
'.urldecode($_GET['user_name']).'은 우정으로 사랑에 충실합니다.',''.urldecode($_GET['user_name']).'은 취소 할 수 없습니다.',''.urldecode($_GET['user_name']).'은 자신이 사랑하는 사람들을 기쁘게합니다.',
''.urldecode($_GET['user_name']).' 다른 사람들에 대한 나쁜 것들을 말하지 않습니다.',''.urldecode($_GET['user_name']).'은 아무도 배신하지 않았습니다.', ''.urldecode($_GET['user_name']).'은 자신의 앞에 다른 사람들의 욕구를 둔다.');

            }
shuffle($texte);
?>
<img src="http://creation.funizi.com/images-theme-perso/1509392071.jpg" id="background"> 

<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
<div id="titretest" ><?php echo urldecode($_GET['full_user_name']); ?>을 (를) 신뢰 <span style=\"color:#D90000\">해야하는 5 가지 이유</span></div>

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
      