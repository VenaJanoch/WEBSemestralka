<?php

if (isset($_GET["id_pr"])){
	$id_pr = $_GET["id_pr"];
}

if (isset($_GET["id_rv"])){
	$id_rv = $_GET["id_rv"];
}

$db->smazRecenzi($id_pr, $id_rv);

		
			$zprava = '<p>Recenze smazána.</p>';
			
			include("stranky/prispevky.php");
			
			
			
?>