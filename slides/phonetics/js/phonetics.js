function strtokey(str) {
  str = str.toLowerCase();
  str = str.replace(new RegExp(/(^\W+?)|(\W+?$)/, 'g'), '');
  str = str.replace(new RegExp(/\W+/, 'g'), '_');
  return str;
}

$("div[autoaudio]").each(function(){
  var iNr = 1;
  var sFormat = $(this).attr('autoaudio');
  $(this).find('example').each(function(){
    $(this).attr('logg', sFormat.replace(/\%s/, (iNr<10 ? '0' + iNr : iNr)));
    iNr++;
  });
});

$("example, card, ogg").click(function () {
  var audioFileName = false

  if($(this).attr('mp3')) {
    var audioFileName = 'audio/' + lessonId + '/' + $(this).attr('mp3');
  }
  else if ($(this).prop('tagName') == 'OGG' || this.hasAttribute('ogg')) {
    var txt = $(this).text().replace(new RegExp(/( ?\/.*?\/ ?)/, 'g'), '');
    audioFileName = 'audio/' + lessonId +'/../' + txt + '.ogg';
  }
  else if (this.hasAttribute('logg')) {
    var txt = $(this).attr('logg');
    if (!txt) txt = strtokey($(this).text());
    audioFileName = 'audio/' + lessonId +'/' + txt + '.ogg';
  }
  if (!audioFileName) return;
  var audio = new Audio(audioFileName);
  var oldBg = $(this).css('background');
  $(this).css('background', 'yellow');
  var theItem = $(this);
  audio.addEventListener('ended', function() {
    theItem.css('background', oldBg);
  }, false);
  audio.play();
});

$("phonetable").each(function() {
  var theCols = $(this).attr("cols").split(", ");
  var theRows = $(this).attr("rows").split(", ");
  var bInvert = $(this).attr("invert");
  //body reference        }

  //var body = document.getElementsByTagName("body")[0];

  // create elements <table> and a <tbody>
  var tbl = document.createElement("table");
  var tblBody = document.createElement("tbody");

  var row = document.createElement("tr");
  var th = document.createElement("th");
  row.appendChild(th);

  for (var i = 0; i < theCols.length; i++) {
    // create element <td> and text node
    //Make text node the contents of <td> element
    // put <td> at end of the table row
    var cell = document.createElement("th");
    var cellText = document.createTextNode(theCols[i]);

    cell.appendChild(cellText);
    row.appendChild(cell);
  }
  tblBody.appendChild(row);

  // cells creation
  for (var j = 0; j < theRows.length; j++) {
    // table row creation
    var row = document.createElement("tr");
    var th = document.createElement("th");
    var cellText = document.createTextNode(theRows[j]);
    th.appendChild(cellText);
    row.appendChild(th);


    for (var i = 0; i < theCols.length; i++) {
      // create element <td> and text node
      //Make text node the contents of <td> element
      // put <td> at end of the table row
      var cell = document.createElement("td");
      if (!bInvert) {
        var cellText = document.createTextNode(theRows[j] + theCols[i]);
      }
      else {
        var cellText = document.createTextNode(theCols[i] + theRows[j]);
      }

      cell.appendChild(cellText);
      row.appendChild(cell);
    }

    //row added to end of table body
    tblBody.appendChild(row);
  }

  // append the <tbody> inside the <table>
  tbl.appendChild(tblBody);
  // put <table> in the <body>
  this.appendChild(tbl);

});

function fakeSprintf(aStr, aVar) {
  var sParts = aStr.split('%s');
  if (sParts.length < 2) return;
  return sParts.join(aVar);
}

function replaceAll(txt, toRepl, replWith) {
  if (toRepl instanceof Array) {
    for(var i=0; i<toRepl.length; i++) {
      txt = txt.split(toRepl[i]).join(fakeSprintf(replWith, toRepl[i]));
    }
  }
  else {
      txt = txt.split(toRepl).join(fakeSprintf(replWith, toRepl));
  }
  return txt;
}

function instruction2Span(instr, theKey) {
  if (instr == 'vowel' || instr == 'voiced' || instr == 'unvoiced') {
    return '<span class="' + instr + '">' + theKey + '</span>';
  }
  return instr;
}

function getColorMarking(txt, filterMap = false) {
  var map = {
    'P': 'unvoiced',
    'p': '<span class="unvoiced">p</span>',
    't': '<span class="unvoiced">t</span>',
    'k': '<span class="unvoiced">k</span>',
    'b': '<span class="voiced">b</span>',
    'd': '<span class="voiced">d</span>',
    'g': '<span class="voiced">g</span>',
    'ea': 'vowel',
    'a': 'vowel',
    'æ': 'vowel',
    'ee': 'vowel',
    'ie': 'vowel',
    'ey': 'vowel',
    'i:': 'vowel',
    'i': 'vowel',
    'ɪ': 'vowel',
  }
  if (filterMap) {
    var newMap = {};
    for(var l = 0; l<filterMap.length; l++) {
      newMap[filterMap[l]] = map[filterMap[l]];
    }
    map = newMap;
  }
  var rez = '';
  for(var i=0; i<txt.length; i++) {
    if (i < txt.length - 1 && map[txt[i] + txt[i+1]]) {
      theKey = txt[i] + txt[i+1];
      rez += instruction2Span(map[theKey], theKey);
      i = i + 1;
    }
    else if (map[txt[i]]) {
      rez += instruction2Span(map[txt[i]], txt[i]);
    }
    else {
      rez += txt[i];
    }
  }
  return rez;
}

$("card.autocolor").each(function(){
    // var txt = $(this).html();
    $(this).html(getColorMarking($(this).html()));
});

function markedToSpans(str) {
  var re = new RegExp(/[\^\`](.)|\!(.+)\!/, 'g')
  return str.replace(re, "<span>$1$2</span>");
}

$("card[mark], example[mark], table tr td[mark], .exercise[mark] li").each(function(){
  $(this).html(markedToSpans($(this).html()));
  // var re = new RegExp(/[\^\`](.)|\!(.+)\!/, 'g')
  // $(this).html($(this).html().replace(re, "<span>$1$2</span>"));
});

$('.exercise li').each(function(){
  var txt = $(this).html();
  var txt = '<word>' + (txt.replace(new RegExp(/ ([BCD]\.)/, 'g'), '</word> <word>$1')) + '</word>';
  $(this).html(txt);
});

$("card").each(function() {
  if (!$(this).attr('span')) return;
  // var repl = $(this).attr('span');
  // var txt = $(this).html();
  // $(this).html(txt.split(repl).join('<span>' + repl + '</span>'));
  var parts = $(this).attr('span').split(', ');
  $(this).html(getColorMarking(this.innerHTML, parts));
});

$("example").each(function() {
  if (!$(this).attr('span')) return;
  // var repl = $(this).attr('span');
  // var txt = $(this).html();
  // $(this).html(txt.split(repl).join('<span>' + repl + '</span>'));
  var parts = $(this).attr('span').split(', ');
  $(this).html(getColorMarking($(this).html(), parts));
});

$("table.autonumber").each(function(){
  var tdNr = 0
  var letters = [false, 'A', 'B', 'C', 'D', 'E'];
  $(this).find('tr').each(function(){
    if (td = $(this).find('td:first')) {
      tdNr++;
      $(td).html('' + tdNr + '.');
    }
    var tdCount = 0
    $(this).find('td').each(function(){
      if (letters[tdCount]) {
        $(this).html(letters[tdCount] + '. ' + $(this).html());
      }
      tdCount++;
    });
  })
});

$(".exercise .answer").click(function(){
  console.log($(this).text());
})

document.addEventListener('keyup', function(event) {
  if(!$('section.present').hasClass('game')) {
    if (event.which == 32) Reveal.next(); // Default space
    return;
  }

  var gType = $('section.present').attr('gametype');

  switch(gType) {
    case 'choosefalseone':
      gameChooseFalseOne($('section.present'), event.which);
      break;
  }
});

var audioTada = new Audio('audio/effects/tada_movie.wav');
var audioTada2 = new Audio('audio/effects/tada_movie.wav');
var audioError = new Audio('audio/effects/error.wav');
var tadaOne = false;
function playTada(){
  if (tadaOne) {
    audioTada.play();
  }
  else {
    audioTada2.play();
  }
  tadaOne = !tadaOne;
}

function gameChooseFalseOne(el, keyCode) {
  var correct = $(el).attr('correct').split(', ');
  var false_options = $(el).attr('false').split(', ');
  $(el).find('game').each(function(){
    if (keyCode == 32) {
      correct = getRandomArrayElements(correct, 2);
      incorrect = getRandomArrayElements(false_options, 1);
      rezarr = shuffle(correct.concat(incorrect));
      var rzHtml = '';
      for(i in rezarr) {
        stl = rezarr[i] == incorrect[0] ? ' class="card' + i + ' right"' : ' class="card' + i + '"';
        rzHtml += '<card' + stl + '>' + markedToSpans(rezarr[i]) + '</card>';
      }
      $(this).html(rzHtml);
      if(!$(el).hasClass('waitanswer')) $(el).addClass('waitanswer');
    }
    else if($(el).hasClass('waitanswer')) {
      var codes = {
        65: [1, 0], // a
        83: [1, 1], // s
        68: [1, 2], // d
        74: [2, 0], // j
        75: [2, 1], // k
        76: [2, 2], // l
      }
      if (codes[keyCode]) {
        $(el).removeClass('waitanswer');
        var ans = codes[keyCode];
        if ($(el).find('.card' + ans[1]).hasClass('right')) {
          var score = $(el).find('.player0' + ans[0]);
          score.html(parseInt(score.text()) + 1);
          $(el).find('.card' + ans[1]).addClass('green');
          playTada();
        }
        else {
          $(el).find('.card' + ans[1]).addClass('red');
          audioError.play();
        }
      }
    }
  })
}

function shuffle(array) {
  var currentIndex = array.length, temporaryValue, randomIndex;

  // While there remain elements to shuffle...
  while (0 !== currentIndex) {

    // Pick a remaining element...
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex -= 1;

    // And swap it with the current element.
    temporaryValue = array[currentIndex];
    array[currentIndex] = array[randomIndex];
    array[randomIndex] = temporaryValue;
  }

  return array;
}

function getRandomArrayElements(arr, count) {
    var shuffled = arr.slice(0), i = arr.length, min = i - count, temp, index;
    while (i-- > min) {
        index = Math.floor((i + 1) * Math.random());
        temp = shuffled[index];
        shuffled[index] = shuffled[i];
        shuffled[i] = temp;
    }
    return shuffled.slice(min);
}
