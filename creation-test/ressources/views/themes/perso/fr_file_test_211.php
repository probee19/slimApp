
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
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

#fb_id_user{position: absolute; z-index:1; left: 20px; bottom: 15px; width:180px ; border-radius:180px; border:4px solid #AD2C10; max-width:800px; max-height:420px;}

#fb_id_friend_1{position: absolute; z-index:1; left: 20px; top: 15px; width:180px ; border-radius:180px; border:4px solid #AD2C10;  max-width:800px; max-height:420px;}

#back{position:absolute; z-index:1; left:0; top:0; width:100%; max-width:800px; max-height:420px; }

#texte{z-index:1; position: absolute; font-family: 'Dancing Script', cursive; left: 230px; top: 70px; color:#000; font-size:35px; line-height:40px; font-weight:700; width:500px ; height:300px ; background:transparent; border:0; border-radius:0px;  padding:5px; text-align:justify; max-width:800px; max-height:420px;}
#entete,#footer{z-index:1; position: absolute; font-family: 'Dancing Script', cursive; color:#0029E3; font-size:40px; font-weight:700; line-height:40px; background:transparent;  }
#entete{left: 230px; top: 20px;}
#footer{right: 200px; bottom: 20px;}
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
          $mots = array(
                    "Tu es le charme incarné. N&#39;importe quelle journée devient radieuse quand je te vois. La vie est faite pour être vécue et tu le sais pertinemment. Ta soif de connaissances et d&#39;aventures n&#39;a pas d&#39;égal que ton amour pour ta famille et tes amies.",
                    "Tu es un ami sympathique qui sait commenter n&#39;importe quelle journée divertissante et passionnante. Quelle que soit l&#39;heure, tu débordes toujours d&#39;une énergie contagieuse et tu es toujours prêt à aller explorer le monde. Tu es vraiment unique.",
                    "Tu vis ta vie comme tu l&#39;entends et tu n&#39;as pas peur d&#39;être la force de la nature que tu es naturellement. Tu tiens beaucoup à tes amis et tu ferais n&#39;importe quoi pour protéger. Tu es quelqu&#39;un d&#39;honnête et d&#39;adorable."
          );
  else
           $mots = array(
                    "Tu es le charme incarné. N&#39;importe quelle journée devient radieuse quand je te vois. La vie est faite pour être vécue et tu le sais pertinemment. Ta soif de connaissances et d&#39;aventures n&#39;a pas d&#39;égal que ton amour pour ta famille et tes amies.",
                    "Tu es une amie sympathique qui sait commenter n&#39;importe quelle journée divertissante et passionnante. Quelle que soit l&#39;heure, tu débordes toujours d&#39;une énergie contagieuse et tu es toujours prêt à aller explorer le monde. Tu es vraiment unique.",
                    "Tu vis ta vie comme tu l&#39;entends et tu n&#39;as pas peur d&#39;être la force de la nature que tu es naturellement. Tu tiens beaucoup à tes amis et tu ferais n&#39;importe quoi pour protéger. Tu es quelqu&#39;un d&#39;honnête et d&#39;adorable."
          );
          
shuffle($mots);
?>
<img src="http://creation.funizi.com/images-theme-perso/1511805425.jpg" id="back"> 

<img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="fb_id_user">
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_1']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_friend_1">


<div class="texte" id="entete"> Cher <?php echo urldecode($_GET['user_name']); ?>, </div>
<div class="texte" id="texte"> <?php echo $mots[0];?> </div>
<div class="texte" id="footer"> <?php echo urldecode($_GET['friend_first_name_1']); ?> </div>


        </div>
        
        </body>
        </html>
      