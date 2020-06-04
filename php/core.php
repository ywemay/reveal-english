<?php
define('DIR_PHP', realpath(dirname(__FILE__)));
define('DIR_ROOT', realpath(DIR_PHP . '/..'));
$files = glob(DIR_PHP . '/core/*.php');
foreach($files as $f) {
  require_once($f);
}
?>
