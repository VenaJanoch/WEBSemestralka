<?php
class Prihlaseni{
    
    public static $uzivatel; // uživatel
    
    public function __construct(){
        // spusti session pro spravu prihlaseni uzivatele
        session_start();
    }
    
	/**
	 * Funkce kontroluje, zda je uživatel přihlášen
	 * @return array přihlášení nebo null
	 */
    public function kontrolaPrihlaseni(){
        return isset($_SESSION["prihlasen"]) ? $_SESSION["prihlasen"] : null;
    }
    
	/**
	 * Funkce přihlásí uživatele
	 * @param String $log login uživatele
	 * @param String $pas heslo uživatele
	 */
    public function prihlasUzivatele($log, $pas){
       
            $_SESSION["prihlasen"]=$log; // zahajim session uzivatele
     
    }
    
	/**
	 * Funkce odhlásí uživatele
	 */
    public function odhlasUzivatele(){
        session_unset(); // smazu session
    }
}
?>