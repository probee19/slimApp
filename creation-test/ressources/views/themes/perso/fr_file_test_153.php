
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
#background{position:absolute; z-index:2; left:0; top:0;  max-width:800px; max-height:420px; }
#fb_id_user{position: absolute; z-index:1; left: 120px; top: 0px; width:130px ; border-radius:0px; max-width:800px; max-height:420px;}
#name_user{position:absolute; z-index:2; left: 260px; top: 40px; font-size:50px; color:#666666;} 
#zone_search{position:absolute; z-index:2; left: 155px; top: 144px; font-size:17px; color:#777777;}
#result1{position:absolute; z-index:2; left: 155px; top: 190px; font-size:18px; color:#333;}
#result2{position:absolute; z-index:2; left: 155px; top: 220px; font-size:18px; color:#333;}
#result3{position:absolute; z-index:2; left: 155px; top: 250px; font-size:18px; color:#333;}
#result4{position:absolute; z-index:2; left: 155px; top: 280px; font-size:18px; color:#333;}


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
                      $recherche = array('Pourquoi '.$_GET['User_name'].' Ne rit-il jamais à mes blaques?','Pourquoi '.$_GET['User_name'].' Est-il plus beau que moi?'
                ,'Pourquoi '.$_GET['User_name'].' Est-il aussi riche?','Pourquoi '.$_GET['User_name'].' Est le plus intelligent?'
                ,'Pourquoi '.$_GET['User_name'].' Est aussi majestueux?','Pourquoi '.$_GET['User_name'].' A rencontré le Président Obama?'
                ,'Pourquoi '.$_GET['User_name'].' A autant de chance?');
                }
            else{ 
                $recherche = array('Pourquoi '.$_GET['User_name'].' Ne rit-elle jamais à mes blagues?','Pourquoi '.$_GET['User_name'].' Est-elle plus belle que moi?'
                ,'Pourquoi '.$_GET['User_name'].' At-elle autant de classe?','Pourquoi '.$_GET['User_name'].' Est la plus intelligente?'
                ,'Pourquoi '.$_GET['User_name'].' Est aussi majestueuse?','Pourquoi '.$_GET['User_name'].' A rencontré Michelle Obama?'
                ,'Pourquoi '.$_GET['User_name'].' A autant de chance?');
               
            }
               
                
                shuffle($recherche);
            ?>
<img src="http://creation.funizi.com/images-theme-perso/1508544962.png" id="background"> 
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
<div class="name texte" id="name_user" ><?php echo $_GET['user_name']; ?></div>
<div  id="zone_search" >Pourquoi <?php echo $_GET['user_name']; ?> est ...</div>
<div  id="result1" ><?php echo $recherche[0] ?></div>
<div  id="result2" ><?php echo $recherche[1] ?></div>
<div  id="result3" ><?php echo $recherche[2] ?></div>
<div  id="result4" ><?php echo $recherche[3] ?></div>

        </div>
        <!-- Ces lignes seront placées dans le footer de la page à capturer -->
        </body>
        </html>
      