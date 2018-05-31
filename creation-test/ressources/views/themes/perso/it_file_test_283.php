
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Bellefair" rel="stylesheet">
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
              .main{ padding:0;margin:0;width: 800px;height:420px;position: relative;overflow: hidden; background: #0D47A1;}
.main img{ position:absolute; max-height:420px; max-width:800px; }

#sis_1,#sis_2,#sis_1_{z-index:1;font-family: 'Bellefair', serif; position: absolute; color:#FFF;  width:800px ;  display:flex; justify-content:center; text-align:center; max-width:800px; max-height:420px;}
#sis_1{left: 0px; top: 0px;font-size:90px;line-height:100px; height:160px ; align-items:flex-end;  }
#sis_1_{left: 0px; top: 160px;font-size:100px;line-height:90px; height:90px ; align-items:flex-end;  }
#sis_2{left: 0px; top: 250px;font-size:50px;line-height:60px; height:150px ; padding-top:20px; }
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
          if( $_GET['user_gender'] == 'homme' || $_GET['user_gender'] == 'male' || $_GET['user_gender'] == 'masculin' )
                   $sis = array('Trattenerlo, devi sposarlo.','Non lasciarlo andare, è gentile.','Resisti, è protettivo.','Ricorda, è un marito perfetto.'
                    ,'Resisti, lui è fedele.','Resisti, è galante. ');
          else
                   $sis = array('Non lasciarla andare, devi sposarla.','Trattenili, è gentile.','Non lasciarla andare, è una moglie perfetta.'
                    ,'Ricorda, lei è fedele e leale.','Trattenerlo, diventerà una buona madre.');
          shuffle($sis);
?>

<div class="texte" id="sis_1"> Se il suo nome è </div>
<div class="texte" id="sis_1_">  <?php echo $_GET['user_name']; ?> </div>
<div class="texte" id="sis_2"> <?php echo  $sis[0]; ?> </div>


        </div>
        
        </body>
        </html>
      