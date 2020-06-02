<?php
function build_js($js) {
  if (!$js) return '';
  $out = '';
  foreach($js as $j) {
    if (preg_match("/\.js$/", $j)) {
      $out .= '<script src="' . $j . '"></script>' . "\n";
    }
    else {
      $out .= "<script type=\"JavaScript\">\n\t$j\n</script>\n";
    }
  }
  return $out;
}

function build_css($css) {
  if (!$css) return '';
  $out = '';
  foreach($css as $c) {
    if (preg_match("/\.css/", $c)) {
      $out .= "\t\t" . '<link rel="stylesheet" href="' . $c . '" />' . "\n";
    }
    else {
      $out .= "\t\t" . "<style>\t\t\t$c\n\t\t</style>\n";
    }
  }
  return $out;
}

?>
