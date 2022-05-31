<?php
    /**
     * Globale Konfigurationsdatei
     * 
     * @author Marco Staab
     *     
     */
    
    /**
     *  Die Parameter zur Herstellung der Datenbankverbindung    
     */
    define('DB_HOST', 'localhost'); 
    define('DB_USER', 'root'); 
    define('DB_PASS', ''); 
    define('DB_NAME', 'iKnow'); 

    /**
     * Das Wurzelverzeichnis der Applikation
     * zur Verwendung in Dateipfaden
     * "/opt/lampp/htdocs/iKnow/app"    
     */
    define('APPROOT', dirname(dirname(__FILE__)));

    /**
    * Das Wurzelverzeichnis der Applikation
    * zur Verwendung in dynamischen URLs
    * "http://localhost/iKnow"            
    */
    define('URLROOT', 'http://localhost/iKnow');

    /**
    * Der Default-Seitenname der Sites
    * wird dynamisch überschrieben  
    */
    define('SITENAME', 'iKnow');

    /**
    * Konstanten zur E-Mail Validierung    
    */
    define('EMAIL_PATTERN', '^[a-zA-ZäöüÄÖÜ0-9.@-]*$');
    
    /**
    * Konstanten zur Passwort Validierung    
    */
    define('PASSWORD_PATTERN', '^[a-zA-ZäöüÄÖÜ0-9.@]*$');
    define('PASSWORD_MIN_LENGTH', '8');
    define('PASSWORD_MAX_LENGTH', '50');

    /**
    * Konstanten zur Benutzernamen Validierung    
    */    
    define('USERNAME_PATTERN', '^[a-zA-ZäöüÄÖÜ0-9.@ ]*$');
    define('USERNAME_MIN_LENGTH', '4');
    define('USERNAME_MAX_LENGTH', '50');