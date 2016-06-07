var selectedInstance = 0;
var dates = new Array();
var reservations = JSON.parse($('#reservations').html());

$(document).ready(function() {
  
  updateDates(reservations);

  $('.datepicker').datepicker({
    beforeShowDay: function(date) {
      var search = date.getFullYear() + '/' + (date.getMonth() + 1) + '/' + date.getDate();

      //if (search in dates) {
      if (jQuery.inArray(search, dates) == -1){
        return [true, 'highlight', (dates[search] || '')];
      }

      return [false, '', ''];
    }
  });

});

function updateDates(reservations){
  dates = new Array();

  for(var i = 0; i < reservations.length; i++){

    if(reservations[i].id_item_instance != selectedInstance)
      continue;

    var start = new Date(reservations[i].start_time);
    var end = new Date(reservations[i].end_time);

    var result = getDates(start, end);
    for(var x = 0; x < result.length; x++){
      var data = result[x].getFullYear() + "/" + (result[x].getMonth() + 1) + '/' + result[x].getDate();
      dates.push(data);
    }

  }
}

Date.prototype.addDays = function(days) {
    var dat = new Date(this.valueOf())
    dat.setDate(dat.getDate() + days);
    return dat;
}

function getDates(startDate, stopDate) {
    var dateArray = new Array();
    var currentDate = startDate;
    while (currentDate <= stopDate) {
        dateArray.push( new Date (currentDate) )
        currentDate = currentDate.addDays(1);
    }
    return dateArray;
}

function updateSelectedInstance(){
  var e = document.getElementById("selectForm");
  var strUser = e.options[e.selectedIndex].value;
  selectedInstance = strUser;
  updateDates(reservations);
};

$( "#selectForm" ).change(function() {
  updateSelectedInstance();
});
