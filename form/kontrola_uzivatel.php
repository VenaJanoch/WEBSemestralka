
<?php
$update = "";
if(isset($_GET["upd"])){
	$update = $_GET["upd"];
}

$pravo = isset($_POST["pravo"]);
$id_uzivatele = $update;
$kontrola = $db->vratPravo($id_uzivatele);
if ($kontrola['janoch_prava_ID_prav'] != $pravo){
	
	$db->zmenPravo($pravo,$id_uzivatele);
	
	$zprava = '<p class="Registrace">Pravo zmeneneno.</p>';
}

else {
	$zprava = '<p class="povine">Uzivatel již dane pravo ma!</p>';

	}
	
	include("stranky/uzivatele.php");

?>