<?php 
if(isset($_POST['submit'])) { 
$body = "Meno hráča: $meno\n Vek hráča: $vek\n E-Mail: $email\n Tel. číslo: $cislo\n Meno postavy: $menop\n Typ postavy: $novmin\n Rasa:$rasa\n Povolanie: $povol\n Presvecenie: $presv\n BG: \n $bg\n Zdravotné problémy: \n $zdrav";
mail('andrejmasar@centrum.sk', 'Registrácia', $body);
}
?>
