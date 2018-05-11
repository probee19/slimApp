
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
#titre{ position:absolute; height:90px; width:700px; left:100px; top:40px; background:#BC8CBE;font-family: 'Bree Serif', serif; }
#fb_id_user{position: absolute; z-index:1; left: 20px; top: 20px; width:150px ; border-radius:100px; max-width:800px; max-height:420px; border:3px solid #BC8CBE;}
#name_user{position:absolute; z-index:1; left: 200px; top: 50px; font-size:50px; color:#FFF;font-family: 'Bree Serif', serif;} 
#resultat1 {position:absolute; z-index:1; left: 170px; top: 150px; font-size:30px; color:#333;}
#resultat1 div {margin-bottom:20px;}
#titre_bottom{ position:absolute; min-height:70px; width:800px; left:0px; bottom:0px; background:#BC8CBE; color:#FFF; font-size:25px; text-align:center; line-height:26px; padding-top:15px;padding-bottom:15px;font-family: 'Bree Serif', serif; }
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
           $texte = array('È estremamente fedele','Rende uno dopo l\'altro','Adoro fare festa!','Sorride anche quando vuole piangere','Odio le ingiustizie','Avere sempre tempo da trascorrere con la famiglia','Sempre sorpreso le persone', 'Non deludere mai i suoi amici' );
$texte1 = array(''.$_GET['user_name'].' vede opportunità in tutti i problemi che deve affrontare. È molto perspicace e può proiettarsi nel futuro.',
'\"'.$_GET['user_name'].' è sempre lì per i suoi amici, capisce l\'importanza del supporto e dell\'amore che ha per loro, ha un cuore d\'oro\"',
'\"'.$_GET['user_name'].' amato e perso, ma non ha perso la passione e la gioia che lo caratterizzano\".',
'\"'.$_GET['user_name'].' ha sempre la soluzione a tutti i problemi, e il suo ottimismo e saggezza non sono secondi a nessuno.\"');
   }
            else{ 
           $texte = array('È estremamente fedele','fa uno sparo dopo l\'altro','Adoro fare festa!','Sorride anche quando lei vuole piangere','Odio le ingiustizie','Avere sempre tempo da trascorrere con la famiglia','Sempre sorpreso le persone', 'Non deludere mai i suoi amici' );
$texte1 = array(''.$_GET['user_name'].' vede le opportunità in ogni problema che affronta. È molto perspicace e può proiettarsi nel futuro.',
'"'.$_GET['user_name'].' è ancora lì per i suoi amici. Comprende l\'importanza del supporto e dell\'amore per loro. Lei ha un cuore d\'oro"',
'\"'.$_GET['user_name'].' amato e perso, ma non ha perso la passione e la gioia che la caratterizzano\".',
'\"'.$_GET['user_name'].' ha sempre la soluzione a tutti i problemi, e il suo ottimismo e saggezza non sono secondi a nessuno.\"');
  
            }
        
shuffle($texte);shuffle($texte1);
?>
<div id="titre"></div>
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
<div class="name texte" id="name_user" ><?php echo $_GET['user_name']; ?> :</div>
<div class="" id="resultat1" ><div>- <?php echo $texte[0]; ?></div><div>- <?php echo $texte[1]; ?></div><div>- <?php echo $texte[2]; ?></div></div>
<div id="titre_bottom"><?php echo $texte1[0]; ?></div>

        </div>
        
        </body>
        </html>
      