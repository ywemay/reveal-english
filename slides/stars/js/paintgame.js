
$(".paintgame .art").click(function (event) {
  if (event.target.hasAttribute('paintable') !== true) return;
  var currentFill = $(this).closest('.paintgame').attr('current_fill');
  $(event.target).attr('style', currentFill);
  paintgamePaintShape($(event.target));
});

$(".paintgame.full .art-container svg").click(function (event) {
  var currentFill = $(this).closest('.paintgame').attr('current_fill');
  $(event.target).attr('style', currentFill);
  paintgamePaintShape($(event.target));
});

$(".paintgame.full svg path").each(function() {
  $(this).attr('style', '');
});
$(".paintgame.full svg").each(function() {
  $(this).attr('style', '');
});


function paintgamePaintShape(el) {
  if(mt = el.attr('style').match(/fill\:(\w+)/)) {
    console.log(mt);
    var toPlay = []
    var ttl;
    if (ttl = el.attr('title')) {
      toPlay[toPlay.length] = ttl.split(' ').join('_');
    }
    toPlay[toPlay.length] = mt[1];
    playChain(toPlay);
  }
}

var $swatches = $(".paintgame .swatches");
$swatches.click(function (event) {
  $swatch = $(event.target);
  loc = [parseInt($swatch.attr('x'), 10), parseInt($swatch.attr('y'), 10)]
  $(".selection", $swatches).attr('x', loc[0]);
  $(".selection", $swatches).attr('y', loc[1]);
  $(this).closest('.paintgame').attr('current_fill', $swatch.attr('style'));
})

$(".paintgame").closest("section").each(function(){
  $(this).attr('data-prevent-swipe', true);
})
