$(document).ready(function(){

	//alert(username);
	initBookings(username);
	//initHistory();
	
});

function initBookings(name){

	$.get( "api/user/get_user_bookings.php", 
		{ 
			username : name
		})
		.done(function( data ) {
			updateBookings(data);
	});
}

function updateBookings(data){
	var $bookingsBody = $('#bookings-body');
	$bookingsBody.html('');


	for (var i = 0; i < data.length; i++) {
		//alert(data[i]['name']);
		$line = $("<tr>");
		$line.html("<td><a href=\"#\">" + data[i]['name']+ "</a></td>" +
			"<td><a href=\"#\">" + data[i]['category'] + "</a></td>" +
			"<td><a href=\"#\">" + data[i]['subcategory'] + "</a></td>" +
			"<td>" + data[i]['start_date'] + "</td>" +
			"<td>" + data[i]['end_date'] + "</td>" +
			"<td>Edit</td>" + 
			"<td><a href=\"\" title=\"Remove Booking\"><span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"></span></a></td></tr>");
		$bookingsBody.append($line);
	}
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

