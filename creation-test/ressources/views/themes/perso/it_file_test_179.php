
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Saira+Semi+Condensed" rel="stylesheet">
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
#texte_top{z-index:1; position: absolute; text-transform:uppercase; font-weight:600; left: 0px; top: 0px; color:#FFF; font-size:30px; line-height:35px; width:800px ; background:#C70039;  padding:15px; text-align:center; max-width:800px; max-height:420px;}

#fb_id_friend_1{position: absolute; z-index:1; border:4px solid; left: 20px; top: 150px; width:250px ; border-radius:30px; max-width:800px; max-height:420px;}
#phrase_1{z-index:1; font-family: 'Saira Semi Condensed', sans-serif; position: absolute; left: 0px; top: 65px; color:#000; font-size:40px; line-height:45px; width:800px ; background:#FFC300; border:0; border-radius:0px;  padding:5px; text-align:center; max-width:800px; max-height:420px;}

#fb_id_user{position: absolute; z-index:1; right: 210px; bottom: 30px; width:110px ; border:4px #C70039 solid; border-radius:110px; max-width:800px; max-height:420px;}
#motif{z-index:1; font-family: 'Saira Semi Condensed', sans-serif; position: absolute; right: 20px; top: 150px; color:#000; font-size:35px; line-height:40px; width:480px ; background:transparent; border-radius:0px;  padding:5px; text-align:center; max-width:800px; max-height:420px;}
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
$motifs = array('voleva sfondare i misteri della bellezza di '.$_GET['user_name'].' ','ha rivelato troppi segreti per '.$_GET['user_name'].' ','Gelosia verso l&#39;eleganza di '.$_GET['user_name'].'  ','Gelosia verso la popolarità di '.$_GET['user_name'].' ','Gelosia verso la bellezza di '.$_GET['user_name'].' ','Gelosia verso il carisma di '.$_GET['user_name'].' ');
shuffle($motifs);

?>
<div class="texte" id="texte_top">Manifesto da ricercato </div>
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_friend_1']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_friend_1">
<div class="name texte" id="name_friend_1" ></div>
<div class="texte" id="phrase_1"> <?php echo $_GET['friend_first_name_1']; ?> rimosso <?php echo $_GET['user_name']; ?> </div>
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
<div class="texte" id="motif"> Ragionare: <?php echo $motifs[0]; ?> </div>


        </div>
        
        </body>
        </html>
      