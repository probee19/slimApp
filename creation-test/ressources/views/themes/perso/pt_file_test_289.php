
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
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
            #titre_test{position:absolute; z-index:1; left:0; top:0;  width:800px; background:#000; text-align:center; font-size:2em; color:#fff; padding-top:15px;padding-bottom:15px; }
            #fb_id_user{position: absolute; z-index:1; left: 50px; top: 100px; width:200px ; border-radius:100px; max-width:800px; max-height:420px; border:3px solid #0079FB;}
            #name_user{position:absolute; z-index:1; left: 0px; top: 280px; font-size:30px; color:#FFF; text-align:center; width:300px;}
            #name_user span{padding:5px; background:#0079FB; color:FFF;border-radius:10px; font-size:0.7em;}
            #resultat{position:absolute; z-index:1; left: 350px; top: 140px; font-size:45px; color:#000; width:400px; height:200px;line-height:45px; text-align:center;font-family: 'Oswald', sans-serif;}

        
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
 $expression = array("Moyibi alingaka te bayiba ye","Moto amemi maki abundaka te","Mama abotaka mwana kasi motema ya mwana te",
 "Masuwa ekendaka libongo etikalaka","Matoyi elekaka moto te","Mayi eninganaka pamba te","Nzungu ya kala babuakaka te, po mokolo mosusu okoki kolingela yango nguba",
 "Soso amelaka mbuma ekoki na mongongo naye ","Bakimaka mbula na mopepe te","Bamekaka mojindo ya mayi na mosapi te","Mosapi moko esokoloka elongi te",
 "Ebembe ya nyoka esilaka somo te","Mbua azalaka na makolo mineyi, kasi alandaka nzela se moko","Mayi ya moto etumbaka elamba te","Soki omoni ndoki belela noki mongongo ekawuka");

shuffle($expression); 

?>
<img src="http://creation.funizi.com/images-theme-perso/1519685557.png" id="background"> 
<div id="titre_test">Quelle expression Lingala te correspond le mieux ?</div>
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
<div class="name texte" id="name_user" ><span><?php echo urldecode($_GET['user_name']); ?></span></div>
<div id="resultat" ><?php echo $expression[0]; ?> </div>



        </div>
        
        </body>
        </html>
      