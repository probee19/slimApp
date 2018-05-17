
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Courgette|Kaushan+Script" rel="stylesheet">
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
              .main{ padding:0;margin:0;width: 800px;height:420px;position: relative;overflow: hidden; background: #E3F2FD;}
.main img{position:absolute;  max-height:420px; max-width:800px; }

#head{z-index:1;position: absolute; left: 0; top: 0;  width:800px ; height:70px ; background:#0D47A1;   }

#head_text{z-index:1; font-family: 'Kaushan Script', cursive; text-transform:uppercase; position: absolute; left: 75px; top: 0px; color:#FFF; font-size:25px; width:725px ; height:70px ;  display:flex; align-items:center; justify-content:center;  text-align:center;  }

#fb_id_user{position: absolute; z-index:1; left: 5px; top: 5px; width:60px ;  height:60px ; object-fit: cover; object-position: 50% 10%; border-radius:60px; }
#name_user{position:absolute; z-index:1; left: 0px; top: 0px; font-size:30px; color:#FFF;} 

#sentiment{z-index:1; font-family: 'Kaushan Script', cursive; position: absolute; left: 0; top: 110px; color:#1565C0; text-transform:uppercase; font-size:55px;line-height:50px; width:550px ; height:50px ;  text-align:center; }

#explication{z-index:1; font-family: 'Courgette', cursive; position: absolute; left: 10px; top: 170px; color:#000;  font-size:30px;line-height:35px; width:530px ; height:230px ; display:flex; align-items:center; justify-content:center; text-align:center; }

#img_sent{position:absolute; right:10px; bottom:10px; width:230px; height:330px; border-radius:30px;}

#back_layer{position:absolute; left:0; top:0; width:800px; height:420px;}



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
          $sentiments = array('in Frieden','geliebt','motiviert','gewünscht');
          $explications = array('Sie haben einen beruhigenden Einfluss auf alle um Sie herum. Du akzeptierst das Leben wie es ist und teilst deine Weisheit mit Menschen, die Probleme haben.',
          'You have a very rare gift; you have the ability to make people feel noticed and geliebt. Your openness and understanding help people feel themselves.',
          'Manchmal müssen Menschen dazu gedrängt werden, ihren Träumen nachzugehen. Hier intervenieren Sie. Sie strahlen Entschlossenheit und Optimismus aus. Ein echter Schub für die Moral',
          'Das Gefühl der Einsamkeit verschwindet, wenn Sie bei Ihnen sind. Ihre Freundlichkeit und ansteckende Energie verbreiten Freude um Sie herum. Ein echter Sonnenstrahl.');
          $couleurs = array('#E3F2FD','#FCE4EC','#C8E6C9','#F3E5F5');
          $img = array('1525280712','1525280729','1525280876','1525280768');
          $ind = mt_rand(0,3);
?>
<!DOCTYPE HTML>

<div id="back_layer" style="background:<?=$couleurs[$ind]?>"></div>
<div class="texte" id="head"> </div>
<div class="texte" id="head_text">So fühlen sich die Menschen in deiner Gegenwart</div>
<img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="fb_id_user">

<div class="texte" id="sentiment"><?=$sentiments[$ind]?> </div>

<div class="texte" id="explication"><?=$explications[$ind]?> </div>

<img src="https://creation.funizi.com/images-theme-perso/<?=$img[$ind]?>.jpg" id="img_sent"> 




        </div>
        
        </body>
        </html>
      