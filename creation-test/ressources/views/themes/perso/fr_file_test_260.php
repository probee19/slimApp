
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
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
              .main{ padding:0;margin:0;width: 800px;height:420px;position: relative;overflow: hidden; background: #FFF; font-size:24px;font-family: 'Montserrat', sans-serif;}
.main img{ position:absolute; max-height:420px; max-width:800px; }
#background{position:absolute; z-index:1; left:0; top:0;  max-width:800px; max-height:420px; }
#label_passenger{position:absolute; z-index:1; left:90px; top:110px;  }
#passenger{position:absolute; z-index:1; left:90px; top:140px; font-weight:900; }

#abordage{position:absolute; z-index:1; left:90px; top:190px; font-size : 25px;  }
#label_date{position:absolute; z-index:1; left:90px; top:230px;  }

#date{position:absolute; z-index:1; left:90px; top:230px;  font-weight:900;}

#label_to{position:absolute; z-index:1; left:400px; top:190px; font-size : 35px;}
#to{position:absolute; z-index:1; left:450px; top:190px; font-weight:900;font-size : 35px; }



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
          $to = array(' Paris ', ' La Havane ', ' Hawai ', ' Bora Bora ', ' Londres ', ' Mexico ', ' Miami ');
          $mois = array(' janvier ',' fevrier ',' mars ',' avril ',' mai ',' juin ');
          shuffle($mois); shuffle($to);
?>

<img src="http://creation.funizi.com/images-theme-perso/1515157095.jpg" id="background">
<div id="label_passenger">  Passager  : </div>
<div id="passenger"> <?php echo $_GET['full_user_name']; ?> </div>
<div id="date"> <?=  mt_rand(1,28).' '.$mois[0].'   2018 à   '.mt_rand(12,23).':'.mt_rand(11,59); ?></div>

<div id="label_to"> A  : </div>
<div id="to"><?=  $to[0]; ?></div>

<div id="abordage"> Heure d'abordage  :</div>



        </div>
        
        </body>
        </html>
      