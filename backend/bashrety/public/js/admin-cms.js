$(document).ready(function(){
	
	
	$(".delete-button").click(function(ev){ 
		
		$("#delete_cms_id", $("#delete-cms")).val($(ev.currentTarget).attr('service-id')); 
		$("#delete_cms_submit", $("#delete-cms")).removeClass('disabled');
	});
	$("#delete_cms_submit").click(function(ev){
		if($(ev.currentTarget).hasClass('disabled'))
		{
			return false;
		}
		deleteServiceType();
	});
	var l = window.location;
    var base_url = l.protocol + "//" + l.host+'/js/tiny_mce/tiny_mce.js';

	$("#email_body").tinymce({
		// Location of TinyMCE script
		script_url : base_url,

		// General options
		width : "600", 
		theme : "advanced",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",
		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,charmap,emotions,iespell,media,advhr,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",
	});
	
	/*$(".delete-button").click(function(ev){ alert('good');
		/*alert($("#delete-cms")).val($(ev.currentTarget).attr('cms-id'));
		$("#delete_cms_id", $("#delete-cms")).val($(ev.currentTarget).attr('cms-id'));
		$("#delete_cms_submit", $("#delete-cms")).removeClass('disabled');
	});
	
	$("#delete_cms_submit").click(function(ev){
		if($(ev.currentTarget).hasClass('disabled'))
		{
			return false;
		}
		deleteServiceType();
	});	*/
	
});

function deleteServiceType()
{   
	
	var l = window.location;
    var base_url = l.protocol + "//" + l.host;
    var  pathToData= "/admin/delete-cms"; 


	$.ajax({
		data 		: {id: $("#delete_cms_id", $("#delete-cms")).val()},
		dataType	: 'json',
		type		: 'POST',
		url			: base_url + pathToData,
		beforeSend	: function(){ $("#delete_cms_submit").addClass('disabled'); },
		complete	: function(){ $("#delete_cms_submit").removeClass('disabled'); },
		success		: function(data, status, xhr){
			if(data != null && data.status && data.status == 'success')
			{
				location.reload();
			}
			else
			{
				html = $("<div class=\"alert-box error\">Failed to delete the service type.<a href=\"\" class=\"close\">×</a></div>").delegate("a.close", "click", function(event) {
				    		event.preventDefault();
				    		$(this).closest(".alert-box").fadeOut(function(event){
				    			$(this).remove();
				    		});
						});
				$("h2", $("#delete-cms")).after(html);
			}
		}
	});
	
}