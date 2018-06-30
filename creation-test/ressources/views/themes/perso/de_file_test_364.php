
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

#back{position:absolute; z-index:1; left:0; top:0;  max-width:800px; max-height:420px; }

#maillot{position:absolute; z-index:1; right:30px; bottom:-20px;  max-width:800px; height:380px; }

.flag_team{z-index:1; position: absolute; left:200px; top:250px;   text-align:center; width:150px;   }

#fb_id_user{position: absolute; z-index:1; left: 100px; top: 110px; width:200px ;  height:200px ; object-fit: cover; object-position: 50% 10%; border-radius:200px;border:10px solid #f1c40f;}
#name_user{position:absolute;font-family: 'Titillium Web', sans-serif; text-transform:uppercase;z-index:1; right:130px; top: 150px; font-size:22px;line-height:23px; color:#FFF; width:180px; height:60px; text-align:center;} 
#number{position:absolute;font-family: 'Titillium Web', sans-serif; z-index:1; right:150px; top: 210px; font-size:120px; line-height:100px; color:#FFF; width:140px; height:160px; display:flex; align-items:flex-start; justify-content:center; text-align:center;}

#tag{z-index:1; position: absolute;font-family: 'Titillium Web', sans-serif; font-style:italic; right: 120px; bottom: 7px; color:#fff; font-size:22px; width:200px ; height:50px ;  text-align:center; }

#message{z-index:1; position: absolute;font-family: 'Titillium Web', sans-serif; text-transform:uppercase; right: 0; top: 0; color:#000;  background-color:#f1c40f; font-size:30px; font-weight:700; display:flex; align-items:center; justify-content:center; width:800px ; height:60px ; text-align:center; }




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
      
<!DOCTYPE HTML>
<?php
          $messages = array('Merci Gaïndé !','Merci aux lions de la téranga.','Mbarawacc gaindé ndiaye. On est fier de vous !', 'Démoon na bay nekh. Merci Gaïndé !');
          shuffle($messages);
?>
<img src="https://creation.funizi.com/images-theme-perso/1529414005.jpg" id="back"> 
 
<img src="https://creation.funizi.com/images-theme-perso/1529412281.png" id="maillot"> 
 
<div class="texte" id="message"> <?=$messages[0]?>  </div>
 
<img src="<?php echo $_GET['url_img_profile_user']; ?>" class="img_profile" id="fb_id_user">
<div class="name texte" id="name_user" ><?php echo $_GET['user_name']; ?></div>
<div class="texte" id="number" ><?=mt_rand(5,11);?></div>
 
<img src="https://s3.us-east-2.amazonaws.com/funiziuploads/api/flags_big/sen.png" id="" class="flag_team"> 


<div class="texte" id="tag">#funizi</div>


        </div>
        
        </body>
        </html>
      