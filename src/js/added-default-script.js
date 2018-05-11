
// Pour crop

function initialisationCropEditor(id){
    $("#btn_charger_image").attr("onclick", "chargerImageCropee("+id+")");
}

function AfficherEditeurImage (){
    // Cacher le bouton et le input pour choisir une image
    $('.crop-selector-image').fadeOut("fast",function(){
        // Afficher la partie d'édition de l'image(crop, zoom, rotate)
        $('.crop-editor').fadeIn("slow");
        $('#btn_charger_image').fadeIn("slow");
        //$('#btn_charger_image').prop("disabled",false);
    });
}
function AfficherSelecteurImage (){
    // Affiche le bouton et le input pour choisir une image
    $('.crop-editor').fadeOut("fast", function(){
        // Cache la partie d'édition de l'image(crop, zoom, rotate)
        $('.crop-selector-image').fadeIn("slow");
        $('#btn_charger_image').fadeOut("slow");
        //$('#btn_charger_image').prop("disabled",true);
        $('#src-cropit').val('');
    });
    $('#input-cropit-image-input').wrap('<form>').closest('form').get(0).reset();
    $('#input-cropit-image-input').unwrap();
}
function chargerImageCropee(id) {

      var imageData = $('.image-editor').cropit('export', {
        type: 'image/jpeg',
        quality: 0.9,
        originalSize: false,
    });
    if(id!=0){ // Pour l'image d'un résultat

        var $idResultataAjouter = $("#idNextResultat").val();
        if($("#theme").val() == 2 && id == 1 ){
            for (var i = 1; i < $("#idNextResultat").val(); i++) {
                if($('#img_resultat_base_64_'+i).val() == '' || i == 1){
                    $('#img_resultat_preview_'+i).attr("src",imageData);
                    $('#img_resultat_base_64_'+i).val(imageData);
                    $('#btn_crop_'+i).val("Changer l'image");
                }
            }
        }
        else {
            $('#img_resultat_preview_'+id).attr("src",imageData);
            $('#img_resultat_base_64_'+id).val(imageData);
            $('#btn_crop_'+id).val("Changer l'image");
        }


    }
    else { // Pour l'image du test

        $('#img_test_preview').attr("src",imageData).load(function(){
            $('#img_test_base_64').val(imageData);
            $('.btn_add_image').val("Changer l'image");
        });
    }
    AfficherSelecteurImage ();



}

// Met à jour le div qui contient les input hidden des id des résultas à enlever dans la base de données
function supprimerResultat(id){
    $idResultatBD = $("#id_resultat"+id).val();
    $numero = $("#nb_resultats_to_del").val();
    $numero++;
    if($idResultatBD != 0){
        $("#resultats-to-del").append("<input type=\"hidden\" name=\"to_del"+$numero+"\" id=\"to_del"+$numero+"\" value=\""+$idResultatBD+"\">");
        $("#nb_resultats_to_del").val($("#resultats-to-del").children().length-1);
    }
}

// Supression d'un résultat
function enleverResultat(id){
    var idToRemove = "#le_resultat_"+id;
    // Enlever le resultat sélectionné
    supprimerResultat(id);
    $("section").remove(idToRemove);
    // Obtenir le nombre de résultats après supression
    var nbResultatsAvantSupp = $("#les_resultats").children().length ;

    nbResultatsAvantSupp ++;
    numeroResultatSuivant = id+1; // Le premier résultat qui vient juste après le résultat supprimé
    for (var j = numeroResultatSuivant ; j <= nbResultatsAvantSupp ; j++) {
        var idResultat = "#le_resultat_"+j;
        var newNumeroResultat = j-1;
        var newIdResultat = "le_resultat_"+newNumeroResultat;

        // Mise à jour du numéro du résultat et du bouton "fermer résultat"
        $(idResultat+' > div > div > h3').html(newNumeroResultat+' <button type="button" onclick="enleverResultat('+newNumeroResultat+')" class="close btn-del-resultat" >&times;</button>' );

        // Changement des labels (html ef velur du for)
        $("label[for='resultat"+j+"']").html("Titre du résultat "+newNumeroResultat).attr("for","resultat"+newNumeroResultat );
        $("label[for='texte_resultat"+j+"']").attr("for","texte_resultat"+newNumeroResultat ).html("Détails sur le résultat "+newNumeroResultat);
        $("label[for='image_resultat"+j+"']").attr("for","image_resultat"+newNumeroResultat ).html("Image du résultat "+newNumeroResultat);
        $("label[for='genre"+j+"']").attr("for","genre"+newNumeroResultat );

        // Mise à jour des input (id et name)
        $("input[name='id_resultat"+j+"']").attr("id","id_resultat"+newNumeroResultat ).attr("name","id_resultat"+newNumeroResultat);
        $("input[name='resultat"+j+"']").attr("id","resultat"+newNumeroResultat ).attr("name","resultat"+newNumeroResultat).attr("onkeyup","majApercu("+newNumeroResultat+")");
        $("input[name='genre"+j+"']").attr("name","genre"+newNumeroResultat);
        $("input[name='image_resultat"+j+"']").attr("id","image_resultat"+newNumeroResultat ).attr("name","image_resultat"+newNumeroResultat).attr("data-panelid","image_resultat"+newNumeroResultat);

        // Mise à jour du textarea de description du résultat (id et name)
        $("textarea[name='texte_resultat"+j+"']").attr("id","texte_resultat"+newNumeroResultat ).attr("name","texte_resultat"+newNumeroResultat);

        // Mise à jour du div de prévisualasiation
        $("img[id='img_resultat_preview_"+j+"']").attr("id","img_resultat_preview_"+newNumeroResultat );
        $("div[id='apercu_resultat"+j+"']").attr("id","apercu_resultat"+newNumeroResultat);

        // Mise à jour pour le cropping
        $("input[id='img_resultat_base_64_"+j+"']").attr("id","img_resultat_base_64_"+newNumeroResultat).attr("name","img_resultat_base_64_"+newNumeroResultat);
        $("input[id='btn_crop_"+j+"']").attr("id","btn_crop_"+newNumeroResultat).attr("onclick","initialisationCropEditor("+newNumeroResultat+")");

        // Mise à jour de l'id du résultat
        $(idResultat).attr('id',newIdResultat);
    }
    // Mise à jour de l'id du prochaine résultat à ajouter
    $("#idNextResultat").val(nbResultatsAvantSupp);
    afficherOuCaherBtnFermer();
}

// Cacher ou afficher les boutons fermer résultat si le nombre de résultat est supériour ou non à 3
function afficherOuCaherBtnFermer(){
    $nbResultats = $("#les_resultats").children().length ;
    if($nbResultats <=2){
        $('.btn-del-resultat').fadeOut();
    }
    else {
        $('.btn-del-resultat').fadeIn();
    }
}

// Apercu du te=itre du résultat
function majApercu(id){
    $apercu = $('#resultat'+id).val();
    $('#apercu_resultat'+id+' input').val($apercu);
}


// Prévisualasiation des image-resultat
function chargerPrev(myinput) {
    var name = $(myinput).attr("name");
    var id = $(myinput).attr("id");
    var val = $(myinput).val();
    debugger;
    switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
        case 'gif': case 'jpg': case 'png': case 'jpeg':
            readURL(myinput);
            break;
        default:
            $(this).val('');
            break;
    }
}

function readURL(myinput) {
    debugger;
    if (myinput.files && myinput.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#img_resultat_preview_' + $(myinput).attr("id").replace('image_resultat','') ).attr('src', e.target.result);
        }
        reader.readAsDataURL(myinput.files[0]);
    }
}
// Prévisualasiation de l'image du test
function chargerPrevImgTest(myinput) {
    var name = $(myinput).attr("name");
    var id = $(myinput).attr("id");
    var val = $(myinput).val();
    debugger;
    switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
        case 'gif': case 'jpg': case 'png': case 'jpeg':
            readURLImgTest(myinput);
            break;
        default:
            $(this).val('');
            break;
    }
}

function readURLImgTest(myinput) {
    debugger;
    if (myinput.files && myinput.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#img_test_preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(myinput.files[0]);
    }
}
// Réinitialisation du formulaire
function initForm () {
    $(':input','form')
    .not(':button, :submit, :reset, :hidden')
    .val('')
    .removeAttr('selected');
    $("img").attr( "src", "images/preview.jpg" );
}


function DisableOrEnabaleBtn(){
    if($('#src-cropit').val()!=''){
        $('#download').prop( "disabled", false );
    }
    else {
        $('#download').prop( "disabled", true );
        //setInterval(DisableOrEnabaleBtn,1000);
    }
}

function changeTheme (id, oldTheme, newTheme) {
    $.ajax({
        url: "action/changeTheme?idTest="+id+"&odlTheme="+oldTheme+"&newTheme="+newTheme,
        type: "GET",
        processData: false,
        contentType: false,
        beforeSend: function(){
            // Bouton désactivé en attendant le traitement
            //$('#btn_add_result').fadeOut("slow");
            //$('#btn_save').prop( "disabled", true ).html( "Traitement en cours...").css("color","#000");
            //$('#btn_cancel').prop( "disabled", true )
        }
        }).done(function( data ) {
            // Bouton réactivé, formulaire réinitialisé
            setTimeout(function(){ window.location.reload(); }, 10);

        });
}

function loadInfoTestLang (id, lang) {
  var formData = new FormData();
	formData.append('id_test',id);
	formData.append('lang',lang);
	$.ajax({
			url: "action/loadInfoTestLang",
			type: "POST",
			data: formData,
      traditional : true,
			processData: false,
			contentType: false,
			beforeSend: function(){
		}
		}).done(function( data ) {
        data = JSON.parse(data);
        $("#titre").val(data["titre_test"]);
        $("#texte_for_share").val(data["test_description"]);
		});
}

function loadingProgress (percent, notification, action = ''){
  if($('#alert_progress').css('display') == 'none') $('#alert_progress').fadeIn();
  $('.progress div').animate({width: percent}, 2000, function (){
    $(this).children().html(percent);
    $('#notif_action_text').html(notification);

    if(percent == '100%'){
        if(action == 'close')
          setTimeout(function(){
            $('#alert_progress').fadeOut();
          }, 2000);
        else if(action == 'reload')
          setTimeout(function(){
            location.reload();
          }, 2000);
          setTimeout(function(){
            $(this).animate({width: '0'}, 1000, function () {
              console.log('Initialisation de la barre de progression');
            });
            $(this).children().html('0%');
          }, 2000);
    }
  })
}
