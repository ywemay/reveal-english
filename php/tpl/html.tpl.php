<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<title><?php echo $site->title; ?></title>
    <?php print $site->head ?>
	</head>
  <body>
    <?php
      print isset($site->page_title) ? "<h1>$site->page_title</h1>\n" : '';
      print $site->content . "\n";
      print isset($site->postjs) ? $site->postjs : '';
    ?>
  </body>
</html>
