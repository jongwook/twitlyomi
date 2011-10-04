
<div id="sidebar">
	<div id="title"><a href="/">Home</a></div>
	<div id="calendar">
		<div id="calendar-title">Calendar</div>
		<? echo View::factory('calendar')->set('offset',-1); ?>
		<? echo View::factory('calendar'); ?>
	</div>
	<div id="archive">
		<div id="archive-title">Archive</div>
		<? for($year=date('Y'), $month=date('m'); $year!="2009"||$month!="07";$month=($month+10)%12+1, $year=(($month==12)?$year-1:$year)): ?>
			<div class="archive-month">
			<a href="/archive/<?=sprintf("%04d%02d",$year,$month)?>"><?=sprintf("%04d/%02d",$year,$month)?></a><br />
			</div>
		<? endfor; ?>
	</div>
</div>
