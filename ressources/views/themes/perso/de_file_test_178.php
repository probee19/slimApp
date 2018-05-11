
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              
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
                          #theme-perso{position: relative; width: 800px; height: 420px; overflow:hidden;}
            #theme-perso img{position:absolute; max-height:420px; max-width:800px; }
            #background{z-index:1; left:0; top:0;  max-width:800px; max-height:420px; }
            #certificat{position:absolute;z-index:1; width:800px; text-align:center; top:40px; font-size:60px; color:#0059B2; }
            #name{position:absolute;z-index:1; width:250px; text-align:right;left:0px; top:130px; font-size:45px; color:#0059B2; }
            #name_reponse{position:absolute;z-index:1; width:500px; text-align:left;left:260px; top:125px; font-size:45px; color:#000; }
            #diagnostic{position:absolute;z-index:1; width:250px; text-align:right;left:0px; top:185px; font-size:45px; color:#0059B2; }
            #diagnostic_reponse{position:absolute;z-index:1; width:500px; text-align:left;left:260px; top:181px; font-size:45px; color:#000; }
            #niveau{position:absolute;z-index:1; width:800px; text-align:right;left:0px; top:260px; font-size:35px; color:#0059B2; text-align:center; }
            #niveau_reponse{position:absolute;z-index:1; width:800px; text-align:left;left:0; top:300px; font-size:25px; color:#000; text-align:center; }
            #docteur{position:absolute;z-index:1; width:800px; text-align:right; right:180px; bottom:20px; font-size:40px; color:#000; }
        
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
               $message_1 = array('Zu ehrlich','Zu aufrichtig','Zu sexy','Herzensbrecher','Zu offenherzig');
            $message_2 = array('Gefährlich, weil es Dinge sagt, wie sie sind.','Gefährlich für diejenigen, die die Wahrheit nicht sehen wollen','Envied von Männern 18 bis 35 Jahre alt'
            ,'Gefährlich für Frauen zwischen 18 und 26 Jahren','Gefährlich für Leute, die das Franchise nicht unterstützen'); }
            else{ 
                 $message_1 = array('Trop honnête','Zu aufrichtig','Zu sexy','Herzensbrecher','Zu offenherzig');
            $message_2 = array('Gefährlich, weil es Dinge sagt, wie sie sind.','Gefährlich für diejenigen, die die Wahrheit nicht sehen wollen','Umgeben von Frauen im Alter von 18 bis 35'
            ,'Gefährlich für Frauen im Alter von 25 bis 45 Jahren','Gefährlich für Leute, die das Franchise nicht unterstützen');
          
            }
            $max_key = 3; $key = mt_rand(0,$max_key);
            ?>
            <img src="http://creation.funizi.com/images-theme-perso/1508976353.jpg" id="background">
            <div id="certificat">Vorstrafenregister</div> <div id="name">Name:</div>
            <div id="name_reponse"> <?php echo $_GET['full_user_name']; ?></div> <div id="diagnostic">Kriminalität:</div>
            <div id="diagnostic_reponse"><?php echo $message_1[$key]; ?></div> <div id="niveau">In diesem Dokument wird bestätigt, dass <?php echo $_GET['user_name']; ?> Folgendes ist:</div>
            <div id="niveau_reponse"><?php echo $message_2[$key]; ?></div> <div id="docteur"><?php echo $_GET['friend_name_1']; ?></div>
        

        </div>
        
        </body>
        </html>
      