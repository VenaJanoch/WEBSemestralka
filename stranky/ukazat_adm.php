<?php

if (isset($_GET["show"])){
	$ukaz = $_GET["show"];
}

$prispevek = $db->vratPrispevek($ukaz);
$text = '<h1 class= "Registrace">' . $prispevek["nazev"] . '</h1>';
$rel = 'index.php?web=stranky/stahnout&amp;file=' . $prispevek["soubor"];
$text .= '<p><a href="' . $rel . '" class= "Registrace">Stáhnout příspěvek</a></p>';

$text .= '<div class = "Prihlaseni"><form role="form" class="form-horizontal">
<div class="form-group">
	<label class="control-label col-sm-2" for="nazev">Název:</label>
	<div class="col-sm-10">
		<input type="text" class="form-control" name="nazev" placeholder="Název příspěvku nebyl zadán" value="' . $prispevek["nazev"] .   '" disabled>
		</div>
		</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="autori">Autoři:</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="autori" placeholder="Autoři nebyli zadáni" value="' . $prispevek["autori"] . '" disabled>
			</div>
			</div>
<div class="form-group">
	<label class="control-label col-sm-2" for="abstract">Abstract:</label>
		<div class="col-sm-10">
			<textarea class="form-control" name="abstract" rows="10" placeholder="Abstract nebyl zadán" disabled>' . $prispevek["abstract"] . '</textarea>
		</div>
		</div>
		</form></div>
<div class="col-sm-offset-2 col-sm-10">
</div>
					<p><a href="index.php?web=stranky/prispevky" class="Registrace">Zpět na příspěvky</a></p>';


$title = 'Příspěvky';
$description = 'Příspěvky stránka naší konference';
$tags = 'Příspěvky, databáze, konference';

$aktivni = 'prispevky';

include 'class/sablona.class.php';
$sablona = new Sablona();
$sablona->zobraz($title, $description, $tags, $aktivni, $text, $glob_uzivatel);


?>