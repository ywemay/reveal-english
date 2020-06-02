console.log("Herereljh;ljhlk");
$('.tap-spawn-game .tapable').click(function(event) {
  console.log(event);
  var circle = '<circle cx="' + event.offsetX + '" cy="' + event.offsetY;
  circle +=  '" r="35" stroke="black" stroke-width="1" fill="' + $(this).attr('audio') +'" />';
  $(this).html($(this).html() + circle);
});

$(".tap-span-game").closest("section").each(function(){
  $(this).attr('data-prevent-swipe', true);
})
