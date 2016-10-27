<?php

$title = 'Registrace';
$description = 'Registrace na strance nasi konference';
$tags = 'Registrace, konference, 2015, Bene�';

$aktivni = null;
// srovn�me ob� heslo PHP funkc� strcmp, pokud se nerovnaj�, vyp�eme znovu formul�� a u�ivatele upozorn�me
if (strcmp($_POST["pwd"], $_POST["pwd2"]) != 0){
	
	$text = '<h3 class="povine">Chyba při registraci. Zadaná hesla se musejí schodovat.</h3>
	
	<div class = "Prihlaseni">
		<form action="index.php?web=form/kontrola_registrace" method="post" class="form-horizontal" role="form">
 				<p class = "povine">Udaje oznacene * jsou povinne </p>
 <div class="form-group">
    <label class="control-label col-sm-2" for="login">Login*:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="uzJmeno" placeholder="Uzivatelske jmeno" required>
    </div>
  </div>
 <div class="form-group">
    <label class="control-label col-sm-2" for="jmeno">Jmeno:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="jmeno" placeholder="Jmeno">
    </div>
  </div>
	<div class="form-group">
    <label class="control-label col-sm-2" for="prijmeni">Prijmeni:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="prijmeni" placeholder="Prijmeni">
    </div>
  </div>
 <div class="form-group">
    <label class="control-label col-sm-2" for="mail">E-mail:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="mail" placeholder="Zadejte E-mail">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Heslo*:</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="pwd" placeholder="Zadejte heslo" required>
    </div>
  </div>
<div class="form-group">
    <label class="control-label col-sm-2" for="pwd2">Kontrola hesla*:</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="pwd2" placeholder="Zadejte heslo znovu" required>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Registrovat</button>
    </div>
  </div>
</form></div>';
			
			
	
}
// zkontrolujeme, �e zadan� login ji� n�kdo nepou��v� - pokud ano, vyp�eme u�ivateli chybu a znovu formul��
elseif ($db->vratIdUzivatele($_POST["uzJmeno"]) <> null){
$text = '<h3 class = "povine">Zadany login uz existuje</h3>
	<div class = "Prihlaseni">
		<form action="action="index.php?web=form/kontrola_registrace" method="post" class="form-horizontal" role="form">
			<legend>Registrace uzivatele </legend>
 				<p class = "povine">Udaje oznacene * jsou povinne </p>
 <div class="form-group">
    <label class="control-label col-sm-2" for="login">Login*:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="uzJmeno" placeholder="Uzivatelske jmeno" value="'. $_POST["uzJmeno"] .'" required>
    </div>
  </div>
 <div class="form-group">
    <label class="control-label col-sm-2" for="jmeno">Jmeno:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="jmeno" placeholder="Jmeno" value="'. $_POST["jmeno"] .'">
    </div>
  </div>
	<div class="form-group">
    <label class="control-label col-sm-2" for="prijmeni">Prijmeni:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="prijmeni" placeholder="Prijmeni" value="'. $_POST["prijmeni"] .'">
    </div>
  </div>
 <div class="form-group">
    <label class="control-label col-sm-2" for="mail">E-mail:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="mail" placeholder="Zadejte E-mail">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Heslo*:</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="pwd" placeholder="Zadejte heslo" required>
    </div>
  </div>
<div class="form-group">
    <label class="control-label col-sm-2" for="pwd2">Kontrola hesla*:</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="pwd2" placeholder="Zadejte heslo znovu"  required>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Registrovat</button>
    </div>
  </div>
</form></div>';
	
	
}
// v�e je v po��dku a nov�ho u�ivatele zaergistrujeme do datab�ze a z�rove� p�ihl�s�me
else {
	$novy_uzivatel = array();
	$novy_uzivatel["ID_uzivatel"] = "null";
	$novy_uzivatel["Jmeno"] = $_POST["jmeno"];
	$novy_uzivatel["Prijmeni"] = $_POST["prijmeni"];
	$novy_uzivatel["Login"] = $_POST["uzJmeno"];
	$novy_uzivatel["Heslo"] = $_POST["pwd"];
	$novy_uzivatel["Email"] = $_POST["mail"];
	$novy_uzivatel["janoch_prava_id_prav"] = 3;

	$db->vlozUzivatele($novy_uzivatel);


	$pr->prihlasUzivatele($novy_uzivatel["Jmeno"], $novy_uzivatel["Heslo"]);
	$glob_uzivatel = $pr->kontrolaPrihlaseni();

	$text = "<p>Registrace proběhla úspěnšně</p>";
}



include 'class/Sablona.class.php';
$sablona = new Sablona();
$sablona->zobraz($title, $description, $tags, $aktivni, $text, $glob_uzivatel);

?>