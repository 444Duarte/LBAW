var currentPage = 1;
var itemsPerPage = 8;
var rows = 2;
var totalPageNumber = 1; 

$("document").ready(function(){
	initItemList();
});

function onPageClick(event){
	event.preventDefault();
	currentPage = $(this).attr('number');
	initItemList();
}

function onPreviousButtonClick(event){
	event.preventDefault();
	--currentPage;
	initItemList();
}

function onNextButtonClick(event){
	event.preventDefault();
	++currentPage;
	initItemList();
}

function initItemList(){
	$.getJSON("api/inventory/get_item_list.php",
	{
		nItems : itemsPerPage,
		start : (currentPage-1) * itemsPerPage
	},
	updatePage
	);
}

function updatePage(data) {
	console.log('Data: ' + data);
	var items = data['items'];
	var maxItems = data['max'];

	updateItems(items);
	updatePages(maxItems);
}

function updateItems(items){
	
	var $itemlist = $('#item-list');
	$itemlist.html('');

	for (var i = 0; i < items.length; i += itemsPerPage/rows) {
		$itemrow = $('<row>');

		for(var j = i; j < items.length && (j < (i + itemsPerPage/rows)); ++j){
			$item = $('<div class="col-xs-6 col-md-3">');
			$item.html("<a class=\"thumbnail\" href=\"pages/inventory/item.php?category=" + items[j]['category'] + "&subcategory=" + items[j]['subcategory'] + "&item=" + items[j]['name'] + "\">" + "<img src=\"images/res/" + items[j]['picture'] + "\"alt=\"" +items[j]['name'] + "\"> <div class=\"caption\"><h3>"+items[j]['name']+"</h3></div></a></div>");
			
			$itemrow.append($item);
		}

		$itemlist.append($itemrow);
	}
}

function pageNumberAppears(number){
	console.log(number);
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