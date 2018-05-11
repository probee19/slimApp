
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Kalam" rel="stylesheet">
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
              .main{ padding:0;margin:0;width: 796px;height:416px; border:2px solid #021363;position: relative;overflow: hidden; background: #3498db;}
.main img{ position:absolute; max-height:420px; max-width:800px; }

#fb_id_user{position: absolute; z-index:1; left: 300px; top: 110px; width:200px ; border:2px solid #021363; border-radius:200px; max-width:800px; max-height:420px;}
#name_user{position:absolute; z-index:1; background:#021363; width:300px; left: 250px; border-radius:20px 20px 0 0; text-align:center; bottom: 0; margin:0 auto; font-size:25px; color:#FFF;} 

.line{z-index:0;width:100%; height:2px; background:#FFF; }
#line1{position:absolute; top:130px;}
#line2{position:absolute; bottom:130px;}
#line3{position:absolute; width:2px; height:100%; top:0; left:399px; margin:0;}
.qualite{font-family: 'Kalam', cursive; color:#FFF; font-size:33px; line-height:33px;width:300px ; height:140px ;  background:transparent; border:0; border-radius:0px;  padding:5px; display: flex; justify-content:center; align-items: center; /* align vertical */flex-wrap: wrap;text-align:center;}
#qualite1{z-index:2; margin:auto 0;position: absolute; left: 0px; top: 0px;  }
#qualite2{z-index:2; position: absolute; right: 0px; top: 0px;   }
#qualite3{z-index:2; position: absolute; left: 0px; top: 140px;  }
#qualite4{z-index:2; position: absolute; right: 0px; top: 140px;  }
#qualite5{z-index:2; position: absolute; left: 0px; bottom: 0px; }
#qualite6{z-index:2; position: absolute; right: 0px; bottom: 0px;  }
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
      
<!DOCTYPE HTML>
<?php
          if( $_GET['user_gender'] == 'homme' || $_GET['user_gender'] == 'male' || $_GET['user_gender'] == 'masculin' )
                    $qualite =array('He is not afraid of challenges', 'He has a heart of gold', 'He is patient', 'He never gives up', 'He has the most beautiful smiles', 'He is humble', 'He is nice', 'He loves his family', 'He is always present for his loved ones','He is a dreamer'  );
          else  
                    $qualite =array('She is not afraid of challenges', 'She has a heart of gold', 'She is patient', 'She never gives up', 'She has the most beautiful smiles', 'She is humble', 'She&#39;s nice', 'She loves her family', 'She is always present for her loved ones','She&#39;s a dreamer'  );
         
          
          shuffle($qualite);
?>
<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user">
<div class="name texte" id="name_user" ><?php echo $_GET['user_name']; ?></div>

<hr class="line" id="line1" />
<hr class="line" id="line2" />
<hr class="line" id="line3" />

<div class="qualite" id="qualite1"> <span><?php echo $qualite[0]?><span> </div>
<div class="qualite" id="qualite2"> <span><?php echo $qualite[1]?><span> </div>
<div class="qualite" id="qualite3"> <span><?php echo $qualite[2]?><span> </div>
<div class="qualite" id="qualite4"> <span><?php echo $qualite[3]?><span> </div>
<div class="qualite" id="qualite5"> <span><?php echo $qualite[4]?><span> </div>
<div class="qualite" id="qualite6"> <span><?php echo $qualite[5]?><span> </div>


        </div>
        
        </body>
        </html>
      