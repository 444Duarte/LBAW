$("document").ready(function(){
	initItemList();
});

function initItemList(){
	$.getJSON("api/inventory/get_item_list.php",
	{
		nItems : 8
	},
	displayItems
	);
}

function displayItems(data){
	console.log(data);
	var items = data['items'];
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