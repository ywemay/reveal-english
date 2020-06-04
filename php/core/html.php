<?php

function attr($attr) {
  $rez = '';
  if (is_array($attr)) {
    $attrs = array();
    foreach ($attr as $key => $value) {
      if (is_array($value)) $value = implode(' ', $value);
      $attrs[$key] = (!is_int($key)) ? "$key=\"$value\"" : $value;
    }
    $rez = ' ' . implode(' ', $attrs);
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
  $content = array2content($content);
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

function img($src, $attr = []) {
  $attr['src'] = $src;
  $attr = attr($attr);
  return "<img$attr />";
}

function array2content($content) {
  if (is_array($content)) {
    foreach ($content as $k => $value) {
      $content[$k] = is_array($value) ? array2content($value) : $value;
    }
    return implode("\n", $content);
  }
  return $content;
}

function video($src, $attr = []) {
  $attr += [
    'src' => $src,
    'controls' => false
  ];
  return el('video', 'Your browser does not support video tag.', $attr);
} 

?>
