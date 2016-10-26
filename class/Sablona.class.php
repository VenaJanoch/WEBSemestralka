<?php
class Sablona {
	
	/**
	 * Funkce zobrazi sablonu
	 * 
	 * @param String $title
	 *        	titulek stranky
	 * @param String $description
	 *        	popis stranky
	 * @param String $tags
	 *        	tagy stranky
	 * @param String $aktivni
	 *        	aktivni stranka
	 * @param String $text
	 *        	text na strance
	 * @param String $uzivatel
	 *        	prihlseni uzivatel
	 */
	function zobraz($title, $description, $tags, $aktivni, $text, $uzivatel = null) {
		?>
<!DOCTYPE html>
<html>
<head>
<?php include 'templates/udaje_hlavicka.php'; ?>
</head>
<body>

	<div class="Obal">

		<header class="Hlavicka">
			<h1>Webova konference Score</h1>
			<br>
			<h2 class="podNadpis">Konference o sportu</h2>

		</header>

		<?php include 'templates/menu.php'; ?>
		
		<div class="container-fluid text-center">
			<div class="row content">

				<div class="Telo">
				<?php echo $text?>
				</div>

			</div>
		</div>
	<?php include 'templates/paticka.php'; ?>
	
</div>

</body>
</html>
<?php
	}
}

?>
