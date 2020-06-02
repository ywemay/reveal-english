<?php
include('../../config.php');
include('php/phonetics.php');

$page = new Page("Learning Stars");

$lesson = g('lesson');
if ($lesson && lesson_exists($lesson)) {
  $page->theme('white');
  $page->css([
    "css/style.css",
    "/css/phonetics.css",
    "css/tapspawngame.css",
  ]);
  $page->js("/js/axios.min.js");
  $page->postjs([
    "js/main.js",
    // "js/audio.js",
    "js/phonetics.js",
    "js/tapspawngame.js",
    "js/init.js"
  ]);
  $page->build_slideshow("lessons/${lesson}.php");
}
else {
  $ph = new Phonetics();

  // i: ɪ æ ɜ: ə ʌ ɑ: ɔ: ɒ u: ʊ
  // eɪ aɪ ɔɪ əʊ aʊ ɪə eə ʊə
  // θ ð ʃ ʒ tʃ dʒ ŋ

  $sets = $ph->lessonSets([
    [['i:', 'ɪ'], ['p', 'b'], ['t', 'd'], ['k', 'd']],
    [['e', 'æ'], ['f', 'v'], ['h', 'r']],
    [['ɜ:', 'ə'], ['s', 'z'], ['θ', 'ð']],
    [['ɑ:', 'ʌ'], ['l'], ['m', 'n', 'ŋ']],
  ]);

  $page->css('css/index.css');
  $page->content = implode("\n", $sets);

  print $page->build();
}

?>
