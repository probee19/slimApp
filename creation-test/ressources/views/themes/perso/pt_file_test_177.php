
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
#fb_id_user{position: absolute; z-index:1;width:80px ; border-radius:100px;}
#ex{position:absolute; z-index:1; width:80px; max-height:80px; border-radius:100px;}
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

           $message_1 = array('Você ainda pensa em mim?','Oi, faz um tempo ...','Olá.','Você está bem ?');
                $message_2 = array('As vezes...','Espere ... você ouve isso?','Hoje não é Satanás.','Ótimo, obrigado. Faz muito tempo...');
                $message_3 = array('Isso é verdade ?','O que ?',' O que! Eu só quero ficar amigos ...','Toda vez que fecho meus olhos, vejo seu rosto.');
                $message_4 = array('Sim e então eu acordo e me digo: &quot;Felizmente, esse pesadelo acabou!&quot;','O som da minha indiferença. DESPEDIDA !','Cancelar subscrição!','Parece um problema médico. Você deve consultar um médico.');
            $max_key = 3; $key = mt_rand(0,$max_key); setlocale(LC_ALL, 'fr_FR'); $min_1 = mt_rand(10,32); $min_2 = $min_1 + 11; $min_3 = $min_1 + 17;
         
               if( $_GET['user_gender'] == 'homme' || $_GET['user_gender'] == 'male' || $_GET['user_gender'] == 'masculin' )
            {
              $img_ex='http://creation.funizi.com/images-theme-perso/1508955170.png';
                 }
            else{ 
               $img_ex='http://creation.funizi.com/images-theme-perso/1508949534.png';}
            ?>
<div style="position:absolute;width:80px; height:80px; border-radius:100px; background:#000; top:20px; left:30px;">
<img src="<?php echo  $img_ex; ?>" id="ex"> </div>
<div style="position:absolute;width:80px; height:60px; width:480px; border-radius:10px; background:#EEEEEE; top:20px; left:130px; font-size:20px; font-weight:bold; padding:10px;"><?php echo $message_1[$key]; ?>
<div style="position:absolute; bottom:5px; left:10px; font-size:15px; color:#666">17:20</div>
</div>
<img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="fb_id_user" style=" top:120px; right:30px;">

<div style="position:absolute;width:80px;  height:60px; width:480px; border-radius:10px; background:#2693FF; top:120px; right:130px; font-size:20px; font-weight:bold; padding:10px; text-align:right; color:#FFF"><?php echo $message_2[$key]; ?>
<div style="position:absolute; bottom:5px; right:10px; font-size:15px;">17:21</div>
</div>
<div style="position:absolute;width:80px; height:80px; border-radius:100px; background:#000; top:220px; left:30px;"><img src="<?php echo  $img_ex; ?>" id="ex"> </div></div>
<div style="position:absolute;width:80px;  height:60px; width:480px; border-radius:10px; background:#EEEEEE; top:220px; left:130px; font-size:20px; font-weight:bold; padding:10px;"><?php echo $message_3[$key]; ?>
<div style="position:absolute; bottom:5px; left:10px; font-size:15px; color:#666">17:21</div></div>
<img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="fb_id_user" style=" top:320px; right:30px;">
<div style="position:absolute;width:80px;  height:60px; width:480px; border-radius:10px; background:#2693FF; top:320px; right:130px; font-size:20px; font-weight:bold; padding:10px; text-align:right; color:#FFF"><?php echo $message_4[$key]; ?>
<div style="position:absolute; bottom:5px; right:10px; font-size:15px;">17:23</div></div>

        </div>
        
        </body>
        </html>
      