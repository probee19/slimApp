
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
        #name_user{position:absolute; z-index:1; left: 0px; top: 310px; font-size:45px; color:#FFF; font-weight:bold; width:800px; text-align:center;}
         #name_user span{background:#FFF; color:#000; padding:10px;}
        #but{position:absolute; z-index:1; left: 0px; top: 260px; font-size:20px; color:#FFF; width:800px; text-align:center; font-weight:bold;}
        #minute{position:absolute; z-index:1; left: 0px; top: 380px; font-size:20px; color:#FFF; width:800px; text-align:center; font-weight:bold;}

        
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
                  

                  });
              </script>
          </head>
          <body style='width: 800px; height:420px; margin:0; padding:0; overflow: hidden;'>
          <div class='main'>
      

        <?php
        $expression = array("Premier","Deuxième","Troisième");
        shuffle($expression);
        ?>
        <img src="http://creation.funizi.com/images-theme-perso/1508522215.jpg" id="background">
        <div id="but" ><?php echo $expression[0]; ?> but du match marqué par </div>
        <div class="name texte" id="name_user" ><?php echo $_GET['user_name']; ?></div>
        <div id="minute" > à la <?php echo rand(5,88); ?>ie minute </div>


        

        </div>
        
        </body>
        </html>
      