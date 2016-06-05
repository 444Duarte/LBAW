$(document).ready(function(){
	$('.modal').on('shown.bs.modal', function () {
	  $(this).find('input')[0].focus();
	});

	$('.modal').on('hidden.bs.modal', function () {
	  $(this).find('form')[0].reset();
	});



	$('.modal form').submit(submitFormAjax);
	$('.submit_form_button').click(function(){
		$(this).closest('.modal').find('form').submit();
	});
	changeSubCategory(null,$('#add-item-form select[name ="category"]'));
	$('#add-item-form select[name ="category"]').change(changeSubCategory)
});

function changeSubCategory(e, ndom){
	var dom = (ndom ==null) ? $(this) : ndom;
	var value = dom.val();
	var subCategoriesSelect = dom.siblings('select[name="subcategory"]');
	subCategoriesSelect.empty();
	for(i = 0; i < subCategories.length ; i++){
		if(subCategories[i]['id_category'] == value){
			var idSubCategory = subCategories[i]['id'];
			var name = subCategories[i]['name'];
			subCategoriesSelect.append("<option value="+idSubCategory+">"+ name+"</option>");
		}
	}
}

function submitFormAjax(e) {
	var dom = $(this);
	var inputs = dom.find('input');
	for (var i = 0; i < inputs.length; i++) {
		if(!inputs[i].checkValidity()){
			return false;
		}
	}
	var action = dom.attr("action");
	var formData = new FormData($(this)[0]);
	console.log(action);
	console.log(formData);
	$.ajax({url: action, 
		type: 'post',
		data: formData,
		cache: false,
    	contentType: false,
    	processData: false, 
		success: function(response){
			var result = response['result'];
			var message = response['message'];
			alertify.logPosition("bottom right");
	    	alertify.log(message);
	    	console.log(response);
	    },
	    error: function(response){
			alertify.logPosition("bottom right");
	    	alertify.error("Request failed");
	    	console.log(response);
	    		    
	    }
	});
	e.preventDefault();
	dom.closest('.modal').modal('toggle');
};