<!doctype html>
<head>
<title>twit.lyomi.net</title>
<link rel="stylesheet" type="style/css" href="/css/style.css" />
</head>
<body>
<? foreach($tweets as $tweet): ?>
<div class="tweet">
	<?=$tweet->text?><br />
	<span class="date"><?=date("Y-m-d H:i:s T",$tweet->created_at);?></span>
</div>
<? endforeach; ?>
<div class="bottom">
	<div class="pages">
		<? foreach($pages as $p): ?>
			<a href="<?=$p[0]?>"><?=$p[1]?></a>
		<? endforeach; ?>
	</div>
</div>
</body>
</html>