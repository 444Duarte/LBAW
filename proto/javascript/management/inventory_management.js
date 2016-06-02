$(document).ready(function(){
	$('.modal').on('shown.bs.modal', function () {
	  $(this).find('input')[0].focus();
	});

	$('.modal').on('hidden.bs.modal', function () {
	  $(this).find('form')[0].reset();
	});



	var form = $('.modal form');
	// form.submit(sendPreRegisterForm);
	//form.validate();
	$('#submit_form_button').click(function(){
		form.submit();
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