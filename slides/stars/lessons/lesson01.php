<section class="paintgame full" current_fill="fill:white;">
    <?php print paintgame([
      'art' => 'img/svg/Jack_paint.svg',
      'buttons' => ['red', ['#fca', 'beige'], 'blue', 'brown', 'black', 'white']
    ]); ?>
</section>

<section class="paintgame full" current_fill="fill:white;">
    <?php print paintgame([
      'art' => 'img/svg/Lilly.svg',
      'buttons' => [['#ef4a9c', 'pink'], 'orange', ['#fca', 'beige'], 'blue', 'brown', 'black', 'white', 'lightblue']
    ]); ?>
    <button audio="hello_im_lilly">Hello!</button>
</section>

<section class="paintgame full" current_fill="fill:white;">
    <?php print paintgame([
      'art' => 'img/svg/Horsey.svg',
      'buttons' => ['white', ['#704526', 'darkbrown'], ['#a36739', 'brown']]
    ]); ?>
</section>

<section>
  <h6>Listen and Order</h6>
  <div class="ordering-elements">
    <img class="dragg" audio="Jack" src="img/svg/Jack.svg" />
    <img class="dragg" audio="Lilly" src="img/svg/Lilly.svg" />
    <img class="dragg" audio="Horsey" src="img/svg/Horsey.svg" />
    <img class="dragg" audio="Bella" src="img/svg/Bella.svg" />
    <img class="dragg" audio="mom" src="img/svg/mom.svg" />
    <img class="dragg" audio="dad" src="img/svg/dad.svg" />
    <img class="dragg" audio="grandma" src="img/svg/grandma.svg" />
    <img class="dragg" audio="grandpa" src="img/svg/grandpa.svg" />
  </div>
  <br />
  <div class="ordering-box dropp">
  </div>
</section>
