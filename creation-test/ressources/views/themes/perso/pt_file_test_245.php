
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Itim" rel="stylesheet">
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

#fb_id_user{position: absolute; z-index:7; left: 300px; top: 110px; width:200px ; border:1px solid #000; border-radius:200px; max-width:800px; max-height:420px;}
#name_user{position:absolute; z-index:7; left: 300px; top: 300px;  width:200px; font-size:20px; text-align:center; line-height:30px; border-radius:10px; background:#fff; color:#000;} 
.mot{font-family: 'Itim', cursive;  position: absolute; color:#000; font-size:45px; line-height:30px; width:400px ; height:140px ;  display:flex; align-items:center;  flex-direction: row; justify-content: center; }
#mot1{ left: 0px; top: 0px; background:#2ecc71;  padding-right:50px; width:350px ; }
#mot2{ left: 0px; top: 140px; background:#2980b9;  padding-right:100px; width:300px ; }
#mot3{ left: 0px; bottom: 0px; background:#FF80AB;  padding-right:50px; width:350px ;}
#mot4{ right: 0px; top: 0px; background:#FFD54F;  padding-left:50px; width:350px ;}
#mot5{ right: 0px; top: 140px; background:#4FC3F7;  padding-left:120px; width:280px ; }
#mot6{ right: 0px; bottom: 0px; background:#80CBC4;  padding-left:50px; width:350px ;}
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
                    $mots = array('sensual','robustoo','grave','magnético','criativo','carismático','Forte','protetor','bom','polivalente','divertido','grato','encantador','gostos','engraçado'  );
         else
                    $mots = array('sensual','robustoo','grave','magnéticoic','criativo','carismático','Forte','protetora','□ Gentil','versátil','divertido','grato','adorável','gostos','engraçado'  );
          shuffle($mots);
?>
<!DOCTYPE HTML>
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
<div class="name texte" id="name_user" ><?php echo $_GET['user_name']; ?></div>


<div class="texte mot" id="mot1"><?php echo $mots[0]; ?> </div>
<div class="texte mot" id="mot2"><?php echo $mots[1]; ?> </div>
<div class="texte mot" id="mot3"><?php echo $mots[2]; ?> </div>
<div class="texte mot" id="mot4"><?php echo $mots[3]; ?> </div>
<div class="texte mot" id="mot5"><?php echo $mots[4]; ?> </div>
<div class="texte mot" id="mot6"><?php echo $mots[5]; ?> </div>


        </div>
        
        </body>
        </html>
      