<?php

$title = 'Temata';
$description = 'Temata konference';
$tags = 'Konference, temata';

$aktivni = null;
$text = "<p>Temata</p>";

include 'class/Sablona.class.php';
$sablona = new Sablona();
$sablona->zobraz($title, $description, $tags, $aktivni, $text, $glob_uzivatel);

?>