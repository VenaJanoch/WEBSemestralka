<?php
$title = 'Registrace';
$description = 'Registrace uzivatele';
$tags = 'Konference, registrace';

$aktivni = null;
if (! isset ( $glob_uzivatel )) {
	
	$text = '<div class = "Prihlaseni">
		
			<form action="index.php?web=form/kontrola_registrace" method="post" class="form-horizontal" role="form">
				<legend>Registrace uzivatele </legend>
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
</form></div>
			';
} else {
	$text = '<legend>Prihlaseni uzivatele </legend>
			<p class = "Registrace">Jste přihlášen, pro další registraci se odhlaste</p>';
}
include 'class/Sablona.class.php';
$sablona = new Sablona ();
$sablona->zobraz ( $title, $description, $tags, $aktivni, $text, $glob_uzivatel );

?>