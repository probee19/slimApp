
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
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

#back{position:absolute; z-index:1; left:0; top:0;  width:800px; height:420px; opacity:0.6;}

#name_user{position:absolute;font-family: 'Ubuntu', sans-serif;  z-index:1; text-transform:uppercase; left: 0px; top: 30px; width:800px; text-align:center; font-size:60px;font-weight:700;  color:#C62828;} 
.ligne{z-index:1;font-family: 'Ubuntu', sans-serif;  text-transform:uppercase; position: absolute; left: 10px; color:#000; font-size:32px;font-weight:700; width:280px ; height:50px ; display:flex; align-items:center; justify-content:flex-end; text-align:right; max-width:800px; max-height:420px;}
#ligne1{top: 120px; }
#ligne2{top: 190px; }
#ligne3{top: 260px; }
#ligne4{top: 330px; }


.resultat{z-index:1; font-family: 'Ubuntu', sans-serif; text-transform:uppercase; position: absolute; left: 300px; color:#000; font-size:32px; width:500px ; height:50px ; display:flex; align-items:center;  text-align:left; max-width:800px; max-height:420px;}
#resultat1{top: 120px; }
#resultat2{top: 190px; }
#resultat3{top: 260px; }
#resultat4{top: 330px; }
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
          $like = array('عائلته','اصدقاءه','donner','شغفه بالسفر','تقدم ابتسامة','مساعدة الناس');
          $dislike = array('كذابين','الاستحمام','الناس غاضب');
          $nature = array('مؤمن','تعاطفا','مرن');
          $personnalite = array('ترغب في المشاركة','ليست أنانية','اجعل الجميع يضحكون');
          shuffle($like); shuffle($dislike); shuffle($nature); shuffle($personnalite);
          
?>
<!DOCTYPE HTML>

<img src="https://creation.funizi.com/images-theme-perso/1523965710.jpg" id="back"> 
<div class="name texte" id="name_user" ><?php echo $_GET['user_name']; ?></div>
<div class="texte ligne" id="ligne1"> {٪احبك :  </div>
<div class="texte resultat" id="resultat1"> <?=$like[0];?> </div>

<div class="texte ligne" id="ligne2"> {٪ t Hate :  </div>
<div class="texte resultat" id="resultat2"> <?=$dislike[0];?> </div>

<div class="texte ligne" id="ligne3"> {٪ t الطبيعة :  </div>
<div class="texte resultat" id="resultat3"> <?=$nature[0];?> </div>

<div class="texte ligne" id="ligne4"> {٪ t الشخصية :  </div>
<div class="texte resultat" id="resultat4"> <?=$personnalite[0];?> </div>




        </div>
        
        </body>
        </html>
      