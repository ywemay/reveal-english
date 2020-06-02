<?php

// i: ɪ æ ɜ: ə ʌ ɑ: ɔ: ɒ u: ʊ
// eɪ aɪ ɔɪ əʊ aʊ ɪə eə ʊə
// θ ð ʃ ʒ tʃ dʒ ŋ

class Phonetics {

  // currently selected sound
  var $currentIndex = 0;

  function index() {
     return ['i:', 'ɪ', 'e', 'æ', 'ɜ:', 'ə', 'ʌ',
      'ɑ:', 'ɔ:', 'ɒ', 'u:', 'ʊ', 'eɪ', 'aɪ', 'ɔɪ', 'əʊ', 'aʊ', 'ɪə', 'eə', 'ʊə', 'p', 'b', 't', 'd', 'k', 'g', 'f', 'v', 'θ', 'ð', 's', 'z', 'ʃ', 'ʒ', 'r', 'h', 'tʃ', 'dʒ', 'tr', 'dr', 'ts', 'dz', 'm', 'n', 'ŋ', 'l', 'w', 'j'];
  }

  function getIndex($mix) {
    if (is_int($mix)) {
      $id = $mix;
    }
    elseif(($id = array_search($mix, $this->index())) > -1) {
      $id++;
    }
    return $id;
  }

  function getType($mix) {
    if (is_int($mix)) {
      $id = $mix;
    }
    elseif(($id = array_search($mix, $this->index())) > -1) {
      $id++;
    }
    if ($id <= 12) {
      return 'vowel';
    }
    elseif($id <= 20) {
      return 'diphtong';
    }
    elseif($this->_is_unvoiced_id($id)) {
      return 'unvoiced';
    }
    else {
      return 'voiced';
    }
  }

  function _is_unvoiced_id($id) {
    $arr = [21, 23, 25, 27, 29, 31, 33, 36, 37, 39, 41];
    return in_array($id, $arr);
  }

  function full_index(){
    $rez = [];
    foreach($this->index() as $k => $v) {
      $rez[sprintf("%'.02d", $k+1)] = $v;
    }
    return $rez;
  }

  function getLessonFile($mix) {
    $id = $this->getIndex($mix);
    return 'lessons/L' . sprintf("%'.02d", $id) . '.php';
  }

  function lessonSet($nr, $data) {
    $out = [h2('Lesson ' . $nr)];
    foreach($data as $line) {
      $cards = [];
      foreach($line as $k) {
        $id = 'L' . sprintf("%'.02d", $this->getIndex($k));
        $cards[] = a('index.php?lesson=' . $id, "/$k/", [
          'class' => $this->getType($k)
        ]);
      }
      $out[] = div(implode("\n", $cards));
    }
    return div(implode("\n", $out), ['class' => 'lesson-index']);
  }

  function lessonSets($data) {
    $sets = [];
    foreach($data as $k => $v) {
      $sets[] = $this->lessonSet($k+1, $v);
    }
    return $sets;
  }
}
 ?>
