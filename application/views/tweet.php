<? echo View::factory('head'); ?>

<div id="body">

<? echo View::factory('sidebar'); ?>

<div id="content">
	<div id="top">
		<div id="desc">
		</div>
		<div id="stat">
		</div>
	</div>
	
	<div class="tweet">
		<? if(isset($tweet->screen_name)): ?>
			<b><?=$tweet->screen_name?></b>
		<? endif; ?>
		<?=$tweet->text?><br />
		<div class="date">
			<a href="http://twitter.com/lyomi/status/<?=$tweet->id?>"><?=date("Y.m.d",$tweet->created_at);?></a> 
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
	
	<div id="bottom">
		<div id="pages">
		</div>
	</div>
</div>

</div>


<? echo View::factory('foot'); ?>
