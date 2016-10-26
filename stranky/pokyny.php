<?php

$title = 'Pokyny';
$description = 'Pokyny pro uzivatele';
$tags = 'Konference, pokyny';

$aktivni = null;
$text = "<h2>Pokyny pro uzivatele </h2>
		<p>Pokyny</p>";

include 'class/Sablona.class.php';
$sablona = new Sablona();
$sablona->zobraz($title, $description, $tags, $aktivni, $text, $glob_uzivatel);

?>