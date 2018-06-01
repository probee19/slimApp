
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
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
              .main{ padding:0;margin:0;width: 798px;height:418px;position: relative;overflow: hidden; background: #FFF; border:1px solid #000;}
.main img{ position:absolute; max-height:420px; max-width:800px; }
#profile_img{position: absolute; z-index:1; left:35px; top: 35px; border:1px solid #000; width:200px; height:350px; overflow: hidden;}
#fb_id_user{left: 50%; top: 50%; height: 100%; width: auto; -webkit-transform: translate(-50%,-50%); -ms-transform: translate(-50%,-50%); transform: translate(-50%,-50%);}
.texte{position:absolute; z-index:1; text-align:center;font-family: 'Kaushan Script', cursive;}
#texte1{right: 35px; top: 35px;  width:500px; height:100px; font-size:40px; line-height:45px; color:#283593;} 
#texte2{right: 35px; top: 145px; width:500px; height:70px; font-size:70px; line-height:75px; color:#D32F2F;} 
#texte3{right: 35px; top: 235px; width:500px; height:50px; font-size:35px; line-height:45px; color:#283593;} 
#texte4{right: 85px; text-transform:uppercase; bottom: 35px; width:400px; height:70px; background:#B71C1C; font-size:40px; line-height:60px; color:#FFF;} 
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
          $causes = array('sein großes Herz','ihre Schönheit','sein Franchise','seine Eleganz','seine Bescheidenheit','sein Humor','sein Mut','seine Tapferkeit','seine Ehrlichkeit');
          shuffle($causes);
?>
<div id="profile_img">
          <img src="<?php echo urldecode($_GET['url_img_profile_user']); ?>" class="img_profile" id="fb_id_user">
</div>
<div class="texte" id="texte1" ><span style="color:#B71C1C;"><?php echo urldecode($_GET['friend_first_name_1']); ?></span> Darüber nachgedacht <?php echo urldecode($_GET['user_name']); ?> </div>
<div class="texte" id="texte2"><?php echo mt_rand(102,450); ?> ZEIT</div>
<div class="texte" id="texte3">dieses Jahr wegen </div> 
<div class="texte" id="texte4"><?php echo $causes[0]; ?></div> 


        </div>
        
        </body>
        </html>
      