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

$title = 'Editace posudku';
$description = 'Editace posudku stránka naší konference';
$tags = 'Editace posudku, databáze, konference';


$aktivni = 'prispevky';

include 'class/Sablona.class.php';
$sablona = new Sablona ();
$sablona->zobraz ( $title, $description, $tags, $aktivni, $text, $glob_uzivatel );