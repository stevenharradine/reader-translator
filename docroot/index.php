<!doctype html>
<html>
  <head>
    <link rel="stylesheet" href="styles.css" />
    <script src="functionality.js"></script>
  </head>
  <body>
    <div id="menu">
      <a id="menuIcon">☰</a>
      <ul id="menuBody">
        <li>
          Origin Language
          <select id="originLanguage">
            <option>fr</option>
            <option>en</option>
            <option selected=selected>es</option>
          </select>
        </li>
        <li>
          Destination Language
          <select id="destinationLanguage">
            <option>fr</option>
            <option selected=selected>en</option>
            <option>es</option>
          </select>
        </li>
        <li>
          <button onclick="addNewSourceContent()">Add source content</button>
          <textarea id="newContent" col=10 rows=10></textarea>
        </li>
      </ul>
    </div>
    <div id="translation"><span style="font-style: italic;">&lt;--- Open the menu and add source content</span></div>
    <div id="content"></div>
    <script>
      // menu
      document.getElementById("menuIcon").onclick = function () {
        if (document.getElementById("menuIcon").innerHTML == "☰") {
          document.getElementById("menuIcon").innerHTML = "X"
          document.getElementById("menu").classList.add("open")
        } else {
          document.getElementById("menuIcon").innerHTML = "☰"
          document.getElementById("menu").classList.remove("open")
        }
      }
    </script>
  </body>
</html>