
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Teko" rel="stylesheet">
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

#fb_id_user{position: absolute; z-index:2; left: 30px; top: 40px; width:275px ;  max-width:800px; max-height:420px;}
#name_user{position:absolute; z-index:2; left: 0px; top: 0px; font-size:30px; color:#FFF;} 
 
#eden_or_hell{position:absolute; z-index:1; left:0; top:0;  width:100%; height:100%; max-width:800px; max-height:420px; }
.notes{position:absolute; font-family: 'Teko', sans-serif; z-index:1; right:30px; top:40px; padding:20px; font-size:45px; line-height:55px; width:395px; height:235px; }
.decision{position:absolute; font-family: 'Teko', sans-serif; z-index:1; left:30px; bottom:20px; width:700px; height:40px; padding:20px; font-size:55px; display:flex; align-items:center; justify-content : center; }
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
          $background_eden = '1513603943'; $background_hell = '1513609996'; 
          $background = $background_eden; $verdict = "PARADISO"; $color1 = '#1A237E'; $color2 = '#fff';
          $action = mt_rand(1000,100000); $peches = mt_rand(50,200); $gentillesse = mt_rand(160,279);
          $bg_color = 'rgba(41, 182, 246, 0.5)'; 
          if($action < 10000){
                    $background = $background_hell;
                    $verdict = "INFERNO";
                    $color1 = '#FFFFFF'; $color2 = '#FFFFFF';  $bg_color = 'rgba(0, 0, 0, 0.6)';
                    $peches = mt_rand(1000,500000); $gentillesse = mt_rand(150,210);
          }
                    

?>
<!DOCTYPE HTML>
<img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="fb_id_user">

<img src="http://creation.funizi.com/images-theme-perso/<?php echo $background; ?>.png" id="eden_or_hell"> 
<div class="notes" style="color:<?php echo $color1;?>; background:<?php echo $bg_color;?>">
          <div id="nom">Nome: <?php echo urldecode($_GET['user_name']); ?></div>
          <div id="good">Buone azioni: <?php echo number_format($action); ?> </div>
          <div id="bad">Sins: <?php echo number_format($peches); ?></div>
          <div id="kindness">Gentilezza: <?php echo $gentillesse; ?> %</div>
</div>

<div class="decision" style="color:<?php echo $color2;?>; background:<?php echo $bg_color;?>">
         Decisione finale : <?php echo $verdict;?>
</div>





        </div>
        
        </body>
        </html>
      