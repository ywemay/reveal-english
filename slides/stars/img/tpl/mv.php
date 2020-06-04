<?php
$c = file_get_contents('splash.tpl.svg');
$c = preg_replace("/(\-?\d+)\.\d+/", "$1", $c);
print $c;
?>
