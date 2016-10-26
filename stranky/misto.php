<?php

$title = 'Misto';
$description = 'Misto konani konference';
$tags = 'Konference, temata';

$aktivni = null;
$text = "<h2>Misto konani Konference</h2><p>Misto</p>";

include 'class/Sablona.class.php';
$sablona = new Sablona();
$sablona->zobraz($title, $description, $tags, $aktivni, $text, $glob_uzivatel);

?>