$(document).ready(function(){
    // Validation
    if($('#theme').val()== 1 ){
        $.validator.addMethod("titre-resultat", function(value, element) {
          return !this.optional(element);
        }, "Veuillez fournir un titre à ce résultat");
    }

    if($('#theme').val()== 2 ){
        $.validator.addMethod("texte-resultat", function(value, element) {
          return !this.optional(element);
        }, "Veulliez fournir une expliquation à ce résultat");
    }

    $.validator.addMethod("img_base_64", function(value, element) {
      return !this.optional(element);
  }, "Veuillez fournir une image");



    $.validator.addMethod("img_base_64", function(value, element) {
      return !this.optional(element);
    }, "Veulliez fournir une image");

    $( "#modification_test" ).validate( {
        ignore: "not:hidden",
        rules: {
            titre: "required",
            rubrique: "required",
        },
        messages: {
            titre: "Le titre du test est manquant",
            rubrique: "Veulliez choisir une rubrique pour le test"
        },
        errorElement: "em",
        errorPlacement: function ( error, element ) {
            // Ajout de la classe help-block pour les érreurs
            error.addClass( "help-block" );
            if ( element.prop( "type" ) === "checkbox" ) {
                error.insertAfter( element.parent( "label" ) );
            } else {
                error.insertAfter( element );
            }
        },
        highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".form-group" ).addClass( "has-error" ).removeClass( "has-success" );
        },
        unhighlight: function (element, errorClass, validClass) {
            $( element ).parents( ".form-group" ).addClass( "has-success" ).removeClass( "has-error" );
        },
        submitHandler: function(e) {

            //e.preventDefault(); // Le navigateur ne peut pas envoyer le formulaire
            //$( "#modification_test" ).submit();
            return true;
        }
    });
    // Fin validation

    var resultat_template = jQuery.validator.format($.trim($("#resultat_template").val()));
    // Ajouter une section pour saisir un nouveau résultat au test
    function ajouterResultat() {
        var $idResultataAjouter = $("#idNextResultat").val();
        $(resultat_template($idResultataAjouter)).appendTo("#les_resultats");
        if($idResultataAjouter>2){
            $('html, body').animate({ scrollTop: $("#le_resultat_"+$idResultataAjouter).offset().top}, 1000);
        }
        $("#idNextResultat").val(++$idResultataAjouter);
        afficherOuCaherBtnFermer();
    }
    afficherOuCaherBtnFermer();
    $("#btn_add_result").click(ajouterResultat);
    // For Cropit Image Test
    $('#btn_charger_image').fadeOut("slow");
    //$('#btn_charger_image').prop("disabled",true);
    $('.image-editor').cropit({
        onImageLoading : function(){
          $(".img-loading").fadeIn("fast");
          $('#message-error').html("");
        },
        onImageLoaded : function(){
          $(".img-loading").fadeOut("fast");
          AfficherEditeurImage ();
        },
        onImageError : function(error) {
          $('#message-error').html(error.message);
              $(".img-loading").fadeOut("fast");
          },
        onFileChange : function(){
          //AfficherEditeurImage ();
        },
        onFileReaderError : function () {

        },
    });


        $('#download').prop( "disabled", true );
        $('#src-cropit').keypress( function(){
            //alert('change');
            console.log($('#src-cropit').val());
            if($('#src-cropit').val()!=''){
                $('#download').prop( "disabled", false );
            }
            else {
                $('#download').prop( "disabled", true );
            }
        });
        $('#src-cropit').keyup( function(){
            //alert('change');
            if($('#src-cropit').val()!=''){
                $('#download').prop( "disabled", false );
            }
            else {
                $('#download').prop( "disabled", true );
            }
        });
        $('#download').click(function(){

            $(".img-loading").fadeIn("fast");
            var ajaxData = new FormData();
                ajaxData.append("url",$('#src-cropit').val());
            $.ajax({
                url: "grabImageForCropit",
                type: "POST",
                data : ajaxData,
                processData: false,
                contentType: false,
                beforeSend: function(){
                    // Bouton désactivé en attendant le traitement
                    $('#download').prop( "disabled", true ).html( "Chargement ...").css("color","#000");
                }
                }).done(function( data ) {
                    console.log(data)
                    // Bouton réactivé
                    $('.image-editor').cropit('imageSrc', 'http://creation.funizi.com/'+data);
                    $('#download').prop( "disabled", false ).html( "Télécharger l\'image");
                    //$(".img-loading").fadeOut("fast");

                });
        });

    $('#return').click(function(){
      AfficherSelecteurImage ();
    });
    $('#openfile').click(function() {
        $('.cropit-image-input').click();
    });
    $('.cropit-image-input').change(function () {
        AfficherEditeurImage ();
    });
    // Rotation de l'image
    $('.rotate-cw').click(function() {
      $('.image-editor').cropit('rotateCW');
    });
    $('.rotate-ccw').click(function() {
      $('.image-editor').cropit('rotateCCW');
    });
    function AfficherEditeurImage (){
        // Cacher le bouton et le input pour choisir une image
        $('.crop-selector-image').fadeOut("fast",function(){
            // Afficher la partie d'édition de l'image(crop, zoom, rotate)
            $('.crop-editor').fadeIn("slow");
            $('#btn_charger_image').fadeIn("slow");
            //$('#btn_charger_image').prop("disabled",false);
        });
    }
    // End For Cropit Image test

        $('#default_lang').on('change', function () {
            if($('#default_lang').val() != 'fr')
              $('#if_translated').prop( "checked", false );
            else
              $('#if_translated').prop( "checked", true );
        });

});
