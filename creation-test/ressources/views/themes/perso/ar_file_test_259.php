
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Acme" rel="stylesheet">
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
#background{position:absolute; z-index:1; left:0; top:0;  width:800px;  }
hr{position:absolute; z-index:1; left: 15px; top: 35px; width:770px; border:1px solid #FFF; color:#FFF;}
#name_user{position:absolute; z-index:1; left: 0px; top: 0px; font-size:30px; color:#FFF;} 
#profile_img{position: absolute; z-index:1; left:15px; bottom: 15px; border:5px solid #FFF; width:200px; height:330px; overflow: hidden;}
#fb_id_user{left: 50%; top: 50%; height: 100%; width: auto; -webkit-transform: translate(-50%,-50%); -ms-transform: translate(-50%,-50%); transform: translate(-50%,-50%);}
#header{position: absolute; z-index:1; font-family: 'Acme', sans-serif; font-weight:700; left:0; top:0; font-size:35px; line-height:40px; text-align:center; width:800px; height:40px; color:#FFF; }
#fait{position: absolute; z-index:2; font-family: 'Acme', sans-serif; right:0; top:55px; font-size:35px; padding-left:20px; line-height:40px; text-align:left; width:550px; height:350px; color:#FFF;
          display:flex; align-items:center; 
}

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
      
<!DOCTYPE HTML>
<?php 
           if( $_GET['user_gender'] == 'homme' || $_GET['user_gender'] == 'male' || $_GET['user_gender'] == 'masculin' )
                   $faits = array('يغفر الجميع','أحب عائلته','وسوف تفعل كل شيء لأصدقائه','لاتيأس أبدا','هو مريض جدا',' هو مقاتل','هو شجاع',
                         'لا يضر شخص','هو دائما يبتسم','تجد دائما الوقت لأصدقائه','دائما التغلب على الفشل','أحب والدته');
          else
                    $faits = array('يغفر الجميع','أحب عائلته','وسوف تفعل كل شيء لأصدقائه','لاتيأس أبدا','هو مريض جدا','هو يتأرجح','هو شجاع',
                         'لا يضر شخص','هو دائما يبتسم','تجد دائما الوقت لأصدقائه','دائما التغلب على الفشل','أحب والدته');
          
          
          shuffle($faits);
?>

<img src="http://creation.funizi.com/images-theme-perso/1514553692.jpg" id="background"> 
<div id="header"> 7 حقائق حول <?php echo $_GET['user_name']; ?></div>
<hr>
<div id="profile_img">
          <img src="https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
</div>
<div classe="fait" id="fait"> 
          - <?php echo $faits[0]; ?> <br>
          - <?php echo $faits[1]; ?> <br>
          - <?php echo $faits[2]; ?> <br>
          - <?php echo $faits[3]; ?> <br>
          - <?php echo $faits[4]; ?> <br>
          - <?php echo $faits[5]; ?> <br>
          - <?php echo $faits[6]; ?> 
</div>



        </div>
        
        </body>
        </html>
      