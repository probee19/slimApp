<style>.main{ padding:0;margin:0;width: 800px;height:420px;position: relative;overflow: hidden; background: #FFF;}
.main img{ position:absolute; max-height:420px; max-width:800px; }

#background{position:absolute; z-index:1; left:0; top:0;  width:800px;  }

#img{position:absolute; z-index:1; right:133px; top:150px; border-radius:200px; width:200px; height:200px; }

#fb_id_user{position: absolute; z-index:1; left: 133px; top: 150px; width:200px ; border-radius:200px; max-width:800px; max-height:420px;}
#surprise{position:absolute; z-index:1; left: 0px; top: 60px; width:800px; text-align:center; font-size:40px; line-height:45px; color:#FFF; font-family: 'Courgette', cursive;} 


#arrow{position:absolute; z-index:1; left:335px; top:180px;  max-width:800px; max-height:420px; }
</style> 
<script>//JavaScript</script> 
<!DOCTYPE HTML>
<?php
          $surprises = array('Tu vas te marier.','Tu auras une nouvelle voiture comme cadeau.','Tu vas te fiancer.','Tu vas appeler ton ex.',
                    'Tu auras udes vacances à Miami.');
          $img = array('1514896378','1514895246','1514896995','1514897325','1514897765');
          $id = mt_rand(0,3);
          
?>
<img src="http://creation.funizi.com/images-theme-perso/1514894006.jpg" id="background"> 

<div id="surprise" ><?php echo $surprises[$id]; ?></div>
<img src="http://creation.funizi.com/images-theme-perso/<?php echo $img[$id]; ?>.jpg" id="img"> 

<img src="https://graph.facebook.com/<?php echo $_GET['fb_id_user']; ?>/picture/?width=275&height=275" class="img_profile" id="fb_id_user">


<img src="http://creation.funizi.com/images-theme-perso/1514899457.png" id="arrow"> 


