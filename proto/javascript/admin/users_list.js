var usersPerPage = 10;
var currentPage = 1;
var currentPageBanned = 1;
var totalPageNumber = 1; 
var totalPageNumberBanned = 1; 


$(document).ready(function(){
	initUserList(true);
	initUserList(false);

	$('.modal').on('shown.bs.modal', function () {
	  $(this).find('input')[0].focus();
	});

	$('.modal').on('hidden.bs.modal', function () {
	  $(this).find('form')[0].reset();
	});


	$('.form-submit').click(function () {
		$(this).children('form').submit();
	});

	var form = $('.modal form');
	form.submit(sendPreRegisterForm);
	form.validate();
	$('#submit_form_button').click(function(){
		form.submit();
	});
});

function initUserList(banned){
	if (banned){
		$.getJSON("api/admin/get_user_list.php",
		{
			nUsers : usersPerPage,
			start : (currentPage-1) * usersPerPage,
			banned : banned
		},
		updatePageBanned
		);
	}
	else {
		$.getJSON("api/admin/get_user_list.php",
		{
			nUsers : usersPerPage,
			start : (currentPage-1) * usersPerPage,
			banned : banned
		},
		updatePageUnbanned
		);
	}
}

function updatePageBanned(data) {
	var users = data['users'];
	var maxUsers = data['max'];

	updateUsers(users, true);
	updatePages(maxUsers, true);
}

function updatePageUnbanned(data) {
	var users = data['users'];
	var maxUsers = data['max'];

	updateUsers(users, false);
	updatePages(maxUsers, false);
}

function updateUsers(data, banned){
	// note to self: activeUsers != active-users
	if (banned)
		var $activeUsers = $('#banned-users > tbody');
	else
		var $activeUsers = $('#active-users > tbody');
	$activeUsers.html('');

	for(var i = 0; i < data.length; ++i){
		var userRow = '<td>' + data[i]['username'] + '</td><td>' + data[i]['type'] + '</td>';
		if(!banned){
			var lastRow = '<td><a class="block-user-botton form-submit" href="javascript:;" title="Block Account"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span><form class="block-user-form" action="/~up201304205/proto/actions/admin/block_user.php" method="post"><input type="hidden" name="user" value="' + data[i]['id'] + '"></form></a></td>';
		}
		else {
			var lastRow = '<td><a href="javascript:;" class="form-submit" title="Revive Account"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><form class="revive-user-form" action="{$BASE_URL}actions/admin/revive_user.php" method="post"><input type="hidden" name="user" value="' + data[i]['id'] + '"></form></a></td> ';
		}
		var $userRow = $('<tr>');
		userRow += lastRow;
		$userRow.html(userRow);

		$activeUsers.append($userRow);
	}
}

function onPageClick(event, banned){
	event.preventDefault();
	if (!banned){
		currentPage = $(this).attr('number');
	}
	else {
		currentPage = $(this).attr('number-banned');
	}
	initUserList(banned);
}

function onPreviousButtonClick(event, banned){
	event.preventDefault();
	if (!banned)
		--currentPage;
	else
		--currentPageBanned;
	initUserList(banned);
}

function onNextButtonClick(event, banned){
	event.preventDefault();
	if (!banned)
		++currentPage;
	else
		++currentPageBanned;
	initUserList(banned);
}

function pageNumberAppears(number, banned){
	if(banned)
		return pageNumberAppearsBanned(number);
	else
		return pageNumberAppearsNotBanned(number);

}

function pageNumberAppearsBanned(number){
	if(number <= (currentPageBanned+2) && (number >= (currentPageBanned-2)))
		var ret = true;
	if((number == 1) || (number == totalPageNumberBanned))
		var ret = true;
	else
		var ret = false;
	return ret;
}

function pageNumberAppearsNotBanned(number){
	if(number <= (currentPage+2) && (number >= (currentPage-2)))
		var ret = true;
	if((number == 1) || (number == totalPageNumber))
		var ret = true;
	else
		var ret = false;
	return ret;
}

function updatePages(maxUsers, banned){
	if (!banned)
		totalPageNumber = Math.ceil(maxUsers/usersPerPage)
	else
		totalPageNumberBanned = Math.ceil(maxUsers/usersPerPage)

	var users = maxUsers;

	if(!banned)
		var $pageList = $("#pagination");
	else
		var $pageList = $("#pagination-banned");

	$pageList.html("");
	var $previousButton = $("<li>");
	if(banned)
		var thePage = currentPageBanned;
	else
		var thePage = currentPage;
	if(thePage == 1){
		$previousButton.addClass("disabled");
	}
	else {
		if(banned){
			$previousButton.click(function(event){
				onPreviousButtonClick(event, true);
			});
		}
		else {
			$previousButton.click(function(event){
				onPreviousButtonClick(event, false);
			});
		}
	}
	$previousButton.html("<a aria-label=\"Previous\"><span aria-hidden=\"true\">&laquo;</span></a>");
	$pageList.append($previousButton);

	if(!banned){
		var pageTotal = totalPageNumber;
	}
	else {
		var pageTotal = totalPageNumberBanned;		
	}

	for(var i = 1; i <= pageTotal; ++i){
		if (!pageNumberAppears(i, banned))
			continue;
		$page = $("<li>");
		$page.html("<a>" + i + "</a>");
		if (banned){
			$page.click(function(event){
				onPageClick(event, true);
			});
		}
		else {
			$page.click(function(event){
				onPageClick(event, false);
			});
		}
		$page.attr('number', i);
		if(i == currentPage){
			$page.addClass("active");
		}
		$pageList.append($page);
	}

	$nextButton = $("<li>");
	$nextButton.html("<a aria-label=\"Next\"><span aria-hidden=\"true\">&raquo;</span></a>");
	
	if (!banned){
		if(currentPage == totalPageNumber){
			$nextButton.addClass("disabled");
		}
		else {
			$nextButton.click(function(event){
				onNextButtonClick(event, false);
			});
		}
	}
	else {
		if(currentPageBanned == totalPageNumberBanned){
			$nextButton.addClass("disabled");
		}
		else {
			$nextButton.click(function(event){
				onNextButtonClick(event, true);
			});
		}
	}
	$pageList.append($nextButton);
}

function sendPreRegisterForm(e) {
	var dom = $(this);
	var inputs = dom.find('input');
	for (var i = 0; i < inputs.length; i++) {
		if(!inputs[i].checkValidity()){
			return false;
		}
	}
	var action = dom.attr("action");
	var data = dom.serialize();
	$.ajax({url: action, 
		type: 'post',
		data: data, 
		success: function(response){
			var result = response['result'];
			var message = response['message'];
			alertify.logPosition("bottom left");
	    	alertify.log(message);
	    },
	    error: function(response){
			alertify.logPosition("bottom left");
	    	alertify.log("Request failed");
	    	//$('body').append(response['responseText']);	    
	    }
	});
	e.preventDefault();
	$('#add-user-modal').modal('toggle');
};
