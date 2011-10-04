<? echo View::factory('head'); ?>

<div id="body">

<? echo View::factory('sidebar'); ?>

<div id="content">
	<? foreach($tweets as $tweet): ?>
	<div class="tweet">
		<?=htmlspecialchars($tweet->text)?><br />
		<span class="date"><?=date("Y-m-d",$tweet->created_at);?></span>
	</div>
	<? endforeach; ?>
	
	<div id="bottom">
		<div id="pages">
			<? foreach($pages as $p): ?>
				<a href="<?=$p[0]?>"><?=$p[1]?></a>
			<? endforeach; ?>
		</div>
	</div>
</div>

</div>

<div id="foot">
	<div id="copyright">
	Copyright <?=date("Y")?> Jong Wook Kim<br />
	All Right Reserved
	</div>
</div>

<? echo View::factory('foot'); ?>
