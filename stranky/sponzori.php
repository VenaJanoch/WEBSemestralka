<?php

$title = 'Sponzori';
$description = 'Sponzori konference';
$tags = 'Konference, sponzori';

$aktivni = null;
$text = "<h1>Sponzori</h1> <p>sponzori</p>";

include 'class/Sablona.class.php';
$sablona = new Sablona();
$sablona->zobraz($title, $description, $tags, $aktivni, $text, $glob_uzivatel);

?>