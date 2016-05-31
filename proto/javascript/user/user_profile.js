$(document).ready(function(){

	//alert(username);
	initBookings(username);
	//initHistory();
	
});

function initBookings(username){

	alert("cenas");

	$.getJSON("api/user/get_user_bookings.php",
	{
		username : username
	},
		updatePage 
	);

	alert("cenas2");
}

function updatePage(data){
	alert(data);
}

function updateItems(items){
	
	var $itemlist = $('#item-list');
	$itemlist.html('');

	for (var i = 0; i < items.length; i += itemsPerPage/rows) {
		$itemrow = $('<row>');

		for(var j = i; j < items.length && (j < (i + itemsPerPage/rows)); ++j){
			$item = $('<div class="col-xs-6 col-md-3">');
			$item.html("<a class=\"thumbnail\">" + "<img src=\"images/res/" + items[j]['picture'] + "\"alt=\"" +items[j]['name'] + "\"> <div class=\"caption\"><h3>"+items[j]['name']+"</h3></div></a></div>");
			
			$itemrow.append($item);
		}

		$itemlist.append($itemrow);
	}
}



var url = document.location.toString();
if (url.match('#')) {
	$('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
} 

// Change hash for page-reload
$('.nav-tabs a').on('shown.bs.tab', function (e) {
	window.location.hash = e.target.hash;
})

