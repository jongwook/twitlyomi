<!doctype html>
<head>
<title>twit.lyomi.net</title>
<link rel="stylesheet" type="style/css" href="/css/style.css" />
</head>
<body>
<? foreach($tweets as $tweet): ?>
<div class="tweet">
	<?=$tweet->text?>
</div>
<? endforeach; ?>
</body>
</html>