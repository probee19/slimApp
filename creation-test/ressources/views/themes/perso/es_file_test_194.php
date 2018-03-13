
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
#resultat1 div {margin-bottom:30px;}
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
           $texte = array('Es extremadamente leal','Renders uno después del otro','Me encanta ir de fiesta!','Sonríe incluso cuando quiere llorar','Odio las injusticias','Siempre tenga tiempo para pasar con la familia','Siempre sorprendido', 'Nunca dejes caer a sus amigos' );
$texte1 = array(''.$_GET[' user_name'].' ve oportunidades en todos los problemas que enfrenta. Él es muy perspicaz y puede proyectarse hacia el futuro.',
'&quot;'.$_GET[' user_name'].' siempre está ahí para sus amigos, él entiende la importancia del apoyo y el amor que él tiene para ellos, tiene un corazón de oro&quot;',
'&quot;'.$_GET[' user_name'].' amado y perdido, pero no ha perdido nada de su pasión y alegría&quot;.',
'&quot;'.$_GET[' user_name'].' siempre tiene la solución a todos los problemas, y su optimismo y sabiduría son insuperables&quot;.');
   }
            else{ 
           $texte = array('Es extremadamente leal','hace una toma tras otra','Me encanta ir de fiesta!','Sonríe incluso cuando ella quiere llorar','Odio las injusticias','Siempre tenga tiempo para pasar con la familia','Siempre sorprendido', 'Nunca dejes caer a sus amigos' );
$texte1 = array(''.$_GET[' user_name'].' ve oportunidades en cada problema que enfrenta. Ella es muy perspicaz y puede proyectarse hacia el futuro.',
'"'.$_GET[' user_name'].' sigue ahí para sus amigos. Ella comprende la importancia del apoyo y amor por ellos. Ella tiene un corazón de oro"',
'&quot;'.$_GET[' user_name'].' amado y perdido, pero ella no ha perdido la pasión y la alegría que la caracterizan&quot;.',
'&quot;'.$_GET[' user_name'].' siempre tiene la solución a todos los problemas, y su optimismo y sabiduría son insuperables&quot;.');
  
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
      