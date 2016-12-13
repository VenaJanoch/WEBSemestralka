<?php

$title = 'Nový příspěvek';
$description = 'Nový příspěvek stránka naší konference';
$tags = 'Nový příspěvek, databáze';

$aktivni = 'prispevky';

// veškerá přijatá data dáme do pole
$novy_prispevek = array();
$novy_prispevek["ID_prispevku"] = "null";
$novy_prispevek["nazev"] = $_POST["nazev"];
$novy_prispevek["abstract"] = $_POST["abstract"];
$novy_prispevek["autori"] = $_POST["autori"];
$target_dir = "soubory/" . $glob_uzivatel . "/";
$target_file = $target_dir . basename($_FILES["pdf_soubor"]["name"]);
$uploadOk = 1;
$fileType = pathinfo($target_file, PATHINFO_EXTENSION);
// kontrola PDF soubor
if ($fileType != "pdf"){
	$uploadOk = 0;
}
if ($uploadOk == 0){
	//soubor nebyl v pořádku, zobrazíme znovu formulář a uživatele upozorníme na jeho chybu
	$text = '<p>Příspěvek nebyl přidán.</p><p class="warning">Povoleným formátem souborů je pdf, zkontrolujte prosím nahraný soubor.</p>';
	
	$text .= '<p><form action="index.php?web=form/kontrola_novy_prispevek" method="post" role="form" class="form-horizontal" enctype="multipart/form-data">
<div class="form-group">
	<label class="control-label col-sm-2" for="nazev">Název*:</label>
	<div class="col-sm-10">
		<input type="text" class="form-control" name="nazev" placeholder="Zadejte název příspěvku" value="'.$_POST["nazev"].'" required>
		</div>
		</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="autori">Autoři*:</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="autori" placeholder="Zadejte autory" value="'.$_POST["autori"].'" required>
			</div>
			</div>
<div class="form-group">
	<label class="control-label col-sm-2" for="abstract">Abstract:</label>
		<div class="col-sm-10">
			<textarea class="form-control" name="abstract" rows="10" placeholder="Zadejte abstract" >'.$_POST["abstract"].'</textarea>
		</div>
		</div>
<div class="form-group">
	<label class="control-label col-sm-2" for="pdf_soubor">PDF soubor*:</label>
			<div class="col-sm-10">
			<input type="file" name="pdf_soubor" id="pdf_soubor" class="form-control" required>
			<span class="help-block">* = Povinné položky.</span>
			</div>
			</div>
<div class="form-group">
 <div class="col-sm-offset-2 col-sm-10">
<button type="submit" class="btn btn-default">Uložit</button>
</div>
</div>
			</form>
			<div class="col-sm-offset-2 col-sm-10">
	<p><a href="index.php?web=pages/prispevky">Zpět na příspěvky</a></p></div>
</p>';
	
	}
else {
	//soubor byl v pořádku, nahrajeme ho do aplikace a vytvoříme nový příspěvek
	if ($target_file <> $target_dir){
	if (!file_exists($target_dir)){
			mkdir($target_dir, 0777, true);
	}
			move_uploaded_file($_FILES["pdf_soubor"]["tmp_name"], $target_file);
	}
		else{
			$target_file = "null";
		}

	$novy_prispevek["soubor"] = $target_file;
	$id = $db->vratIdUzivatele($glob_uzivatel);
	$novy_prispevek["Janoch_uzivatel_ID_uzivatel"] = $id["id"];


	$db->vlozPrispevek($novy_prispevek);

	$text = '<h1>Příspěvek úspěšně přidán.</h1>
			<p><a href="index.php?web=stranky/prispevky" class = "Registrace">Zpět na příspěvky</a></p>
			';
}

include 'class/sablona.class.php';
$sablona = new Sablona();
$sablona->zobraz($title, $description, $tags, $aktivni, $text, $glob_uzivatel);

?>