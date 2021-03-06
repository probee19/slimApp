
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Courgette|Montserrat:400,800" rel="stylesheet">
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
.main img{ position:absolute; max-height:420px; max-width:800px; object-fit: cover; object-position: 50% 10%;  }

#back_t{position:absolute; z-index:1; left:0; top:0;  max-width:800px; max-height:420px; }

#header_t{font-family: 'Montserrat', sans-serif; z-index:1; position: absolute; left: 180px; top: 55px; color:#B71C1C; font-size:30px; display:flex; align-items:center; justify-content:center; width:450px ; height:50px ; text-transform:uppercase;}
#header_t_2{font-family: 'Courgette', cursive; z-index:1; position: absolute; left: 180px; top: 100px; color:#000; font-size:20px; display:flex; align-items:center; justify-content:center; width:450px ; height:50px ;  }
#name_user{position:absolute; z-index:1; left: 180px; top: 155px; font-size:30px; color:#000; width:450px ; height:40px ; text-align:center; border-bottom:2px solid;} 
#pour{font-family: 'Montserrat', sans-serif; z-index:1; position: absolute; left: 80px; top: 200px; color:#B71C1C; font-size:20px; display:flex; align-items:center; justify-content:center; width:650px ; height:50px ; text-transform:uppercase; }
#en{font-family: 'Courgette', cursive; z-index:1; position: absolute; left: 80px; top: 240px; color:#66BB6A; font-size:24px; line-height:24px; display:flex; align-items:center; justify-content:center; text-align:center; width:650px ; height:50px ;  }
#deliv{font-family: 'Courgette', cursive; z-index:1; position: absolute; left: 80px; top: 285px; color:#000; font-size:20px; display:flex; align-items:center; justify-content:center; text-align:center; width:650px ; height:50px ;  }

#friend_1, #friend_2, #friend_3 {font-family: 'Courgette', cursive; z-index:1; position: absolute; bottom: 55px; text-decoration:underline; color:#000; font-size:20px;line-height:32px; display:flex; align-items:center; justify-content:center; text-align:center; width:225px ; height:35px ;  }
#friend_1{left: 60px; }
#friend_2{left: 287px; }
#friend_3{right: 60px; }

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
      
<?php
          $pour = array('for his excellent bodyguard services','for his acting skills','for the baths he gives to the lions','for his comic talent');
          $en = array('in recognition of his support and protection at all times','in recognition of his personality that makes the world a little less boring','in recognition of the baths that he manages to give to the lions without any accident','in recognition of his humor that gives the smile to everyone');
          $ind = mt_rand(0,3);
?>
<!DOCTYPE HTML>

<img src="https://creation.funizi.com/images-theme-perso/1521734435.jpg" id="back_t"> 

<div class="texte" id="header_t"> Success certificate </div>

<div class="texte" id="header_t_2"> proudly issued to </div>

<div class="name texte" id="name_user" ><?php echo urldecode($_GET['full_user_name']); ?></div>

<div class="texte" id="pour" ><?=$pour[$ind];?></div>

<div class="texte" id="en" ><?=$en[$ind];?></div>

<div class="texte" id="deliv" >Recognition issued and recognized by:</div>

<div class="name texte" id="friend_1" > <?php echo urldecode($_GET['friend_name_1']); ?> </div>
<div class="name texte" id="friend_2" > <?php echo urldecode($_GET['friend_name_2']); ?> </div>
<div class="name texte" id="friend_3" > <?php echo urldecode($_GET['friend_name_3']); ?> </div>



        </div>
        
        </body>
        </html>
      