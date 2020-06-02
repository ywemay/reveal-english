$("[audio]").click(function () {
  playElementAudio(this);
});

function playElementAudio(el) {
  var audioFileName = false
  if($(el).attr('audio')) {
    var audioFileName = 'audio/' + $(el).attr('audio');
    if (!audioFileName.match(/.(mp3|ogg)$/)) {
      audioFileName += '.mp3';
    }
  }
  else if ($(el).text()) {
    var txt = strtokey($(el).text());
    audioFileName = 'audio/' + txt + '.ogg';
  }
  if (!audioFileName) return;
  var audio = new Audio(audioFileName);
  // var oldBg = $(this).css('background');
  // $(this).css('background', 'yellow');
  // var theItem = $(el);
  audio.addEventListener('ended', function() {
    // theItem.css('background', oldBg);
  }, false);
  audio.play();
}

function playChain(words) {
    var audio = new Audio('audio/' + words[0] + '.mp3');
    words = words.splice(1, 20);
    if (words.length > 0) {
      audio.addEventListener('ended', function() {
        playChain(words)
      })
    }
    audio.play();
}
