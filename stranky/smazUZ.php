<?php
if (isset($_GET["id_pr"])){
	$id_pr = $_GET["id_pr"];
}


$db->smazUzivatele($id_pr);

		
			$zprava = '<p>Uzivatel smazán.</p>';
			
			include("stranky/uzivatele.php");
			
			
			
?>