<?php

$oGame = new Game();

?>
<section>
  <h1>Learning Stars</h1>
  <h3>Horse, Fox, Fish</h3>
</section>

<section>
  <h3>Warm up</h2>
  <video src="/video/simplesongs/action_song.mp4" controls>
    Choose a video song for warm up.
  </video>
</section>

<section>
  <svg height="500" width="500" audio="orange">
    <circle cx="250" cy="250" r="240" stroke="black" stroke-width="1" fill="orange" />
      Sorry, your browser does not support inline SVG.
  </svg>
</section>

<section class="game">
  <h1>Game time</h1>
  <p>
    <a href="/games/baloony/Baloony.html" target="_game">Baloony Game</a>
  </p>
  <svg height="200" width="200" audio="orange">
    <circle cx="100" cy="100" r="95" stroke="black" stroke-width="1" fill="orange" />
  </svg>
</section>

<section>
  <svg height="500" width="500" audio="white">
    <circle cx="250" cy="250" r="240" stroke="black" stroke-width="1" fill="white" />
      Sorry, your browser does not support inline SVG.
  </svg>
</section>

<section class="game">
  <h1>Game time</h1>
  <p>
    <a href="/games/baloony/Baloony.html" target="_game">Baloony Game</a>
  </p>
  <svg height="200" width="200" audio="orange">
    <circle cx="100" cy="100" r="95" stroke="black" stroke-width="1" fill="orange" />
  </svg>
  <svg height="200" width="200" audio="white">
    <circle cx="100" cy="100" r="95" stroke="black" stroke-width="1" fill="white" />
  </svg>
</section>

<section>
  <svg height="500" width="500" audio="blue">
    <circle cx="250" cy="250" r="240" stroke="black" stroke-width="1" fill="blue" />
  </svg>
</section>

<section class="game">
  <h1>Game time</h1>
  <p>
    <a href="/games/baloony/Baloony.html" target="_game">Baloony Game</a>
  </p>
  <svg height="200" width="200" audio="orange">
    <circle cx="100" cy="100" r="95" stroke="black" stroke-width="1" fill="orange" />
  </svg>
  <svg height="200" width="200" audio="white">
    <circle cx="100" cy="100" r="95" stroke="black" stroke-width="1" fill="white" />
  </svg>
  <svg height="200" width="200" audio="blue">
    <circle cx="100" cy="100" r="95" stroke="black" stroke-width="1" fill="blue" />
  </svg>
</section>

<section>
  <h6>Chant</h6>
  <audio src="/songs/claps.ogg" controls>
    Browser does not support audio.
  </audio>
  <div class="tap-spawn-game">
    <svg class="tapable orange" audio="orange" width=220pt height=320pt>
    </svg>
    <svg class="tapable white" audio="white" width=220pt height=320pt>
    </svg>
    <svg class="tapable blue" audio="blue" width=220pt height=320pt>
    </svg>
  </div>
  <notes class="notes">
    Orange is not yellow,
    Orange orange is.
    So if you see an orange -
    Call it orange please.

    What is white?
    The paper is.
    Sky is blue.
    Eat orange please.

    I can say blue
    Times tow or three
    Can you say Orange
    With me?

    Snow is white.
    An white ice cream.
    A blue ball.
    An orange team.
  </notes>
</section>

<section>
  <h3>Horse</h3>
  <img src="img/horse_white.png" audio="horse" />
</section>

<section class="paintgame" current_fill="fill:white;">
    <?php print $oGame->paintgame([
      'art' => 'img/svg/horse.svg',
      'buttons' => ['white', 'black']
    ]); ?>
</section>

<section>
  <h3>Fox</h3>
  <img class="clean" src="img/fox.png" audio="fox" />
</section>

<section class="paintgame" current_fill="fill:white;">
    <?php print $oGame->paintgame([
      'art' => 'img/svg/fox.svg',
      'buttons' => ['white', 'orange']
    ]); ?>
</section>

<section>
  <h3>Fish</h3>
  <img src="img/fish.png" audio="fish" />
</section>

<section class="paintgame" current_fill="fill:white;">
    <?php print $oGame->paintgame([
      'art' => 'img/svg/fish.svg',
      'buttons' => ['blue', 'lightblue', 'darkblue', 'yellow']
    ]); ?>
</section>

<section>
  <div class="cols3">
    <div class="col">
      <img class="dragg" src="img/horse_white.png" /><br />
      <img class="dragg" src="img/fox.png" /><br />
      <img class="dragg" src="img/fish.png" />
    </div>
    <div class="col">
    </div>
    <div class="col">
      <svg height="200" width="200">
        <circle cx="100" cy="100" r="90" stroke="black" stroke-width="1" fill="orange" />
      </svg><br />
      <svg height="200" width="200">
        <circle cx="100" cy="100" r="90" stroke="black" stroke-width="1" fill="blue" />
      </svg><br />
      <svg height="200" width="200">
        <circle cx="100" cy="100" r="90" stroke="black" stroke-width="1" fill="white" />
      </svg><br />
  </div>
</section>

<section>
  <h6>Listen and Order</h6>
  <div class="ordering-elements">
    <img class="dragg" audio="horse" src="img/horse_white.png" />
    <img class="dragg" audio="fox" src="img/fox.png" />
    <img class="dragg" audio="fish" src="img/fish.png" />
    <img class="dragg" audio="horse" src="img/horse_white.png" />
    <img class="dragg" audio="fox" src="img/fox.png" />
    <img class="dragg" audio="fish" src="img/fish.png" />
  </div>
  <br />
  <div class="ordering-box dropp">
  </div>
</section>

<section>
  <h6>Listen and Order</h6>
  <div class="ordering-elements">
    <img class="dragg" audio="horse" src="img/horse_white.png" />
    <svg class="dragg" audio="orange">
      <circle cx="50" cy="40" r="39" stroke="black" stroke-width="1" fill="orange" />
    </svg>
    <img class="dragg" audio="fox" src="img/fox.png" />
    <svg class="dragg" audio="blue">
      <circle cx="50" cy="40" r="39" stroke="black" stroke-width="1" fill="blue" />
    </svg>
    <img class="dragg" audio="fish" src="img/fish.png" />
    <svg class="dragg" audio="white">
      <circle cx="50" cy="40" r="39" stroke="black" stroke-width="1" fill="white" />
    </svg>
  </div>
  <br />
  <div class="ordering-box dropp">
  </div>
</section>

<section>
  <div class="ordering-elements">
    <img class="dragg" audio="horse" src="img/horse_white.png" />
    <img class="dragg" audio="fox" src="img/fox.png" />
    <img class="dragg" audio="fish" src="img/fish.png" />
  </div>
  <div class="places">
    <div class="dropparallax" style="background-image: url(img/grass_house.jpg)"></div>
    <div class="dropparallax" style="background-image: url(img/diver.jpg)"></div>
    <div class="dropparallax" style="background-image: url(img/forest.jpg)"></div>
  </div>
</section>

<section>
  <h1>The End</h1>
  <p><a href="index.html">Index</a></p>
</section>
