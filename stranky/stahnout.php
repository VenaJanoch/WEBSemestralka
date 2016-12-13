<?php

if(isset($_GET["file"])){
	$soubor = $_GET["file"];
}

	if (file_exists($soubor)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($soubor).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($soubor));
    readfile($soubor);
    exit;
}

?>
