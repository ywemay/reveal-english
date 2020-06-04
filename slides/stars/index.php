<?php
include('../../config.php');

$oLesson = new Lesson();
$oLesson->title = "Learning Stars";

if ($oLesson->getLesson()) {
  $oLesson->theme('serif');
  $oLesson->css([
    "css/style.css",
    "css/paintgame.css",
    "css/tapspawngame.css",
  ]);
  $oLesson->js("/js/axios.min.js");
  $oLesson->postjs([
    "js/main.js",
    "js/audio.js",
    "js/paintgame.js",
    "js/tapspawngame.js",
    "js/init.js"
  ]);

  $oLesson->build_slideshow();
}
else {
  $l = new Lesson();
  $l->lessons_index($oLesson);
}

?>
