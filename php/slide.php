<?php
function card($text, $attr = []) {
  return el('card', $text, $attr);
}
function slideH3($title, $content, $attr = []) {
  $out = [
    h3($title),
    $content
  ];
  return el('section', $out, $attr);
}

function slideVideoH3($title, $src, $attr=[]) {
  $out = "  <video src=\"$src\" controls>
    Video on how to make the sound.
  </video>";
  return slideH3($title, $out);
}
?>
