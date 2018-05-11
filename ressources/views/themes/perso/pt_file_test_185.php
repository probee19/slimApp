
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
.conteneur{ position:absolute; height:210px; width:200px; }
.blanc{ background:#FFFFFF; }
.rouge{ background:#D90000; }
.img_profile{ position:absolute; width:120Px; border-radius:100px; left:40px; top:20px}
.blanc_border{ border:5px solid #FFFFFF; }
.rouge_border{ border:5px solid #D90000; }
.texte{ position:absolute; width:200Px; border-radius:100px; bottom:20px; text-align:center; font-size:20px; font-weight:bold}
.blanc_texte{ color: #FFFFFF; }
.rouge_texte{ color: #D90000; }
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
 $texte=array('Selvagem', 'Sexy', 'louco','Louco','Louco', 'bufão', 'Encantador', 'palhaço');
 shuffle($texte);
?>

<div class="conteneur rouge" style="top:0;left:0">
 <img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile blanc_border" id="fb_id_user">          
<div class='texte blanc_texte'><?php echo $texte[0]; ?></div>
</div>
<div class="conteneur blanc" style="top:0;left:200px">
 <img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_1']; ?>/picture/?width=275&height=275" class="img_profile rouge_border" id="fb_id_user">          
<div class='texte rouge_texte'><?php echo $texte[1]; ?></div>
</div>
<div class="conteneur rouge" style="top:0;left:400px">
 <img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_2']; ?>/picture/?width=275&height=275" class="img_profile blanc_border" id="fb_id_user">          
<div class='texte blanc_texte'><?php echo $texte[2]; ?></div>
</div>
<div class="conteneur blanc" style="top:0;left:600px">
 <img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_3']; ?>/picture/?width=275&height=275" class="img_profile rouge_border" id="fb_id_user">          
<div class='texte rouge_texte'><?php echo $texte[3]; ?></div>
</div>
<div class="conteneur blanc" style="top:210px;left:0">
 <img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_4']; ?>/picture/?width=275&height=275" class="img_profile rouge_border" id="fb_id_user">          
<div class='texte rouge_texte'><?php echo $texte[4]; ?></div>
</div>
<div class="conteneur rouge" style="top:210px;left:200px">
 <img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_5']; ?>/picture/?width=275&height=275" class="img_profile blanc_border" id="fb_id_user">          
<div class='texte blanc_texte'><?php echo $texte[5]; ?></div>
</div>
<div class="conteneur blanc" style="top:210px;left:400px">
 <img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_6']; ?>/picture/?width=275&height=275" class="img_profile rouge_border" id="fb_id_user">          
<div class='texte rouge_texte'><?php echo $texte[6]; ?></div>
</div>
<div class="conteneur rouge" style="top:210px;left:600px">
 <img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_7']; ?>/picture/?width=275&height=275" class="img_profile blanc_border" id="fb_id_user">          
<div class='texte blanc_texte'><?php echo $texte[7]; ?></div>
</div>

        </div>
        
        </body>
        </html>
      