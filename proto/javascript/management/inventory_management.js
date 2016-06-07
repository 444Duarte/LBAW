var currentPage = 1;
var itemsPerPage = 10;
var totalPageNumber = 1;

$(document).ready(function(){

	initItems();

	$('.modal').on('shown.bs.modal', function (e) {
		var $button = $(e.relatedTarget);
	  $(this).find('input')[0].focus();
	  $(this).find('input[name="category"]').attr('value', $button.data('category'));
	  $(this).find('input[name="subcategory"]').attr('value', $button.data('subcategory'));
	  $(this).find('input[name="item"]').attr('value', $button.data('item'));
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
	    },
	    error: function(response){
			alertify.logPosition("bottom right");
	    	alertify.error("Request failed");
	    		    
	    }
	});
	e.preventDefault();
	dom.closest('.modal').modal('toggle');
};

function initItems(){

	$.get( "api/management/get_item_list.php", 
		{ 
			limit : itemsPerPage,
			offset : (currentPage-1) * itemsPerPage
		})
		.done(function( data ) {
			updateItems(data);
		})
		.fail(function(error){
			var errorMessage = '<%= Session["error_messages"] %>';
			alert(errorMessage);
		});
}

function updateItems(data){
	var items = data['items'];
	var max = data['max'];

	updateItemsDisplayed(items);
	updatePages(max);
}

function updateItemsDisplayed(data){
	var historyBody = $('#item-list-table');
	

	historyBody.html('');

	for (var i = 0; i < data.length; i++) {
		$line = $("<tr>");
		var itemURL = "pages/inventory/item.php?category=" + data[i]['category'] + "&subcategory=" + data[i]['subcategory'] + "&item=" + data[i]['name'];
		var cateURL = "pages/inventory/category.php?category=" + data[i]['category'];
		var subcatURL = "pages/inventory/subcategory.php?category=" + data[i]['category'] + "&amp;subcategory=" + data[i]['subcategory'];
		var Iname = data[i]['name'];
		var Icategory = data[i]['category'];
		var IsubCategory = data[i]['subcategory'];


		var info = "<td><a href=\""+ itemURL +"\">" + Iname + "</a></td>" +
			"<td><a href=\""+ cateURL +"\">" + Icategory + "</a></td>" +
			"<td><a href=\""+ subcatURL +"\">" + IsubCategory + "</a></td>";
		
		var remBool = data[i]['removed'];
		var avaib, actionI;
		var starsInfo = "<td>";

		if(remBool == false)
			avaib = "<td>Available</td>";
		else
			avaib = "<td>Removed</td>";

		for (var idStar =1; idStar <= 5; idStar++){
			if (idStar < data[i]['condition'])
				starsInfo = starsInfo + "<span class=\"glyphicon glyphicon-star\" aria-hidden=\"true\"></span>";
			else
				starsInfo = starsInfo + "<span class=\"glyphicon glyphicon-star-empty\" aria-hidden=\"true\"></span>";
		}

		starsInfo = starsInfo + "</td>";

		if (!remBool){
			actionI = "<td><a href=\"javascript:;\" title=\"Remove item\" data-toggle=\"modal\" data-target=\"#remove-item-modal\" data-category=\""+ Icategory +"\" data-subcategory=\""+ IsubCategory +"\" data-item=\""+ Iname +"\"><span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"></span></a></td>";
		}
		else{
			actionI = "<td><a href=\"javascript:;\" title=\"Add item\" data-toggle=\"modal\" data-target=\"#add-confirmation-modal\" data-category=\""+ Icategory +"\" data-subcategory=\""+ IsubCategory +"\" data-item=\""+ Iname +"\"><span class=\"glyphicon glyphicon-ok\" aria-hidden=\"true\"></span></a></td>";
		}

		var result = info + avaib + starsInfo + actionI;

		$line.html(result);
		historyBody.append($line);
	}
	
	
}

function pageNumberAppears(number){
	if(number <= (currentPage+2) && (number >= (currentPage-2)))
		return true;
	if((number == 1) || (number == totalPageNumber))
		return true;
	else
		return false;
}

function updatePages(maxItems){
	totalPageNumber = Math.ceil(maxItems/itemsPerPage)
	var items = maxItems;

	var $pageList = $("#pagination");
	$pageList.html("");
	var $previousButton = $("<li>");
	if(currentPage == 1){
		$previousButton.addClass("disabled");
	}
	else {
		$previousButton.click(onPreviousButtonClick);
	}
	$previousButton.html("<a aria-label=\"Previous\"><span aria-hidden=\"true\">&laquo;</span></a>");
	$pageList.append($previousButton);

	for(var i = 1; i <= totalPageNumber; ++i){
		if (!pageNumberAppears(i))
			continue;
		$page = $("<li>");
		$page.html("<a>" + i + "</a>");
		$page.click(onPageClick);
		$page.attr('number', i);
		if(i == currentPage){
			$page.addClass("active");
		}
		$pageList.append($page);
	}

	$nextButton = $("<li>");
	$nextButton.html("<a aria-label=\"Next\"><span aria-hidden=\"true\">&raquo;</span></a>");
	if(currentPage == totalPageNumber){
		$nextButton.addClass("disabled");
	}
	else {
		$nextButton.click(onNextButtonClick);
	}
	$pageList.append($nextButton);
}

function onPageClick(event){
	event.preventDefault();
	currentPage = $(this).attr('number');
	initItems();
}

function onPreviousButtonClick(event){
	event.preventDefault();
	--currentPage;
	initItems();
}

function onNextButtonClick(event){
	event.preventDefault();
	++currentPage;
	initItems();
}