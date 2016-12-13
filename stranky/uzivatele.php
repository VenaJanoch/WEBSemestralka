<?php
$title = 'Uzivatele';
$description = 'Uzivatele naší konference';
$tags = 'Uzivatele, databáze';

$aktivni = 'uzivatele';

$uzivatele = $db->vratVsechnyUzivatele ();
// projedeme všechny příspěvky
$text = '';
if (isset($zprava)){
	$text .= $zprava;
}
$text .= '<table class="table table-bordered table-hover table-striped table-condensed">';
$text .= '<thead>
			<tr>
			<th rowspan="1">Jmeno</th>
			<th rowspan="1">Prijmeni</th>
			<th rowspan="1">login</th>
			<th rowspan="1">Pravo</th>
			</tr>			
			</thead>
			<tbody>';


foreach ( $uzivatele as $item ) {
	// zobrazíme název příspěvku a jeho autory
	
	$text .= '<tr><td>' . $item ['Jmeno'] . '</td><td >' . $item ['Prijmeni'] . '</td><td >'
			. $item ["Login"] . '</td>';
	//for($i = 0; $i < 3; $i ++) {
		$prava_select = '<td><form action="index.php?web=form/kontrola_uzivatel&amp;upd=' . $item["ID_uzivatel"] . '" method="post"><select name = "pravo">';
		
		// vytvoření selectu recenzentů
			$prava_select .= '<option value = "1" >1</option><option value = "2" >2</option><option value = "3" >3</option>';
		
		$prava_select .= '</select></td>';
		$text .= $prava_select;
		$text .= '<td ><input class="adm_rev" type="submit" value="Zmenit pravo"></form></td><td><a class="povine"href="index.php?web=stranky/smazUZ&amp;id_pr='.$item["ID_uzivatel"].'">Smazat</a></td>';
	//}
	$text .= '</tr>';
}
// konec tabulky
$text .= "</tbody></table>";

include 'class/Sablona.class.php';
$sablona = new Sablona ();
$sablona->zobraz ( $title, $description, $tags, $aktivni, $text, $glob_uzivatel );

?>
