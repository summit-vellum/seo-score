$('#seo_keyword, #meta_title, #meta_description, #content').blur(function(){
	generateSeoScore('form');
});

$(document).ready(function(){
	tinymce.get('content').on('blur', function(e){
		generateSeoScore('form');
	});
});
