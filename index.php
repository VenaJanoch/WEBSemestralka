<?php
require_once 'init.php';
require_once 'class/databaze.class.php';

$db = new databaze ();
$db->Connect ();
// // sprava prihlaseni uzivatele
require ("class/prihlaseni.class.php");
$pr = new Prihlaseni ();

// kontrola zadaneho uzivatele
$glob_uzivatel = $pr->kontrolaPrihlaseni ();

$dostupne = array (
		"stranky/home",
		"stranky/temata",
		"stranky/misto",
		"stranky/sponzori",
		"stranky/organizatori",
		"stranky/prispevky",
		"stranky/pokyny",
		"stranky/terminy",
		"stranky/prihlaseni",
		"form/kontrola_prihlaseni",
		"stranky/odhlaseni",
		"stranky/registrace",
		"form/kontrola_registrace",
		"stranky/smazat",
		"stranky/novy_prispevek",
		"form/kontrola_novy_prispevek",
		"stranky/ukazat",
		"form/kontrola_hodnoceni",
		"form/kontrola_uprava_prispevku",
		"stranky/hodnoceni",
		"stranky/stahnout",
		"form/kontrola_pridatRev",
		"stranky/smazRev",
		"stranky/ukazat_adm",
		"stranky/rozhodnuti" 
); // dostupne stranky webu
$zobrazim = $dostupne [0]; // prvni de defaultni
                          
// Prechod mezi strankami
if (isset ( $_GET ["web"] ) && in_array ( $_GET ["web"], $dostupne )) {
	$zobrazim = $_GET ["web"];
}

include ($zobrazim . ".php");
?>