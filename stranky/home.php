<?php

$title = 'Uvodni stranka';
$description = 'Uvodni stranka konference';
$tags = 'Konference, Uvod';

$aktivni = null;
$text = '<h1 class="Registrace">Vítejte na našich stránkách</h1><p>Doufáme, že se vám zde bude líbit.</p>';

include 'class/Sablona.class.php';
$sablona = new Sablona();
$sablona->zobraz($title, $description, $tags, $aktivni, $text, $glob_uzivatel);

?>