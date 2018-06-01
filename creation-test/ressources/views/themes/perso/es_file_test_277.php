
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Acme" rel="stylesheet">
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
              .main{ padding:0;margin:0;width: 800px;height:420px;position: relative;overflow: hidden; background: #D50000;}
.main img{ position:absolute; max-height:420px; max-width:800px; }

#fb_id_user{position: absolute; z-index:1; left: 30px; top: 30px; width:360px ; border:1px solid #000; border-radius:0; max-width:800px; max-height:420px;}
#name_user{position: absolute; z-index:1; left: 0px; top: 0px; font-size:30px; color:#FFF;} 

#result{z-index:1; font-family: 'Acme', sans-serif; position: absolute; right: 30px; top: 30px; color:#000; font-size:54px; line-height:60px; color:#FFF; width:360px ; height:360px ; display:flex ; align-items:center; justify-content:center; text-align:center; max-width:800px; max-height:420px;}
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
           if( $_GET['user_gender'] == 'homme' || $_GET['user_gender'] == 'male' || $_GET['user_gender'] == 'masculin' ){
                  $results = array('Ver videos graciosos en Youtube','Pasar un buen rato antes del partido PSG Real Madrid FC','Celebrando la victoria del PSG sobre el Real Madrid','Celebrando la victoria del Real Madrid sobre el PSG',
          'Besando a una chica bonita','En una cena romántica', 'Contando tu dinero','Visitando amigos');
           }
           else{
                  $results = array('Ver videos graciosos en Youtube','Celebrando la victoria del PSG sobre el Real Madrid','Celebrando la victoria del Real Madrid sobre el PSG',
          'Besando a un buen chico','En una cena romántica', 'Contando tu dinero','Visitas de novias');
           }
           shuffle($results);
         
?>
<!DOCTYPE HTML>

<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user">

<div class="texte" id="result"><?php echo $results[0]; ?> </div>




        </div>
        
        </body>
        </html>
      