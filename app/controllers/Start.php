<?php    
    /**
    * Start ist Kindklasse von Controller
    * und enthält sämtliche Logik
    * zum Start der Anwendung
    * 
    * @author Marco Staab
    * @access public 
    *     
    */        
    class Start extends Controller  
    {
        /**
        * Anonyme Konstruktormethode
        */
        public function __construct() 
        {
            
        }

        /**
        * Methode ruft die View der Startseite auf
        * und übergibt dynamische Parameter an die Site
        */
        public function index() 
        {
            /**
            * Setze Seitentitel auf "Startseite"
            * Markiere Navigation Aktiv
            */
            $data = array
            (
            'title' => 'Startseite - iKnow',
            'StartIsActive' => 'active',
            'GameIsActive' => '',
            'QuestionsIsActive' => ''
            );
                
            $this->view('index', $data);
        }       
    }