
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Do+Hyeon" rel="stylesheet">

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
.overlay{position:absolute; z-index:1; left:0; top:0;  width:800px; height:420px; background:#000; opacity:0.4;}

#fb_id_user{position: absolute; z-index:1; left: 350px; top: 30px; width:100px ;  height:100px ; object-fit: cover; object-position: 50% 10%; border-radius:100px; -webkit-mask-image: linear-gradient( transparent 8%, black 25%);mask-image: linear-gradient(to right, transparent 8%, black 25%);}
#peur{z-index:1; position: absolute; font-family: 'Do Hyeon', sans-serif;left: 50px; bottom: 20px; color:#FFF; font-size:34px; line-height:40px; width:700px ; height:250px ;display:flex; align-items:center; justify-content:center; text-align:center; max-width:800px; max-height:420px;}
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
          if( $_GET['user_gender'] == 'homme' || $_GET['user_gender'] == 'male' || $_GET['user_gender'] == 'masculin' ){
                    $peurs = array('فكرة الابتعاد عن عائلتك ترعبك. أنت تحبهم كثيرًا لدرجة أنك تريد دائمًا أن تكون معها.',
                    'خوفك الأكبر هو عدم القدرة على إخبار أصدقائك وعائلتك كم تحبهم كل يوم.',
                    'عائلتك تحبك كثيرا ، وقد جادلت بقوة بأن فكرة خيبة الأمل لها يكسر قلبك. أنت فقط تريد أن ترى الابتسامات على وجوههم.',
                    'عائلتك رائعة. أنت تشارك كل شيء وأنت تعرف كيف تدعم بعضها البعض. سوف تضيع بدونهم.',
                    'خوفك الأكبر هو أن تنفصل عن أفضل صديق لك. أنت توأمان تقريبا!',
                    'أنت تحب عائلتك أكثر من أي شيء في العالم. أنت مرعوب من خسارتها. هؤلاء هم أهم الناس في حياتك',
                    'عائلتك هي مصدر السعادة. إنهم ليسوا مجرد أشخاص يشاركونك الدماء ، فهم أفضل أصدقائك وأفضل دعم لك.');
          }
          else{
                    $peurs = array('فكرة الابتعاد عن عائلتك ترعبك. أنت تحبهم كثيرًا لدرجة أنك تريد دائمًا أن تكون معها.',
                    'خوفك الأكبر هو عدم القدرة على إخبار أصدقائك وعائلتك كم تحبهم كل يوم.',
                    'عائلتك تحبك كثيرا ، وقد جادلت بقوة بأن فكرة خيبة الأمل لها يكسر قلبك. أنت فقط تريد أن ترى الابتسامات على وجوههم.',
                    'عائلتك رائعة. أنت تشارك كل شيء وأنت تعرف كيف تدعم بعضها البعض. سوف تضيع بدونهم.',
                    'خوفك الأكبر هو أن تنفصل عن أفضل صديق لك. أنت توأمان تقريبا!',
                    'أنت تحب عائلتك أكثر من أي شيء في العالم. أنت مرعوب من خسارتها. هؤلاء هم أهم الناس في حياتك',
                    'عائلتك هي مصدر السعادة. إنهم ليسوا مجرد أشخاص يشاركونك الدماء ، فهم أفضل أصدقائك وأفضل دعم لك.');
                    
          }
          shuffle($peurs);
?>
<!DOCTYPE HTML>

<img src="https://creation.funizi.com/images-theme-perso/1524925262.jpg" id="back"> 
<div class="overlay"></div>
  
<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user"> 
<div class="texte" id="peur"><?=$peurs[0]?></div>
 

        </div>
        
        </body>
        </html>
      