<?php
include('../../config.php');

$page = new Page("Learning Stars");

$lesson = g('lesson');
if ($lesson && lesson_exists($lesson)) {
  $page->theme('serif');
  $page->css([
    "css/style.css",
    "css/paintgame.css",
    "css/tapspawngame.css",
  ]);
  $page->js("/js/axios.min.js");
  $page->postjs([
    "js/main.js",
    "js/audio.js",
    "js/paintgame.js",
    "js/tapspawngame.js",
    "js/init.js"
  ]);
  $page->build_slideshow("lessons/${lesson}.php");
}
else {
  print_lessons_index($page);
}

?>
