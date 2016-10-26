<?php

$title = 'Organizátoři';
$description = 'Organizátoři konferenci';
$tags = 'Konference, organizatori';

$aktivni = null;
$text = "<h2>Organizatori</h2>
		<p>Organizatori</p>";

include 'class/Sablona.class.php';
$sablona = new Sablona();
$sablona->zobraz($title, $description, $tags, $aktivni, $text, $glob_uzivatel);

?>