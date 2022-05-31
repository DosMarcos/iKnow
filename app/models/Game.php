<?php
    /**
    * Game ist die Modell-Klasse
    * zur Interaktion mit der Datenbank
    * betreffend relevanter Spieldaten
    * 
    * @author Marco Staab
    * @access public 
    *     
    */   
    class Game
    {    
        private $db;
        
        /**
        * Anonyme Konstruktormethode zur Erzeugung
        * eines Game-Objektes
        *               
        * @author Marco Staab
        * @access public         
        *          
        */
        public function __construct() 
        {
            $this->db = new Database;
        }

        /**
        * Methode zur Ermittlung der
        * Spieler, die für ein neues Spiel
        * potentiell bereit sind
        *               
        * @author Marco Staab
        * @access public        
        *                                
        */
        public function DisplayAvailablePlayers() 
        {
            // Definiere Array für Spieler
            $players = array();
            
            // Hole alle Users aus der Datenbank
            $this->db->query('SELECT DISTINCT * FROM Users WHERE UserIsOnline = "true" ORDER BY UserID');
            
            // Lege alle User-Objekte in ein Array ab
            $result = $this->db->resultSet();

            foreach($result as $value)
            {
                // Username aus der Datenbank
                $name = $value->UserName;

                // Die Game-Id aus der Datenbank
                // Typumwandlung nach Integer
                $token = intval($value->GameID);

                // Wenn ich nicht in der Browser-Session stehe
                // muss es ein Mitspieler sein
                if($value->UserName != $_SESSION['username'])
                {                    
                    // Jeder Benutzer ohne Game-ID könnte spielen
                    if($token == 0)
                    {
                        $token = rand(10000, 10000000);
                        $players[] = array($name, $token);
                    }                                                            
                }                  
            }
            
            return $players;
        }

        /**
        * Methode zur Auswahl des Gegners
        * für ein mögliches Spiel
        * in der Datenbank und im Browser        
        *               
        * @author Marco Staab
        * @access public        
        * 
        * @param int $token Session Token
        * @param string $name Benutzername
        *
        * @return bool Rückgabwert true bei Erfolg 
        *
        */
        public function SelectOpponent($token, $name) 
        {            
            $_SESSION['game_id'] = intval($token);

            $opponent = $name;
            $_SESSION['opponent'] = $opponent;

            // Hole alle Users aus der Datenbank
            $this->db->query('SELECT * FROM Users WHERE UserID = :userid');

            $this->db->bind(':userid', $_SESSION['user_id']);

            // Lege alle User-Objekte in ein Array ab
            $result = $this->db->resultSet();
                        
            // Iteriere durch alle Array-Werte
            foreach($result as $value)
            {
                // Typumwandlung nach Integer wegen folgender SQL-Abfrage
                $gameID = intval($value->GameID);

                // Wenn in der Datenbank die gleich Game-ID, wie im Browser
                // vorhanden ist, muss werfe die Session weg
                if($gameID == 0)
                {
                    // Schreibe die Werte zurück in die Datenbank
                    $this->db->query('UPDATE Users SET GameID = :token, GameOpponent = :gameopponent WHERE UserName = :username ');

                    $this->db->bind(':token', $_SESSION['game_id']);
                    $this->db->bind(':gameopponent', $opponent);                
                    $this->db->bind(':username', $_SESSION['username']);       

                    $this->db->execute();

                    // Schreibe die Werte zurück in die Datenbank
                    $this->db->query('UPDATE Users SET GameID = :token, GameOpponent = :gameopponent WHERE UserName = :username ');

                    $this->db->bind(':token', $_SESSION['game_id']);
                    $this->db->bind(':gameopponent', $_SESSION['username'] );                
                    $this->db->bind(':username', $opponent);    
                    
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
            // Setze den Token auf 0
            $token = 0;
            
            // Hole alle Users aus der Datenbank
            $this->db->query('SELECT * FROM Users ORDER BY UserID');
            
            // Lege alle User-Objekte in ein Array ab
            $result = $this->db->resultSet();
                        
            // Iteriere durch alle Array-Werte
            foreach($result as $value)
            {
                // Typumwandlung nach Integer wegen folgender SQL-Abfrage
                $gameID = intval($value->GameID);

                // Wenn in der Datenbank die gleich Game-ID, wie im Browser
                // vorhanden ist, muss werfe die Session weg
                if($gameID == $id)                
                {
                    // Setze die Browser-Sessionvariable auf 0
                    $_SESSION['game_id'] = 0;
                    
                    // Setze den Mitspieler zurück
                    $GameOpponent = "";                                       

                    // Schreibe die Werte zurück in die Datenbank
                    $this->db->query('UPDATE Users SET GameID = :token, GameOpponent = :gameopponent WHERE GameID = :gameid ');

                    $this->db->bind(':token', $token);
                    $this->db->bind(':gameopponent', $GameOpponent);                
                    $this->db->bind(':gameid', $id);                
                    
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
        }
    }

    
        
