<?php
function vyber($nastavena_hodnota, $hodnota) {
	if (strcmp ( $nastavena_hodnota, $hodnota ) == 0) {
		return "selected";
	} 

	else {
		return null;
	}
}

if (isset ( $_GET ["show"] )) {
	$ukaz = $_GET ["show"];
}

$prispevek = $db->vratPrispevek ( $ukaz );

$recenze = $db->vratRecenzi ( $prispevek ["ID_prispevku"], $db->vratIdUzivatele ( $glob_uzivatel ) ["id"] );

// formulář pro ohodnoiceni

$text = '<h1 class = "Registrace">' . $prispevek ["nazev"] . '</h1>';
$rel = 'index.php?web=stranky/stahnout&amp;file=' . $prispevek ["soubor"];
$text .= '<p><a href="' . $rel . '">Stáhnout příspěvek</a></p>';

$text .= '<div class = "Prihlaseni"><form action="index.php?web=form/kontrola_hodnoceni&amp;sup=' . $recenze ["janoch_prispevky_ID_prispevku"] . '&amp;rev=' . $recenze ["janoch_uzivatel_ID_uzivatel"] . '" method="post" role="form" class="form-horizontal">';

$originalita = $recenze ["originalita"];

$originalita_text = '<div class="form-group">
		<label class="control-label col-sm-2" for="originalita">Originalita:</label>
		<div class="col-sm-10">
		<select class="form-control" name="originalita" required>

<option value="1"' . vyber ( 1, $originalita ) . '>1 = Neoriginální</option>
<option value="2"' . vyber ( 2, $originalita ) . '>2 = Spíše neoriginální</option>
<option value="3"' . vyber ( 3, $originalita ) . '>3 = Neutrální</option>
<option value="4"' . vyber ( 4, $originalita ) . '>4 = Spíše originální</option>
<option value="5"' . vyber ( 5, $originalita ) . '>5 = Originální</option>
</select></div></div>';

$tema = $recenze ["tema"];

$tema_text = '<div class="form-group">
		<label class="control-label col-sm-2" for="tema">Téma:</label>
		<div class="col-sm-10">
		<select class="form-control" name="tema" required>

<option value="1"' . vyber ( 1, $tema ) . '>1 = Nerelevantní</option>
<option value="2"' . vyber ( 2, $tema ) . '>2 = Spíše nerelevantní</option>
<option value="3"' . vyber ( 3, $tema ) . '>3 = Neutrální</option>
<option value="4"' . vyber ( 4, $tema ) . '>4 = Spíše relevantní</option>
<option value="5"' . vyber ( 5, $tema ) . '>5 = Relevantní</option>
</select></div></div>';

$technicka_kvalita = $recenze ["technicka_kvalita"];

$technicka_kvalita_text = '<div class="form-group">
		<label class="control-label col-sm-2" for="technicka_kvalita">Technická kvalita:</label>
		<div class="col-sm-10">
		<select class="form-control" name="technicka_kvalita" required>

<option value="1"' . vyber ( 1, $technicka_kvalita ) . '>1 = Špatná</option>
<option value="2"' . vyber ( 2, $technicka_kvalita ) . '>2 = Spíše špatná</option>
<option value="3"' . vyber ( 3, $technicka_kvalita ) . '>3 = Neutrální</option>
<option value="4"' . vyber ( 4, $technicka_kvalita ) . '>4 = Spíše dobrá</option>
<option value="5"' . vyber ( 5, $technicka_kvalita ) . '>5 = Dobrá</option>
</select></div></div>';

$jazykova_kvalita = $recenze ["jazykova_kvalita"];

$jazykova_kvalita_text = '<div class="form-group">
		<label class="control-label col-sm-2" for="jazykova_kvalita">Jazyková kvalita:</label>
		<div class="col-sm-10">
		<select class="form-control" name="jazykova_kvalita" required>

<option value="1"' . vyber ( 1, $jazykova_kvalita ) . '>1 = Špatná</option>
<option value="2"' . vyber ( 2, $jazykova_kvalita ) . '>2 = Spíše špatná</option>
<option value="3"' . vyber ( 3, $jazykova_kvalita ) . '>3 = Neutrální</option>
<option value="4"' . vyber ( 4, $jazykova_kvalita ) . '>4 = Spíše dobrá</option>
<option value="5"' . vyber ( 5, $jazykova_kvalita ) . '>5 = Dobrá</option>
</select></div></div>';

$doporuceni = $recenze ["doporuceni"];

$doporuceni_text = '<div class="form-group">
		<label class="control-label col-sm-2" for="doporuceni">Doporučení:</label>
		<div class="col-sm-10">
		<select class="form-control" name="doporuceni" required>

<option value="1"' . vyber ( 1, $doporuceni ) . '>1 = Nepřijmout</option>
<option value="2"' . vyber ( 2, $doporuceni ) . '>2 = Spíše nepřijmout</option>
<option value="3"' . vyber ( 3, $doporuceni ) . '>3 = Neutrální</option>
<option value="4"' . vyber ( 4, $doporuceni ) . '>4 = Spíše přijmout</option>
<option value="5"' . vyber ( 5, $doporuceni ) . '>5 = Přijmout</option>
</select></div></div>';

$text .= $originalita_text;
$text .= $tema_text;
$text .= $technicka_kvalita_text;
$text .= $jazykova_kvalita_text;
$text .= $doporuceni_text;

$text .= '<div class="form-group">
		<label class="control-label col-sm-2" for="poznamky">Poznámky:</label>
		<div class="col-sm-10">
		<textarea class="form-control" name="poznamky" rows="10" placeholder="Místo pro poznámky">' . $recenze ["poznamky"] . '</textarea>
	</div>
	</div>
	
	<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
	<button type="submit" class="btn btn-default">Uložit</button>
	</div>
	</div>

</form></div>
<div class="col-sm-offset-2 col-sm-10">
<p><a href="index.php?web=stranky/prispevky" class = ">Zpět na příspěvky k posouzení</a></p></div>';

$title = 'Editace posudku';
$description = 'Editace posudku stránka naší konference';
$tags = 'Editace posudku, databáze, konference';

$aktivni = 'prispevky';

include 'class/Sablona.class.php';
$sablona = new Sablona ();
$sablona->zobraz ( $title, $description, $tags, $aktivni, $text, $glob_uzivatel );

?>