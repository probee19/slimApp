
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
                          .main{ padding:0;margin:0;width: 800px;height:420px;position: relative;overflow: hidden; background: #FFF;}
            .main img{ position:absolute; max-height:420px; max-width:800px; }
            #background{position:absolute; z-index:1; left:0; top:0;  max-width:800px; max-height:420px; }
            #name_user{position:absolute; z-index:1; left: 0px; top: 190px; font-size:20px; text-align:center; width:800px;}
            #recherche{position:absolute; z-index:1; left: 0px; top: 250px; font-size:15px; text-align:center; width:800px;font-weight:bold;}
            #nombre_recherche{position:absolute; z-index:1; left: 0px; top: 285px; font-size:60px; text-align:center; width:800px; color:#E8453C; font-weight:bold;}
            #commentaire_recherche{position:absolute; z-index:1; left: 0px; top: 370px; font-size:20px; text-align:center; width:800px;font-weight:bold;}
        
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
      
<!DOCTYPE HTML>

<img src="http://creation.funizi.com/images-theme-perso/1508438185.jpg" id="background"> 
<div class="name texte" id="name_user" ><?php echo $_GET['full_user_name']; ?></div>
<div id="recherche" >تم البحث ...</div>
<div id="nombre_recherche" ><?php echo number_format(rand(30000,500000), 0, ',', ' '); ?> fois !</div>
<div id="commentaire_recherche" >كنت المشاهير الحقيقي!</div>


        </div>
        
        </body>
        </html>
      