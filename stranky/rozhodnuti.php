<?php


if (isset($_GET["id"])){
	$id_prispevku = $_GET["id"];
}

$prispevek = $db->vratPrispevek($id_prispevku);

// pokud byl příspěvek předtím přijat a nyní má být nepřijat, jednoduše to změníme
if (strcmp($prispevek["prijato"], "ANO") == 0){
	
	$rozhodnuti = "NE";
	$zprava = '<h1 class="Registrace">Rozhodnutí změněno.</h1>';
	$db->zmenRozhodnuti($id_prispevku, $rozhodnuti);
	
}
else {
	
	$recenze = $db->vratRecenzePodlePrispevku($id_prispevku);
	$recenze = array_pad($recenze, 3, null);
	$kontrola = 0;
	
	// projdeme všechny recenze na tento příspěvek - zjistíme, zda jsou 3 vyplněné tím, že spočteme pro všechny průměry - 0 znamená, že recenze nebyla napsána a rozhodnutí tedy nelze změnit
	foreach ($recenze as $item){
		$prumer = ($item["originalita"] * 1 + $item["tema"] * 1 + $item["technicka_kvalita"] * 2 + $item["jazykova_kvalita"] * 2 + $item["doporuceni"] * 3) / (1 + 1 + 2 + 2 + 3);
		
				
		$prumer = round($prumer, 2);
				
		if ($prumer == 0){
			$kontrola = -1;
		}
	}

	if ($kontrola <> 0){
		$zprava = '<p class="povine">Je potřeba 3 recenzí pro přijetí.</p>';
	}
	
	else {
		$rozhodnuti = "ANO";
		$zprava = '<h1 class="Registrace">Rozhodnutí změněno.</h1>';
		$db->zmenRozhodnuti($id_prispevku, $rozhodnuti);
	}
	
}

include("stranky/prispevky.php");


?>