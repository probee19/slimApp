
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
 
.flag_team{z-index:1; position: absolute;  top:180px; font-size:70px; width:80px ; height:40px ; text-align:center;   }
#flag_tema_a{left: 265px;}

#flag_tema_b{right: 265px;}
.team_name{z-index:1; font-family: 'Titillium Web', sans-serif;position: absolute; top: 142px; color:#FFF; font-size:35px; line-height:35px; width:260px ; height:110px; display:flex; align-items:center; }
#team_a{ left: 0;  justify-content:flex-end ;}
#team_b{ right: 0;  justify-content:left;}
#hour{z-index:1; font-family: 'Titillium Web', sans-serif; position: absolute; top: 145px; color:#FFF; font-size:25px; line-height:25px; width:800px ; height:110px; display:flex; align-items:center;justify-content:center; }

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

<img src="https://creation.funizi.com/images-theme-perso/1528387221.jpg" id="back">   

<div class="texte team_name" id="team_a"><?php echo $_GET['team_a']; ?></div>
  
<img src="https://s3.us-east-2.amazonaws.com/funiziuploads/api/flags/<?php echo $_GET['team_a_flag']; ?>.png" id="flag_tema_a" class="flag_team"> 
 
<div class="texte " id="hour"> <?php echo $_GET['time']; ?> </div>

<img src="https://s3.us-east-2.amazonaws.com/funiziuploads/api/flags/<?php echo $_GET['team_b_flag']; ?>.png" id="flag_tema_b" class="flag_team">

<div class="texte team_name" id="team_b"><?php echo $_GET['team_b']; ?></div>

        </div>
        
        </body>
        </html>
      