<?php

$title = 'Úprava příspěvku';
$description = 'Úprava příspěvku stránka naší konference';
$tags = 'Úprava příspěvku, databáze, konference, 2015, Beneš';

$aktivni = 'prispevky';

if(isset($_GET["upd"])){
	$update = $_GET["upd"];
}
// všechny hodnoty přidáme do pole
$upraveny_prispevek = array();
$upraveny_prispevek["ID_prispevku"] = $update;
$upraveny_prispevek["nazev"] = $_POST["nazev"];
$upraveny_prispevek["autori"] = $_POST["autori"];
$upraveny_prispevek["abstract"] = $_POST["abstract"];
$target_dir = "uploads/" . $glob_uzivatel . "/";
$target_file = $target_dir . basename($_FILES["pdf_soubor"]["name"]);
if ($target_file <> $target_dir){
	if (!file_exists($target_dir)){
			mkdir($target_dir, 0777, true); // neexistovala složka, vytvoříme jí
	}
	move_uploaded_file($_FILES["pdf_soubor"]["tmp_name"], $target_file);
}
else{
	$target_file = "null";
}

$upraveny_prispevek["pdf_soubor"] = $target_file;

$db->upravPrispevek($upraveny_prispevek);

$text = '<h1>Příspěvek úspěšně upraven.</h1>
		<p><a href="index.php?web=stranky/prispevky" class = "Registrace">Zpět na příspěvky</a></p>';


include 'class/sablona.class.php';
$sablona = new Sablona();
$sablona->zobraz($title, $description, $tags, $aktivni, $text, $glob_uzivatel);

?>