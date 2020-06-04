<?php

class Page {

  var $title = 'No Title';
  var $content = 'No content';
  var $page_title = false;
  var $theme = 'serif';

  var $css = [];
  var $js = [];
  var $postjs = [];

  var $content_file = '';

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
    include(DIR_PHP . '/tpl/html.tpl.php');
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

  function default_scripts() {
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
  }

  function build_slideshow() {
    $this->default_scripts();

    switch($this->type) {
      case 'php':
        $content = $this->get_content($this->content_file);
        break;
      case 'yaml':
        $yaml = yaml_parse_file($this->content_file);
        $content = [];
        if (method_exists($this, 'titleSlide')) {
          $content[] = $this->titleSlide();
        }
        foreach($yaml as $page) {
          foreach($page as $k => $params) {
            $parts = explode('_', $k);
            foreach($parts as $pk => $part) $parts[$pk] = ucfirst($part);
            $f = 'slide' . (implode('', $parts));
            if (method_exists($this, $f)) {
              $content[] = $this->$f($params);
            }
            elseif (function_exists($f)) {
              $content[] = $f($params);
            }
            else {
              error_log("No function found: " . $f);
            }
          }
        }
        $content = implode("\n", $content);
        break;
      default:
        error_log("Unknow slideshow source file type: " . $this->type);
        break;
    }
    $content = div($content,  ['class' => 'slides']);
    $this->content = div($content, ['class' => 'reveal']);
    $this->build();
  }
}
?>
