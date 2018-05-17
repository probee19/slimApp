
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
                          <link href="https://fonts.googleapis.com/css?family=Rancho" rel="stylesheet"> 
        
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
                          .main{ padding:0;margin:0;width: 800px;height:420px;position: relative;overflow: hidden; background: #FFF;} .main img{ position:absolute; max-height:420px; max-width:800px; } #background{position:absolute; z-index:1; left:0; top:0; max-width:800px; max-height:420px; } #titre_test{position:absolute; z-index:1; left:0; top:0; width:800px; background:#000; text-align:center; font-size:1.7em; color:#fff; padding-top:15px;padding-bottom:15px; } #fb_id_user{position: absolute; z-index:1; left: 50px; top: 100px; width:200px ; border-radius:100px; max-width:800px; max-height:420px; border:3px solid #0B795F ;} #name_user{position:absolute; z-index:1; left: 0px; top: 280px; font-size:30px; color:#FFF; text-align:center; width:300px;} #name_user span{padding:5px; background:#0B795F ; color:#FFF;border-radius:10px; font-size:0.7em;} #resultat{position:absolute; z-index:1; left: 350px; top: 110px; font-size:40px; color:#000; width:400px; height:200px;line-height:45px; text-align:center;font-family: 'Rancho', cursive;}
        
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
                  

                  });
              </script>
          </head>
          <body style='width: 800px; height:420px; margin:0; padding:0; overflow: hidden;'>
          <div class='main'>
      
&lt;?php 
$expression = array(&quot;Si tu penses à un rhinocéros, grimpe à un arbre&quot;,&quot;Tu attends qu'on se souvienne de toi, mais c'est l'oubli qui s'ensuit&quot;,&quot;La calebasse d'un chanceux pousse toujours dans les broussailles&quot;,&quot;La fumée doit rester dans la maison&quot;,&quot;C'est quand le vent souffle que l'on voie les fesses de la poule&quot;,&quot;Même le poisson qui vit dans l'eau a toujours soif&quot;); 
shuffle($expression); 
 if( $_GET['user_gender'] == 'homme' || $_GET['user_gender'] == 'male' || $_GET['user_gender'] == 'masculin' )
            {
               
            }
?&gt;
&lt;img src=&quot;http://creation.funizi.com/images-theme-perso/1508498520.png&quot; id='background'&gt; 
&lt;div id='titre_test'&gt;Quelle expression Camerounaise te correspond le mieux ?&lt;/div&gt; 
&lt;img src='https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=275&amp;height=275'class='img_profile' id='fb_id_user'&gt; 
&lt;div class='name texte' id='name_user' &gt;&lt;span&gt;<?php echo urldecode($_GET['user_name']); ?>&lt;/span&gt;&lt;/div&gt; 
&lt;div id='resultat' &gt;&lt;?php echo $expression[0]; ?&gt; &lt;/div&gt;

        </div>
        
        </body>
        </html>
      