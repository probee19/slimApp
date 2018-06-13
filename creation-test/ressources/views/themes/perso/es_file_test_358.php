
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
              .main{ padding:0;margin:0;width: 800px;height:420px;position: relative;overflow: hidden; background: #FFF; color:#FFF;}
.main img{ position:absolute; max-height:420px; max-width:800px; }

#back{position:absolute; z-index:1; left:0; top:0;  max-width:800px; max-height:420px; }
.games{  z-index:1; left:0; top:0;  width:800px; height:auto;    }
#box{position:absolute; z-index:1; left:0; top:0;  width:800px; height:420px; display:flex;align-items:center; }
.overlay{position:absolute; z-index:1; left:0; top:0;  width:800px; height:420px; background-color:#000; opacity:0.3;}
.game{position:relative; z-index:1; width:800px; height:85px;  display:flex; align-items:center;  }
.flag_team{z-index:1; position: absolute;   width:80px ; height:40px ; text-align:center;   }
.flag_tema_a{left: 265px;}

.flag_tema_b{right: 265px;}
.team_name{z-index:1; font-family: 'Titillium Web', sans-serif;position: absolute;   color:#FFF; font-size:35px; line-height:40px; width:260px ; height:30px; display:flex; align-items:center; }
.team_a{ left: 0;  justify-content:flex-end ;}
.team_b{ right: 0;  justify-content:left;}
.hour{z-index:1; font-family: 'Titillium Web', sans-serif; position: absolute;  color:#FFF; font-size:25px; line-height:25px; width:800px ; height:30px; display:flex; align-items:center;justify-content:center; }

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
<div class="overlay"></div>
<div id="box">
          <div id="" class="games"> 
                    <?php   
                     if(isset($_GET['a1'])) { 
                              ?> 
                              <div id="" class="game">
                                        <span class="texte team_name team_a" id=""><?php echo $_GET['a1']; ?></span>
                                        <img src="https://s3.us-east-2.amazonaws.com/funiziuploads/api/flags/<?php echo $_GET['cca1']; ?>.png" id="" class="flag_team flag_tema_a"> 
                                        <span class="texte hour" id=""> <?php echo $_GET['time1']; ?> </span>
                                        <img src="https://s3.us-east-2.amazonaws.com/funiziuploads/api/flags/<?php echo $_GET['ccb1']; ?>.png" id="" class="flag_team flag_tema_b">
                                        <span class="texte team_name team_b" id=""><?php echo $_GET['b1']; ?></span>
                              </div> 
                              <?php 
                     }
                     
                     if(isset($_GET['a2'])) { 
                              ?> 
                              <div id="" class="game">
                                        <span class="texte team_name team_a" id=""><?php echo $_GET['a2']; ?></span>
                                        <img src="https://s3.us-east-2.amazonaws.com/funiziuploads/api/flags/<?php echo $_GET['cca2']; ?>.png" id="" class="flag_team flag_tema_a"> 
                                        <span class="texte hour" id=""> <?php echo $_GET['time2']; ?> </span>
                                        <img src="https://s3.us-east-2.amazonaws.com/funiziuploads/api/flags/<?php echo $_GET['ccb2']; ?>.png" id="" class="flag_team flag_tema_b">
                                        <span class="texte team_name team_b" id=""><?php echo $_GET['b2']; ?></span>
                              </div> 
                              <?php 
                     }
                     
                     if(isset($_GET['a3'])) { 
                              ?> 
                              <div id="" class="game">
                                        <span class="texte team_name team_a" id=""><?php echo $_GET['a3']; ?></span>
                                        <img src="https://s3.us-east-2.amazonaws.com/funiziuploads/api/flags/<?php echo $_GET['cca3']; ?>.png" id="" class="flag_team flag_tema_a"> 
                                        <span class="texte hour" id=""> <?php echo $_GET['time3']; ?> </span>
                                        <img src="https://s3.us-east-2.amazonaws.com/funiziuploads/api/flags/<?php echo $_GET['ccb3']; ?>.png" id="" class="flag_team flag_tema_b">
                                        <span class="texte team_name team_b" id=""><?php echo $_GET['b3']; ?></span>
                              </div> 
                              <?php 
                     }
                     
                     if(isset($_GET['a4'])) { 
                              ?> 
                              <div id="" class="game">
                                        <span class="texte team_name team_a" id=""><?php echo $_GET['a4']; ?></span>
                                        <img src="https://s3.us-east-2.amazonaws.com/funiziuploads/api/flags/<?php echo $_GET['cca4']; ?>.png" id="" class="flag_team flag_tema_a"> 
                                        <span class="texte hour" id=""> <?php echo $_GET['time4']; ?> </span>
                                        <img src="https://s3.us-east-2.amazonaws.com/funiziuploads/api/flags/<?php echo $_GET['ccb4']; ?>.png" id="" class="flag_team flag_tema_b">
                                        <span class="texte team_name team_b" id=""><?php echo $_GET['b4']; ?></span>
                              </div> 
                              <?php 
                     }
                    ?> 
          </div>
</div>

        </div>
        
        </body>
        </html>
      