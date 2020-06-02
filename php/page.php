<?php

class Page {

  var $title = 'No Title';
  var $content = 'No content';
  var $page_title = false;
  var $theme = 'serif';

  var $css = [];
  var $js = [];
  var $postjs = [];

  private $_head = '';

  function __construct($params = false) {
    if ($params) {
      if (is_string($params)) $this->title = $params;
      else $this->add_params($params);
    }
  }

  function add_params($params) {
    if (is_array($params)) {
      foreach ($params as $key => $value) {
        $this->{$key} = $value;
      }
    }
  }

  function css($css) {
    if (is_array($css)) {
      $this->css = array_merge($this->css, $css);
    }
    else $this->css[] = $css;
  }

  function js($js) {
    if (is_array($js)) {
      $this->js = array_merge($this->js, $js);
    }
    else $this->js[] = $js;
  }

  function postjs($js) {
    if (is_array($js)) {
      $this->postjs = array_merge($this->postjs, $js);
    }
    else $this->postjs[] = $js;
  }

  function get_content($source) {
    $this->content = $this->get_include($source);
    return $this->content;
  }

  function get_include($source) {
    if (!file_exists($source)) {
      error_log("Cannot find file: " . $source);
    }
    ob_start();
    include($source);
    return ob_get_clean();
  }

  function build($ret = false) {
    if ($ret) {
      ob_start();
    }
    $site = new stdClass();
    $site->title = $this->title;
    $site->head = $this->build_css() . "\n" . $this->build_js();
    $site->content = $this->content;
    $site->postjs = $this->build_js($this->postjs);
    include(dirname(__FILE__) . '/tpl/html.tpl.php');
    if ($ret) {
      $rez = ob_get_clean();
      return $rez;
    }
  }

  function build_js($js = false) {
    if (!$js) $js = $this->js;
    if (!$js) return '';
    $out = '';
    foreach($js as $j) {
      if (preg_match("/\@(.*?\.js)/", $j, $mt)) {
        if (file_exists($mt[1])) {
          $j = file_get_contents($mt[1]);
        }
        else {
          error_log("Failed to find js file: " . $j);
        }
      }
      if (preg_match("/\.js$/", $j)) {
        $out .= '<script src="' . $j . '"></script>' . "\n";
      }
      else {
        $out .= "<script type=\"text/javascript\">\n\t$j\n</script>\n";
      }
    }
    return $out;
  }

  function build_css() {
    if (!$this->css) return '';
    $out = '';
    foreach($this->css as $c) {
      if (preg_match("/\.css/", $c)) {
        $out .= "\t\t" . '<link rel="stylesheet" href="' . $c . '" />' . "\n";
      }
      else {
        $out .= "\t\t" . "<style>\t\t\t$c\n\t\t</style>\n";
      }
    }
    return $out;
  }

  function theme($theme) {
    $css = DIR_ROOT . '/caa/theme/' . $theme . '.css';
    if (!file_exists($css)) {
      error_log("Cannot find theme css: " . $css);
    }
    $this->theme = $theme;
  }

  function build_slideshow($src, $params = []) {
    if ($this->theme) {
      $this->css('/css/theme/' . $this->theme . '.css');
    }
    array_unshift($this->css,
      "/css/reset.css",
      "/css/reveal.css"
    );
    array_unshift($this->js,
      "/js/jquery-1.12.4.js",
      "/js/jquery-ui.js"
    );
    array_unshift($this->postjs,
      "/js/reveal.js",
      "/js/config.js",
      "/js/main.js"
    );
    $content = div($this->get_content($src),
      ['class' => 'slides']);

    $this->content = div($content, ['class' => 'reveal']);
    $this->build();
  }
}
?>
