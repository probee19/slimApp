
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
           $texte = array('Est extrèmement loyal','Coup d&#39;État sur coup','Adore faire la fête!','Sourit même quand il y a une envie de pleurer','Déteste les injustices','Toujours du temps à consacrer à sa famille','Surprends toujours les gens', 'Ne laisse jamais tomber ses amis' );
$texte1 = array(''.$_GET[' user_name'].' voit des opportunités dans tous les problèmes il fait face à face. Il est très perspicace et peut se projeter dans le futur.',
'&quot;'.$_GET[' user_name'].' est toujours là pour ses amis.&quot; Il est un coeur en ou &quot;',
'&quot;'.$_GET[' nom_utilisateur'].' a aimé, il s&#39;est perdu.&quot; Il s&#39;est assagi mais n&#39;a jamais perdu la passion et la joie qui caractérisent. &quot;',
'&quot;'.$_GET[' user_name'].' a toujours la solution à tous les problèmes.&quot; Son optimisme et sa sagesse sont inégalables. &quot;');
   }
            else{ 
           $texte = array('Est extrèmement loyal','coup de coup sur coup','Adore faire la fête!','Sourit même quand elle a envie de pleurer','Déteste les injustices','Toujours du temps à consacrer à sa famille','Surprends toujours les gens', 'Ne laisse jamais tomber ses amis' );
$texte1 = array(''.$_GET[' user_name'].' voit des opportunités dans tous les cas de figure. Elle est très perspicace et peut se projeter dans le futur.',
'"'.$_GET[' user_name'].' est toujours là pour ses amis. Elle comprend l&#39;importance du soutien et de l&#39;amour qu&#39;elle leur porte. Elle a un coeur en or"',
'&quot;Elle s&#39;est assagie mais n&#39;a jamais perdu la passion et la joie qui le caractérise.&quot;',
'&quot;'.$_GET[' user_name'].' a toujours la solution à tous les problèmes.&quot; Son optimisme et sa sagesse sont inégalables. &quot;');
  
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
      