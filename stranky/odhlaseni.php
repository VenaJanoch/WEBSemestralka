<?php


$title = 'Odhlášení';
$description = 'Odhlášení stránka naší konference';
$tags = 'Odhlášení, konference';

$aktivni = null;



	$pr->odhlasUzivatele();
	$glob_uzivatel = $pr->kontrolaPrihlaseni();
	$text = "<h1>Odhlášení</h1><p>Odhlášení proběhlo úspěšně.</p>";


include 'class/Sablona.class.php';
$sablona = new Sablona();
$sablona->zobraz($title, $description, $tags, $aktivni, $text, $glob_uzivatel);

?>