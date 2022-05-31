<?php    
    /**
    * Games ist Kindklasse von Controller
    * und enthält sämtliche Logik
    * zum Spielehandling
    * 
    * @author Marco Staab
    * @access public 
    *     
    */   
    class Games extends Controller 
    {
        /**
        * Anonyme Konstruktor-Methode
        * erzeugt ein neues Gameobjekt
        * 
        * @author Marco Staab
        * @access public       
        *         
        */   
        public function __construct() 
        {
            $this->gameModel = $this->model('Game');            
        }

        /**
        * Diese Methode beinhaltet
        * die Logik zur Anwahl
        * der Spiel-Startview
        * 
        * @author Marco Staab
        * @access public       
        *         
        */ 
        public function index() 
        {
            $data = array(
                'title' => 'Spieler - iKnow',
                'GameIsActive' => 'active',
                'StartIsActive' => '',
                'QuestionsIsActive' => ''                                
            );
            
            if (isset($_SESSION['loggedin']) == true )
            {
                $data['Players'] = $this->gameModel->DisplayAvailablePlayers();
            }
               
        $this->view('/games/index', $data);
        }

        /**
        * Diese Methode beinhaltet
        * die Logik zur Anwahl
        * der Spiel-Startview
        * 
        * @author Marco Staab
        * @access public       
        *         
        */ 
        public function opponent($token, $name) 
        {
            // Bevor ein neuer Mitspieler gewählt werden kann
            // werfe altes Game weg
            if ($_SESSION['game_id'] !=0 )
            {
                $this->gameModel->DeleteGame($_SESSION['game_id']);                                                                    
            }

            // Wähle den neuen Mitspieler
            $this->gameModel->SelectOpponent($token, $name);            
            header('location:/public/Games/index');
        }
        

    }