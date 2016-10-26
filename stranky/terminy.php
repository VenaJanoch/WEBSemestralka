<?php

$title = 'Termíny';
$description = 'Termíny konání';
$tags = 'Konference, termíny';

$aktivni = null;
$text = "<p>Terminy</p>";

include 'class/Sablona.class.php';
$sablona = new Sablona();
$sablona->zobraz($title, $description, $tags, $aktivni, $text, $glob_uzivatel);

?>