function validateForm(formName) {
	var valid = true;
	
	valid = validateInput('formInput') && valid;

	if(formName == 'leaveTypeForm'){
		var criteriaVal = document.getElementById('criteria').value;
		if(criteriaVal == 1){
			var criterias = document.getElementsByClassName('criterias');
			var err = document.getElementById('errNoCriteria');
			if(criterias.length < 1){
				err.innerHTML = 'Please add at least one criteria';
				valid = false;
			}
			else {
				err.innerHTML = '';
			}
		}
	}
	else if (formName == 'leaveAppForm'){
		var leaveType = document.getElementById('leaveType');
		var days = parseFloat(document.getElementById('days').value);
		var holiday = document.getElementById('holiday').value;
		holiday = holiday.split("/");
		var dateFrom = document.getElementById('dateFrom');
		var dateTo = document.getElementById('dateTo');
		var errFrom = document.getElementById('errdateFrom');
		var errTo = document.getElementById('errdateTo');
		
		if(leaveType.value != ''){
			var val = document.getElementById(leaveType.value);
			var err = document.getElementById('errdays');
			if(val != null){
				var entitlements = val.value.split("XXYYXX");
				
				if(days > entitlements[2]){
					err.innerHTML = '<br>The applied days are more than your ' 
						+ leaveType.value + ' balance';
					valid = false;
				} 
				else {
					err.innerHTML = '<br>';
				}
			}
			else{
				err.innerHTML = '<br>No Entitlement for this Leave';
				valid = false;
			}
		}
		if(dateFrom.value != '' && dateTo.value != ''){
			var dateValid = dateFrom.value.search("-") != -1;
			if(dateValid){
				var test = dateFrom.value.split('-');
				if(test.length == 3)
					dateValid = !(test[0].length != 4 || test[1].length != 2 || test[2].length != 2);
				else
					dateValid = false;
			}
			
			dateValid = dateTo.value.search("-") != -1;
			if(dateValid){
				var test = dateTo.value.split('-');
				if(test.length == 3)
					dateValid = !(test[0].length != 4 || test[1].length != 2 || test[2].length != 2);
				else
					dateValid = false;
			}
			if(dateValid){
				var thisYear = new Date();
				thisYear = thisYear.getFullYear();
				var dateFromYear = dateFrom.value.substr(0,4);
				var dateToYear = dateTo.value.substr(0,4);
				if(dateFromYear != thisYear){
					errFrom.innerHTML = '<br>Unable to apply leave on next year';
					valid = false;
				}
				else if(dateToYear != thisYear){
					errTo.innerHTML = '<br>Unable to apply leave on next year';
					valid = false;
				}
				else if(days == 0.5 || days == 1){
					
					var i = 0;
					var same = false;
					while(i < holiday.length && !same){
						if(dateFrom.value == holiday[i]){
							errFrom.innerHTML = '<br>This date is a holiday';
							same = true;
							valid = false;
						}
						else if(dateTo.value == holiday[i] && !dateTo.disabled){
							errTo.innerHTML = '<br>This date is a holiday';
							same = true;
							valid = false;
						}
						else{
							errFrom.innerHTML = '<br>';
							errTo.innerHTML = '<br>';
						}
						i++;
					}
				}
			}
		}
	}
	else if(formName == 'holidayScheduleForm'){
		var holiday = document.getElementById('holiday').value;
		holiday = holiday.split("/");
		var hsDate = document.getElementById('hsDate');
		var err = document.getElementById('errhsDate');
		var hsId = document.getElementById('hsId').value;
		
		if(hsId == ''){
			var i = 0;
			var same = false;
			while(i < holiday.length && !same){
				if(hsDate.value == holiday[i]){
					err.innerHTML = 'Holiday existed';
					same = true;
					valid = false;
				}
				else{
					err.innerHTML = '';
				}
				i++;
			}
		}
	}
	else if (formName == 'yearForm'){
		var yearValue = document.getElementById('year').value;
		var year = parseInt(yearValue);
		var thisYear = (new Date()).getFullYear();
		var err = document.getElementById('erryear');
		if(yearValue.length != 4){
			err.innerHTML = 'Year should be 4 digit.';
			valid = false;
		}
		else{
			err.innerHTML = '';
		}
	}

	if(valid){
		valid = confirm('Confirm Submission?');
	}
	
	return valid;
}

function validateInput(inputClass){
	var valid = true;
	var inputs = document.getElementsByClassName(inputClass);
	var br = '';
	
	if(inputClass == 'criteriaInput')
		br = '<br>';
	
	for(var x = 0; x < inputs.length; x++){
		var input = inputs[x];
		var err;
		if(!input.disabled){
			if(inputClass == 'form-control')
			{
				err = document.getElementById('errLogin');
			}
			else{
				err = document.getElementById('err' + input.name);
			}
			
			if(err.innerHTML.substr(0,4) == '<br>')
				br = '<br>';
			
			if(input.value == ''){
				err.innerHTML = br + 'Invalid Input';
				valid = false;
			}
			else{
				if(input.type == 'number'){
					var num = parseFloat(input.value);
					if(isNaN(num)){
						err.innerHTML = br + 'Invalid Input';
						valid = false;
					}
					else if(num < 0){
						err.innerHTML = br + 'Invalid Input';
						valid = false;
					}	
					else if(input.max != null && num > parseFloat(input.max)){
						err.innerHTML = br + 'Invalid Input';
						valid = false;
					}
					else{
						err.innerHTML = "";
					}
				}
				else if(input.type == 'text'){
					if(input.value.length > 255){
						err.innerHTML = br + 'Exceeded 255 words';
						valid = false;
					}
					else{
						err.innerHTML = br + '';
					}
				}
				else if(input.className.search("datePicker") != -1){
					if(input.value.search("-") != -1){
						var test = input.value.split('-');
						if(test.length == 3){
							if(test[0].length != 4 || test[1].length != 2 || test[2].length != 2){
								err.innerHTML = br + 'Invalid Input. Format = "YYYY-MM-DD"';
								valid = false;
							}
							else{
								err.innerHTML = br + '';
							}
						}
						else{
							err.innerHTML = br + 'Invalid Input. Format = "YYYY-MM-DD"';
							valid = false;
						}
					}
					else
					{
						err.innerHTML = br + 'Invalid Input. Format = "YYYY-MM-DD"';
						valid = false;
					}
				}
				else
					err.innerHTML = br + "";
			}
		}
	}

	if(inputClass == 'criteriaInput'){
		
		var err = document.getElementById('err' + inputs[0].name);
		var yearFrom = inputs[0].value;
		var yearTo = inputs[1].value;
		
		if(yearFrom != '' && yearTo != ''){
			yearFrom = parseInt(yearFrom);
			yearTo = parseInt(yearTo);
			if(yearFrom >= yearTo){
				err.innerHTML = '<br>Year From should not be larger than Year To';
				valid = false;
			}
			else{
				var criterias =  document.getElementsByClassName('criterias');;
				var i = 0;
				var within = false;
				
				while(i<criterias.length && !within){
					var criteria = criterias[i].value.split("XXYYXX");
					if(yearFrom >= criteria[0] && yearFrom < criteria[1]){
						valid = false;
						within = true;
						err.innerHTML = '<br>Value entered should not be within the range of other criteria';
					}
					i++;
				}
				if(!within)
					err.innerHTML = '';
			}
		}
	}

	return valid;
}

function criteriaChange(){
	var criteria = document.getElementById('criteria');
	var porata = document.getElementById('porata');
	var days = document.getElementById('days');
	var criteriaForm = document.getElementById('criteria-form');
	var criteriaInput = document.getElementsByClassName('criteriaInput');
	if(criteria.value == '0'){
		porata.value = 0;
		porata.disabled = true;
		days.parentNode.style.visibility = "visible";
		days.disabled = false;
		for(var x = 0; x < criteriaInput.length; x++)
			criteriaInput[x].disabled = true;
		criteriaForm.style.visibility = "hidden";
	}
	else {
		porata.disabled = false;
		days.disabled = true;
		days.parentNode.style.visibility = "hidden";
		for(var x = 0; x < criteriaInput.length; x++)
			criteriaInput[x].disabled = false;
		criteriaForm.style.visibility = "visible";
	}
}

function addCriteria(){
	if(validateInput('criteriaInput')){
		var yearFrom = document.getElementById('yearFrom');
		var yearTo = document.getElementById('yearTo');
		var cdays = document.getElementById('cdays');
		var criteria_table = document.getElementById('criteria-table');
		
		var deleteButton = document.createElement('button');
		deleteButton.type = "button";
		deleteButton.setAttribute("onClick", 'deleteCriteria(this)');
		deleteButton.appendChild(document.createTextNode('Delete'));
		
		var tRow = criteria_table.insertRow();
		var tCell = tRow.insertCell();
		tCell.appendChild(document.createTextNode(yearFrom.value));
		tCell = tRow.insertCell();
		tCell.appendChild(document.createTextNode(yearTo.value));
		tCell = tRow.insertCell();
		tCell.appendChild(document.createTextNode(cdays.value));
		tCell = tRow.insertCell();
		tCell.appendChild(deleteButton);
		
		var input = document.createElement("input");
		input.setAttribute("type", "hidden");
		input.name = "criterias[]";
		input.className = 'criterias';
		input.value = yearFrom.value + "XXYYXX" + yearTo.value + "XXYYXX" + cdays.value + "XXYYXX";
		tCell.appendChild(input);
		
		yearFrom.value = '';
		yearTo.value = '';
		cdays.value = '';
	}
}

function deleteCriteria(row){
	var confirmation = confirm('Confirm deletion?');
	if(confirmation){
		var i = row.parentNode.parentNode.rowIndex;
		document.getElementById("criteria-table").deleteRow(i);
	}
}

function daysAmountChange(daysAmount){
	var days = document.getElementById('days');
	var dateFrom = document.getElementById('dateFrom');
	var dateTo = document.getElementById('dateTo');
	var ldateFrom = document.getElementById('ldateFrom');
	days.value = daysAmount.value;
	if(days.value == '0.5'){
		dateTo.parentNode.style.visibility = "hidden";
		dateTo.disabled = true;
		ldateFrom.innerHTML = 'Date:';
	}
	else{
		dateTo.parentNode.style.visibility = "visible";
		dateTo.disabled = false;
		dateTo.value = dateFrom.value;
		ldateFrom.innerHTML = 'Date From:';
	}
}

function dateChange(){
	var days = document.getElementById('days');
	var holiday = document.getElementById('holiday').value;
	holiday = holiday.split("/");
	var dateFrom = document.getElementById('dateFrom');
	var dateTo = document.getElementById('dateTo');
	var errFrom = document.getElementById('errdateFrom');
	var errTo = document.getElementById('errdateTo');
	
	if(days.value == '0.5'){
		dateTo.value = dateFrom.value;
		var i = 0;
		var same = false;
		while(i < holiday.length && !same){
			if(dateFrom.value == holiday[i]){
				errFrom.innerHTML = '<br>This date is a holiday';
				same = true;
			}
			else{
				errFrom.innerHTML = '<br>';
			}
			i++;
		}
	}
	else{
		dateTo.min = dateFrom.value;
		if(dateTo.value < dateFrom.value)	
			dateTo.value = dateFrom.value;
		
		var dateToVal = new Date(dateTo.value);
		var dateFromVal = new Date(dateFrom.value);
		var daysVal = (dateToVal - dateFromVal)/86400000 + 1;
		
		var same = 0;
		var i = 0;
		while(i < holiday.length){
			var holidayVal = new Date(holiday[i]);
			if(holidayVal <= dateToVal && holidayVal >= dateFromVal){
				if(holidayVal == dateFromVal)
					errFrom.innerHTML = '<br>This date is a holiday';
				else
					errFrom.innerHTML = '<br>';
				
				if(holidayVal == dateToVal)
					errTo.innerHTML = '<br>This date is a holiday';
				else
					errTo.innerHTML = '<br>';
				
				same++;
			}
			i++;
		}
		if(same > 0){
			if(daysVal == 1){
				errfrom.innerHTML = 'this date is a holiday';
			}
			else{
				daysVal -= same;
				errFrom.innerHTML = 'This date contains a holiday';
			}
		}
		else{
			errFrom.innerHTML = '';
			errTo.innerHTML = '';
		}
		days.value = daysVal;
	}
}

function leaveTypeChange(){
	var leaveType = document.getElementById('leaveType');
	var CF = document.getElementById('CF');
	var entitlement = document.getElementById('entitlement');
	var taken = document.getElementById('taken');
	var balance = document.getElementById('balance');
	var val = document.getElementById(leaveType.value);
	
	if(leaveType.value == 'Annual Leave')
		CF.parentNode.style.visibility = '';
	else
		CF.parentNode.style.visibility = 'hidden';
	
	if(val != null){
		var entitlements = val.value.split("XXYYXX");
		entitlement.innerHTML = entitlements[0];
		taken.innerHTML = entitlements[1];
		balance.innerHTML = entitlements[2];
	}
	else {
		entitlement.innerHTML = '0';
		taken.innerHTML = '0';
		balance.innerHTML = '0';
	}
}

function confirmLeave(item, id){
	var confirmation = confirm('Confirm Approval?');
	var statusId = 0;
	if(confirmation){
		if(item.name == '1')
			statusId = 1;
		else if(item.name == '2')
			statusId = 2;
		else
			statusId = 3;
		window.location = 'update.php?status=' + statusId + '&leaveId=' + id;
	}
}