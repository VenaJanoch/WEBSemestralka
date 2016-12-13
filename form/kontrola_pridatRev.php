<?php

foreach ($_POST as $item => $value){
	$id_prispevku = $item;
	$id_uzivatele = $value;
}

$kontrola = $db->vratRecenzi($id_prispevku, $id_uzivatele);
// recenze ještě neexistuje, přidáme jí
if ($kontrola == null){
	$nova_recenze = array();
	$nova_recenze["janoch_prispevky_ID_prispevku"] = $id_prispevku;
	$nova_recenze["Janoch_uzivatel_ID_uzivatel"] = $id_uzivatele;

	$db->vytvorRecenzi($nova_recenze);
	
	$zprava = '<p class="Registrace">Recenze přidána.</p>';
}

else {
	// jinak recenze existuje napsána tím samým recenzentem, nedovolíme to
	$zprava = '<p class="povine">Recenzent již daný příspěvek recenzuje!</p>';

	}
	
	include("stranky/prispevky.php");

?>