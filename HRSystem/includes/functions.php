<?php

function formInput($type, $id, $name, $label, $value, $addDiv = '', $addInput = '', $class = 'formInput', $br = '') {
	return <<<HTML
<div $addDiv>
<label id ="l$id" for="$id">$label</label>
<input class = "$class" type="$type" id="$id" name="$name" value="$value" $addInput>
<span class="error" id="err$id">$br</span>
</div>
HTML;
}

function formDropdown($id, $name, $label, $values, $value = null, 
	$prompt = null, $addDiv = '', $addInput = '', $class = 'formInput', $br = '') {
	
	$options = [];
	
	if($prompt != null) {
		array_push($options, "<option value=\"\">$prompt</option>");
	}
	
	foreach($values as $key => $val) {
		if($value == $key) {
			$selected = 'selected';
		}
		else {
			$selected = '';
		}
		array_push($options, "<option value=\"$key\" $selected>$val</option>");
	}
	$htmlOptions = implode('', $options);
	
	return <<<HTML
<div $addDiv>
<label>$label</label>
<select class = "$class" id="$id" name="$name" $addInput>$htmlOptions</select>
<span class="error" id="err$id">$br</span>
</div>
HTML;
}

function formRadio($id, $name, $label, $values, $value = null, $prompt = null, $addDiv = '', $addInput = '', $class = 'formInput') {
	$options = [];
	
	if($prompt != null) {
		array_push($options, "<input type = 'radio' name = '$name' value=\"\">$prompt</input>");
	}
	
	foreach($values as $key => $val) {
		if($value == $key) {
			$selected = 'checked';
		}
		else {
			$selected = '';
		}
		array_push($options, "<label class = 'radio'>");
		array_push($options, "<input class = '$class' type = 'radio' name = '$name' value=\"$key\" $selected $addInput>$val");
	
		array_push($options, "</label>");
	}
	$htmlOptions = implode('', $options);
	
	return <<<HTML
<div $addDiv>
$htmlOptions
<span class="error" id="err$id"></span>
</div>
HTML;
}

/* draws a calendar */
function draw_calendar($month,$year){

	$holidays = getHoliday($year, $month);
	
	/* draw table */
	$calendar = '
	<form method="post">
		<input type="submit" name="LastMonth" value="<< Last Month" />
		<input type="submit" name="Today" value="Today" />
		<input type="submit" name="NextMonth" value="Next Month >>" />
		</form>
	<table cellpadding="0" cellspacing="0" class="calendar">';
	
	$headings = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
	$calendar .= '<tr class="calendar-row">
	<td colspan="7" id = "monthYear" class="calendar-day-head"><h3>' . $headings[$month-1] . ' ' . $year .  '</h3></td>';

	/* table headings */
	$headings = array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
	$calendar.= '<tr class="calendar-row"><td class="calendar-day-head" style = "width:100px">'.implode('</td><td class="calendar-day-head" style = "width:100px">',$headings).'</td></tr>';
	
	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np"> </td>';
		$days_in_this_week++;
	endfor;

	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		if($key = array_search($list_day, $holidays)){
			$addClass = 'holiday';
			$holidayName = $key;
		}
		else{
			$addClass = '';
			$holidayName = '';
		}
		
		$leavePplName = '';
		if($addClass != 'holiday'){
			$leave = getLeave($year, $month, $list_day);
			if(!empty($leave)){
				for($i = 0; $i<sizeof($leave);$i++)
					$leavePplName.= "-$leave[$i]\n";
				$addClass = ' leaveTaken';
			}
		}
			
		$calendar.= "<td class='calendar-day $addClass' title = '$holidayName\n$leavePplName'>";
			/* add in the day number */
			$calendar.= '<div class="day-number">'.$list_day.'</div>';
			
			
		$calendar.= '</td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np"> </td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';

	/* end the table */
	$calendar.= '</table>';
	
	/* all done, return result */
	return $calendar;
}

function getHoliday($year, $month){
	$db = initdb();
	$sql = 'SELECT DAY(hsDate), hsDesc FROM HolidaySchedule WHERE YEAR(hsDate) = ? AND MONTH(hsDate) = ? AND enabled = 1;';
	
	$stmt = $db->prepare($sql);
	$stmt->bind_param('ii', $year, $month);
	$stmt->execute();
	$stmt->bind_result($date, $name);
	$stmt->store_result();
	
	$holidays = [];
	while($stmt->fetch()){
		$holidays[$name] = $date;
	}
	return $holidays;
}

function getLeave($year, $month, $day){
	$db = initdb();
	$sql = 'SELECT name 
		FROM 
			(SELECT createdBy FROM LeaveApplication
			WHERE YEAR(dateFrom) = ? AND (MONTH(dateFrom) = ? OR MONTH(dateTo) = ?)
			AND (DAY(dateFrom) <= ? AND DAY(dateTo) >= ?)
			AND status = "Approved" AND leaveType = "Annual Leave") la
		INNER JOIN
			(SELECT employeeCode, name FROM Employee) e
		ON e.employeeCode = la.createdBy
		ORDER BY(name)
		LIMIT 4;';
	
	$stmt = $db->prepare($sql);
	$stmt->bind_param('iiiii', $year, $month, $month, $day, $day);
	$stmt->execute();
	$stmt->bind_result($name);
	$stmt->store_result();
	
	$leave = [];
	while($stmt->fetch()){
		array_push($leave, $name);
	}
	
	return $leave;
}