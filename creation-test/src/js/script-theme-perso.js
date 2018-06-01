var $url = "Une erreur s'est produite, Veulliez réessayer !";
//var nbFriend = $("#nb_friends_fb").val()+1;
var nbFriendSet = 0;

$("#btnModalAddFriend").on("click",function () {
	nbFriend = nbFriendSet +1;
	$("#num_friend").fadeIn();
	$("#number_friend").val(nbFriend);
	$("#btn_charger_friend").attr({onclick:"chargerFriend('fb_id_friend_"+nbFriend+"','name_friend_"+nbFriend+"','friend_name_"+nbFriend+"')"});
})

$("#btnModalAddUser").on("click",function () {
	$("#num_friend").fadeOut('fast');
	$("#btn_charger_friend").attr({onclick:"chargerFriend('fb_id_user','name_user','user_name')"});
})
$('#openbackground').on("click", function() {
	$('#input_background').click();
});
$('#input_background').on("change", function () {
	if($('#input_background').val() != 'undefined')
	upload('#input_background','#openbackground');
});
$("#id_image").on('keyup', function functionName() {
	verifierIdInput("#id_image","#openbackground");
})
$("#id_text").on('keyup', function functionName() {
	verifierIdInput("#id_text","#btn_charger_text");
})
function verifierIdInput(idInput,btnToActivate){
	if($(idInput).val()!= ''){$(btnToActivate).prop('disabled',false);}
	else {$(btnToActivate).prop('disabled',true);}
}

function upload(input, btn) {

	var formData = new FormData();
	var file_data = $("#input_background");
	var file = file_data[0].files[0];
	formData.append( 'file_background[]', file);
	console.log(file);
	$.ajax({
		url: "action/uploadImageThemePerso",
		type: "POST",
		data: formData,
		processData: false,
		contentType: false,
		beforeSend: function(){
			$(btn).prop('disabled', true).html('Chargement ...');
			$('.img-loading').fadeIn("slow");
		}
		}).done(function( data ) {
			$(btn).prop('disabled', false).html('Changer le fichier');
			$('.img-loading').fadeOut("slow");

			$('#code_html_img').html("Code HTML : \n<img src=\""+data+"\" id=\""+$('#id_image').val()+"\"> \n\nCode CSS : \n#"+$('#id_image').val()+"{position:absolute; z-index:1; left:0; top:0;  max-width:800px; max-height:420px; }");
			$('#block_get_code').fadeIn("fast");

		});
}

function chargerFriend(idImage, idName, name) {
	var urlImg = '';
	$('#set-css-friend-code').fadeIn("fast");
	if(idImage != 'fb_id_user')
		urlImg = 'https://graph.facebook.com/{{' + idImage + '}}/picture/?width=275&height=275';
	else
		urlImg = '{{url_img_profile_user}}';
	$('#code_html_friend').html("Code HTML : \n<img src=\"" + urlImg + "\" class=\"img_profile\" id=\"" + idImage + "\">\n"+
		"<div class=\"name texte\" id=\""+idName+"\" >{{"+name+"}}</div>\n\n"+
		"Code CSS : \n#"+idImage+"{position: absolute; z-index:"+$('#z_index_friend').val()+"; left: 0px; top: 0px; width:"+$('#width_friend').val()+"px ;  height:"+$('#width_friend').val()+"px ; object-fit: cover; object-position: 50% 10%; border-radius:"+$('#radius_friend').val()+"px; max-width:800px; max-height:420px;}\n"+
		"#"+idName+"{position:absolute; z-index:"+$('#z_index_friend').val()+"; left: 0px; top: 0px; font-size:30px; color:#FFF;} ");
	if(idImage != 'fb_id_user'){
		nbFriend = parseInt($("#nb_friends_fb").val()) +1;
		if(nbFriendSet >= parseInt($("#nb_friends_fb").val())) $("#nb_friends_fb").val(nbFriend);
		nbFriendSet++;
	}
	$("#btn_charger_friend").fadeOut();
}

function chargerText() {
	$('#set-css-text-code').fadeIn("fast");
	$('#code_html_text').html("Code HTML : \n<div class=\"texte\" id=\""+$('#id_text').val()+"\"> Le texte ici </div>\n\n"+
		"Code CSS : \n#"+$('#id_text').val()+"{z-index:"+$('#z_index_text').val()+"; position: absolute; left: 0px; top: 0px; color:"+$('#color_text').val()+"; font-size:"+$('#font_size_text').val()+"px; width:"+$('#width_text').val()+"px ; height:"+$('#height_text').val()+"px ;"+
		" background:"+$('#background_text').val()+"; border:"+$('#border_text').val()+"; border-radius:"+$('#radius_text').val()+"px; "+
		" padding:"+$('#padding_text').val()+"px; text-align:"+$('#text_align_text').val()+"; max-width:800px; max-height:420px;}");
}

function executePHP() {

	var formData = new FormData();
	var codePHP = editorHTML.getSession().getValue();
	var codeJS = editorJS.getSession().getValue();
	var codeRequireBottom = editorRequireBottom.getSession().getValue();
	//$('#theme-perso > #body').html(code);

	formData.append( 'codePHP', codePHP);
	$.ajax({
		url: "action/executephp",
		type: "POST",
		data: formData,
		processData: false,
		contentType: false,
		beforeSend: function(){
		}
		}).done(function( data ) {
			$('#theme-perso > #body').html(data);
			$('#theme-perso > #body').append(codeRequireBottom);
			$('#apercu_js').html(editorJS.getSession().getValue());

			$(".img_profile").attr({src:"https://creation.funizi.com/src/img/user-default.jpg"});
		});
}

var eHTML=  $('#editor_html').val();
var editorHTML = ace.edit("editor_html");
editorHTML.resize();
editorHTML.$blockScrolling = Infinity;
editorHTML.getSession().setTabSize(10);
editorHTML.setStyle('editor_html');
editorHTML.setTheme("ace/theme/monokai");
editorHTML.setValue(eHTML);
editorHTML.getSession().setMode("ace/mode/php");



var eCSS=  $('#editor_css').val();
var editorCSS = ace.edit("editor_css");
editorCSS.$blockScrolling = Infinity;
editorCSS.getSession().setTabSize(10);
editorCSS.setStyle('editor_css');
editorCSS.setTheme("ace/theme/monokai");
editorCSS.setValue(eCSS);
editorCSS.getSession().setMode("ace/mode/css");

var eJS=  $('#editor_js').val();
var editorJS = ace.edit("editor_js");
editorJS.$blockScrolling = Infinity;
editorJS.getSession().setTabSize(10);
editorJS.setStyle('editor_js');
editorJS.setTheme("ace/theme/monokai");
editorJS.setValue(eJS);
editorJS.getSession().setMode("ace/mode/javascript");

var eRT =  $('#editor_require_top').val();
var editorRequireTop = ace.edit("editor_require_top");
editorRequireTop.$blockScrolling = Infinity;
editorRequireTop.getSession().setTabSize(10);
editorRequireTop.setStyle('editor_require_top');
editorRequireTop.setTheme("ace/theme/monokai");
editorRequireTop.setValue(eRT);
editorRequireTop.getSession().setMode("ace/mode/html");

var eRB =  $('#editor_require_bottom').val();
var editorRequireBottom = ace.edit("editor_require_bottom");
editorRequireBottom.$blockScrolling = Infinity;
editorRequireBottom.getSession().setTabSize(10);
editorRequireBottom.setStyle('editor_require_bottom');
editorRequireBottom.setTheme("ace/theme/monokai");
editorRequireBottom.setValue(eRB);
editorRequireBottom.getSession().setMode("ace/mode/html");

function putTranslateTag() {
	$.each( editorHTML.selection.getAllRanges(), function( index, range ){
		editorHTML.session.replace(range, "{%t "+editorHTML.session.doc.getTextRange(range)+" t%}");
	});
}

$('#btnPutTranslateTag').on('click', function() {
	putTranslateTag();
});

function doLoader(id, state){
  $(id).prop("disabled", state);
  if(state == true)
    $(id).html("<img src='https://creation.funizi.com/src/img/loader_spin.gif' > ");
  else
    $(id).html('');
}

function initFormAddImg () {
    $('#input_background').val('');
    $("#id_image").val('');
    $('#block_get_code').fadeOut("fast");
	$("#openbackground").prop('disabled',true);
	console.log('input ');
}

function initFormAddText () {
	$('#set-css-text-code').fadeOut("fast");
	$('#code_html_text').html();
	$("#btn_charger_text").prop('disabled',true);
	$('#id_text').val('');
	$('#color_text').val('#000');
	$('#font_size_text').val('14');
    $('#width_text').val('200');
	$("#height_text").val('50');
	$("#radius_text").val('0');
	$("#padding_text").val('5');
	$("#z_index_text").val('1');
    $("#text_align_text").val('left');
    $('#block_get_code').fadeOut("fast");
	$("#openbackground").prop('disabled',true);
	console.log('input ');
}

function initFormAddFriend () {
    $('#width_friend').val('200');
    $('#radius_friend').val('0');
    $('#z_index_friend').val('1');
    $('#set-css-friend-code').fadeOut("fast");
    $('#btn_charger_friend').fadeIn("fast");
}
function preview() {
	var gabarit =   '<html lang="en">\n'+
					'<head>\n'+
					'<meta charset="UTF-8">\n'+
					'<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">\n'+
					'<meta http-equiv="X-UA-Compatible" content="ie=edge">\n<title>Theme 4</title>\n'+editorRequireTop.getSession().getValue()+
					'\n<style></style>\n</head>\n'+
					'<div id="body" style="margin:0; padding:0; overflow: hidden;">\n</div>'+
					'<div id="#js" ></div>'+
					'</html>';
					//object.onload = function(){myScript};
	var gabaritJs = 'function tester(){'+editorJS.getSession().getValue()+'}';

	$('#theme-perso').html(gabarit);
	$('#theme-perso > style').html(editorCSS.getSession().getValue());
	executePHP() ;
	//$('#theme-perso > #body').html($code);
	$(".img_profile").attr({src:"https://creation.funizi.com/src/img/user-default.jpg"});



}
function saveTest(idTest) {
	var formData = new FormData();
	var codePHPHTML = editorHTML.getSession().getValue();
	var codeCSS = editorCSS.getSession().getValue();
	var codeJS = editorJS.getSession().getValue();
	var codeRequireTop = editorRequireTop.getSession().getValue();
	var codeRequireBottom = editorRequireBottom.getSession().getValue();
	var nbFriends = parseInt($("#nb_friends_fb").val());
	var nbMaxFriends = parseInt($("#max_friend_fb").val());
	var bestFriends = 0;
	if($('#best_friend').is( ":checked" )){
		bestFriends = 1;
	}
	console.log(bestFriends);
	formData.append('codePHPHTML', codePHPHTML);
	formData.append('codeCSS', codeCSS);
	formData.append('codeJS', codeJS);
	formData.append('codeRequireTop', codeRequireTop);
	formData.append('codeRequireBottom', codeRequireBottom);
	formData.append('idTest', idTest);
	formData.append('nbFriends', nbFriends);
	formData.append('nbMaxFriends', nbMaxFriends);
	formData.append('bestFriends', bestFriends);
	$.ajax({
			url: "action/saveTestPerso",
			type: "POST",
			data: formData,
			processData: false,
			contentType: false,
			beforeSend: function(){
				loadingProgress ('50%', 'Sauvegarde du thème personnalisé en cours...');
		}
		}).done(function( data ) {
			console.log(data);
		});
}

function updateTest(idTest) {
	//event.preventDefault();
	var formData = new FormData();
	var codePHPHTML = editorHTML.getSession().getValue();
	var codeCSS = editorCSS.getSession().getValue();
	var codeJS = editorJS.getSession().getValue();
	var codeRequireTop = editorRequireTop.getSession().getValue();
	var codeRequireBottom = editorRequireBottom.getSession().getValue();
	var nbFriends =  parseInt($("#nb_friends_fb").val());
	var nbMaxFriends = parseInt($("#max_friend_fb").val());
	var bestFriends = 0;
	if($('#best_friend').is( ":checked" )){
		bestFriends = 1;
	}
	var langsEdit = $("#langs_edit").val();

	formData.append('codePHPHTML', codePHPHTML);
	formData.append('codeCSS', codeCSS);
	formData.append('codeJS', codeJS);
	formData.append('codeRequireTop', codeRequireTop);
	formData.append('codeRequireBottom', codeRequireBottom);
	formData.append('idTest', idTest);
	formData.append('nbFriends', nbFriends);
	formData.append('nbMaxFriends', nbMaxFriends);
	formData.append('bestFriends', bestFriends);
	formData.append('langsEdit', langsEdit);
	$.ajax({
			url: "action/updateTestPerso",
			type: "POST",
			data: formData,
			processData: false,
			contentType: false,
			beforeSend: function(){
				event.preventDefault();
				//console.log(formData);
				loadingProgress ('50%', 'Sauvegarde du thème personnalisé en cours...');
				$("#btn_save").prop("disabled", true);
				$("#btn_save").html("<img src='https://creation.funizi.com/src/img/91.gif' > Enregistrement en cours ");
		}
		}).done(function( data ) {
			console.log(data);
			$("#modification_test").submit();
		});

}

function loadCodeTestPersoLang(id, lang) {
	var formData = new FormData();
	formData.append('id_test',id);
	formData.append('lang',lang);
	$.ajax({
			url: "action/loadCodeTestPersoLang",
			type: "POST",
			data: formData,
			processData: false,
			contentType: false,
			beforeSend: function(){
			//	console.log(formData);
				doLoader("#loader_lang",true);
		}
		}).done(function( data ) {
				doLoader("#loader_lang",false);
				editorHTML.setValue(data);
		});
}
