<?php
$title = 'Prihlaseni';
$description = 'Prihlaseni uzivatele';
$tags = 'Konference, prihlaseni';

$aktivni = null;
$uzivatel = $db->vratUzivatele($_POST["uzJmeno"], $_POST["pwd"]);

if ($uzivatel <> null && strcmp($uzivatel["Login"], $_POST["uzJmeno"]) == 0 && strcmp($uzivatel["Heslo"], $_POST["pwd"]) == 0){


	$pr->prihlasUzivatele($_POST["uzJmeno"], $_POST["pwd"]);
	$glob_uzivatel = $pr->kontrolaPrihlaseni();

	$text = "<p>Přihlášení proběhlo úspěšně.</p>";

}
else{
$text = '<div class = "Prihlaseni"> <form action="index.php?web=form/kontrola_prihlaseni" method="post" class="form-horizontal" role="form">
				<legend>Prihlaseni uzivatele </legend>
	<p class = "povine">Zadane jmeno nebo heslo se neschoduji<p>	
  <div class="form-group">
    <label class="control-label col-sm-2" for="uzJmeno">Login:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="uzJmeno" placeholder="Uzivatelske jmeno">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Heslo:</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="pwd" placeholder="Zadejte heslo">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Prihlasit</button>
    </div>
  </div>
</form></div>
			<br> <a class="Registrace" href="index.php?web=stranky/registrace">Zde se
				registrujte </a>';
}

include 'class/Sablona.class.php';
$sablona = new Sablona ();
$sablona->zobraz ( $title, $description, $tags, $aktivni, $text, $glob_uzivatel );

?>