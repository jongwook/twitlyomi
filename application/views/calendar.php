<?
if(!isset($year)) $year = date('Y');
if(!isset($month)) $month = date('m');
if(isset($offset)) {
	if($offset<0) {
		for($i=0;$i>$offset;$i--) {
			$month--;
			if($month===0) {
				$month=12;
				$year--;
			}
		}
	} else {
		for($i=0;$i<$offset;$i++) {
			$month++;
			if($month===13) {
				$month=1;
				$year++;
			}
		}
	}
}
$month = str_pad($month,2,'0',STR_PAD_LEFT);
$first = date('w',mktime(0,0,0,$month,1,$year));
$days = date('t',mktime(0,0,0,$month,1,$year));
$weeks = ceil(($first+$days)/7);

echo '<div class="calendar">';
echo '<div class="calendar-month">'.$year.'/'.$month.'</div>';

for($row=0; $row<$weeks; $row++): 
	echo '<div class="calendar-week">';
		for($col=0; $col<7; $col++):
			echo '<div class="calendar-day">';
				$day = $row*7+$col-$first+1;
				if($day>0 && $day<=$days):
					$date = $year.$month.str_pad($day,2,'0',STR_PAD_LEFT);
					if($date == date("Ymd")) $day = '<b>'.$day.'</b>'; 
					echo '<a href="/archive/'.$date.'">'.$day.'</a>';
				else:
					echo '&nbsp;';
				endif;
			echo '</div>';
		endfor;
	echo '</div>';
endfor; 

echo '</div>';

