
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
           $texte = array('مخلص للغاية','يجعل واحدا تلو الآخر','أحب أن الحفلة!','يبتسم حتى عندما يريد البكاء','مظالم الكراهية','دائما وقت لقضاء مع العائلة','يفاجأ الناس دائما', 'لا تدع أصدقاءه' );
$texte1 = array('{؟ user_name؟} ترى الفرص في جميع المشاكل التي يواجهها. إنه متقن جدًا ويمكنه أن يبرز نفسه في المستقبل.',
'\"{؟ user_name؟} موجود دائمًا لأصدقائه ، إنه يفهم أهمية الدعم والحب الذي يمتلكه ، لديه قلب من الذهب\"',
'\"{؟ user_name؟} أحب وأحب ، لكنه لم يفقد الشغف والفرح الذي يميزه\".',
'\"{؟ user_name؟} دائما لديه الحل لجميع المشاكل ، وتفاؤلها وحكمتها لا يعلى عليهما.\"');
   }
            else{ 
           $texte = array('مخلص للغاية','يجعل طلقة واحدة تلو الأخرى','أحب أن الحفلة!','ابتسم حتى عندما تريد البكاء','مظالم الكراهية','دائما وقت لقضاء مع العائلة','يفاجأ الناس دائما', 'لا تدع أصدقاءه' );
$texte1 = array('{؟ user_name؟} ترى الفرص في كل مشكلة تواجهها. إنها متعمقة للغاية ويمكن أن تبرز نفسها في المستقبل.',
'"{؟ user_name؟} لا يزال هناك لأصدقائه. إنها تدرك أهمية الدعم والحب لهم. لديها قلب من ذهب"',
'\"{؟ user_name؟} محبوب وخاسر ، لكنها لم تفقد أي من العاطفة والفرحة التي تميزها\".',
'\"{؟ user_name؟} دائما لديه الحل لجميع المشاكل ، وتفاؤلها وحكمتها لا يعلى عليهما.\"');
  
            }
        
shuffle($texte);shuffle($texte1);
?>
<div id="titre"></div>
<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user">
<div class="name texte" id="name_user" ><?php echo $_GET['user_name']; ?> :</div>
<div class="" id="resultat1" ><div>- <?php echo $texte[0]; ?></div><div>- <?php echo $texte[1]; ?></div><div>- <?php echo $texte[2]; ?></div></div>
<div id="titre_bottom"><?php echo $texte1[0]; ?></div>

        </div>
        
        </body>
        </html>
      