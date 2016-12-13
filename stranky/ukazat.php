<?php

if (isset($_GET["show"])){
	$ukaz = $_GET["show"];
}

$prispevek = $db->vratPrispevek($ukaz);
// formulář úpravy příspěvku
$text = '

<form action="index.php?web=form/kontrola_uprava_prispevku&amp;upd=' . $prispevek["ID_prispevku"] . '" method="post" role="form" class="form-horizontal" enctype="multipart/form-data">
<div class="form-group">
	<label class="control-label col-sm-2" for="nazev">Název*:</label>
	<div class="col-sm-10">
		<input type="text" class="form-control" name="nazev" placeholder="Zadejte název příspěvku" value="' . $prispevek["nazev"] .   '" required>
		</div>
		</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="autori">Autoři*:</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="autori" placeholder="Zadejte autory" value="' . $prispevek["autori"] . '" required>
			</div>
			</div>
<div class="form-group">
	<label class="control-label col-sm-2" for="abstract">Abstract:</label>
		<div class="col-sm-10">
			<textarea class="form-control" name="abstract" rows="10" placeholder="Zadejte abstract">' . $prispevek["abstract"] . '</textarea>
		</div>
		</div>
<div class="form-group">
	<label class="control-label col-sm-2" for="pdf_soubor">PDF soubor*:</label>
			<div class="col-sm-10">
			<input type="file" name="pdf_soubor" id="pdf_soubor" class="form-control" required>
			<span class= "povine">Udaje oznacene * jsou povinne</span>
			</div>
			</div>
<div class="form-group">
 <div class="col-sm-offset-2 col-sm-10">
<button type="submit" class="btn btn-default">Uložit</button>
</div>
</div>
			</form>
<div class="col-sm-offset-2 col-sm-10">
<p><a href="index.php?web=stranky/prispevky" class = "Registrace">Zpět na příspěvky</a></p></div>';



$title = 'Příspěvky';
$description = 'Příspěvky stránka naší konference';
$tags = 'Příspěvky, databáze, konference';

$aktivni = 'prispevky';

include 'class/sablona.class.php';
$sablona = new Sablona();
$sablona->zobraz($title, $description, $tags, $aktivni, $text, $glob_uzivatel);



?>