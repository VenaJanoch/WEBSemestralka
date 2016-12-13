<?php
class databaze {
	public $connection; // tam si ulozim aktualni spojeni
	function databaze() {
	}
	
	/**
	 * Připojí k vybrané databázi dle konstruktoru.
	 */
	function Connect() {
		try {
			$options = array (
					PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' 
			);
			$this->connection = new PDO ( "mysql:host=" . MYSQL_DATABASE_SERVER . ";dbname=" . MYSQL_DATABASE_NAME . "", MYSQL_DATABASE_USER, MYSQL_DATABASE_PASSWORD, $options );
		} catch ( PDOException $e ) {
			print "Error!: " . $e->getMessage () . "<br/>";
			die ();
		}
	}
	
	/**
	 * Odpojí se od vybrané databáze.
	 */
	function Disconnect() {
		$this->connection = null;
	}
	
	/**
	 * Funkce upraví rozhodnutí u příspěvku
	 * 
	 * @param int $id_prispevku
	 *        	id příspěvku
	 * @param String $rozhodnuti
	 *        	rozhodnutí, na které se rozhodnutí u příspěvku změní
	 */
	function zmenRozhodnuti($id_prispevku, $rozhodnuti) {
		$query = "UPDATE janoch_prispevky SET prijato=:rozhodnuti WHERE ID_prispevku=:id_prispevku;";
		
		$statement = $this->connection->prepare ( $query );
		$params = array(':rozhodnuti' => $rozhodnuti, ':id_prispevku' => $id_prispevku);
		
		if(!$statement->execute($params)){
			return null;
		}
	}
	
	/**
	 * Funkce smaže recenzi z databáze
	 * 
	 * @param int $id_prispevku
	 *        	id příspěvku
	 * @param int $id_uzivatele
	 *        	id uživatele
	 */
	function smazRecenzi($id_prispevku, $id_uzivatele) {
		$query = "DELETE FROM janoch_hodnoceni WHERE janoch_uzivatel_ID_uzivatel =:id_uzivatele AND janoch_prispevky_ID_prispevku=:id_prispevku;";
		
		$statement = $this->connection->prepare ( $query );
		$params = array(':id_uzivatele' => $id_uzivatele, ':id_prispevku' => $id_prispevku);
		
		if(!$statement->execute($params)){
			return null;
		}
	}
	
	/**
	 * Funkce vytvoří novou recenzi
	 * 
	 * @param array $nova_recenze
	 *        	pole udaju nove recenze
	 * @return int id nove recenze
	 */
	function vytvorRecenzi($nova_recenze) {
		
		$stmt_text = "INSERT INTO janoch_hodnoceni (janoch_uzivatel_ID_uzivatel,janoch_prispevky_ID_prispevku
				,originalita,tema,technicka_kvalita,jazykova_kvalita,doporuceni,poznamky) VALUES (?,?);";
			
		$stmt = $this->connection->prepare ( $stmt_text );
		$stmt->execute(array($nova_recenze['Janoch_uzivatel_ID_uzivatel'],$nova_recenze['janoch_prispevky_ID_prispevku']));
		
		
		
		
		// tohle by urcilo ID typu auto increment pro prave vlozeny predmet
		$item_id = $this->connection->lastInsertId ();
		return $item_id;
	}
	
	/**
	 * Funkce vrátí jméno a id všech recenzentů v databázi
	 * 
	 * @return array všichni recenzenti v databázi
	 */
	function vratRecenzenty() {
		$query = "SELECT jmeno, ID_uzivatel FROM janoch_uzivatel WHERE Janoch_prava_ID_prav='2';";
		$statement = $this->connection->prepare ( $query );
		$statement->execute ();
		
		$pole = $statement->fetchAll();
        
		return isset($pole) ? $pole : null;
	}
	
	/**
	 * Funkce vrátí všechny recenze, které byly přiřazeny k zadanému recenzentovi
	 * 
	 * @param int $id_uzivatele
	 *        	id recenzenta
	 * @return array všchny recenzentovi recenze
	 */
	function vratRecenzePodleRecenzenta($id_uzivatele) {
		$query = "SELECT * FROM janoch_hodnoceni WHERE janoch_uzivatel_ID_uzivatel=:id_uzivatel;";
		$statement = $this->connection->prepare ( $query );
		$params = array(':id_uzivatel' => $id_uzivatele);
		
		if(!$statement->execute($params)){
			return null;
		}
		
		$rtn = $statement->fetchAll ( PDO::FETCH_ASSOC );
		return $rtn;
	}
	
	/**
	 * Funkce vrátí všechny recenze, které recenzovali zadaný příspěvek
	 * 
	 * @param int $id_prispevku
	 *        	id recenzovaného příspěvku
	 * @return array všechny recenze tohoto příspěvku
	 */
	function vratRecenzePodlePrispevku($id_prispevku) {
		$query = "SELECT * FROM janoch_hodnoceni WHERE janoch_prispevky_ID_prispevku=:id_prispevku;";
		
		$statement = $this->connection->prepare ( $query );
		$params = array(':id_prispevku' => $id_prispevku);
		
		if(!$statement->execute($params)){
			return null;
		}
		$rtn = $statement->fetchAll ( PDO::FETCH_ASSOC );
		return $rtn;
	}
	
	/**
	 * Funkce vrátí jednu recenzi
	 * 
	 * @param int $id_prispevku
	 *        	id příspěvku
	 * @param int $id_uzivatele
	 *        	id uživatele
	 *        	$return array recenze
	 */
	function vratRecenzi($id_prispevku, $id_uzivatele) {
		$query = "SELECT * FROM janoch_hodnoceni WHERE janoch_prispevky_ID_prispevku=:id_prispevku AND janoch_uzivatel_ID_uzivatel=:id_uzivatele;";
		
		$statement = $this->connection->prepare ( $query );
		$params = array(':id_uzivatele' => $id_uzivatele, ':id_prispevku' => $id_prispevku);
		
		if(!$statement->execute($params)){
			return null;
		}
		
		$rtn = $statement->fetch ();
		return $rtn;
	}
	
	/**
	 * Funkce vrátí jeden příspěvek
	 * 
	 * @param int $id
	 *        	id příspěvku
	 * @return array příspěvek
	 */
	function vratPrispevek($id) {
		$query = "SELECT * FROM janoch_prispevky WHERE id_prispevku=:id ;";
		
		$statement = $this->connection->prepare ( $query );
		$params = array(':id' => $id);
		
		if(!$statement->execute($params)){
			return null;
		}
		
		$rtn = $statement->fetch ();
		return $rtn;
	}
	
	/**
	 * Funkce vrátí cestu k souboru u zadaného příspěvku
	 * 
	 * @param int $id_prispevku
	 *        	id příspěvku
	 * @return array cesta k souboru
	 */
	function vratSoubor($id_prispevku) {
		$query = "SELECT soubor FROM janoch_prispevky WHERE ID_prispevku=:id_prispevku;";
		
		$statement = $this->connection->prepare ( $query );
		$params = array(':id_prispevku' => $id_prispevku);
		
		if(!$statement->execute($params)){
			return null;
		}
		$rtn = $statement->fetch ();
		return $rtn;
	}
	
	/**
	 * Funkce upraví zvolenou recenzi na nové hodnoty
	 * 
	 * @param array $upravena_recenze
	 *        	pole upravených hodnot recenze
	 */
	function upravRecenzi($upravena_recenze) {
		$query = "UPDATE janoch_hodnoceni SET originalita='" . $upravena_recenze ["originalita"] . "', tema='" . $upravena_recenze ["tema"] . "', technicka_kvalita='" . $upravena_recenze ["technicka_kvalita"] . "', jazykova_kvalita='" . $upravena_recenze ["jazykova_kvalita"] . "', doporuceni='" . $upravena_recenze ["doporuceni"] . "', poznamky='" . $upravena_recenze ["poznamky"] . "' WHERE janoch_prispevky_ID_prispevku= '" . $upravena_recenze ["janoch_prispevky_ID_prispevku"] . "' AND janoch_uzivatel_ID_uzivatel='" . $upravena_recenze ["janoch_uzivatele_ID_uzivatele"] . "';";
		$statement = $this->connection->prepare ( $query );
		$statement->execute ();
	}
	
	/**
	 * Funkce upraví zvolený příspěvek na nové hodnoty
	 * 
	 * @param array $upraveny_prispevek
	 *        	pole upravených hodnot příspěvku
	 */
	function upravPrispevek($upraveny_prispevek) {
		$query = "UPDATE janoch_prispevky SET nazev='" . $upraveny_prispevek ["nazev"] . "', autori='" . $upraveny_prispevek ["autori"] . "', abstract='" . $upraveny_prispevek ["abstract"] . "', soubor='" . $upraveny_prispevek ["pdf_soubor"] . "' WHERE ID_prispevku='" . $upraveny_prispevek ["ID_prispevku"] . "';";
		$statement = $this->connection->prepare ( $query );
		$statement->execute ();
	}
	
	/**
	 * Funkce vloží nový příspěvek do databáze
	 * 
	 * @param array $novy_prispevek
	 *        	nový příspěvek
	 * @return int id příspěvku
	 */
	function vlozPrispevek($novy_prispevek) {
				
		$stmt_text = "INSERT INTO janoch_prispevky (nazev,autori,abstract,soubor,prijato,janoch_uzivatel_ID_uzivatel) VALUES (?,?,?,?,?,?);";
		$nazev = htmlspecialchars($novy_prispevek['nazev']);
		$autori = htmlspecialchars($novy_prispevek['autori']);		
		$abstract = htmlspecialchars($novy_prispevek['abstract']);
		$soubor = htmlspecialchars($novy_prispevek['soubor']);
		$prijato = htmlspecialchars("NE");
		$stmt = $this->connection->prepare ( $stmt_text );
		$stmt->execute(array($nazev,$autori, $abstract, $soubor, $prijato,$novy_prispevek['Janoch_uzivatel_ID_uzivatel']));
	
		// tohle by urcilo ID typu auto increment pro prave vlozeny predmet
		$item_id = $this->connection->lastInsertId ();
		return $item_id;
	}
	
	/**
	 * Funkce vrátí uživatelovo id podle loginu
	 * 
	 * @param String $login
	 *        	login uživatele
	 * @return array uživatelovo id
	 */
	function vratIdUzivatele($login) {
		$query = "SELECT ID_uzivatel AS id FROM janoch_uzivatel WHERE Login=:login;";
		$statement = $this->connection->prepare ( $query );
		$params = array(':login' => $login);
		
		if(!$statement->execute($params)){
			return null;
		}
		$rtn = $statement->fetch ();
		return $rtn;
	}
	
	/**
	 * Funkce vrátí příspěvky podle autora
	 * 
	 * @param int $autor
	 *        	id uživatele
	 * @return array příspěvky autora
	 */
	function vratPrispevkyAutor($autor) {
		$query = "SELECT * FROM janoch_prispevky WHERE janoch_uzivatel_ID_uzivatel=:autor ;";
		
		$statement = $this->connection->prepare ( $query );
		$params = array(':autor' => $autor);
		
		if(!$statement->execute($params)){
			return null;
		}
		$rtn = $statement->fetchAll ( PDO::FETCH_ASSOC );
		return $rtn;
	}
	
	/**
	 * Funkce smaže příspěvek z databáze podle id
	 * 
	 * @param int $id
	 *        	id příspěvku
	 */
	function smazPrispevek($id) {
		$query = "DELETE FROM janoch_prispevky WHERE id_prispevku = :id ;";
		
		$statement = $this->connection->prepare ( $query );
		$params = array(':id' => $id);
		
		if(!$statement->execute($params)){
			return null;
		}	}
	
	/**
	 * Funkce vrátí všechny příspěvky v databázi
	 * 
	 * @return array příspěvky
	 */
	function vratVsechnyPrispevky() {
		$query = "SELECT * FROM janoch_prispevky;";
		
		$statement = $this->connection->prepare ( $query );
		$statement->execute ();
		
		$rtn = $statement->fetchAll ( PDO::FETCH_ASSOC );
		return $rtn;
	}
	
	/**
	 * Funkce vrátí právo uživatele podle uživatelovo loginu
	 * 
	 * @param String $login
	 *        	login uživatele
	 * @return array právo uživatele
	 */
	function vratPravoUzivatele($login) {
		$query = "SELECT Janoch_prava_ID_prav FROM janoch_uzivatel WHERE login=:login;";
		
		$statement = $this->connection->prepare ( $query );
		$params = array(':login' => $login);
		
		if(!$statement->execute($params)){
			return null;
		}
		$rtn = $statement->fetch ();
		return $rtn;
	}
	
	/**
	 * Funkce vrátí uživatele podle jeho id
	 * 
	 * @param int $id_uzivatele
	 *        	id uživatele
	 * @return array uživatel
	 */
	function vratUzivatelePodleId($id_uzivatele) {
		$query = "SELECT * FROM janoch_uzivatel WHERE ID_uzivatel=:id_uzivatele;";
		
		$statement = $this->connection->prepare ( $query );
		$params = array(':id_uzivatele' => $id_uzivatele);
		
		if(!$statement->execute($params)){
			return null;
		}
		$rtn = $statement->fetch ();
		return $rtn;
	}
	
	
	/**
	 * Funkce vrátí uživatele dle jeho loginu a hesla
	 * 
	 * @param String $login
	 *        	login uživatele
	 * @param String $heslo
	 *        	heslo uživatele
	 * @return array uživatel
	 */
	function vratUzivatele($login, $heslo) {
		$query = "SELECT * FROM janoch_uzivatel WHERE Login=:login AND Heslo=:heslo;";
		
		$statement = $this->connection->prepare ( $query );
		$params = array(':login' => $login, ':heslo' => $heslo);
		
		if(!$statement->execute($params)){
			return null;
		}	
		$rtn = $statement->fetch ();
		return $rtn;
	}
	
	function vratVsechnyUzivatele() {
		$query = "SELECT * FROM janoch_uzivatel ;";
	
		$statement = $this->connection->prepare ( $query );
	
		if(!$statement->execute()){
			return null;
		}
		$rtn = $statement->fetchAll ( PDO::FETCH_ASSOC );;
		
		return $rtn;
	}
	
	/**
	 * Funkce vloží nového uživatele do databáze
	 * 
	 * @param array $novy_uzivatel
	 *        	pole nových hodnot uživatele
	 * @return int uživatelovo id
	 */
	function vlozUzivatele($novy_uzivatel) {
		
		$stmt_text = "INSERT INTO janoch_uzivatel (Jmeno,Prijmeni, Login, Heslo, Email) VALUES (?,?,?,?,?);";
		
		$jm = htmlspecialchars($novy_uzivatel['Jmeno']);
		$pr = htmlspecialchars($novy_uzivatel['Prijmeni']);		
		$log = htmlspecialchars($novy_uzivatel['Login']);
		$pas = htmlspecialchars($novy_uzivatel['Heslo']);
		$mail = htmlspecialchars($novy_uzivatel['Email']);
		$stmt = $this->connection->prepare ( $stmt_text );
		$stmt->execute(array($jm,$pr, $log, $pas, $mail));
		
		
		// tohle by urcilo ID typu auto increment pro prave vlozeny predmet
		$item_id = $this->connection->lastInsertId ();
		return $item_id;
	}
	
	function vratPravo($id_uzivatele){
		$query = "SELECT janoch_prava_ID_prav FROM janoch_uzivatel WHERE ID_uzivatel=:uzivatel ;";
		
		$statement = $this->connection->prepare ( $query );
		$params = array(':uzivatel' => $id_uzivatele);
		
		if(!$statement->execute($params)){
			return null;
		}	
		$rtn = $statement->fetch();
		return $rtn;
	}
	
	
	function vratSchvalenePrispevky(){
		$ANO = "ANO";
		$query = "SELECT * FROM janoch_prispevky WHERE prijato='".$ANO."';";
		
		$statement = $this->connection->prepare ( $query );
		
		if(!$statement->execute()){
			return null;
		}
		$rtn = $statement->fetchAll ( PDO::FETCH_ASSOC );
		
		return $rtn;
		
	}
	
	
	
	function zmenPravo($pravo,$id_uzivatele){
	$query = "UPDATE janoch_uzivatel SET janoch_prava_ID_prav ='" . $pravo . "' WHERE ID_uzivatel='" . $id_uzivatele . "';";
		$statement = $this->connection->prepare ( $query );
		$statement->execute ();
	}
	
	/**
	 * Funkce smaže uzivatele z databáze podle id
	 *
	 * @param int $id
	 *        	id příspěvku
	 */
	function smazUzivatele($id) {
		$query = "DELETE FROM janoch_uzivatel WHERE ID_uzivatel = :id ;";
	
		$statement = $this->connection->prepare ( $query );
		$params = array(':id' => $id);
	
		if(!$statement->execute($params)){
			return null;
		}	}
	
	
	
}
?>