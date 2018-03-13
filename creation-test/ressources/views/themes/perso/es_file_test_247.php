
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Kalam:700" rel="stylesheet">
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
              .main{ padding:0;margin:0;width: 800px;height:420px;position: relative;overflow: hidden; background: #fff;}
.main img{ position:absolute; max-height:420px; max-width:800px; }

#background{position:absolute; z-index:1; left:0; top:0;  width:100%; max-width:800px; }
#overlay{position: absolute; z-index:1; top:0; left:0; width:100%; height:100%; background:#FFF;opacity:0.3; }
#fb_id_user{position: absolute; z-index:1; left: 40px; top: 40px; width:100px ; border-radius:100px; max-width:800px; max-height:420px;}
#name_user{position:absolute;font-family: 'Kalam', cursive;  z-index:1; left: 240px; top: 15px; font-size:30px; color:#000;} 
#entete{position: absolute;font-family: 'Kalam', cursive; left:240px; top:60px; z-index:1; font-size:25px;  }
.cadeau{position: absolute;font-family: 'Kalam', cursive; left:250px; z-index:1; font-size:28px;  }
#cadeau1{top:110px;}
#cadeau2{top:150px;}
#cadeau3{top:190px;}
#cadeau4{top:230px;}

#cadeau5{right:85px;top:275px; text-align:right;}

#year{position: absolute; font-family: 'Kalam', cursive; right:25px; bottom:35px; z-index:1; font-size:40px; color:#FFF;}
#footer{position: absolute; font-family: 'Kalam', cursive; right:110px; bottom:65px; z-index:1; font-size:25px; text-align:right; }
.rotate {

/* Safari */
-webkit-transform: rotate(-38deg);

/* Firefox */
-moz-transform: rotate(-38deg);

/* IE */
-ms-transform: rotate(-38deg);

/* Opera */
-o-transform: rotate(-38deg);

/* Internet Explorer */
filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);

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
      
<?php
          $houses = array('Una villa de $ 20,000,000', 'Una lujosa villa de $ 15,000,000', 'Un edificio en Miami', 'Una isla solo para ti');
          $cars = array('Un Mercedes Clase A','Un Lamborghini Urus' ,'Una serie de BMW 7');
          $calls = array('Un Iphone X', 'Un Galaxy S9');
          $trips = array('Unas vacaciones en Bora Bora','15 días de locura en Dubai','Vacaciones en Bali', 'Una estadía en Londres');
          $money = array('un cheque por $ 5,000', 'un cheque por $ 10,000', 'un cheque por $ 15,000');
          shuffle($houses);shuffle($cars);shuffle($calls);shuffle($trips);shuffle($money);
?>
<!DOCTYPE HTML>

<img src="http://creation.funizi.com/images-theme-perso/1513792272.jpg" id="background"> 
<div id="overlay"></div>
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
<div class="name texte" id="name_user" ><?php echo $_GET['user_name']; ?>,</div>

<div class="entete" id="entete" >Para su próximo cumpleaños, tendrá:</div>
<div class="cadeau" id="cadeau1">- <?php echo $houses[0];?></div>
<div class="cadeau" id="cadeau2">- <?php echo $cars[0];?></div>
<div class="cadeau" id="cadeau3">- <?php echo $calls[0];?></div>
<div class="cadeau" id="cadeau4">- <?php echo $trips[0];?></div>
<div class="cadeau" id="cadeau5">et <?php echo $money[0];?></div>

<div class="footer" id="footer" >... ¡de tus amigos!</div>
<div id="year" class="rotate">2018</div>


        </div>
        
        </body>
        </html>
      