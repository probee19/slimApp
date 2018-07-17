
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Boogaloo" rel="stylesheet">
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

#voyance{z-index:1;font-family: 'Boogaloo', cursive;position: absolute;  left: 50px; top: 40px; color:#fff; font-size:40px; line-height:45px; width:500px ; height:180px ; display:flex; align-items:center; justify-content:center; text-align:center; max-width:800px; max-height:420px;}

#fb_id_user{position: absolute; z-index:1; left: 30px; bottom: 20px; width:100px ;  height:100px ; object-fit: cover; object-position: 50% 10%; border-radius:100px; border:10px solid #FFF; max-width:800px; max-height:420px;}

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
                  //JavaScript

                  });
              </script>
          </head>
          <body style='width: 800px; height:420px; margin:0; padding:0; overflow: hidden;'>
          <div class='main'>
      
<?php
          $voyance = array('15 jours you baakh yiguay ame Dubai guuiss nako si samay guénnt',
          'Si faane you néééw digua démm îles du Saloum ame fa 10 jours',
          'Londres dé dafa amm 8 jours yodoul faté moukk, sa billet bi mangui ni diko guiss',
          'Wane nagnouma si samay guénnt guay tothie Ibiza',
          'Sa patron dé dinala may 21 jours gua dém Miami, Vegas ak Bahamas',
          'Sa démm Saly guiss nako, gua andakk koula diégué lolou guén ame fa 7 jours',
          '3 semaines pour Rome yilay khaar so paréwoul rék gua mayy mako mane Sélbé');
          shuffle($voyance);
?>
<!DOCTYPE HTML>

<img src="https://creation.funizi.com/images-theme-perso/1531750078.jpg" id="back"> 

<div class="texte" id="voyance"><?=$voyance[0]?></div>

<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user">


        </div>
        
        </body>
        </html>
      