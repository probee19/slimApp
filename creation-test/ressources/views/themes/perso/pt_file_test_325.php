
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
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
.bulletin{position:absolute; left:0; top:0; width:800px; height:420px; display:flex; justify-content:center; align-items:center; }
table{width:750px;font-family: 'Oswald', sans-serif; }
table, th, td { border: 2px solid #000;  border-collapse: collapse;  }
th, td { padding: 5px; font-size:17px; }
.center{text-align:center;}
caption{font-weight:800; font-size:24px; }
.general{font-weight:800; font-size:18px; }

#tamp{position:absolute; z-index:1; right:25px; bottom:15px;  }
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
          $appreciations = array('5'=> 'O curso está indo bem na sua ausência','6'=>'Ele sente falta desse travesseiro na aula.','7'=>'A janela não é mais interessante que a mesa.',
          '8'=>'A sala de aula não é uma recriação','9'=>'A sala de aula não é um anel','10'=>'Justo','11'=>'Justo','12'=>'Pode fazer melhor',
          '13'=>'Continue','14'=>'Trabalho satisfatório','15'=>'Quando queremos, podemos','16'=>'Continue seus esforços');
          $note1 = mt_rand(5,16); $note2 = mt_rand(5,16); $note3 = mt_rand(5,16); $note4 = mt_rand(5,16); $note5 = mt_rand(5,16); $note6 = mt_rand(5,16);
          $moyenne = ($note1 +$note2 +$note3 +$note4 +$note5 +$note6 )/6;
          $ind = mt_rand(0,3);
?>
<!DOCTYPE HTML>
<div class="bulletin">
<table>
  <caption>2018 Boletim Escolar <?php echo urldecode($_GET['full_user_name']); ?></caption>
  <tr>
    <th width="150px">conteúdo</th>
    <th width="110px">Média do aluno</th>
    <th width="120px">Class avg</th>
    <th width="300px">Gostos</th>
  </tr>
  <tr>
    <td>francês</td>
    <td class="center"><?=$note1?></td>
    <td class="center"><?=mt_rand(8,14)?></td>
    <td><?=$appreciations[$note1]?></td>
  </tr>
  <tr>
    <td>Inglês</td>
    <td class="center"><?=$note2?></td>
    <td class="center"><?=mt_rand(8,14)?></td>
    <td><?=$appreciations[$note2]?></td>
  </tr>
  <tr>
    <td>Mathématques</td>
    <td class="center"><?=$note3?></td>
    <td class="center"><?=mt_rand(8,14)?></td>
    <td><?=$appreciations[$note3]?></td>
  </tr>
  <tr>
    <td>Geografia da história</td>
    <td class="center"><?=$note4?></td>
    <td class="center"><?=mt_rand(8,14)?></td>
    <td><?=$appreciations[$note4]?></td>
  </tr>
  <tr>
    <td>Física Química</td>
    <td class="center"><?=$note5?></td>
    <td class="center"><?=mt_rand(8,14)?></td>
    <td><?=$appreciations[$note5]?></td>
  </tr>
  <tr>
    <td>EPS</td>
    <td class="center"><?=$note6?></td>
    <td class="center"><?=mt_rand(8,14)?></td>
    <td><?=$appreciations[$note6]?></td>
  </tr>
  
  <tr class="general">
    <td class="general">Média geral</td>
    <td class="center general"><?=round($moyenne,2)?></td>
  </tr>
</table>
</div>

<img src="https://creation.funizi.com/images-theme-perso/1524228433.png" id="tamp"> 


        </div>
        
        </body>
        </html>
      