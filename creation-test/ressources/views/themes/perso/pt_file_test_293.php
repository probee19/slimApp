
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
#fb_id_user{position: absolute; z-index:1; right: 50px; top: 60px; width:300px ; border-radius:300px; border: 3px solid #333; max-width:800px; max-height:420px;}
#name_user{position:absolute; z-index:1; left: 0px; top: 100px; font-size:45px; color:#EE1716; width:400px; text-align:center;font-family: 'Roboto Condensed', sans-serif;} 
#fidele{position:absolute; z-index:1; left: 0px; top: 160px; font-size:40px; color:#355BA5; width:400px; text-align:center;font-family: 'Roboto Condensed', sans-serif;} 
#fidele1{position:absolute; z-index:1; left: 0px; top: 310px; font-size:40px;color:#355BA5; width:400px; text-align:center;font-family: 'Roboto Condensed', sans-serif;} 
#pourcentage{position:absolute; z-index:1; left: 0px; top: 210px; font-size:60px;color:#FFF; background:#EE1716; padding-top:15px; padding-bottom:15px; width:400px; padding-top:10px; padding-bottom:10px; text-align:center;font-family: 'Roboto Condensed', sans-serif;} 
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
// set variables
$queryUrl = "http://api.kairos.com/detect";

//$imageObject = '{"image":"http://everythinggirlslove.com/wp-content/uploads/2016/01/cheating-1-EDITED.jpg"}';
$imageObject = '{"image":"https://graph.facebook.com/'.$_GET['fb_id_user'].'/picture/?width=275&height=275"}';
$APP_ID = "abda1dad";
$APP_KEY = "c9d2a4822805c1a7d664a8feb9905367";
$request = curl_init($queryUrl);
// set curl options
curl_setopt($request, CURLOPT_POST, true);
curl_setopt($request,CURLOPT_POSTFIELDS, $imageObject);
curl_setopt($request, CURLOPT_HTTPHEADER, array(
        "Content-type: application/json",
        "app_id:" . $APP_ID,
        "app_key:" . $APP_KEY
    )
);
curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($request);
// show the API response
//echo $response;

$my_array_data = json_decode($response, TRUE);
$face_analyse=1;
if (isset($my_array_data["Errors"][0]["ErrCode"])) $face_analyse=0;
//echo $face_analyse;
//var_dump($my_array_data);
$image = $my_array_data['images'][0];
$face_attr = $image['faces'][0]['attributes'];
$gender = ($face_attr['gender']['type'] == 'F' ? 'female' : 'male');
//echo "****".$face_attr['gender']['type'].'---age:'.$face_attr['age'];

$ethnicities = ['asian', 'hispanic', 'black', 'white', 'other'];
	$eth_arr = [];
	foreach ($ethnicities as $from) {
		$eth_arr[] = round($face_attr[$from] * 100).'% '.ucwords($from);
	}
	sort($eth_arr, SORT_NATURAL);
	$eth_str = implode(', ', array_reverse($eth_arr));
	//print sprintf("- Image URL: %s\n", $image_url);
	//print sprintf("- Detected as '%s' with %s years of age.\n", $gender, $face_attr['age']);
	//print sprintf("- Ethnicity matching: %s\n", $eth_str);

// close the session
curl_close($request);
 
if ($face_analyse) $age=$face_attr['age']; else $age=mt_rand(23,43);
?>
<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
<div class="name texte" id="name_user" ><?php echo $_GET['user_name']; ?></div>
<div id="fidele" >Você tem</div>
<div id="pourcentage" ><?php echo $age ?> ans</div>
<div id="fidele1" >de acordo com sua cara</div>


        </div>
        
        </body>
        </html>
      