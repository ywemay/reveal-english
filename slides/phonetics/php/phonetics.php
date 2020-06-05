<?php
require_once(DIR_PHP . '/core/lesson.php');
// i: ɪ æ ɜ: ə ʌ ɑ: ɔ: ɒ u: ʊ
// eɪ aɪ ɔɪ əʊ aʊ ɪə eə ʊə
// θ ð ʃ ʒ tʃ dʒ ŋ

class Phonetics extends Lesson {

  // currently selected sound
  var $id = 0;
  var $sound = '';
  var $sound_type = 'missing';

  var $lesson_ext = '.php';

  function sounds_index() {
     return ['iː', 'ɪ', 'e', 'æ', 'ɜː', 'ə', 'ʌ',
      'ɑː', 'ɔː', 'ɒ', 'uː', 'ʊ', 'eɪ', 'aɪ', 'ɔɪ', 'əʊ', 'aʊ', 'ɪə', 'eə', 'ʊə', 'p', 'b', 't', 'd', 'k', 'g', 'f', 'v', 'θ', 'ð', 's', 'z', 'ʃ', 'ʒ', 'r', 'h', 'tʃ', 'dʒ', 'tr', 'dr', 'ts', 'dz', 'm', 'n', 'ŋ', 'l', 'w', 'j'];
  }

  function getIndex($mix) {
    if (is_int($mix)) {
      $id = $mix;
    }
    elseif(($id = array_search($mix, $this->sounds_index())) > -1) {
      $id++;
    }
    return $id;
  }

  function getSoundType($mix) {
    if (is_int($mix)) {
      $id = $mix;
    }
    elseif(($id = array_search($mix, $this->sounds_index())) > -1) {
      $id++;
    }
    if (!$this->getLessonFile($id)) {
      return 'missing';
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

  function full_sounds_index(){
    $rez = [];
    foreach($this->sounds_index() as $k => $v) {
      $rez[sprintf("%'.02d", $k+1)] = $v;
    }
    return $rez;
  }

  function getLessonFile($mix) {
    $id = $this->getIndex($mix);
    return $this->exists('L' . sprintf("%'.02d", $id));
  }

  function slideVideo($data) {
    return slideVideoH3($data['title'], $data['url']);
  }

  function lessonSet($nr, $data) {
    $out = [h2('Lesson ' . $nr)];
    foreach($data as $line) {
      $cards = [];
      foreach($line as $k) {
        $id = 'L' . sprintf("%'.02d", $this->getIndex($k));
        $ttl = "/$k/";
        if ($id == 'L00') {
          $id = $k;
          $ttl = $k;
        }
        $cards[] = a('index.php?lesson=' . $id, $ttl, [
          'class' => $this->getSoundType($k)
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

  function setCurrent($mix) {
    $this->id = $this->getIndex($mix);
    $this->sound = $this->sounds_index()[$this->id - 1];
    $this->sound_type = $this->getSoundType($this->id);
  }

  function buildFromYaml($fName) {
    $this->lesson_ext = '.yaml';


    $yaml = yaml_parse_file($fName);
    foreach($yaml as $slide) {
      foreach($slide as $mode => $data) {
        $mode = explode('_', $mode);
        foreach($mode as $k=>$v) {
          $mode[$k] = ucfirst($v);
        }
        $mode = implode('', $mode);
        $f = 'slide' . $mode;
        $out[] = $this->$f($data);
      }
    }

    return implode("\n", $out);
  }

  function titlePage() {
    $nr = intval(preg_replace("/^(L(0+)?)|(\.\w+$)/", '', basename($this->content_file)));
    if (preg_match("/(R\d\d)\.\w+$/", $this->content_file, $mt)) {
      return [
        h1('Review'),
        h2($mt[1])
      ];
    }
    $this->setCurrent(intval($nr));
    $out = [
      h1('phonetics'),
      h2('Lesson ' . $this->id),
      el('card', "/$this->sound/", ['class' => $this->sound_type, 'logg' => 'sound'])
    ];
    return implode('  ', $out);
  }

  function titleSlide() {
    return el('section', $this->titlePage());
  }

  function transcribe(&$word) {
    $word = $word . ' /' . $this->getTranscript($word) . '/';
  }

  function cureWord(&$word) {
    $word = trim($word);
    return $word;
    $word = preg_replace([
      "/(\`\w)+/",
      "/\`/"
    ], [
      "!$0!",
      ''
    ], $word);
  }

  function slidePresent($data) {
    $words  = $data['words'];
    $phrase = $data['phrase'];
    $out = [];
    if (!is_array($words)) {
      $words = explode(";", $words);
    }
    foreach ($words as $k => $word) {
      // $word = $this->getTranscript($word);
      $this->cureWord($word);
      $this->transcribe($word);
      $out[] = el('card', $word, [
        'class' => $k ? 'fragment' : '',
        'mark', 'ogg'
      ]);
    }
    $this->cureWord($phrase);
    $out[] = '    <br />
      <p>
        <example class="fragment" mark mp3="phrase.ogg">
        ' . $phrase . '
        </example>
      </p>';
    return slideH3('Presentation', $out);
  }

  function getTranscript($w) {
    $w = preg_replace([
      "/\/.*?\/$/",
      "/[\`\!]/"
    ],[
      '',
      ''
    ], $w);
    $tr = exec("espeak -x -q --ipa \"$w\"");
    $tr = str_replace($this->sound, '<span>' . $this->sound . '</span>', $tr);
    $tr = str_replace([
      'ˈ', 'ɹ'], [
      '', 'r'],
      $tr);
    return trim($tr);
  }

  function slideRules($rules) {
    $out = [];
    $firstOne = true;
    foreach($rules as $k => $set) {
      $cls = [
        $firstOne ? '' : 'fragment',
        $this->sound_type
      ];
      $firstOne = false;
      $div = [card($k, [
        'class' => $cls,
        'mark', 'ogg'
      ])];
      if (!is_array($set)) {
        $set = explode(';', $set);
      }
      foreach($set as $kk => $card) {
        $card = trim($card);
        if (!$card) continue;
        $this->cureWord($card);
        $this->transcribe($card);
        $div[] = card($card, [
          'class' => 'fragment', 'ogg', 'mark'
        ]);
      }
      $out[] = div($div);
    }
    return slideH3('Rules', $out);
  }

  function slideExamples($examples) {
    $out = [];
    foreach($examples as $k => $ex) {
      $this->cureWord($ex);
      $out[] = el('example', $ex, [
        'class' => $k == 0 ? '' : 'fragment',
        'mark'
      ]);
    }
    $out = implode("<br />\n", $out);
    $out = div($out, ['autoaudio' => 'example%s']);
    return slideH3('Practice', $out);
  }

  function slideDialogue($data) {
    $out = [];
    $attr = [];
    if (isset($data['img']))
    {
      $attr['class'] = ['half'];
      $out[] = div(img($data['img']), $attr);
    }
    $dia = [];
    foreach($data['dialogue'] as $v) {
      $dia[] = el('example', $v, ['mark']);
    }
    $out[] = div(implode("<br />\n", $dia), $attr);
    return slideH3('Dialogue', $out);
  }

  var $twistCount = 1;

  function slideTongueTwist($data) {
    $twist = $data['twist'];
    $imgs = $data['img'];
    $this->cureWord($twist);
    $twNr = sprintf("%'.02d", $this->twistCount);
    $out = [
      div(el('example', $twist, ['mark',
        'logg' => 'tonguetwist' . $twNr]))
    ];
    $imgs = explode(';', $imgs);
    foreach($imgs as $src) {
      $src = trim($src);
      if (!$src) continue;
      $out[] = img($src);
    }
    return slideH3('Tongue-twister', $out);
  }

  function slideGameChooseFalse($data) {
    $out = '<section class="game"
      gametype="choosefalseone"
      correct="' . $data['correct'] . '"
      false="' . $data['wrong'] . '"
    >
      <div class="score">
        <div class="player01">0</div>
        <div class="player02">0</div>
      </div>

      <game>Use the buttons to choose the word that does not have the sound <span>/' . $this->sound . '/</span>.<br>
          Press space to start.</game>
      </section>';
    return $out;
  }

  function slideExercise($data) {
    $out = [el('example',
      "Chose out the words that do not contain <span>/$this->sound/</span> sound."),
      ['mark']
    ];
    $lines = [];
    foreach ($data['lines'] as $l) {
      $lines[] = li($l);
    }
    $data['answer'] = str_split($data['answer']);
    foreach($data['answer'] as $k => $a) {
      $ans[] = ($k+1) . '.`' . $a;
    }
    $lines[] = el('card', implode(' ', $ans), [
      'class' => ['fragment', 'answer'],
      'mark'
    ]);
    $out[] = ol($lines, ['class' => 'exercise', 'mark']);
    return slideH3('Exercise', div($out));
  }

  function slideImageWord($data) {
    if (!is_array($data)) {
      $img = 'img/' . str_replace(['`', '!'], '', $data);
      if (!preg_match("/\.(png|jpg|gif|svg|jpeg)$/", $img)) {
        $img .= '.png';
      }
      $word = preg_replace("/\.\w{3,4}$/", '', $data);
    }
    else {
      $img = $data['img'];
      $word = $data['word'];
    }

    return el('section', [
      img($img) . '<br />',
      card($word, ['mark'])
    ]);
  }

  function slideExerciseSort($data) {
    $data += [
      'options' => [' ', ' '],
      'words' => ['one', 'two', 'three']
    ];
    $this->postjs('js/exercise-sort.js');
    $out[] = div($data['options'][0], ['class' => ['width33', 'dropbox1']]);

    $options = [];
    foreach ($data['words'][0] as $w) {
      $options[] = el('card', $w, ['class' => ['dragg', 'option1'], 'mark', 'ogg']);
    }
    foreach ($data['words'][1] as $w) {
      $options[] = el('card', $w, ['class' => ['dragg', 'option2'], 'mark', 'ogg']);
    }
    shuffle($options);
    //print_r($options);
    //die();
    $out[] = div($options, ['class' => ['width33', 'stack']]);
    $out[] = div($data['options'][1], ['class' => ['width33', 'dropbox2']]);
    return el('section', $out, ['class' => 'exercise-sort']);
  }
}
 ?>
