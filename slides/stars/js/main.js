// Prevent swiping so that students can play games without moving to the next slide.
$('section').attr('data-prevent-swipe', true);

$('.dragg').draggable();

var droppContents = {}

$('.dropp').droppable({
  drop: function(event, ui) {
    playElementAudio(ui.draggable);
    // var sNr = 's' + window.location.hash.split('/')[1];
    if (!$(ui.draggable).hasClass('dragg')) return;

    $(this).append($(ui.draggable));
    $(ui.draggable).attr('style', '');
    $(ui.draggable).removeClass('dragg');
  }
})

$('.dropp').click(function() {
  console.log($(this))
})

$('.dropparallax').droppable({
  drop: function(event, ui) {
    var toX
    toX = parseInt($(this).css('background-position-x'));
    console.log(toX)
    toX = (toX < 0) ? 0 : -200;
    $(this).animate({
      'background-position-x': toX,
    }, 8000);
  }
})

$('.places div').click(function() {
  return;
  var toX
  toX = parseInt($(this).css('background-position-x'));
  console.log(toX)
  toX = (toX < 0) ? 0 : -200;
  $(this).animate({
    'background-position-x': toX,
  }, 8000);
})
