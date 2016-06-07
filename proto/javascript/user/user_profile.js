var currentPage = 1;
var itemsPerPage = 20;
var totalPageNumber = 1;

$(document).ready(function(){

	initBookings(username);
	initHistory();
	
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
		var itemURL = "pages/inventory/item.php?category=" + data[i]['category'] + "&subcategory=" + data[i]['subcategory'] + "&item=" + data[i]['name'];
		
		$line.html("<td><a href=\""+ itemURL +"\">" + data[i]['name']+ "</a></td>" +
			"<td><a href=\"#\">" + data[i]['category'] + "</a></td>" +
			"<td><a href=\"#\">" + data[i]['subcategory'] + "</a></td>" +
			"<td class=\"startDate\">" + $startD + "</td>" +
			"<td class=\"endDate\">" + $endD + "</td>" +
			"<td class=\"editButton\"><a onCLick=\"editBookingForm(" + data[i]['id'] + ")\" title=\"Edit Booking\">Edit</a></td>" + 
			"<td><a onClick=\"removeBooking(" + data[i]['id'] + ")\" title=\"Remove Booking\"><span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"></span></a></td></tr>");
		$bookingsBody.append($line);
	}
}

function initHistory(){
	$.get( "api/user/get_user_history.php", 
		{ 
			limit : itemsPerPage,
			offset : (currentPage-1) * itemsPerPage
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
	var history = data['items'];
	var maxHistory = data['max'];

	updateHistoryItems(history);
	updatePages(maxHistory);
}

function updateHistoryItems(data){
	var $historyBody = $('#history-body');
	$historyBody.html('');


	for (var i = 0; i < data.length; i++) {
		//alert(data[i]['name']);
		$line = $("<tr>");
		var itemURL = "pages/inventory/item.php?category=" + data[i]['category'] + "&subcategory=" + data[i]['subcategory'] + "&item=" + data[i]['name'];
		$line.html("<td>" + data[i]['date']+ "</td>" +
			"<td>" + data[i]['type'] + "</td>" +
			"<td><a href=\""+ itemURL +"\">" + data[i]['name'] + "</a></td>" +
			"<td><a href=\"#\">" + data[i]['category'] + "</a></td>" +
			"<td><a href=\"#\">" + data[i]['subcategory'] + "</a></td>");
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
	$startColumn.html("<td class=\"startDate\"><input id=\"start" + id + "\" type=\"date\" name=\"date\" value=\"" +  startTS + "\"></td>");
	$endColumn.html("<td class=\"endDate\"><input id=\"end" + id + "\" type=\"date\" name=\"date2\" value=\"" +  endTS + "\"></td>");
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
				if (data == false)
					alert("Booking edit failed");
				location.reload();
		});

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
	initHistory();
}

function onPreviousButtonClick(event){
	event.preventDefault();
	--currentPage;
	initHistory();
}

function onNextButtonClick(event){
	event.preventDefault();
	++currentPage;
	initHistory();
}

var url = document.location.toString();
if (url.match('#')) {
	$('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
} 

// Change hash for page-reload
$('.nav-tabs a').on('shown.bs.tab', function (e) {
	window.location.hash = e.target.hash;
})

