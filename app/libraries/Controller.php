<?php
    /**
    * Controller ist die Oberklasse
    * der Kontrollschicht, als Bindeglied
    * zwischen UI und der Modellschicht
    * im MVC-Design-Pattern
    * 
    * @author Marco Staab
    * @access public 
    *     
    */        
    class Controller
    {
        /**
        * Methode bindet die Modelldatei ein
        * und gibt ein neues Modellobjekt zurück
        * 
        * @author Marco Staab
        * @access public
        * @param string $model Name der Modelldatei
        * 
        * @return object $model Neue Modellobjektinstanz
        */
        public function model($model) 
        {
            /**
            * Binde Datei aus Dateipfad ein 
            */        
            require_once '../app/models/' . $model . '.php';
            
            /**
            * Erzeuge neue Objektinstanz
            */ 
            return new $model();
        }

        /**
        * Methode bindet die Modelldatei ein
        * und gibt ein neues Modellobjekt zurück
        * 
        * @author Marco Staab
        * @access public
        * @param string $view Name der zu rendernden Site
        * @param array  $data Array mit Parametern für die zu rendernde Site
        *          
        */
        public function view($view, $data = []) 
        {
            /**
            * Nur zum Debuggen in der Browser-Konsole
            * Nach Bedarf auskommentieren !
            */
            //echo "<script>console.log('Seitentitel: ".$data['title']."');</script>";

            /**
            * Prüft, ob die Ansicht im Dateipfad vorhanden ist
            * sonst Abbruch mit Fehlermeldung
            */
            if (file_exists('../app/views/' . $view . '.php')) 
            {
                require_once '../app/views/' . $view . '.php';
            }
            else 
            {
                die("View does not exists.");
            }
        }
    }
