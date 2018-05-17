
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">
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
#background { position:absolute; height:420px; width:800px; background:#FF4000; }
#fb_id_user{position: absolute; z-index:1; left: 30px; top: 20px; width:80px ; border-radius:100px; max-width:800px; max-height:420px;}
#name_user{position:absolute; z-index:1; left: 0px; top: 0px; font-size:30px; color:#FFF;} 
#titretest{position:absolute; z-index:1; left: 150px; width:600px; height:150px; top: 20px; font-size:30px; line-height:35px; color:#FFFF00;font-family: 'Bree Serif', serif;} 
ol{position:absolute; z-index:1; left: 50px; width:600px; height:150px; top: 120px; font-size:30px; line-height:25px; color:#FFF;font-family: 'Bree Serif', serif;} 
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
       $texte = array("Quando lo raddoppiamo in coda!","Quando il suo telefono non ha batteria!",
"Quando il suo parrucchiere fa disastri!", "Quando sua madre lo chiama 10 volte al giorno!", "Quando una zanzara gli impedisce di dormire"
,"Quando piove e lui non ha un ombrello!","Quando le persone parlano alle sue spalle!","Quando la gente bisbiglia al cinema!");    
 }
 else
 {
           $texte = array("Quando lo raddoppiamo in coda!","Quando il suo telefono non ha batteria!",
"Quando il suo parrucchiere fa disastri!", "Quando sua madre lo chiama 10 volte al giorno!", "Quando una zanzara gli impedisce di dormire"
,"Quando piove e lei non ha un ombrello!","Quando le persone parlano alle sue spalle!","Quando la gente bisbiglia al cinema! ");
 }

 shuffle($texte);
?>
<div id="background" ></div>
<img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="fb_id_user">
<div class="name texte" id="name_user" ></div>
<div id="titretest" >Quali sono le 5 cose che <?php echo urldecode($_GET['user_name']); ?> odiano di più?</div>
<div class="name texte" id="name_user" ></div>

<ol>
<li><?php echo $texte[0]; ?> </li> 
<li><?php echo $texte[1]; ?> </li> 
<li><?php echo $texte[2]; ?> </li> 
<li> <?php echo $texte[3]; ?> </li> 
<li><?php echo $texte[4]; ?> </li> 
</ol>


        </div>
        
        </body>
        </html>
      