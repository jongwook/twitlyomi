<? echo View::factory('head'); ?>

<? foreach($tweets as $tweet): ?>
<div class="tweet">
	<?=$tweet->text?><br />
	<span class="date"><?=date("Y-m-d",$tweet->created_at);?></span>
</div>
<? endforeach; ?>
<div class="bottom">
	<div class="pages">
		<? foreach($pages as $p): ?>
			<a href="<?=$p[0]?>"><?=$p[1]?></a>
		<? endforeach; ?>
	</div>
</div>

<? echo View::factory('foot'); ?>
