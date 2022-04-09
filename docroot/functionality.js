function addWord (sourceWord, sourceLanguage, destinationLanguage) {
  var sourceWord=prompt(sourceLanguage + " word:", sourceWord);
  var destinationWord=prompt(destinationLanguage + " word:");

  // automaticly validate (not empty string and not null)
  if ((sourceWord != "" && sourceWord !== null) && (destinationWord != "" && destinationWord !== null)) {
    // manual confirmation
    var confirmation=confirm(sourceLanguage + ": " + sourceWord + "\n" + destinationLanguage + ": " + destinationWord)

    if (confirmation) {
      const xhttp = new XMLHttpRequest();
      xhttp.open("GET", "addWord.php?originWord=" + sourceWord + "&originLanguage=" + sourceLanguage + "&destinationWord=" + destinationWord + "&destinationLanguage=" + destinationLanguage, false);  // blocking call to add item
      xhttp.send();
      translateWord (sourceWord, sourceLanguage, destinationLanguage)
    } else {
      alert ("manual abort")
    }
  } else {
    alert ("automatic abort")
  }
}
function translateWord (word, sourceLanguage, destinationLanguage) {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("translation").innerHTML = word + " : " + this.responseText + "<button id='add' onclick='addWord(\"" + word + "\", \"" + sourceLanguage + "\", \"" + destinationLanguage + "\")'>Add</button>";
    document.getElementById("add").focus()
  }
  xhttp.open("GET", "translateWord.php?word=" + word + "&source=" + sourceLanguage + "&destination=" + destinationLanguage);
  xhttp.send();
}
function addNewSourceContent() {
  originLanguage = document.getElementById("originLanguage").options[document.getElementById("originLanguage").selectedIndex].value
  destinationLanguage = document.getElementById("destinationLanguage").options[document.getElementById("destinationLanguage").selectedIndex].value

  // add div tags on new lines
  document.getElementById('content').innerHTML = "<div class='translate'>" + document.getElementById('newContent').value.replaceAll("\n", "</div><div class='translate'>") + "</div>"

  // add header for first line
  document.getElementById('content').innerHTML = document.getElementById('content').innerHTML.replace("<div", "<h1").replace("</div", "</h1")

  // add spans to words so they are clickable
  var sections = document.getElementsByClassName ("translate")

  for (var i = 0; i < sections.length; i++) {
    var words = sections[i].innerHTML.split(" ")
    var buffer = ""

    for (var j = 0; j < words.length; j++) {
      var word = words[j]
      var safeWord = word.replaceAll(/("|'|“|”|<|>|,)/g,"").replaceAll(".","").replaceAll("(","").replaceAll(")","")

      buffer += "<span onclick=\"translateWord ('" + safeWord + "','" + originLanguage + "','" + destinationLanguage + "')\">" + word + "</span> "
    }

    sections[i].innerHTML = buffer
    document.getElementById("translation").innerHTML = '<span style="font-style: italic;">Click a word to translate it</span>'
  }
}