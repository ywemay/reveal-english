<?php
include(dirname(__FILE__) . '/params.php');

$w = g('w');
$data = [];

if ($w) {
  $data['trans'] = exec("espeak -x -q --ipa \"$w\"");
}
print json_encode($data, JSON_PRETTY_PRINT);
 ?>
