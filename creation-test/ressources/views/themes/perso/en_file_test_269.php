
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Open+Sans:800" rel="stylesheet">
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
              .main{ padding:0;margin:0;width: 800px;height:420px;position: relative;overflow: hidden; background: #F9F9F9;}
.main img{ position:absolute; max-height:420px; max-width:800px; }

#fb_id_user{position: absolute; z-index:1; left: 50px; top: 80px; width:200px ;border:3px solid #000; border-radius:200px; max-width:800px; max-height:420px; object-fit: cover;}
#name_user{position:absolute; font-family: 'Open Sans', sans-serif; z-index:1; left: 20px; top: 290px; width:260px; padding:10px 0; text-align:center; font-size:20px;font-weight:700; color:#000;} 
 
#crochet{position:absolute; z-index:1; left:320px; top:20px; height:380px; max-width:800px; max-height:420px; }
#qualites{font-family: 'Open Sans', cursive; z-index:1; position: absolute; left: 380px; top: 10px; color:#000; font-size:20px; font-weight:700; width:400px ; height:400px ; background:transparent;   padding:5px; text-align:left; max-width:800px; max-height:420px; display: flex; justify-content: left; /* align horizontal */ align-items: center; /* align vertical */flex-wrap: wrap; }
.one_line{position:relative;  width:100%; display:block; clear:both; }
.first-letter{font-size:30px; text-transform:uppercase; color:#C70039; margin-right:0;}
.erreur{font-size:30px; line-height:35px;}
#fond_vert{position:absolute; z-index:1; right:0; top:0;  max-width:800px; max-height:420px; }

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
 function removeAccents($str) {
  $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ', 'Ά', 'ά', 'Έ', 'έ', 'Ό', 'ό', 'Ώ', 'ώ', 'Ί', 'ί', 'ϊ', 'ΐ', 'Ύ', 'ύ', 'ϋ', 'ΰ', 'Ή', 'ή');
  $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o', 'Α', 'α', 'Ε', 'ε', 'Ο', 'ο', 'Ω', 'ω', 'Ι', 'ι', 'ι', 'ι', 'Υ', 'υ', 'υ', 'υ', 'Η', 'η');
  return str_replace($a, $b, $str);
}
 $couleurs= ['#FFBB00','#3182FC','#FD2C25','#00AC47'];
 
 $mots = ['Amusing','Brave','Curious','Devoted','Eager','Funny','Graceful','Honest','Impressive','Jovial','Keen','Loyal','Mature','Natural','Optimistic','Pretty','Quiet','Reliable','Sincere','Tough','Upbeat','Vibrant','Wily','Xtra',
          'Yahoo','Zen','Attentive','Brillant','Crafty','Delightful','Exciting','Formidable','Generous','Happy','Intelligent','Joyful','Kind','Lovable','Modest','Nice','Outstanding','Popular','Quick','Realistic','Sober','Talented','Unique','Vigorous',
          'Wise','Xtrem','Yeah','Zealous','angelic','Brainy','Candid','Diligent','Emotional','Famous','Gracious','Helpful','Interesting','Jocular','Kissable','Leader','Motivated','Neat','Orderly','Polite','Qualified','Respected','Sweet','Tolerant','Useful','Virtuous','Winsome','Xcellent',
          'Yes','Zeal'];
          
 shuffle($mots);
 $prenom=removeAccents(urldecode($_GET['user_name']));
 //$prenom='Frederec edouard';
 $prenom = explode(' ',trim($prenom));
$prenom=$prenom[0]; //
 $prenom = str_split($prenom);
 $nb_lettre = count($prenom);
 if($nb_lettre >=4 )
          $font_size = 400 / (count($prenom)*2) + 5;
else
          $font_size = 50;
 $qualites = ''; $qualites_choisies = [];
 $erreur = "<div class='erreur'>We apologize for not being able to give the meaning of your name. This can be caused by the fact that your name does not use the Latin alphabet!</div>";
 foreach($prenom as $lettre){
           foreach($mots as $id => $qualite){
                     $pos = strpos($qualite, $lettre);
                     $lettre = strtolower($lettre); $qualite = strtolower($qualite);
                     if(strpos($qualite, $lettre) !== false && strpos($qualite, $lettre) === 0 && array_search($qualite, $qualites_choisies) === false){
                              $qualites_choisies[] = $qualite; $erreur = "";
                               shuffle($couleurs);
                              $qualites .= '<div class="one_line"><span class="first-letter" style="font-size:'.$font_size.'px; color:'.$couleurs[0].'">'.$lettre.'</span>'.substr($qualite, 1).' </div>';
                              break;
                     }
           }
           
 }
 $font_size -= 5;
?>
<img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" width="200" height="200" class="img_profile" id="fb_id_user">
<div class="name texte" id="name_user" ><?php echo urldecode($_GET['user_name']); ?></div>
<img src="http://creation.funizi.com/images-theme-perso/1517592561.png" id="crochet">

<div class="texte" id="qualites" style="font-size:<?php echo $font_size;?>px"> <?php echo $qualites.$erreur;?> </div>
<img src="http://creation.funizi.com/images-theme-perso/1517592582.png" id="fond_vert"> 


        </div>
        
        </body>
        </html>
      