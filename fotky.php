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
      <h1>Fotky</h1>
        <div id="clickable">
          <div id="akon1">
            <h2 onclick="document.getElementById('akon1').innerHTML=akon1;">
              Akon I:</h2>
          <img id="fotkyheader" src="data/akon1.jpg" onclick="document.getElementById('akon1').innerHTML=akon1;">
          </div>
          <div id="akon2">
            <h2 onclick="document.getElementById('akon2').innerHTML=akon2;">
              Akon II:</h2>
          <img id="fotkyheader" src="data/akon2.jpg" onclick="document.getElementById('akon2').innerHTML=akon2;">
          </div>
          <div id="akon3">
            <h2 onclick="document.getElementById('akon3').innerHTML=akon3;">
              Akon III:</h2>
          <img id="fotkyheader" src="data/akon3.jpg" onclick="document.getElementById('akon3').innerHTML=akon3;">
          </div>
          <div id="akon4">
            <h2 onclick="document.getElementById('akon4').innerHTML=akon4;">
              Akon IV:</h2>
          <img id="fotkyheader" src="data/akon4.jpg" onclick="document.getElementById('akon4').innerHTML=akon4;">
          </div>
          <!-- <a href="http://img13.rajce.idnes.cz/d1303/9/9450/9450943_3fae0c2f0cff5f0b47d5407cdb777839/images/Akon11.jpg?ver=0" data-lightbox="image-1"><img src="http://img13.rajce.idnes.cz/d1303/9/9450/9450943_3fae0c2f0cff5f0b47d5407cdb777839/images/Akon11.jpg?ver=0"></a> -->
        </div>
      </div>
   <?php 
    //for ($i=1; $i<=146; $i++) {
  // echo "<a href=\"http://img20.rajce.idnes.cz/d2002/9/9451/9451078_6e13b289b0a6707d4662f9c2770b6c20/images/Akon3". $i .".jpg?ver=0\" data-lightbox=\"image-1\"><img src=\"http://img20.rajce.idnes.cz/d2002/9/9451/9451078_6e13b289b0a6707d4662f9c2770b6c20/images/Akon3". $i .".jpg?ver=0\"></a>";            
 //   } 
      ?> 
    </div>
</body>
</html>


