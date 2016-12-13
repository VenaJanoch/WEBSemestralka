<?php

$title = 'Editace posudku';
$description = 'Editace posudku stránka naší konference';
$tags = 'Editace posudku, databáze, konference';

$aktivni = 'prispevky';

if(isset($_GET["sup"])){
	$id_prispevku = $_GET["sup"];
}
if(isset($_GET["rev"])){
	$id_uzivatele = $_GET["rev"];
}
// veškeré hodnoty načteme do pole a upravíme recenzi
$upravena_recenze = array();
$upravena_recenze["janoch_uzivatele_ID_uzivatele"] = $id_uzivatele;
$upravena_recenze["janoch_prispevky_ID_prispevku"] = $id_prispevku;
$upravena_recenze["originalita"] = $_POST["originalita"];
$upravena_recenze["tema"] = $_POST["tema"];
$upravena_recenze["technicka_kvalita"] = $_POST["technicka_kvalita"];
$upravena_recenze["jazykova_kvalita"] = $_POST["jazykova_kvalita"];
$upravena_recenze["doporuceni"] = $_POST["doporuceni"];
$upravena_recenze["poznamky"] = $_POST["poznamky"];

$db->upravRecenzi($upravena_recenze);

$text = '<h1>Posudek byl úspěšně upraven.</h1>
		<p><a href="index.php?web=stranky/prispevky" class="Registrace">Zpět na příspěvky k posouzení</a></p>';


include 'class/sablona.class.php';
$sablona = new Sablona();
$sablona->zobraz($title, $description, $tags, $aktivni, $text, $glob_uzivatel);

?>