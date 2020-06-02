<?php
$files = glob('L*.html');
foreach ($files as $fname) {
  print $fname . '<br />';
  parse_lesson($fname);
}

function parse_lesson($fname) {
  $lines = file($fname);
  $out = [];
  $bRead = false;
  foreach ($lines as $l) {
    if (!$bRead) {
      if (!preg_match("/section/", $l)) {
        continue;
      }
      else {
        $bRead = true;
      }
    }
    if (preg_match("/\/section/", $l)) $bRead = false;
    $out[] = preg_replace(
      ["/\t/", "/^( {8})/"],
      ["  ", ''],
      $l);
  }
  $out_name = 'lessons/' . basename($fname, '.html') . '.php';
  file_put_contents($out_name, implode('', $out));
}
?>
