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

function initItemList(){
	$.getJSON("api/inventory/get_item_list.php",
	{
		nItems : itemsPerPage
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

function updatePages(maxItems){
	console.log(maxItems);
	var items = maxItems;

	var $pageList = $("#pagination");
	$pageList.html("<li class=\"disabled\"><a href=\"#\" aria-label=\"Previous\"><span aria-hidden=\"true\">&laquo;</span></a></li>");

	console.log(Math.ceil(maxItems/itemsPerPage));

	for(var i = 1; i <= Math.ceil(maxItems/itemsPerPage); ++i){
		$page = $("<li>");
		$page.html("<a href=\"#\">" + i + "</a>");
		$page.click(onPageClick);
		$page.attr('number', i);
		if(i == currentPage){
			$page.addClass("active");
		}
		$pageList.append($page);
	}

	$nextButton = $("<li>");
	$nextButton.html("<a href=\"#\" aria-label=\"Next\"><span aria-hidden=\"true\">&raquo;</span></a>");
	if(maxItems > 1){
		$nextButton.addClass("disabled");
	}
	$pageList.append($nextButton);
}