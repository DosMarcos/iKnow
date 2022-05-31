<?php
    /**
    * User ist die Modell-Klasse
    * zur Interaktion mit der Datenbank
    * betreffend relevanter Benutzerdaten
    * 
    * @author Marco Staab
    * @access public 
    *     
    */   
    class User
    {
    
        private $db;
    
        public function __construct() 
        {
            $this->db = new Database;
        }

        /**
        * Methode zum Anlegen eines
        * Benutzers, in der Datenbank
        *                       
        * @author Marco Staab
        * @access public     
        *   
        * @param array $data Array mit Benutzerdaten   
        *         
        * @return bool Rückgabwert true bei Erfolg
        *          
        */
        public function register($data) 
        {
            // Lege den Benutzer in der Datenbank an
            $this->db->query('INSERT INTO Users (UserName, UserEmail, UserPassword) VALUES(:username, :email, :password)');

            // Binde Variablen an SQL-Statement
            $this->db->bind(':username', $data['username']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);

            // Führe das SQL-Statemnt
            if ($this->db->execute()) 
            {
                return true;
            } 
                else 
            {
                return false;
            }
        }

        /**
        * Methode zum Einloggen eines
        * Benutzers, in das System
        *                       
        * @author Marco Staab
        * @access public     
        *   
        * @param string $email E-Mail Adresse des Benutzers
        * @param string $password Passwort des Benutzers
        *         
        * @return object $row Benutzer Datenbank-Objekt
        *          
        */
        public function login($email, $password) 
        {                        
            // Hole das User-Passwort
            $this->db->query('SELECT * FROM Users WHERE UserEmail = :email');

            //Bind value
            $this->db->bind(':email', $email);

            // Führe SQL-Statement aus
            $row = $this->db->single();
            
            // Hole das gehashte Password
            $hashedPassword = $row->UserPassword;

            // Wenn Passwort gültig ist, gib das Datenbank-Objekt zurück
            if (password_verify($password, $hashedPassword)) 
            {                
                return $row;                
            }
            else 
            {
                return false;
            }
        }

        /**
        * Methode zum Prüfen ob
        * Benutzer bereits angemeldet ist
        *                       
        * @author Marco Staab
        * @access public     
        *   
        * @param string $email E-Mail Adresse des Benutzers    
        *         
        * @return bool Rückgabwert true bei Erfolg
        *          
        */
        public function getLoginByEmail($email) 
        {                        
            // Lese Benutzer Online-Status aus Datenbank
            $this->db->query('SELECT DISTINCT * FROM Users WHERE (UserIsOnline = "true" AND UserEmail = :email)');
            
            // Binde die Variable an das SQL-Statement
            $this->db->bind(':email', $email);

            // Warte auf Ergebnis
            $result = $this->db->single();

            // Wenn kein Eintrag gefunden wird, ist Inhalt von $result null
            if(!($result))
            {
                return false;
            }
            else
            {
                // Wenn ein Eintrag vorhanden ist, extrahiere UserEmail-Feld
                $value = $result->UserEmail;

                // Wenn Inhalt aus Formular identisch, mit UserEmail-Feld
                // ist der Benutzer schon angemeldet
                if($value == $_POST['email'])
                {
                    return true;
                }
                else
                {
                return false;
                }    
            }        
        }

        /**
        * Methode zum Eintragen in die Datenbank,
        * dass Benutzer angemeldet ist
        *                       
        * @author Marco Staab
        * @access public     
        *   
        * @param string $email E-Mail Adresse des Benutzers    
        *         
        * @return bool Rückgabwert true bei Erfolg
        *          
        */
        public function setLoginStatus($email) 
        {
            $status = $_SESSION['loggedin'] ? 'true' : 'false';
            
            // Setze Benutzer Online in Datenbank
            $this->db->query('UPDATE Users SET UserIsOnline = :stat WHERE UserEmail = :email ');

            // Binde Variablen an das SQL-Statement
            $this->db->bind(':stat', $status);
            $this->db->bind(':email', $email);

            // Führe das SQL-Statement aus
            if ($this->db->execute()) 
            {
                return true;
            } 
                else 
            {
                return false;
            }
        }

    
        /**
        * Methode zum Suchen eines 
        * Benutzers in der Datenbank
        *                       
        * @author Marco Staab
        * @access public     
        *   
        * @param string $email E-Mail Adresse des Benutzers    
        *         
        * @return bool Rückgabwert true bei Erfolg
        *          
        */
        public function findUserByEmail($email) 
        {        
            // Zähle die Benutzer mit passender E-Mail Adresse
            $this->db->query('SELECT COUNT(*) AS Anzahl FROM Users WHERE UserEmail = :email');
        
            // Binde Variable an das SQL-Statement
            $this->db->bind(':email', $email);

            // Gibt das Datenbank-Objekt mit dem Eintrag zurück
            $result = $this->db->single();

            // Zähle die Einträge
            $count = intval($result->Anzahl);
        
            if($count > 0) 
            {
                return true;
            } 
            else 
            {
                return false;
            } 
        }    

        /**
        * Methode zur Bereinigung aller
        * Game ID-Werte im System, sowohl
        * in der Datenbank als auch im Browser        
        *               
        * @author Marco Staab
        * @access public        
        * 
        * @param int $id Session Game-ID
        *
        * @return bool Rückgabwert true bei Erfolg 
        *
        */
        public function DeleteGame($id) 
        {
            // Setze die Browser-Sessionvariable auf 0
            $_SESSION['game_id'] = 0;
                    
            // Setze den Mitspieler zurück
            $GameOpponent = "";                                       

            // Schreibe die Werte zurück in die Datenbank
            $this->db->query('UPDATE Users SET GameID = :token, GameOpponent = :gameopponent WHERE UserName = :username ');

            // Binde die Variablen an das SQL-Statement
            $this->db->bind(':token', $_SESSION['game_id']);
            $this->db->bind(':gameopponent', $GameOpponent);                
            $this->db->bind(':username', $_SESSION['username']);                
                    
            // Checke den Erfolg
            if ($this->db->execute()) 
            {
                return true;
            } 
            else 
            {
                return false;
            }                                                            
        }
    }   
