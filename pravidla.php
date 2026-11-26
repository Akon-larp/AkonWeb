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
<h1>Pravidlá</h1>
<div id="zak"><h2 class="click" onclick="document.getElementById('zak').innerHTML=zak;">Základné:</h2></div>
<div id="clickable">
<div id="zsz"><h2 onclick="document.getElementById('zsz').innerHTML=zsz;">Zbrane, štíty, zbroje:</h2></div>
<div id="sau"><h2 onclick="document.getElementById('sau').innerHTML=sau;">Skúsenosti a úroveň:</h2></div>
<div id="pre"><h2 onclick="document.getElementById('pre').innerHTML=pre;">Presvedčenie:</h2></div>
<div id="rs"><h2 onclick="document.getElementById('rs').innerHTML=rs;">Rasy:</h2></div>
<div id="po"><h2 onclick="document.getElementById('po').innerHTML=po;">Povolania:</h2></div>
<div id="bh"><h2 onclick="document.getElementById('bh').innerHTML=bh;">Bohovia</h2></div>
<div id="ty"><h2 onclick="document.getElementById('ty').innerHTML=ty;">Tituly</h2></div>
</div>
</div>
</div>
</body>
</html>
