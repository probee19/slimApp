
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Courgette" rel="stylesheet">
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

#background{position:absolute; z-index:1; left:0; top:0;  width:800px;  }

#img{position:absolute; z-index:1; right:133px; top:150px; border-radius:200px; width:200px; height:200px; }

#fb_id_user{position: absolute; z-index:1; left: 133px; top: 150px; width:200px ; border-radius:200px; max-width:800px; max-height:420px;}
#surprise{position:absolute; z-index:1; left: 0px; top: 60px; width:800px; text-align:center; font-size:40px; line-height:45px; color:#FFF; font-family: 'Courgette', cursive;} 


#arrow{position:absolute; z-index:1; left:335px; top:180px;  max-width:800px; max-height:420px; }

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
          $surprises = array('Te vas a casar.','Tendrá un auto nuevo como regalo.','Te vas a comprometer','Llamarás a tu ex',
                    'Tendrás unas vacaciones en Miami.', 'Tendrás gemelos');
          $img = array('1514896378','1514895246','1514896995','1514897325','1514897765','1515405337');
          $id = mt_rand(0,5);
          
?>
<img src="http://creation.funizi.com/images-theme-perso/1514894006.jpg" id="background"> 

<div id="surprise" ><?php echo $surprises[$id]; ?></div>
<img src="http://creation.funizi.com/images-theme-perso/<?php echo $img[$id]; ?>.jpg" id="img"> 

<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user">


<img src="http://creation.funizi.com/images-theme-perso/1514899457.png" id="arrow"> 




        </div>
        
        </body>
        </html>
      