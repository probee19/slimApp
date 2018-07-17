
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
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

#danse{z-index:1;font-family: 'Titillium Web', sans-serif;  position: absolute; left: 0px; top: 0px; color:#fff; font-size:44px; line-height:54px; width:800px ; height:250px ; display:flex; align-items:center; justify-content:center; text-align:center; }

#back{position:absolute; z-index:1; left:0; top:0;  max-width:800px; max-height:420px; }
#fb_id_user{position: absolute; z-index:1; left: 315px; bottom: 20px; width:150px ;  height:150px ; object-fit: cover; object-position: 50% 10%; border-radius:150px; max-width:800px; max-height:420px;}

              </style>
              <script src='https://code.jquery.com/jquery-1.12.0.min.js'></script>
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
                    

                  });
              </script>
          </head>
          <body style='width: 800px; height:420px; margin:0; padding:0; overflow: hidden;'>
          <div class='main'>
      
<?php
          $danses = array('Rigou Rigou, Rigou Rigou <br> Nékété yow Rigou Rigou kén dakkoulako','Aka ya meunone Goana','Néké Oupoukay dina indi guélaw ...<br> Guay oupou di oupou bay nélaw... <br> '.$_GET['user_name'].' dafay Oupou... <br> '.$_GET['user_name'].'  ba feekh gua...',
          'Ay khalé yi statue lén ... <br> MBAARASSS','Khiiss Mbacc <br> Khiiss Khiiss Mbacc ','Jaalguati héééé, Jaalguati...<br>Yaw aka ya meunone Jaalguati','Kay kay kay gneuweul gnu bloqué...<br>Aka ya meunone Blokass',
          'Aythia léééén na rang yi juub <br> Maana yéna barri maana... ','Diaabiraa <br> Yaw féthial diaabira...','Linguay paaxa nekh <br>Rimbaax Paapax','Sama diouni bi...<br> Thiakhagun gou tathie',
          'Yuza Yuza Yuza ...<br> Yaw ya meunone Yuza', ' Mborokhé Mborokhé <br> Mborokhé Mborokhé', 'Raass dafa khéw <br> Raass dafa nékh <br> Aythia lénn gnu Raass','Kou nékk ak kala gnopati, kala gaadji, kala khourii.. ba wookk la <br> Wookkal Wookkal Wookkal');
          shuffle($danses);
?>
<!DOCTYPE HTML>

<img src="https://creation.funizi.com/images-theme-perso/1531494730.jpg" id="back"> 
 
<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user">
 
<div class="texte" id="danse"><?=$danses[0]?></div>


        </div>
          
        </body>
        </html>
      