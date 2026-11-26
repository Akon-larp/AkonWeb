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
      <h1>Registrácia</h1>
<?php
$mail = $body = $meno = $vek = $email = $cislo = $menop = $rasa = $povol = $presv = $viera = $novmin = $bg = $zdrav = $rasaT = "";
$menoErr = $vekErr = $emailErr = $cisloErr = $menopErr = $rasaErr = $povolErr = $presvErr = $vieraErr = $novminErr = $bgErr = $zdravErr = "";
$valid = "1";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
   if (empty($_POST["meno"]))
     {
     $menoErr = "Nezadané meno!";
     $valid = "0";
     }
   else
     {
     $meno = ohol($_POST["meno"]);
     if (!preg_match("/^[a-zA-Z ]*$/",$meno))
       {
       $menoErr = "Používaj iba písmená a medzeru!";
       $valid = "0";
       }
     }
     
  if (empty($_POST["vek"]))
     {
     $vekErr = "Nezadaný vek!";
     $valid = "0";
     }
   else
     {
     $vek = ohol($_POST["vek"]);
     if (!preg_match("/^[0-9 ]*$/",$vek))
       {
       $vekErr = "Používaj iba čísla a medzeru!";
       $valid = "0";
       }
     }
     
  if (empty($_POST["email"]))
     {
     $emailErr = "Nezadaný email!";
     $valid = "0";
     }
   else
     {
     $email = ohol($_POST["email"]);
     if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email))
       {
       $emailErr = "Zlý formát emailu!";
       $valid = "0";
       }
     }
     
  if (empty($_POST["cislo"]))
     {
     $cisloErr = "Nezadané telefóne číslo!";
     $valid = "0";
     }
   else
     {
     $cislo = ohol($_POST["cislo"]);
     if (!preg_match("/^[0-9 ]*$/",$cislo))
       {
       $cisloErr = "Používaj iba čísla a medzeru!";
       $valid = "0";
       }
     }
     
   if (empty($_POST["menop"]))
     {
     $menopErr = "Nezadané meno postavy!";
     $valid = "0";
     }
   else
     {
     $menop = ohol($_POST["menop"]);
     if (!preg_match("/^[a-zA-Z ]*$/",$menop))
       {
       $menopErr = "Používaj iba písmená a medzeru!";
       $valid = "0";
       }
     }    
        
   if (empty($_POST["rasa"]))
     {
     $rasaErr = "Nezadaná rasa!";
     $valid = "0";
     }
   else
     {$rasa = ohol($_POST["rasa"]);}

   if (empty($_POST["povol"]))
     {
     $povolErr = "Nezadané povolanie!";
     $valid = "0";
     }
   else
     {$povol = ohol($_POST["povol"]);}

   if (empty($_POST["presv"]))
     {
     $presvErr = "Nezadané presvečenie!";
     $valid = "0";
     }
   else
     {$presv = ohol($_POST["presv"]);}
      
   if (empty($_POST["novmin"]))
     {
     $novminErr = "Je to nová postava, alebo pokračuješ v starej?!";
     $valid = "0";
     }
   else
     {$novmin = ohol($_POST["novmin"]);}
 
   if (empty($_POST["bg"]))
     {
     $bg = "";
     $valid = "0";
     $bgErr = "Nezadané BG!";
     }
   else
     {$bg = ohol($_POST["bg"]);}

   if (empty($_POST["zdrav"]))
     {
     $zdrav = "";
     
     }
   else
     {$zdrav = ohol($_POST["zdrav"]);}


if(isset($_POST['submit']) && ($valid!="0")) { 
$body = "Meno hráča: $meno\n Vek hráča: $vek\n E-Mail: $email\n Tel. číslo: $cislo\n Meno postavy: $menop\n Typ postavy: $novmin\n Rasa:$rasa\n Povolanie: $povol\n Presvecenie: $presv\n BG: \n $bg\n Zdravotné problémy: \n $zdrav";
$mail = "mail('andrejmasar55@gmail.com', 'Registrácia', '$body', '$email')";
}
}

function ohol($data)
{
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
} 
?>

<h2>Registračka</h2>
<p><span class="error">* polia nutné vyplniť.</span></p>
<form method="post" action="<?php echo $mail; ?>">
   Meno hráča: <input type="text" name="meno" value="<?php echo $meno;?>">
   <span class="error">* <?php echo $menoErr;?></span>
   <br><br>
   Vek hráča ktorý dosiahne ku dňu 1.7.2014: <input type="text" name="vek" value="<?php echo $vek;?>">
   <span class="error">* <?php echo $vekErr;?></span>
   <br><br>
   E-mail: <input type="text" name="email" value="<?php echo $email;?>">
   <span class="error">* <?php echo $emailErr;?></span>
   <br><br>
   Tel. číslo: <input type="text" name="cislo" value="<?php echo $cislo;?>">
   <span class="error">* <?php echo $cisloErr;?></span>
   <br><br>
   Meno postavy: <input type="text" name="menop" value="<?php echo $menop;?>">
   <span class="error">* <?php echo $menopErr;?></span>
   <br><br>
   Typ postavy:
   <input type="radio" name="novmin" <?php if (isset($novmin) && $novmin=="Nová postava") echo "checked";?>  value="Nová postava">Nová postava
   <input type="radio" name="novmin" <?php if (isset($novmin) && $novmin=="Stará postava") echo "checked";?>  value="Stará postava">Stará postava
   <span class="error">* <?php echo $novminErr;?></span>
   <br><br>
   Rasa: <select name="rasa" id="rasa">
   <option value=""><-- vyber --></option>
   <option onclick="document.getElementById('povol').innerHTML=clovek;" value="Človek">Človek</option>
   <option onclick="document.getElementById('povol').innerHTML=horal;" value="Horal">Horal</option>
   <option onclick="document.getElementById('povol').innerHTML=nix;" value="Nix">Nix</option>
   <option onclick="document.getElementById('povol').innerHTML=droub;" value="Droub">Droub</option>
   <option onclick="document.getElementById('povol').innerHTML=hobit;" value="Hobit">Hobit</option>
   <option onclick="document.getElementById('povol').innerHTML=sorp;" value="Sorp">Sorp</option>
   <option onclick="document.getElementById('povol').innerHTML=dulon;" value="Dulon">Dulon</option>
   <option onclick="document.getElementById('povol').innerHTML=lesny;" value="Lesný elf">Lesný elf</option>
   <option onclick="document.getElementById('povol').innerHTML=zlaty;" value="Zlatý elf">Zlatý elf</option>
   <option onclick="document.getElementById('povol').innerHTML=derkansky;" value="Derkánsky elf">Derkánsky elf</option>
   <option onclick="document.getElementById('povol').innerHTML=targonsky;" value="Targónsky elf">Targónsky elf</option>
   <option onclick="document.getElementById('povol').innerHTML=temny;" value="Temný elf">Temný elf</option>
   <option onclick="document.getElementById('povol').innerHTML=trpaslik;" value="Trpaslík">Trpaslík</option>
   <option onclick="document.getElementById('povol').innerHTML=amazonka;" value="Amazonka">Amazonka</option>
   <option onclick="document.getElementById('povol').innerHTML=zorx;" value="Zorx">Zorx</option>
   </select>
   <span class="error">* <?php echo $rasaErr;?></span>
   <br><br>
   Povolanie: <select name="povol" id="povol">
   <option value=""><-- vyber --></option>
   </select>
   <span class="error">* <?php echo $povolErr;?></span>
   <br><br>
   Presvecenie: <select name="presv" id="presv">
   <option value=""><-- vyber --></option>
   </select>
   <span class="error">* <?php echo $presvErr;?></span>
   <br><br>
   BackGround: <span class="error">* <?php echo $bgErr;?></span><br>
   <textarea name="bg" rows="5" cols="40"><?php echo $bg;?></textarea>
   <br><br>
   Vážne zdravotné problémi (ak nemáš nechaj prázdne):
   <br> 
   <textarea name="zdrav" rows="5" cols="40"><?php echo $zdrav;?></textarea>
   <br><br>
   <input type="submit" name="submit" value="Odoslať">
</form>      
      
<?php 
echo $meno;
echo "<br>";
echo $email;
echo "<br>";
echo $rasa;
echo "<br>";
echo $bg;
echo "<br>";
echo $novmin;


?>      
      
          
      <p>
        Registrovať sa môžete najneskôr do 15.6.2014 a to na email: akon-larp@azet.sk. Na tento mail mi posielajte len registrácie. Všetky vaše ostatné dotazy mi posielajte na email: patriot-sr@azet.sk, na FB na meno Nina Vasiľová, prípadne ich riešte so mnou cez mobil: 0908481813.
      </p>
      <h2>Do registrácie napíšte:</h2>
      <p>
        - Meno hráča<br />
        - Vek hráča (vek hráča ktorý dosiahne ku dňu 1.7.2014)<br />
        - Tel. číslo<br />
        - Meno postavy<br />
        - Rasa<br />
        - Povolanie<br />
        - Presvedčenie<br />
        - Viera (či je postava ateista alebo či verí v niektorého zuvedených bohov)<br />
        - Či je postava nová, alebo pokračuje z minula<br />
        - BackGround(povod postavy, ciele..)<br />
        - Ak má niekto vážne zdravotné problémi tak ich uvádzajte pri registrácii!!<br />
        - Pre tých ktorí ešte nedovŕšili 18 rokov v deň začatia akcie je potrebné aby ste doniesli vyplnené <a href="data/prehlasenie.doc">prehlásenie.</a><br /><br />
        <b>Prehlásenie:</b> Organizátor tejto hry nepreberá akúkoľvek zodpovednosť za majetok, zdravie či život účastníkov hry.
      </p>
    </div>
  </div>
</body>
</html>
