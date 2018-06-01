
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
            #certificat{position:absolute;z-index:1; width:800px; text-align:center; top:40px; font-size:60px; color:#BD0000; }
            #name{position:absolute;z-index:1; width:250px; text-align:right;left:0px; top:130px; font-size:45px; color:#BD0000; }
            #name_reponse{position:absolute;z-index:1; width:500px; text-align:left;left:260px; top:125px; font-size:45px; color:#000; }
            #diagnostic{position:absolute;z-index:1; width:250px; text-align:right;left:0px; top:185px; font-size:45px; color:#BD0000; }
            #diagnostic_reponse{position:absolute;z-index:1; width:500px; text-align:left;left:260px; top:181px; font-size:45px; color:#000; }
            #niveau{position:absolute;z-index:1; width:250px; text-align:right;left:0px; top:250px; font-size:45px; color:#BD0000; }
            #niveau_reponse{position:absolute;z-index:1; width:500px; text-align:left;left:260px; top:245px; font-size:45px; color:#000; }
            #docteur{position:absolute;z-index:1; width:800px; text-align:center; bottom:40px; font-size:50px; color:#000; }
        
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
                  // JAVASCRIPT

                  });
              </script>
          </head>
          <body style='width: 800px; height:420px; margin:0; padding:0; overflow: hidden;'>
          <div class='main'>
      
            <!DOCTYPE HTML> <?php $diagnostic = array('Contagious humor','Advanced kindness','Acute loyalty','Viral optimism','Incurable sensuality');
            $niveau = array('Serious','Alarming','Highly contagious');
            shuffle($diagnostic); shuffle($niveau); ?>
            <img src="http://creation.funizi.com/images-theme-perso/1508420459.jpg" id="background">
            <div id="certificat">Medical certificate</div> <div id="name">Name:</div>
            <div id="name_reponse"> <?php echo urldecode($_GET['user_name']); ?></div> <div id="diagnostic">Diagnostic :</div>
            <div id="diagnostic_reponse"><?php echo $diagnostic[0]; ?></div> <div id="niveau">Level:</div>
            <div id="niveau_reponse"><?php echo $niveau[0]; ?></div> <div id="docteur">Dr <?php echo urldecode($_GET['friend_name_1']); ?></div>
        

        </div>
        
        </body>
        </html>
      