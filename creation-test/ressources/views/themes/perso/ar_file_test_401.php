
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
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

#fb_id_user{position: absolute; z-index:1; left: 0; bottom: 0; width:400px ;  height:400px ; object-fit: cover; object-position: 50% 10%; }
 
#user{z-index:2; font-family: 'Titillium Web', sans-serif; text-transform:uppercase; position: absolute; left: 0; top: 0; color:#FFF; font-size:30px; width:400px ; height:50px ; background:#F45B49;  text-align:center; display:flex; align-items:center; justify-content:center;  }

#personnage{z-index:2; font-family: 'Titillium Web', sans-serif; text-transform:uppercase; position: absolute; right: 0; top: 0; color:#FFF; font-size:30px; width:400px ; height:50px ; background:#FB3522;  text-align:center; display:flex; align-items:center; justify-content:center;  }
 
#perso{position:absolute; z-index:1; right:0; bottom:0;  width:400px; height:370px; }
              </style>
              <script src='https://code.jquery.com/jquery-1.12.0.min.js'></script>
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
 if( $_GET['user_gender'] == 'homme' || $_GET['user_gender'] == 'male' || $_GET['user_gender'] == 'masculin' ){
          $personnages = array('Junior','Modibo','Daddy Guèye','Mangane','Barro','Bathie');
          $image = array('1534247150','1534247254','1534247271','1534247288','1534247311','1534247327');
          $ind = mt_rand(0,5);
 }
 else{
         $personnages = array('Adji Soda','Adji Mbarka','Miss Guèye','Laliyah');
          $image = array('1534247402','1534247494','1534247511','1534247771');
          $ind = mt_rand(0,3);
 }
                    
           
?>
<!DOCTYPE HTML>

<div class="texte" id="user"><?php echo $_GET['user_name']; ?> </div>
<div class="texte" id="personnage"> <?=$personnages[$ind]?> </div>
<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user"> 
<img src="https://creation.funizi.com/images-theme-perso/<?=$image[$ind]?>.jpg" id="perso"> 
 

        </div>
        
        </body>
        </html>
      