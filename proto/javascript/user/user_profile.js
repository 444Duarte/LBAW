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
		$startD = data[i]['start_date'];
		$endD = data[i]['end_date'];
		$line = $("<tr id=\"bookingN" + data[i]['id'] + "\">");
		$line.html("<td><a href=\"#\">" + data[i]['name']+ "</a></td>" +
			"<td><a href=\"#\">" + data[i]['category'] + "</a></td>" +
			"<td><a href=\"#\">" + data[i]['subcategory'] + "</a></td>" +
			"<td class=\"startDate\">" + $startD + "</td>" +
			"<td class=\"endDate\">" + $endD + "</td>" +
			"<td class=\"editButton\"><a onCLick=\"editBookingForm(" + data[i]['id'] + ")\" title=\"Edit Booking\">Edit</a></td>" + 
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
		})
		.fail(function(error){
			var errorMessage = '<%= Session["error_messages"] %>';
			alert(errorMessage);
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
			var successMessage = '<%= Session["success_messages"][] %>';
			//alert(data);
			location.reload();

	})
		.fail(function(error){
			var errorMessage = '<%= Session["error_message"] %>';
			alert(errorMessage);
		});
}

function editBookingForm(id){
	$bookLine = $("#bookingN"+id);
	$startColumn = $("#bookingN"+id+" .startDate");
	$endColumn = $("#bookingN"+id+" .endDate");
	var startDate = $startColumn.text();
	var endDate = $endColumn.text();
	$editButton = $("#bookingN"+id+" .editButton");

	var str = "<td class=\"editButton\"><a onClick=\"submitEditDate("+ id +")\"><span>Submit </span></a><a onClick=\"cancelEditDate(";
	var str2 = str.concat(id + ", \'" + startDate + "\', \'" + endDate + "\')\"><span>Cancel</span></a></td>");


	startTS = startDate.replace(" ", "T");
	endTS = endDate.replace(" ", "T");

	$startColumn.html('');
	$startColumn.html("<td class=\"startDate\"><input id=\"start" + id + "\" type=\"datetime-local\" name=\"date\" value=\"" +  startTS + "\"></td>");
	$endColumn.html("<td class=\"endDate\"><input id=\"end" + id + "\" type=\"datetime-local\" name=\"date2\" value=\"" +  endTS + "\"></td>");
	$editButton.html(str2);
}

function cancelEditDate(id, start, end){
	$startColumn = $("#bookingN"+id+" .startDate");
	$endColumn = $("#bookingN"+id+" .endDate");
	$editButton = $("#bookingN"+id+" .editButton");

	$startColumn.html('');
	$startColumn.html(start);
	$endColumn.html(end);
	$editButton.html("<td class=\"editButton\"><a onCLick=\"editBookingForm(" + id + ")\" title=\"Edit Booking\">Edit</a></td>");

}

function submitEditDate(id){
	$startColumn = $("#bookingN"+id+" .startDate");
	$endColumn = $("#bookingN"+id+" .endDate");
	startDate = document.getElementById('start'+id).value.replace("T", " ");
	endDate = document.getElementById('end'+id).value.replace("T", " ");

	$.get( "actions/user/edit_booking.php", 
		{ 
			id : id,
			start : startDate,
			end : endDate
		})
		.done(function( data ) {
			location.reload();
	});
}

//esta função não pertence a este ficheiro, mas para testar vou fazê-lo aqui. Lembrar de mudar.
function bookItem(idClient, itemInstance, startDate, endDate){

	idCLient = 71;
	itemInstance = 20;
	startDate = "2016-07-01 10:00:00";
	endDate = "2016-07-02 10:00:00";


	var url = "actions/user/book_item.php";
    $.ajax({
      url: url,
      data: {id_client = idClient, item_instance = itemInstance, start_date = startDate, end_date = endDate}, //parameters go here in object literal form
      type: 'GET',
      datatype: 'json',
      success: function(data) { alert('got here with data'); },
      error: function() { alert('something bad happened'); }
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

