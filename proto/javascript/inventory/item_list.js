var currentPage = 1;
var itemsPerPage = 8;

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

	for (var i = 0; i < items.length; i += 4) {
		$itemrow = $('<row>');

		for(var j = i; j < items.length && (j < (i + 4)); ++j){
			$item = $('<div class="col-xs-6 col-md-3">');
			$item.html("<a class=\"thumbnail\">" + "<img src=\"images/res/" + items[j]['picture'] + "\"alt=\"" +items[j]['name'] + "\"> <div class=\"caption\"><h3>"+items[j]['name']+"</h3></div></a></div>");
			
			$itemrow.append($item);
		}

		$itemlist.append($itemrow);
	}
}

function pageNumberAppears(number){
	if(number > currentPage-2 && number < currentPage+2)
		return true;
	if(number == 1 || number == Math.ceil(maxItems/itemsPerPage))
		return true;
	else
		return false;
}

function updatePages(maxItems){
	console.log(maxItems);
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

	console.log(Math.ceil(maxItems/itemsPerPage));

	for(var i = 1; i <= Math.ceil(maxItems/itemsPerPage); ++i){
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
	if(currentPage == Math.ceil(maxItems/itemsPerPage)){
		$nextButton.addClass("disabled");
	}
	else {
		$nextButton.click(onNextButtonClick);
	}
	$pageList.append($nextButton);
}