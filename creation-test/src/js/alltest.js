
// Mise à jour des fichiers json des tests pour chaque langue activée
function updateJsonTestFiles () {
  $.ajax({
    url: 'action/updatejsonalltests',
    type: 'GET',
    data: '',
    dataType: 'html',
    beforeSend: function () {
      loadingProgress ('80%', 'Mise à jour des fichiers json en cours...');
      console.log('Début MAJ des fichiers json des tests pour chaque langue activée...');
    }
  }).done(function (data) {
    console.log(data);
  });
}
function updateJsonHighlightedTestsFiles () {
  $.ajax({
    url: 'action/updatejsonhighlightedtests',
    type: 'GET',
    data: '',
    dataType: 'html',
    beforeSend: function () {
      loadingProgress ('70%', 'Mise à jour des fichiers json en cours...');
      console.log('Début MAJ des fichiers json des tests promus pour chaque langue activée...');
    }
  }).done(function (data) {
    console.log(data);
  });
}

// Prépare la fenetre modale avec les données du test à supprimer
function prepareDelete(id){
  //$(".modal-title").html(title);
  $("#id_to_delete").val(id);
}
// Supprime le test choisi puis recharge la page
function deleteTest () {
  var idToDelete = $("#id_to_delete").val();

  $.ajax({
     url : 'action/deleteTest',
     type : 'GET',
     data : 'action=del&idtest='+idToDelete,
     dataType : 'html',
     success : function(code_html, statut){
       updateJsonTestFiles();
       location.reload();
    }
   });
}
// Active le test choisi puis recharge la page
function activeTest(id){
  $.ajax({
     url : 'action/activeTest',
     type : 'GET',
     data : 'action=act&idtest='+id,
     dataType : 'html',
     beforeSend: function () {
       loadingProgress ('0%', 'Activation du test en cours...');
     }
   }).done(function (data) {
     updateJsonTestFiles();
     setTimeout(function(){
       loadingProgress ('100%', 'Opération terminée avec succès.', 'reload');
     },1000);
   });
}

// Desactive le test choisi puis recharge la page
function desactiveTest(id){
  $.ajax({
     url : 'action/desactiveTest',
     type : 'GET',
     data : 'action=des&idtest='+id,
     dataType : 'html',
     beforeSend: function () {
       loadingProgress('0%', 'Désactivation du test en cours...');
     }
   }).done(function (data) {
     updateJsonTestFiles();
     setTimeout(function(){
       loadingProgress('100%', 'Opération terminée avec succès.', 'reload');
     },1000);
   });
}
    // Supprime le test déjà effectué
function deleteResult( admin, test){

  $.ajax({
     url : 'action/deleteResult',
     type : 'GET',
     data : 'action=delResult&admin='+admin+'&test='+test,
     dataType : 'html',
           beforeSend : function () {
               $('#btn_del_resultl_'+test).html("<img src='./src/img/91.gif' >");

           },
     success : function(code_html, statut){
               setTimeout(function () {
                   $('#btn_del_resultl_'+test).fadeOut("slow");
                   $('#texte_notif_del_result').val(' Votre résultat a été supprimé avec succès. Vous pouvez effectuer maintenant un nouveau test !');
                   $('#notif_del_result').css("display","block");
                   $('#notif_del_result').fadeIn("slow");
               }, 2000)
               console.log(code_html);

            }
   });
}

function highlight(test) {
    $.ajax({
       url : 'action/highlight',
       type : 'GET',
       data : 'action=highlight&idtest='+test,
       dataType : 'html',
       beforeSend : function () {
          loadingProgress ('0', 'Mise en avant du test en cours...');
          $('#highlight_'+test).html("<img src='./src/img/91.gif' >");
       }
     }).done(function (data) {
       updateJsonHighlightedTestsFiles();
       setTimeout(function () {
           $('#highlight_'+test).html("<i class=\"fa fa-level-down\" aria-hidden=\"true\"></i> ");
           $('#highlight_'+test).prop("title","Ne plus mettre en avant le test");
           $('#highlight_'+test).attr("onclick","moveHighlight("+test+")");
           $('#highlight_'+test).removeClass("btn-success").addClass("btn-danger");
       }, 2000);
       setTimeout(function () {
         loadingProgress('100%', 'Opération terminée avec succès.', 'close');
       }, 2000);
     });
}
function moveHighlight(test) {
    $.ajax({
       url : 'action/moveHighlight',
       type : 'GET',
       data : 'action=movehighlight&idtest='+test,
       dataType : 'html',
       beforeSend : function () {
           $('#highlight_'+test).html("<img src='./src/img/91.gif' >");
           loadingProgress ('0', 'Annulation de la mise en avant du test en cours...');
       },
       success : function(code_html, statut){
          updateJsonHighlightedTestsFiles();
           setTimeout(function () {
               $('#highlight_'+test).html("<i class=\"fa fa-level-up\" aria-hidden=\"true\"></i> ");
               $('#highlight_'+test).prop("title","Mettre en avant le test");
               $('#highlight_'+test).attr("onclick","highlight("+test+")");
               $('#highlight_'+test).removeClass("btn-danger").addClass("btn-success");
           }, 2000);

           setTimeout(function () {
             loadingProgress('100%', 'Opération terminée avec succès.', 'close');
           }, 3000);
        }
   });
}


// Supprime une citation
function deleteCitation () {
  var idToDelete = $("#id_to_delete").val();

  $.ajax({
     url : 'action/deleteCitation',
     type : 'GET',
     data : 'action=del&idcitation='+idToDelete,
     dataType : 'html',
     success : function(code_html, statut){
       location.reload();
    }
   });
}

// Active la citation choisie puis recharge la page
function activeCitation(id){
  $.ajax({
     url : 'action/activeCitation',
     type : 'GET',
     data : 'action=act&idcitation='+id,
     dataType : 'html',
     beforeSend: function () {
       loadingProgress ('0%', 'Activation de la citation en cours...');
     }
   }).done(function (data) {
     updateJsonTestFiles();
     setTimeout(function(){
       loadingProgress ('100%', 'Opération terminée avec succès.', 'reload');
     },1000);
   });
}

// Desactive la citation choisie puis recharge la page
function desactiveCitation(id){
  $.ajax({
     url : 'action/desactiveCitation',
     type : 'GET',
     data : 'action=des&idcitation='+id,
     dataType : 'html',
     beforeSend: function () {
       loadingProgress('0%', 'Désactivation de la citation en cours...');
     }
   }).done(function (data) {
     updateJsonTestFiles();
     setTimeout(function(){
       loadingProgress('100%', 'Opération terminée avec succès.', 'reload');
     },1000);
   });
}
