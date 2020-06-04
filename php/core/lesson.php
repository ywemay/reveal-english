<?php

require_once(DIR_PHP . '/core/page.php');

class Lesson extends Page {

  var $type = '';

  function setFName($fname) {
    $this->content_file = $fname;
    $parts = explode('.', basename($fname));
    $this->type = count($parts) > 1 ? end($parts) : '';
  }

  function getLesson() {
    $lesson = g('lesson');
    if (!$lesson) return false;
    if ($fname = $this->exists($lesson)) {
      $this->setFName($fname);
      return true;
    }
    $this->setFName('');
    return false;
  }

  function exists($key) {
    $fname = [
      'lessons/' . $key,
      'lessons/' . $key . '.php',
      'lessons/' . $key . '.yaml',
    ];
    foreach($fname as $f) {
      if (file_exists($f)) {
        return $f;
      }
    }
    return false;
  }

  function _index_links($ext = 'yaml') {
    $lessons = glob('./lessons/*.' . $ext);

    $lnks = [];
    foreach($lessons as $lesson) {
      $key = basename($lesson, '.php');
      $lnks[] = li(a('index.php?lesson=' . $key, basename($key, '.' . $ext)));
    }
    return $lnks;
  }

  function lessons_index() {
    $links = $this->_index_links();
    $links = array_merge($links, $this->_index_links('php'));
    arsort($links);

    $this->content =
      h1($this->title)
      . ul(implode('', $links));
    $this->build();
  }

  function slideSection($params) {
    $params += [
      'h1' => false,
      'h2' => false,
    ];
    $content = [
      $params['h1'] ? h1($params['h1']) : '',
      $params['h2'] ? h2($params['h2']) : '',
    ];
    return el('section', $content);
  }

  function slideVideo($params) {
    $content[] = video($params['src']);
    return el('section', $content);
  }

  function slideImage($params) {
    $params += [
      'title' => false,
      'src' => false,
      'generate' => false,
    ];
    $content = [];
    if ($params['title']) {
      $content[] = h3($params['title']);
    }
    if ($params['src']) {
      $content[] = img($params['src']);
    }
    if ($params['generate']) {
      $f = 'img/tpl/' . $params['generate']['tpl'] . '.tpl.svg';
      if (file_exists($f)) {
        $c = file_get_contents($f);
        foreach($params['generate'] as $k => $v) {
          $c = str_replace("[[$k]]", $v, $c);
        }
        $content[] = $c;
      }
    }
    return el('section', $content);
  }

  function slidePaintGame($params) {
    $game = new Game();
    return el('section', $game->paintgame($params), [
      'class' => ['paintgame', 'full']
    ]);
  }

  function slideListenAndOrder($params) {
    $params += [
      'words' => []
    ];

    $imgs = [];
    foreach($params['words'] as $w) {
      $imgs[] = img('img/svg/' . $w . '.svg', [
        'audio' => $w,
        'class' => ['dragg']
      ]);
    }

    $content = [
      h6('Listen and Order'),
      div($imgs, ['class' => 'ordering-elements']),
      div('', ['class' => ['ordering-box', 'dropp']])
    ];

    return el('section', $content);
  }
}
?>
