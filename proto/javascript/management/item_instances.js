	//item
	//itemInstances
	//reservations;

function updateLendForm(instance){

	var form = $('#lend-item-form');


	for(var i = 0; i < reservations.length; i++){
		var reserva = reservations[i];
		if (reserva['id_item_instance'] == instance){
			var start = new Date(reserva['start_time']);
			var end = new Date(reserva['end_time']);
			var today = new Date();

			if (start <= today && end > today){
				resetLendForm();

				var clientInput = document.getElementById("lend-item-form").elements[0];
				clientInput.value = reserva['username'];

				var dateInput = document.getElementById("lend-item-form").elements[1];
				dateInput.value = reserva['end_time'];

				var idInput = document.getElementById("lend-item-form").elements[2];
				idInput.value = reserva['id_item_instance'];

				var todayInput = document.getElementById("lend-item-form").elements[3];
				var todayS = today.getFullYear() + "-" + (today.getMonth() + 1) + "-" + today.getDate();
				todayInput.value = todayS;
				//alert(todayS);
				//alert(reserva['username'] + " " + reserva['end_time']);
				return;
			}
		}
	}

	form.html('<span>No reservations for today</span>');

}

function resetLendForm(){
	var form = $('#lend-item-form');
	form.html('Client:<br><input type="text" name="client" required><br>End Date:<br><input type="date" name="end_date" required><input type="hidden" name="id"><input type="hidden" name="today">');
}

function updateReturnForm(instance, state){
	var today = new Date();
	var idInput = document.getElementById("return-item-form").elements[0];
	idInput.value = instance;
	var todayS = today.getFullYear() + "-" + (today.getMonth() + 1) + "-" + today.getDate();
	var todayInput = document.getElementById("return-item-form").elements[1];
	todayInput.value = todayS;
	var todayInput = document.getElementById("return-item-form").elements[2];
	todayInput.value = state;

}

function updateMaintenance(instance){
	var today = new Date();
	var idInput = document.getElementById("maintenance-item-form").elements[2];
	idInput.value = instance;
	var todayS = today.getFullYear() + "-" + (today.getMonth() + 1) + "-" + today.getDate();
	var todayInput = document.getElementById("maintenance-item-form").elements[3];
	todayInput.value = todayS;
}