<?php
    /**
    * Database ist die Klasse zur
    * Umsetzung der Datenbankschnittstelle
    * enthält sämtliche Operationen
    * auf der Datenbank
    * 
    * @author Marco Staab
    * @access public 
    *     
    */ 
    class Database 
    {
        private $dbHost = DB_HOST;
        private $dbUser = DB_USER;
        private $dbPass = DB_PASS;
        private $dbName = DB_NAME;

        private $statement;
        private $dbHandler;
        private $error;

        /**
        * Anonyme Konstruktormethode zur Erzeugung
        * einer Datenbankverbindung in Form eines
        * PDO (PHP Data Object)
        *               
        * @author Marco Staab
        * @access public         
        *          
        */
        public function __construct() 
        {
            /**
            * Bilde Connection-String 
            */ 
            $conn = 'mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName;

            /**
            * Lege Optionen für PDO fest 
            */ 
            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,                
            );

            /**
            * Erzeuge Datenbank-Verbindung, sonst werfe Exception, mit Meldung             
            */ 
            try 
            {
                $this->dbHandler = new PDO($conn, $this->dbUser, $this->dbPass, $options);
            } 
            catch (PDOException $e) 
            {
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }

        /**
        * Methode zur Vorbereitung einer
        * einer Datenbankabfrage
        * erzeugt SQL-Statement mit Platzhaltern
        * die in der bind-Methode, mit Variablen
        * gefüllt werden         
        *               
        * @author Marco Staab
        * @access public        
        * 
        * @param string $sql MySQL-Statement 
        *          
        */
        public function query($sql) 
        {
            $this->statement = $this->dbHandler->prepare($sql);
        }

        /**
        * Methode zur Anbindung von PHP-Variablen
        * an eine vorbereitete Datenbankabfrage,
        * aus der query-Methode    
        *                       
        * @author Marco Staab
        * @access public        
        * 
        * @param string $parameter Platzhalter in MySQL-Statement 
        * @param string $value Wert zur Anbindung
        * @param string $type Optional Parameter für PDO
        *          
        */
        public function bind($parameter, $value, $type = null) 
        {
            switch (is_null($type)) 
            {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
            $this->statement->bindValue($parameter, $value, $type);
        }

        /**
        * Methode zur Ausführung einer
        * vorbereiteten Datenbankabfrage        
        *                       
        * @author Marco Staab
        * @access public        
        * 
        * @return bool Rückgabwert true bei Erfolg 
        *          
        */
        public function execute() 
        {
            return $this->statement->execute();
        }

        /**
        * Methode zur Abfrage ALLER Zeilen einer
        * Datenbank-Tabelle, als Objekt          
        *                       
        * @author Marco Staab
        * @access public        
        *         
        * @return array Datenbank-Zeilen als Array
        *          
        */
        public function resultSet() 
        {
            $this->execute();
            return $this->statement->fetchAll(PDO::FETCH_OBJ);
        }

        /**
        * Methode zur Abfrage EINER Zeile einer
        * Datenbank-Tabelle, als Objekt          
        *                       
        * @author Marco Staab
        * @access public        
        *         
        * @return object Datenbank-Zeile als Objekt
        *          
        */
        public function single() 
        {
            $this->execute();
            return $this->statement->fetch(PDO::FETCH_OBJ);
        }

        /**
        * Methode zur Abfrage der Anzahl
        * von Zeilen, Datenbank-Tabelle        
        *                       
        * @author Marco Staab
        * @access public        
        *         
        * @return int Anzahl der Zeilen aus letztem SQL-Statement
        *          
        */
        public function rowCount() 
        {
            return $this->statement->num_rows;
        }
    }
