
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <!-- Ces lignes seront placées entre les balises HEAD de la page à capturer -->
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
.fb_id_friend{position: absolute; z-index:1; width:70px ; border-radius:0px; background:#000;}

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
$cpt=1;
while ($cpt!=11)
{
 $left=80*($cpt-1)+10;
 
?>
<img src="https://graph.facebook.com/<?php echo ''.$_GET['fb_id_friend_'.$cpt.''].''?>/picture/?width=275&height=275" style="top:10px; left:<?php echo $left;?>px" class="img_profile fb_id_friend">

<?php $cpt++; } ?>

<?php
$cpt_line2=1;
while ($cpt_line2!=11)
{
 $left=80*($cpt_line2-1)+10;

?>
<img src="https://graph.facebook.com/<?php echo ''.$_GET['fb_id_friend_'.$cpt.''].''?>/picture/?width=275&height=275" style="top:80px; left:<?php echo $left;?>px" class="img_profile fb_id_friend">

<?php $cpt++; $cpt_line2++;} ?>

<?php
$cpt_line3=1;
while ($cpt_line3!=11)
{
 $left=80*($cpt_line3-1)+10;

?>
<img src="https://graph.facebook.com/<?php echo ''.$_GET['fb_id_friend_'.$cpt.''].''?>/picture/?width=275&height=275" style="top:150px; left:<?php echo $left;?>px" class="img_profile fb_id_friend">

<?php $cpt++; $cpt_line3++;} ?>


        </div>
        <!-- Ces lignes seront placées dans le footer de la page à capturer -->
        </body>
        </html>
      