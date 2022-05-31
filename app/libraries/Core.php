<?php  
    /**
    * Core ist die Klasse
    * zur Abstraktion der eingebenen Site-URL
    * um den richtigen Controller anzusprechen    
    * 
    * @author Marco Staab
    * @access public 
    *     
    */      
    class Core 
    {
        /**
        * Falls URL ungültig, wähle immer Startseite
        */
        protected $currentController = 'Start';
        protected $currentMethod = 'index';
        protected $params = [];

        /**
        * Konstruktor-Methode zerlegt die Site-URL
        * in einzelne Teile, speichert diese in ein Array
        * nach folgendem Schema und ruft dann 
        * Controller-Klasse, mit Controller-Methode und
        * optionalen Parametern auf        
        *
        * Die Controller-Klassen enden alle mit "s" --> Games
        * Die Model-Klassen enden alle ohne "s" --> Game
        * Die View-Klassen sind alle kleingeschrieben --> games
        * z.B: localhost/iKnow/Games/Spielmodus?si=1&li=2&gi=3
        * gültige Parameter sind si, li, gi, und ii
        *       
        * url[0] --> Games       --> Auswahl der Controller-Klasse Games
        * url[1] --> Spielmodus --> Auswahl der Methode Spielmodus in Games
        * url[]  --> si=1       --> Parameter-Array für Methode Spielmodus in Games        
        *            
        * @author Marco Staab
        * @access public
        *         
        */
        public function __construct()
        {
            /**
            * Hole URL und speichere in Array 
            */ 
            $url = array();
            $url = $this->getUrl();

            /**
            * Nur zum Debuggen in der Browser-Konsole
            * Nach Bedarf auskommentieren !
            */
            //echo "<script>console.log('Die URL lautet: ".$url."');</script>";

            /**
            * Index 0 in Array ist Name der Controller-Klasse
            * Prüfe ob Controller-Datei vorhanden ist            
            */
            if(file_exists('../app/controllers/' . $url[0] . '.php'))
            {      
              /**
              * Setze diesen Controller, als aktuellen Controller
              */
              $this->currentController = $url[0];
              
              /**
              * Lösche Index 0 in Array 
              */
              unset($url[0]);
            }
            else
            {
              /**
              * Sonst Fehler, Server wählt die Startseite an
              */
              echo "<script>console.log('Datei wurde nicht gefunden');</script>";
            }

            /**
            * Binde die gefunden Kontroller-Datei ein
            */
            require_once '../app/controllers/'. $this->currentController . '.php';

            /**
            * Und erzeuge daraus, eine neue Kontroller-Instanz 
            */
            $this->currentController = new $this->currentController;

            /**
            * Index 1 in Array ist Methode in Controller-Klasse                 
            */
            if(isset($url[1]))
            {
              /**
              * Prüfe ob Methode in Controller vorhanden ist
              */        
              if(method_exists($this->currentController, $url[1]))
              {
                /**
                * Setze diese Methode, als aktuelle Methode
                */
                $this->currentMethod = $url[1];
          
                /**
                * Lösche Index in Array 
                */
                unset($url[1]);
              }
            }

            /**
            * Was noch im Array ist, sind die Parameter, als Array
            */
            $this->params = $url ? array_values($url) : [];
            
            /**
            * Rufe Controller mit Klasse, Methode, Parameter auf
            */
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        }
    
        /**
        * Methode liest die Request-URL ein
        * und zerlegt diese in die einzelnen Pfad-Teile
        * sowie optionale URL-Parameter
        * 
        * @author Marco Staab
        * @access public        
        * 
        * @return array $result Array mit einzelnen URL-Teilen
        */
        public function getUrl()
        {     
          // Prüfe ob URL etwas beinhaltet
          if(isset($_GET['url']))
          {
            // Parse den URL-String, in ein Array
            $parsed = parse_url($_SERVER['REQUEST_URI']);            
            
            // Parse die URL-Parameter, in ein separates Array
            $params = array();

            // Aber nur wenn Parameter vorhanden sind
            if(isset($_GET['si']))
            {
              parse_str($parsed['query'], $params);
            }
                           
            // Entferne das erste Vorkommen von "/"
            $url = ltrim($parsed['path'], "/");
       
            // Zerlege den Teilstring, bei jedem Vorkommen von "/"
            $url = explode('/', $url);       

            // Wird den URL-Teil "iKnow" weg, da nicht von Bedeutung
            unset($url[0]);     

            // Führe URL-Array und Parameter-Array, in einem Array zusammen
            $result = array_merge($url, $params);
                                                                  
            return $result;
          }
        }
  }


