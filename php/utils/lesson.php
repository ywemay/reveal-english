<?php

function lesson_exists($key) {
  $fname = 'lessons/' . $key . '.php';
  if (file_exists($fname)) return $fname;
  $fname = 'lessons/' . $key . '.yaml';
  if (file_exists($fname)) return $fname;
  return false;
}


function print_lessons_index($page) {
  $lessons = glob('./lessons/*.php');

  $lnks = [];
  foreach($lessons as $lesson) {
    $key = basename($lesson, '.php');
    $lnks[] = li(a('index.php?lesson=' . $key, $key));
  }

  $page->content =
    h1($page->title)
    . ul(implode('', $lnks));
  $page->build();
}
?>
