<?php
$ph = new Phonetics();
print $ph->titleSlide(__FILE__);

$yaml = yaml_parse_file(dirname(__FILE__) . '/L05.yaml');
foreach($yaml as $slide) {
  foreach($slide as $mode => $data) {
    $mode = explode('_', $mode);
    foreach($mode as $k=>$v) {
      $mode[$k] = ucfirst($v);
    }
    $mode = implode('', $mode);
    $f = 'slide' . $mode;
    print $ph->$f($data);
  }
}
?>
