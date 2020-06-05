$('.exercise-sort .dragg').draggable();

function removeWrongCorrect(el) {
  if ($(el).hasClass('correct-option')) {
    $(el).removeClass('correct-option');
  }
  if ($(el).hasClass('wrong-option')) {
    $(el).removeClass('wrong-option');
  }
}

$('.exercise-sort .dropbox1').droppable({
  drop: function(event, ui) {
    removeWrongCorrect(ui.draggable);
    if ($(ui.draggable).hasClass('option1')) {
      $(ui.draggable).addClass('correct-option');
      playAudioFile('audio/effects/weee.wav');
    } else {
      $(ui.draggable).addClass('wrong-option');
      playAudioFile('audio/effects/error.wav');
    }
  }
});

$('.exercise-sort .dropbox2').droppable({
  drop: function(event, ui) {
    removeWrongCorrect(ui.draggable);
    if ($(ui.draggable).hasClass('option2')) {
      $(ui.draggable).addClass('correct-option');
      playAudioFile('audio/effects/weee.wav');
    } else {
      $(ui.draggable).addClass('wrong-option');
      playAudioFile('audio/effects/error.wav');
    }
  }
});
