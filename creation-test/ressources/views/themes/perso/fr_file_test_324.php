
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
.main img{ position:absolute;  max-width:800px; }

#back, #back2, #guirlande{position:absolute; z-index:1; left:0; top:0;  width:800px; }
#guirlande{opacity:0.1;}
#nom1{z-index:1; position: absolute; font-family: 'Dancing Script', cursive; left: 350px; top: 60px; color:#000; font-size:14px; width:450px ; height:300px ;  display: flex; justify-content: left; align-items: center; flex-wrap: wrap;  }
.one_line{position:relative;  width:100%; display:block; clear:both; line-height:initial; }
.underline{text-decoration:underline;}
.nom{text-transform:capitalize;font-weight:700;}
.signification{text-transform:capitalize;font-weight:500;}
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
          $nom = urldecode($_GET['full_user_name']);
          $chaine = trim($nom);
          $chaine = str_replace("###antiSlashe###t", " ", $chaine);
          $chaine = eregi_replace("[ ]+", " ", $chaine);
          $nom = explode(' ',$chaine);
          $couleurs= ['#FFBB00','#3182FC','#FD2C25','#00AC47'];
          $nb_mots = count($nom);
          $significations = array(' honnêteté ',' leadership ',' motivation ',' persévérance ',' courage ',' force ',' loyauté ');
          
          if($nb_mots >=2 )
                    $font_size = 200 / (count($nom)*2) ;
          else
                    $font_size = 50;
                    
          shuffle($significations); shuffle($couleurs); $signification = ''; $ind = 0; $margin = $font_size/2;
          foreach($nom as $mot){
                    $signification .= '<div class="one_line underline" style="font-size:'.$font_size.'px;"><span class="nom" >'.$mot.'</span>  signifie  : </div> 
                                       <div class="one_line signification" style="font-size:'.$font_size.'px;">'.$significations[$ind++].' </div>';
                              
          }
?>
<!DOCTYPE HTML>

<img src="https://creation.funizi.com/images-theme-perso/1524071551.jpg" id="back"> 

<img src="https://creation.funizi.com/images-theme-perso/1524075232.png" id="guirlande"> 

<div class="texte" id="nom1"> <?=$signification;?> </div>



        </div>
        
        </body>
        </html>
      