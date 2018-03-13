
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
#background{position:absolute; z-index:1; left:0; top:0;  max-width:800px; max-height:420px; }
#fb_id_user{position: absolute; z-index:1; left: 00px; top: 00px; width:90px ;}
#name_user{position:absolute; z-index:1; left: 0px; top: 0px; font-size:30px; color:#FFF;} 
#titretest{position:absolute; z-index:1; left: 150px; width:600px; height:150px; top: 20px; font-size:30px; line-height:30px; color:#FEF574;font-family: 'Bree Serif', serif;} 
.liste_reponse {position:absolute; z-index:1; left: 50px; width:600px; height:150px; top: 100px; font-size:25px; line-height:25px; color:#FFF;font-family: 'Bree Serif', serif;} 
.liste_reponse li{height:60px; list-style-type: none; margin-left:0;} 
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
$texte = array("dice solo cose interessanti","è grazioso","è misterioso","è bello","abbracci d&#39;amore","è intelligente","trasmette la sua gioia di vivere","è adempiuto", "Prenditi cura di lei","è inaccessibile"
,"ha un senso dell&#39;umorismo","è appassionato","è frizzante ed energico","ha un senso dell&#39;umorismo","è pronto a scendere a compromessi","piace andare a fare una passeggiata", "sapere cosa vuole"
,"è una donna indipendente","è gentile e premuroso");
 shuffle($texte);
?>
<img src="http://creation.funizi.com/images-theme-perso/1509234528.jpg" id="background"> 
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
<div class="name texte" id="name_user" ></div>
<div id="titretest" >Perché <?php echo $_GET['user_name']; ?> è una donna perfetta?</div>
<div class="name texte" id="name_user" ></div>

<ul class='liste_reponse'>
<li> <?php echo $_GET['user_name']; ?> <?php echo $texte[0]; ?> </li> 
<li><?php echo $_GET['user_name']; ?> <?php echo $texte[1]; ?> </li> 
<li><?php echo $_GET['user_name']; ?> <?php echo $texte[2]; ?> </li> 
<li><?php echo $_GET['user_name']; ?> <?php echo $texte[3]; ?> </li> 
<li><?php echo $_GET['user_name']; ?> <?php echo $texte[4]; ?> </li> 
</ul>


        </div>
        
        </body>
        </html>
      