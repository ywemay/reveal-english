<?php

function attr($attr) {
  $rez = '';
  if (is_array($attr)) {
    $attrs = array();
    foreach ($attr as $key => $value) {
      $attrs[$key] = "$key=\"$value\"";
    }
    $rez = ' ' . implode($attrs);
  }
  elseif($attr) {
    $rez = ' ' . $attr;
  }
  return $rez;
}

function h($i, $str, $attr = false) {
  $attr = attr($attr);
  return "<h$i$attr>$str</h$i>\n";
}

function h1($str, $attr = false) { return h(1, $str, $attr); }
function h2($str, $attr = false) { return h(2, $str, $attr); }
function h3($str, $attr = false) { return h(3, $str, $attr); }
function h4($str, $attr = false) { return h(4, $str, $attr); }
function h5($str, $attr = false) { return h(5, $str, $attr); }
function h6($str, $attr = false) { return h(6, $str, $attr); }

function el($tag, $content, $attr = false) {
  $attr = attr($attr);
  return "<$tag$attr>$content</$tag>\n";
}

function ul($str, $attr = false) {
  if (is_array($str)) {
    $lis = [];
    foreach ($str as $li) {
      $lis[] = li($li);
    }
    $str = implode("\n", $lis);
  }
  return el('ul', $str, $attr);
}

function li($str, $attr = false) {
  return el('li', $str, $attr);
}

function ol($str, $attr = false) {
  return el('ol', $str, $attr);
}

function div($str, $attr = false) {
  return el('div', $str, $attr);
}

function a($href, $str, $attr = []) {
  $attr['href'] = $href;
  return el('a', $str, $attr);
}

function svg($fname) {
  if (file_exists($fname)) {
    return file_get_contents($fname);
  }
}

?>
