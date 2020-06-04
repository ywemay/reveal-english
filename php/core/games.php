<?php

class Game {

  function svg_swatches($data) {
    $cnr = count($data['buttons']);
    $h = $cnr * 50;
    $out = '<svg class="swatches" width="130px" height="' . $h . 'px" viewBox="-4 -4 130 200">';
    $x = 0;
    $y = 0;
    foreach($data['buttons'] as $btn) {
      if (is_array($btn)) {
        $clrAudio = $btn[1];
        $clr = $btn[0];
      }
      else {
        $clr = $btn;
        $clrAudio = preg_match("/[a-z\_]+/", $btn) ? $btn : false;
      }

      $audio = $clrAudio ? ' audio="' . $clrAudio . '"' : '';
      $out .= '<rect' . $audio . ' style="fill:' . $clr . '" ';
      $out .= 'x="' . $x . '"  y="' . $y . '" width="40" height="40"/>';
      $x += 50;
      if ($x >= 100) {
        $y += 50;
        $x = 0;
      }
    }
    $out .= '<rect class="selection" x="0" y="0" width="40" height="40"/>';
    $out .= '</svg>';
    return $out;
  }

  function paintgame($data) {
    $out = '    <div class="sidebar">' . "\n";
    $out .= '      ' . Game::svg_swatches($data) . "\n";
    $out .= '    </div>' . "\n";

    $out .= '   <div class="art-container">' . "\n";
    $out .= svg($data['art']);
    $out .= '   </div>';

    return $out;
  }
}
?>
