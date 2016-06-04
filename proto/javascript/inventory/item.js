function bookItem(idClient, itemInstance, startDate, endDate){
/*
	//valores de teste
	idClient = 71;
	itemInstance = 20;
	startDate = "2016-07-01 10:00:00";
	endDate = "2016-07-03 11:00:00";
*/
	//alert($USERNAME);
	var url = "actions/user/book_item.php";
    $.ajax({
      url: url,
      data: {id_client : idClient, item_instance : itemInstance, start_date : startDate, end_date : endDate}, 
      type: 'POST',
      datatype: 'json',
      success: function(data) { console.log(data); },
      error: function() { alert('something bad happened'); }
    });
}