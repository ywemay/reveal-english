<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title>Paint</title>
<style>
svg path{
  stroke: #000 !important;
  stroke-width: 0.3pt !important;;
  stroke-opacity: 1 !important;;
  fill: white !important;;
}
div svg {
  width: 220pt;
  height: 220pt;
}
div {
  display: inline-block;
}
</style>
    </head>
    <body>
     <?php
     foreach (['Jack', 'Lilly', 'Bella', 'Horsey', 'mom', 'dad', 'grandma', 'grandpa'] as $k) {
       $c = '<div class="art">' . file_get_contents('../img/svg/' . $k . '.svg') . '<br /> <center>' . $k  .'</center></div>';
       print $c;
     }
     ?>
    </body>
</html>
