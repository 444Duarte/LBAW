$(document).ready(function(){

	function toggleFieldInline (dom) {
		if(dom.is(':visible'))
			dom.hide();
		else
			dom.css('display','inline-block');
	};

	$(".edit-button").click(function(){
		$(this).siblings(".preview-field").toggle();
		toggleFieldInline($(this).siblings(".edit-field"));
		$(this).siblings(".edit-field").children("form")[0].reset();
		if($(this).text()=="Edit")
			$(this).text("Cancel");
		else
			$(this).text("Edit");
	});

});