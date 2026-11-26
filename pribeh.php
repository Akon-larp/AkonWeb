<?php
  include "head.php";
?>
<body>
  <div id="all">
    <div id="top-banner">
      <img src="data/topbanner.png">
    </div>
    <div id="menu">
      <dl>
        <a href="uvod.php">
          <dd> Úvod
          </dd></a>
        <a href="pribeh.php">
          <dd> Príbeh
          </dd></a>
        <a href="pravidla.php">
          <dd> Pravidlá
          </dd></a>
        <a href="fotky.php">
          <dd> Fotky
          </dd></a>
        <a href="reg.php">
          <dd> Registrácia
          </dd></a>
        <a href="kontakt.php">
          <dd> Kontakt
          </dd></a>
      </dl>
    </div>
    <img id="obrazL" src="data/zena.png">
    <img id="obrazR" src="data/fuso.png" width="105px">
    <div id="content">
      <h1>Príbeh</h1>
      <a href="data/mapa.jpg" data-lightbox="image-1"><img src="data/mapa.jpg" width="200px" style="position:relative; float: right;"></a>
      <h2>
        <u>Dokumenty:</u></h2>
      <div id="clickable">
        <div id="za">
          <h3 onclick="document.getElementById('za').innerHTML=za;">
            Zákony Akonu</h3>
        </div>
        <div id="ks">
          <h3 onclick="document.getElementById('ks').innerHTML=ks;">
            Kráľove Slová</h3>
        </div>
        <div id="zm">
          <h3 onclick="document.getElementById('zm').innerHTML=zm;">
            Zánik Makenu - Vznik Akonu</h3>
        </div>
        <div id="mm">
          <h3 onclick="document.getElementById('mm').innerHTML=mm;">
            Mŕtvy z Makenu</h3>
        </div>
      </div>
      <h2>
        <u>Reporty:</u></h2>
      <div id="clickable">
        <div id="dpt">
          <h3 onclick="document.getElementById('dpt').innerHTML=dpt;">
            Denník Paladina Terrodauna</h3>
        </div>
        <div id="pv">
          <h3 onclick="document.getElementById('pv').innerHTML=pv;">
            Pribeh Vyslanca Akonu</h3>
        </div>
        <div id="zz">
          <h3 onclick="document.getElementById('zz').innerHTML=zz;">
            Zápisky Zlatého Elfa Kúzelníka</h3>
        </div>
        <div id="cd">
          <h3 onclick="document.getElementById('cd').innerHTML=cd;">
            Cesta do Akonu</h3>
        </div>
      </div>
</body>
</html>
