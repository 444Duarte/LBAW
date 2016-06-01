$(document).ready(function(){

	initBookings(username);
	//initHistory(username);
	
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
		$line = $("<tr>");
		$line.html("<td><a href=\"#\">" + data[i]['name']+ "</a></td>" +
			"<td><a href=\"#\">" + data[i]['category'] + "</a></td>" +
			"<td><a href=\"#\">" + data[i]['subcategory'] + "</a></td>" +
			"<td>" + data[i]['start_date'] + "</td>" +
			"<td>" + data[i]['end_date'] + "</td>" +
			"<td>Edit</td>" + 
			"<td><a onClick=\"removeBooking(" + data[i]['id'] + ")\" title=\"Remove Booking\"><span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"></span></a></td></tr>");
		$bookingsBody.append($line);
	}
}

function initHistory(name){
	$.get( "api/user/get_user_bookings.php", 
		{ 
			username : name
		})
		.done(function( data ) {
			updateHistory(data);
	});
}

function updateHistory(data){
	var $historyBody = $('#history-body');
	$historyBody.html('');


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
		$historyBody.append($line);
	}
}

function removeBooking(id){
	$.get( "actions/user/remove_booking.php", 
		{ 
			id : id
		})
		.done(function( data ) {
			location.reload();

	})
		.fail(function(error){
			alert("error");
		});
}


var url = document.location.toString();
if (url.match('#')) {
	$('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
} 

// Change hash for page-reload
$('.nav-tabs a').on('shown.bs.tab', function (e) {
	window.location.hash = e.target.hash;
})

