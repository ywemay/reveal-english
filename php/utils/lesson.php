<?php

function lesson_exists($key) {
  return file_exists('./lessons/' . $key . '.php');
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
