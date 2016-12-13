<?php

if(isset($_GET["del"])){
	$smaz = $_GET["del"];
}
// smazání příspěvku i se souborem, který byl s příspěvkem nahrán
	$target_file = $db->vratSoubor($smaz);
	if (file_exists($target_file["soubor"]) && $target_file["soubor"] <> "null"){
		unlink($target_file["soubor"]);
	}
	
	$db->smazPrispevek($smaz);
	
	
	include 'stranky/prispevky.php';

?>