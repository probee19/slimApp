
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Paytone+One" rel="stylesheet">
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
#background{position:absolute; z-index:2; right:0; top:0;  width:500px; height:420px; background:#177DE1;}
#ilsdisent{position:absolute; z-index:2; right:0; top:40px; width:500px; height:40px;color:#FBFF08; text-align:center; font-size:40px;}
#fb_id_user{position: absolute; z-index:1; left: -100px; top: 0px; width:420px ; border-radius:0px; max-width:800px; max-height:420px;}
#message{position:absolute; z-index:2; right:25px; top:20px; width:450px; height:400px; font-size:50px; line-height:50px;font-family: 'Paytone One', sans-serif; text-align:center;color:#FBFF08;display: flex;
justify-content: center; /* align horizontal */
align-items: center; /* align vertical */ }
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
               $message = array('Che smetti di bere','che hai un sacco di soldi','che hai un sacco di soldimais sans avoir comment ','che mangi molto ma non ingrassi','che sei bella, donnaiolo e ubriaca',
'che cambi spesso le ragazze','che quelli che ti conoscono non ti dimenticano','che hai baciato un sacco di ragazze','che ti piace avere diverse amiche');          }
            else{ 
               $message = array('che hai un sacco di soldi','che mangi molto ma non ingrassi','che hai un sacco di soldimais sans avoir comment ','che hai fatto un intervento di chirurgia estetica perché sei super bella',
'che ti piacciono le cose raffinate','che quelli che ti conoscono non ti dimenticano');
            }

shuffle($message);
?>
<div id="background"></div> 
<div id="ilsdisent">dicono :</div> 
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
<div id="message"> <?php echo $message[0]; ?>
</div>



        </div>
        
        </body>
        </html>
      