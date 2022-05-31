<?php
        
    // Binde die Bibliotheken ein
    require_once 'libraries/Core.php';
    require_once 'libraries/Controller.php';
    require_once 'libraries/Database.php';

    // Binde die globale Konfigurationsdatei ein    
    require_once 'config/config.php';

    // Erzeuge die Kerninstanz
    $init = new Core();
