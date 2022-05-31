<?php
    /**
    * Questions ist Kindklasse von Controller
    * und enthält sämtliche Logik
    * zum Fragenhandling
    * 
    * @author Marco Staab
    * @access public 
    *     
    */   
    class Questions extends Controller 
    {
        /**
        * Anonyme Konstruktor-Methode
        * erzeugt ein neues Frageobjekt
        * 
        * @author Marco Staab
        * @access public       
        *         
        */   
        public function __construct() 
        {
            $this->questionModel = $this->model('Question');            
        }

        /**
        * Diese Methode beinhaltet
        * die Logik zur Anwahl
        * der Fragen-Startview
        * 
        * @author Marco Staab
        * @access public       
        *         
        */ 
        public function index() 
        {
             $data = array(
                'title' => 'Fragen - iKnow',
                'QuestionsIsActive' => 'active',
                'GameIsActive' => '',
                'StartIsActive' => ''
            );

            $this->view('index', $data);
        }       
    }