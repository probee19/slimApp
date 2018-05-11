
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:700" rel="stylesheet">
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
#background{position:absolute; z-index:1; left:0; top:0;  max-width:800px; max-height:420px; }
#fb_id_user{position: absolute; z-index:1; left: 30px; top: 10px; width:80px ; border-radius:100px; border:4px solid #666; max-width:800px; max-height:420px;}
#name_user{position:absolute; z-index:1; left: 0px; top: 0px; font-size:30px; color:#FFF;} 
#titretest{position:absolute; z-index:1; left: 150px; width:650px; height:150px; top: 15px; font-size:33px; line-height:35px; color:#FFF;font-family: 'Roboto Condensed', sans-serif;} 
ol{position:absolute; z-index:1; left: 50px; width:700px; height:150px; top: 110px; font-size:30px; line-height:25px; color:#000;font-family: 'Roboto Condensed', sans-serif;} 
ol li{height:55px;} 
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
            $texte = array('Você faria qualquer coisa por seus amigos','Seu charme é fatal','Você ama apaixonadamente','As pessoas não devem subestimá-lo','Você odeia injustiças','Você é mais forte do que parece','Nada pode quebrar seu espírito','Sua confiança em você é inabalável','Você é mais corajoso do que você pensa');
  }
            else{ 
          $texte = array('Você faria qualquer coisa por seus amigos','Seu charme é fatal','Você ama apaixonadamente','As pessoas não devem subestimá-lo','Você odeia injustiças','Você é mais forte do que parece','Nada pode quebrar seu espírito','Sua confiança em você é inabalável','Você é mais corajoso do que você pensa');
  }
shuffle($texte);
?>
<img src="http://creation.funizi.com/images-theme-perso/1512742548.png" id="background"> 

<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user">
<div id="titretest" >As <span style=\"color:#EFA200\">5 VERDAS</span> descobertas sobre você em 2017<br> <?php echo $_GET['full_user_name']; ?> 
         </div>

<ol>
<li><?php echo $texte[0]; ?> </li> 
<li><?php echo $texte[1]; ?> </li> 
<li style="color:#EE2D0B"><?php echo $texte[2]; ?> </li> 
<li><?php echo $texte[3]; ?> </li> 
<li><?php echo $texte[4]; ?> </li> 
</ol>


        </div>
        
        </body>
        </html>
      