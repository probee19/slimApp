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



    $( "#ajout_test_form" ).validate( {
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
            var ajaxData = new FormData();

            // Ajout des autres données dans ajaxData
            var other_data = $('form').serializeArray();
            $.each(other_data,function(key,input){
                ajaxData.append(input.name,input.value);
            });

            $.ajax({
                url: "save",
                type: "POST",
                data : ajaxData,
                processData: false,
                contentType: false,
                beforeSend: function(){
                    // Bouton désactivé en attendant le traitement
                    $('#btn_add_result').fadeOut("slow");
                    $('#btn_save').prop( "disabled", true ).html("Traitement en cours...").css("color","#000");
                    $('#btn_cancel').prop( "disabled", true );
                    $("html, body").animate({ scrollTop: 0 }, 600);
                    loadingProgress ('0%', 'Création du test en cours...');
                }
                }).done(function( data ) {
                    // Bouton réactivé, formulaire réinitialisé
                    console.log(data);
                    if ($('#theme').val()== 4 && data != 0 ) {
                        console.log('Test personnalisé');
                        saveTest(data);
                    }
                    setTimeout(function(){
                      loadingProgress ('100%', 'Test enrégistré avec succès.');
                      //$(".alert-success").fadeIn("slow");
                    },2000);

                    $("html, body").animate({ scrollTop: 0 }, 600);
                    setTimeout(function(){ window.location = "https://creation.funizi.com/tests"; }, 4000);
                });
            return false;
        }
    });
    // Fin validation

    var premier_ajout = true;
    var resultat_template = jQuery.validator.format($.trim($("#resultat_template").val()));
    // Ajouter une section pour saisir un nouveau résultat au test
    function ajouterResultat() {
        var $idResultataAjouter = $("#idNextResultat").val();
        $(resultat_template($idResultataAjouter)).appendTo("#les_resultats");
        if(!premier_ajout){
            $('html, body').animate({ scrollTop: $("#le_resultat_"+$idResultataAjouter).offset().top}, 1000);
        }
        $("#idNextResultat").val(++$idResultataAjouter);
        afficherOuCaherBtnFermer();
    }
    // Débuter avec quatre résultats
    if($('#theme').val()== 1 || $('#theme').val()== 2 ){

        ajouterResultat();
        ajouterResultat();
        ajouterResultat();
        ajouterResultat();
    }
    premier_ajout = false;

    // Action d'ajout de nouveau résultat
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


    $('#download').prop("disabled", true );
    $('#src-cropit').keypress( function(){
        //alert('change');
        //console.log($('#src-cropit').val());
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
                $('.image-editor').cropit('imageSrc', 'https://creation.funizi.com/'+data);
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
        //AfficherEditeurImage ();
    });
    $('#btn_cancel_charger_image').click(function () {
        AfficherSelecteurImage ();
    });
    // Rotation de l'image
    $('.rotate-cw').click(function() {
      $('.image-editor').cropit('rotateCW');
    });
    $('.rotate-ccw').click(function() {
      $('.image-editor').cropit('rotateCCW');
    });

    // End For Cropit Image test


    $('#default_lang').on('change', function () {
        if($('#default_lang').val() != 'fr')
          $('#if_translated').prop("checked", false );
        else
          $('#if_translated').prop("checked", true );
    });


    $('#langs_edit').on('change', function () {
      loadCodeTestPersoLang($('#idTest').val(), $('#langs_edit').val());
      loadInfoTestLang($('#idTest').val(), $('#langs_edit').val());

    });


    $( "#ajout_citation_form" ).validate( {
        ignore: "not:hidden",
        rules: {
            titre: "required",
            rubrique: "required",
        },
        messages: {
            titre: "Le titre de la citation est manquant",
            rubrique: "Veulliez choisir une rubrique pour la citation"
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
            var ajaxData = new FormData();

            // Ajout des autres données dans ajaxData
            var other_data = $('form').serializeArray();
            $.each(other_data,function(key,input){
                ajaxData.append(input.name,input.value);
            });
            //saveCitation(data);

            var codePHPHTML = editorHTML.getSession().getValue();
          	var codeCSS = editorCSS.getSession().getValue();
          	var codeJS = editorJS.getSession().getValue();
          	var codeRequireTop = editorRequireTop.getSession().getValue();
          	var codeRequireBottom = editorRequireBottom.getSession().getValue();

          	ajaxData.append('codePHPHTML', codePHPHTML);
          	ajaxData.append('codeCSS', codeCSS);
          	ajaxData.append('codeJS', codeJS);
          	ajaxData.append('codeRequireTop', codeRequireTop);
          	ajaxData.append('codeRequireBottom', codeRequireBottom);
            $.ajax({
                url: "save",
                type: "POST",
                data : ajaxData,
                processData: false,
                contentType: false,
                beforeSend: function(){
                    // Bouton désactivé en attendant le traitement
                    $('#btn_save_citation').prop( "disabled", true ).html("Traitement en cours...").css("color","#000");
                    $('#btn_cancel').prop( "disabled", true );
                    $("html, body").animate({ scrollTop: 0 }, 600);
                    loadingProgress ('0%', 'Création de la citation en cours...');
                }
                }).done(function( data ) {
                    // Bouton réactivé, formulaire réinitialisé
                    console.log(data);
                    setTimeout(function(){
                      loadingProgress ('100%', 'Citation enrégistrée avec succès.');
                      $(".alert-success").fadeIn("slow");
                    },2000);

                    $("html, body").animate({ scrollTop: 0 }, 600);
                    setTimeout(function(){ window.location = "https://creation.funizi.com/citations"; }, 4000);
                });
            return false;
        }
    });

    $( "#ajout_playbuzz_form" ).validate( {
        ignore: "not:hidden",
        rules: {
            titre: "required",
            rubrique: "required",
        },
        messages: {
            titre: "Le titre du contenu est manquant",
            rubrique: "Veulliez choisir une rubrique pour le contenu"
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
            var ajaxData = new FormData();

            // Ajout des autres données dans ajaxData
            var other_data = $('form').serializeArray();
            $.each(other_data,function(key,input){
                ajaxData.append(input.name,input.value);
            });
            //saveCitation(data);

            var codePHPHTML = editorHTML.getSession().getValue();


            ajaxData.append('codePHPHTML', codePHPHTML);
            $.ajax({
                url: "save",
                type: "POST",
                data : ajaxData,
                processData: false,
                contentType: false,
                beforeSend: function(){
                    // Bouton désactivé en attendant le traitement
                    $('#btn_save_citation').prop( "disabled", true ).html("Traitement en cours...").css("color","#000");
                    $('#btn_cancel').prop( "disabled", true );
                    $("html, body").animate({ scrollTop: 0 }, 600);
                    loadingProgress ('0%', 'Création du contenu en cours...');
                }
                }).done(function( data ) {
                    // Bouton réactivé, formulaire réinitialisé
                    console.log(data);
                    setTimeout(function(){
                      loadingProgress ('100%', 'PlayBuzz enrégistré avec succès.');
                      $(".alert-success").fadeIn("slow");
                    },2000);

                    $("html, body").animate({ scrollTop: 0 }, 600);
                    setTimeout(function(){ window.location = "https://creation.funizi.com/citations"; }, 4000);
                });
            return false;
        }
    });
    // Fin validation

});
