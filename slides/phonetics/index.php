<?php
include('../../config.php');
include('php/phonetics.php');

$page = new Page("Phonetics");

$lesson = g('lesson');
if ($lesson && ($fn = lesson_exists($lesson))) {
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
  $page->build_slideshow($fn);
}
else {
  $ph = new Phonetics();

  // iː ɪ æ ɜː ə ʌ ɑː ɔː ɒ uː ʊ
  // eɪ aɪ ɔɪ əʊ aʊ ɪə eə ʊə
  // θ ð ʃ ʒ tʃ dʒ ŋ

  $sets = $ph->lessonSets([
    [['iː', 'ɪ'], ['p', 'b'], ['t', 'd'], ['k', 'd']],
    [['e', 'æ'], ['f', 'v'], ['h', 'r']],
    [['ɜː', 'ə'], ['s', 'z'], ['θ', 'ð']],
    [['ɑː', 'ʌ'], ['l'], ['m', 'n', 'ŋ']],
    [['ɔː', 'ɒ'], ['ʃ', 'ʒ'], ['tʃ', 'dʒ']],
    [['uː', 'ʊ'], ['tr', 'dr']],
    [['eɪ', 'aɪ'], ['ɔɪ', 'əʊ'], ['aʊ'], ['ts', 'dz']],
    [['ɪə', 'eə', 'ʊə'], ['w', 'j']]
  ]);

  $page->css('css/index.css');
  $page->content = implode("\n", $sets);

  print $page->build();
}

?>
