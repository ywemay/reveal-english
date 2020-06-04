<?php

function g($key) {
  if (isset($_GET[$key])) {
    return $_GET[$key];
  }
  return false;
}

function p($key) {
  if (isset($_POST[$key])) {
    return $_POST[$key];
  }
  return false;
}

?>
