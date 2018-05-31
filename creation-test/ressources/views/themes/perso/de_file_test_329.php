
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
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

#back{position:absolute; z-index:1; left:0; top:0;  width:800px; max-height:420px; opacity:0.7; }

#fb_id_user{position: absolute; z-index:1; opacity:0.2; left: 240px; top: 50px; width:320px ;  height:320px ; object-fit: cover; object-position: 50% 10%; border-radius:320px; max-width:800px; max-height:420px;}

#layer{z-index:1; position: absolute; opacity:0.4; left: 50px; top: 50px;  width:700px ; border-radius:10px; height:320px ; background:#FFF; }
#signification{z-index:1; font-family: 'Kanit', sans-serif;text-transform:uppercase; position: absolute; left: 100px; top: 50px; color:#1A237E; font-size:44px; line-height:65px; width:600px ; height:320px ; display:flex; align-items:center; justify-content:center; text-align:center;}

.first-letter{font-size:60px; text-transform:uppercase; }

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
  if( $_GET['user_gender'] == 'homme' || $_GET['user_gender'] == 'male' || $_GET['user_gender'] == 'masculin' ){
          $mots = ['admirable','agile', 'attentionné', 'authentique', 'bienveillant', 'brillant', 'bienfaisant', 'brave','combatif', 'chanceux', 'charmant', 'clément', 'courageux','digne','discipliné','dévoué','dynamique','efficace','exemplaire','eloquent','eblouissant','fantastique','fidèle','fort','fascinant','fiable'
           ,'galant','généreux','gentil','génial','gracieux','honnête','honorable','humble','habile','héroïque','ingénieux','intelligent','irrésistible','innovateur','indomptable','judicieux','juste','jovial','kiffable','loyal','laborieux','marrant','méthodique','malin','modèle'
           ,'naturel','noble','novateur','ordonné','original','optimiste','précieux','protecteur','quièt','radieux','rayonnant','respectueux','romantique','rusé','sage','serein','serviable','sincère','splendide','tendre','travailleur','tombeur','unique','utile','vaillant','vigilant','wouah'
           ,'xtra', 'yo','yup', 'zen','zélé','zlantanesque'];
          $article = 'tous';
  }
 else{
          $mots = ['admirable','agile', 'attentionnée', 'authentique', 'bienveillante', 'brillante', 'brave', 'combative', 'charmante', 'courageuse','digne','disciplinée','dévouée','dynamique','efficace','exemplaire','eloquente','eblouissante','equilibrée','fantastique','forte','fascinante','fiable'
           ,'galante','généreuse','gentille','géniale','gracieuse','honnête','honorable','humble','habile','héroïque','ingénieuse','intelligente','irrésistible','innovatrice','indomptable','judicieuse','juste','joviale','joyeuse' ,'kiffable', 'loyale','laborieuse','magnifique','marrante','méthodique','maligne'
           ,'naturelle', 'novatrice','ordonnée','originale','optimiste','pacifique','parfaite','précieuse', 'protectrice','quiète','radieuse','rayonnante','respectueuse','romantique','rusée','sage','sereine','serviable','sincère','splendide','tendre','travailleuse', 'unique','utile','vaillante','vigilante','virtuose','wouah','wouaaaw'
           ,'xtra','yup','zen','zélée','zlantanesque'];
           $article = 'toutes';
 }
          
 shuffle($mots);
 
 $prenoms =removeAccents($_GET['user_name']); 
 // $prenom=Ludovic;
 $prenom = explode(' ',trim($prenoms));
 $prenom = $prenom[0]; //
 $prenom = str_split($prenom);
 $qualites = ''; $qualites_choisies = [];
 $erreur = "<div class='erreur'>Nous nous excusons de ne pas pouvoir donner la signification de votre prénom. 
          Cela peut etre causé par le fait que votre prénom n'utilise pas l'alphabet latin !</div>";
 foreach($prenom as $lettre){
           foreach($mots as $id => $qualite){
                     $pos = strpos($qualite, $lettre);
                     $lettre = strtolower($lettre); $qualite = strtolower($qualite);
                     if(strpos($qualite, $lettre) !== false && strpos($qualite, $lettre) === 0 && array_search($qualite, $qualites_choisies) === false){
                              $qualites_choisies[] = $qualite; $erreur = "";
                               shuffle($couleurs);
                              //$qualites .= '<span class="first-letter" style="font-size:'.$font_size.'px; color:'.$couleurs[0].'">'.$lettre.'</span>'.substr($qualite, 1).'';
                              break;
                     }
           }
           break;
           
 }
 $firt_letter = '<span class="first-letter" style="color:'.$couleurs[0].'">'.$lettre.'</span>'; 
?>

<!DOCTYPE HTML>

<img src="https://creation.funizi.com/images-theme-perso/1524587617.jpg" id="back"> 
 
<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user"> 

<div class="texte" id="layer"></div>
 
<div class="texte" id="signification"><div>Comme <?=$article?> les <?=$firt_letter?><?=substr($prenoms,1)?>, <br> tu es <?=$firt_letter?><?=substr($qualite, 1)?></div>  </div>
  



        </div>
        
        </body>
        </html>
      