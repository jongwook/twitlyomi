<? echo View::factory('head'); ?>

<div id="body">

<? echo View::factory('sidebar'); ?>

<div id="content">
	<div id="top">
		<div id="desc">
			<?=$desc?>
		</div>
		<div id="stat">
			total <?=$total?> tweets
		</div>
	</div>
	<? foreach($tweets as $tweet): ?>
	<div class="tweet">
		<?=$tweet->text?><br />
		<div class="date">
			<?=date("Y.m.d",$tweet->created_at);?>
			<? if($tweet->source): ?>
				via <?=strip_tags($tweet->source)?>
			<? endif; ?>
			<? if($tweet->in_reply_to_screen_name): ?>
				in reply to 
				<? if($tweet->in_reply_to_status_id): ?>
					<a href="https://twitter.com/#!/<?=$tweet->in_reply_to_screen_name?>/status/<?=$tweet->in_reply_to_status_id?>" target="blank">
						<?=$tweet->in_reply_to_screen_name?>
					</a>
				<? else: ?>
				<?=$tweet->in_reply_to_screen_name?>
				<? endif; ?>
			<? endif; ?>
		</div>
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


<? echo View::factory('foot'); ?>
