<?php
$message = array("  Grâce à de bonnes actions passées, tu vas recevoir de l'argent auquel tu ne t'attends pas ainsi que des bonnes nouvelles. Tu vas gagner sur tous les tableaux.  ",
"  Tu vas faire un long voyage aves deux amis proches. En cours de route, tu vas rencontrer de nouveaux visages qui auront un énorme impact sur ta vie en 2018. Passionnant.  ",
"  Un énorme changement au cours de la dernière semaine du mois va t'amener à te concenter sur tes objectifs de l'année prochaine. Tu vas planifier la plus grande aventure de toute ta vie.  ",
"  Tu vas rencontrer l'amour de ta vie, mais pas de la manière dont tu l'imagines. Une soirée chez un ami va déclencher les événements.  ");
shuffle($message);
?>

<div id="titre" class="titre">  Que te réserve le mois de juin ?  </div>
<img src="http://creation.funizi.com/images-theme-perso/1509379734.jpg" id="background"> 

<img src="{{url_img_profile_user}}" class="img_profile" id="fb_id_user">
<div class="name texte" id="name_user" ><span id="name_contour">{{user_name}}</span></div>

<img src="https://graph.facebook.com/{{fb_id_user}}/picture/?width=275&height=275" class="img_profile" id="fb_id_user">
<div id="message"> <?php echo $message[0]; ?>
</div>