
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Fira+Sans" rel="stylesheet">
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
#fb_id_user{position: absolute; z-index:1; right: 20px; top: 20px; width:80px ;  height:80px ; border:4px solid #666;object-fit: cover; object-position: 50% 10%; border-radius:80px; }
#name_user{position:absolute; z-index:1; left: 0px; top: 0px; font-size:30px; color:#FFF;} 
#titretest{position:absolute; font-family: 'Fira Sans', sans-serif;z-index:1; left: 50px; width:650px; height:150px; top: 20px; font-size:33px; line-height:37px; color:#000;;} 
ol{font-family: 'Fira Sans', sans-serif; position:absolute; z-index:1; left: 50px; width:700px; height:150px; top: 120px; font-size:25px; line-height:25px; color:#000;} 
ol li{height:55px;} 
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
 
  $texte = array(''.$_GET['user_name'].' keep secrets!', 'With '.$_GET['User_name'].' We never get bored!', ''.$_GET['user_name'].' is just adorable!',
  ''.$_GET['user_name'].' can give everything by friendship!',''.$_GET['user_name'].' knows how to give good advice!', 
  ''.$_GET['user_name'].' prepares wonderful surprises!',''.$_GET['user_name'].' knows how to make life more beautiful!');
shuffle($texte);
?>
<img src="http://creation.funizi.com/images-theme-perso/1531932164.jpg" id="background"> 

<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user">

<div id="titretest" >The <span style="color:#D90000">5 reasons</span> to be friends with <br><?php echo $_GET['full_user_name']; ?></div>

<ol>
<li><?php echo $texte[0]; ?> </li> 
<li><?php echo $texte[1]; ?> </li> 
<li style="color:#D90000"><?php echo $texte[2]; ?> </li> 
<li><?php echo $texte[3]; ?> </li> 
<li><?php echo $texte[4]; ?> </li> 
</ol>


        </div>
        
        </body>
        </html>
      