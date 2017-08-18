$(document).ready(function() {
    $('.Set1CF').click(function() {
		var id = $(this).attr('id');
		var cf = document.getElementById(id);
		var err = document.getElementById('err'+id);
		if(!(cf.value == '' || parseFloat(cf.value) > parseFloat(cf.max))){
			err.innerHTML = '';
			var confirmation = confirm('Set CF for particular employee?');
			if(confirmation){
				var employeeCode1 = document.getElementById('employeeCode').value;
				var year1 = document.getElementById('year').value;
				var code1 = id.substring(3, id.lastIndexOf("]"));

				$.post("update.php", 
					{ employeeCode : employeeCode1, year : year1, code : code1, days : cf.value }, 
					function(){
						err.innerHTML = 'Updated';
					});
				
			}
		}
		else{
			err.innerHTML = 'Invalid CF';
		}
    });
	
	
	$( ".datePicker" ).datepicker({dateFormat: "yy-mm-dd"});
	
	$( ".calendar-day" ).tooltip();
});


