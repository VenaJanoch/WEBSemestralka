<?php
function vyber($nastavena_hodnota, $hodnota) {
	if (strcmp ( $nastavena_hodnota, $hodnota ) == 0) {
		return "selected";
	} 

	else {
		return null;
	}
}

$title = 'Příspěvky';
$description = 'Příspěvky stránka naší konference';
$tags = 'Příspěvky, databáze';

$aktivni = 'prispevky';
$text = "";
if (! isset ( $glob_uzivatel )) {
	
	$prispevky = $db->vratSchvalenePrispevky ();
	
	if ($prispevky != null) {
		$text = '<div class = "Prihlaseni"><table class="table table-striped table-bordered table-condensed">';
		$text .= '<thead><tr><th>Název</th></tr></thead><tbody>';
		
		// For cyklus pro zobrazeni vsech prispevku do tabulky
		foreach ( $prispevky as $item ) {
			
			$rel = 'index.php?web=stranky/stahnout&amp;file=' . $item ["soubor"];
			
			$text .= '<tr><td><a class="Registrace" href="' . $rel . '">' . $item ["nazev"] . '</a></td></tr>';
		}
		// konec tabulky
		$text .= '</tbody></table></div>';
	} else {
		$text = '<h3 class = "povine">Pokud chcete příspěvky upravovat, musíte se přihlásit.</h3>';
	}
} // uživatel je přihlášen
else {
	$pravo = $db->vratPravoUzivatele ( $glob_uzivatel ) ["Janoch_prava_ID_prav"];
	if ($pravo == '1') { // administrátor
		$prispevky_items = $db->vratVsechnyPrispevky ();
		
		if ($prispevky_items == null) { // žádné příspěvky k zobrazení
			$text = '<h1 class = "Registrace">Žádné příspěvky k zobrazení.</p>';
		} else {
			
			$text = '';
			
			if (isset ( $zprava )) {
				$text .= $zprava;
			}
			
			$text .= '<table class="table table-bordered table-hover table-striped table-condensed">';
			$text .= '<thead>
			<tr>
			<th rowspan="2">Název</th>
			<th rowspan="2">Autoři</th>
			<th rowspan="1" colspan="8" >Recenze</th>
			<th rowspan="2">Rozhodnutí</th>
			</tr>
			<tr>
			<th>Recenzent</th>
			<th>Orig.</th>
			<th>Téma</th>
			<th>Tech.</th>
			<th>Jaz.</th>
			<th>Dop.</th>
			<th>Avg.</th>
			<th>Smazat</th>
			</tr>
			</thead>
			<tbody>';
			
			$recenzenti = $db->vratRecenzenty ();
			// projedeme všechny příspěvky
			foreach ( $prispevky_items as $item ) {
				// zobrazíme název příspěvku a jeho autory
				$rel_ukaz_adm = 'index.php?web=stranky/ukazat_adm&amp;show=' . $item ["ID_prispevku"];
				$text .= '<tr><td rowspan="3" ><a href="' . $rel_ukaz_adm . '" class="Registrace">' . $item ["nazev"] . '</a></td><td rowspan="3" >' . $item ["autori"] . '</td>';
				$recenze = array ();
				$recenze = $db->vratRecenzePodlePrispevku ( $item ["ID_prispevku"] );
				$recenze = array_pad ( $recenze, 3, null );
				
				// je třeba vytvořit 3 řádky pro 3 recenze
				for($i = 0; $i < 3; $i ++) {
					// recenze nebyla napsána - sloupečky se smrsknou do jednoho s nápisem Přidělit recenzi
					if ($recenze [$i] == null) {
						$select_name = $item ["ID_prispevku"];
						$recenzenti_select = '<td><form action="index.php?web=form/kontrola_pridatRev" method="post"><select name="' . $select_name . '" >';
						
						// vytvoření selectu recenzentů
						foreach ( $recenzenti as $recenzent ) {
							$id_recenzenta = $recenzent ["ID_uzivatel"];
							$recenzenti_select .= '<option value = "' . $id_recenzenta . '">' . $recenzent ["jmeno"] . '</option>';
						}
						
						$recenzenti_select .= '</select></td>';
						$text .= $recenzenti_select;
						$text .= '<td colspan="7"><input class="adm_rev" type="submit" value="Přidělit recenzi"></form></td>';
					} 					

					// recenze byla napsána - zobrazíme její výsledky a průměr výsledků + možnost jí smazat
					else {
						
						$recenzent = $db->vratUzivatelePodleId ( $recenze [$i] ["janoch_uzivatel_ID_uzivatel"] );
						
						$prumer = ($recenze [$i] ["originalita"] * 1 + $recenze [$i] ["tema"] * 1 + $recenze [$i] ["technicka_kvalita"] * 2 + $recenze [$i] ["jazykova_kvalita"] * 2 + $recenze [$i] ["doporuceni"] * 3) / (1 + 1 + 2 + 2 + 3);
						
						$prumer = round ( $prumer, 2 );
						if ($prumer == 0) { // pokud prumer je 0, znamena to, že recenze je pouze přidělena - prumer proto nezobrazíme
							$prumer = null;
						}
						
						$text .= '<td>' . $recenzent ["Jmeno"] . '</td><td>' . $recenze [$i] ["originalita"] . '</td><td>' . $recenze [$i] ["tema"] . '</td><td>' . $recenze [$i] ["technicka_kvalita"] . '</td><td>' . $recenze [$i] ["jazykova_kvalita"] . '</td><td>' . $recenze [$i] ["doporuceni"] . '</td><td>' . $prumer . '</td><td><a class="povine"href="index.php?web=stranky/smazRev&amp;id_pr=' . $recenze [$i] ["janoch_prispevky_ID_prispevku"] . '&amp;id_rv=' . $recenze [$i] ["janoch_uzivatel_ID_uzivatel"] . '">Smazat</a></td>';
					}
					// začátek cyklu, tady je nutné nastavit poslední sloupeček tabulky - rozhodnutí
					if ($i == 0) {
						
						if (strcmp ( "ANO", $item ["prijato"] ) == 0) {
							$rozhodnuti = "Přijato";
						} else {
							$rozhodnuti = "Nepřijato";
						}
						
						$text .= '<td rowspan="3"><a href="index.php?web=stranky/rozhodnuti&amp;id=' . $item ["ID_prispevku"] . '" class="Registrace">' . $rozhodnuti . '</a></td></tr>';
					} else {
						$text .= '</tr><tr>';
					}
				}
			}
			// konec tabulky
			$text .= '</tr></tbody></table><br/><a href="index.php?web=stranky/uzivatele" class="odkazMenu">Uzivatele</a>';
		}
	} 

	elseif ($pravo == '2') { // recenzent
		
		$recenze = $db->vratRecenzePodleRecenzenta ( $db->vratIdUzivatele ( $glob_uzivatel ) ["id"] );
		$text = '';
		if ($recenze == null) { // žádné příspěvky k posouzení
			$text = '<h1 class="Registrace">Žádné příspěvky k zobrazení.</h1>';
		} else { // nějaké příspěvky tam jsou, začátek vytváření tabulky
			$text .= '<div class="Prihlaseni"><table class="table table-hover table-bordered table-striped table-condensed">';
			$text .= '<thead><tr><th>Název</th><th>Ohodnocení</th></tr></thead><tbody>';
			
			// projdeme všechny recenze a zobrazíme je do tabulky i s jejich průměrem
			foreach ( $recenze as $item ) {
				
				$prumer = ($item ["originalita"] * 1 + $item ["tema"] * 1 + $item ["technicka_kvalita"] * 2 + $item ["jazykova_kvalita"] * 2 + $item ["doporuceni"] * 3) / (1 + 1 + 2 + 2 + 3);
				
				$prumer = round ( $prumer, 2 );
				
				if ($prumer == 0) { // prumer je 0, znamena to, že recenze ještě nebyla napsána, pouze přiřazena, prumer nezobrazíme
					$prumer = null;
				}
				
				$prispevek = $db->vratPrispevek ( $item ["janoch_prispevky_ID_prispevku"] );
				
				$rel = 'index.php?web=stranky/hodnoceni&amp;show=' . $prispevek ["ID_prispevku"];
				
				$text .= '<tr><td><a href="' . $rel . '"  class="Registrace">' . $prispevek ["nazev"] . '</a></td><td>' . $prumer . '</td></tr>';
			}
			// konec tabulky
			$text .= '</tbody></table></div>';
		}
	} 

	elseif ($pravo == '3') { // autor
		
		$id = $db->vratIdUzivatele ( $glob_uzivatel );
		
		$prispevky_items = $db->vratPrispevkyAutor ( $id ["id"] );
		// Vetev pro zadne prispevky
		
		if ($prispevky_items == null) {
			$text = '<h3>
					Žádné příspěvky k zobrazení.</h3>
					<p><a class = "Registrace" href="index.php?web=stranky/novy_prispevek">Přidat nový příspěvěk</a></p>';
		} 		// Vetev pro vypis prispevku
		else {
			
			$text = '<div class = "Prihlaseni"><table class="table table-striped table-bordered table-condensed">';
			$text .= '<thead><tr><th>Název</th><th>Recenzovano</th><th>Prijato</th><th>Prumer</th><th>Smazat</th></tr></thead><tbody>';
			
			// For cyklus pro zobrazeni vsech prispevku do tabulky
			foreach ( $prispevky_items as $item ) {
				
				$rel = 'index.php?web=stranky/smazat&amp;del=' . $item ["ID_prispevku"];
				$rel2 = 'index.php?web=stranky/ukazat&amp;show=' . $item ["ID_prispevku"];
				$rel3 = $db->vratRecenziAutor ( $item ["ID_prispevku"], $id ["id"] );
				$rec = '';
				$prumer = 0;
				$count = 0;
				foreach ( $rel3 as $rec1 ) {
					
					$prumer1 = ($rec1 ["originalita"] * 1 + $rec1 ["tema"] * 1 + $rec1 ["technicka_kvalita"] * 2 + $rec1 ["jazykova_kvalita"] * 2 + $rec1 ["doporuceni"] * 3) / (1 + 1 + 2 + 2 + 3);
					
					$prumer1 = round ( $prumer1, 2 );
					$prumer = $prumer + $prumer1;
					
					$count++;
					
				}
				echo $count;
				if ($count == 0) {
					$rec = 'NE';
					$prumer = 0;
				}else{
					$rec = 'ANO';				
				}
				
				$text .= '<tr><td><a class="Registrace" href="' . $rel2 . '">' . $item ["nazev"] . '</a></td><td>' . $rec . '</td><td>' . $item ["prijato"] . '</td><td>' . $prumer . '</td><td><a class="povine" href="' . $rel . '"> Odstranit</a> </td></tr>';
			}
			// konec tabulky
			$text .= '</tbody></table><p ><a href="index.php?web=stranky/novy_prispevek" class ="Registrace">Přidat nový příspěvěk</a></p></div>';
		}
	}
}

include 'class/Sablona.class.php';
$sablona = new Sablona ();
$sablona->zobraz ( $title, $description, $tags, $aktivni, $text, $glob_uzivatel );

?>
