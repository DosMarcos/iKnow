<?php    
    /**
    * Users ist Kindklasse von Controller
    * und enthält sämtliche Logik
    * zum Benutzerhandling
    * also Registrierung und Anmeldung
    * 
    * @author Marco Staab
    * @access public 
    *     
    */   
    class Users extends Controller 
    {
        /**
        * Anonyme Konstruktor-Methode
        * erzeugt ein neues Userobjekt
        * 
        * @author Marco Staab
        * @access public       
        *         
        */    
        public function __construct() 
        {
            $this->userModel = $this->model('User');
        }

        /**
        * Diese Methode beinhaltet
        * die Logik zur Validierung
        * der Benutzer-Registrierung
        * 
        * @author Marco Staab
        * @access public       
        *         
        */ 
        public function register() 
        {
            // Default-Werte die beim Seitenaufruf geladen werden
            $data = [
                'title' => 'Registrierung - iKnow',
                'username' => '',
                'email' => '',
                'password' => '',
                'confirmPassword' => '',
                'usernameError' => '',
                'userStatus' => '',
                'emailError' => '',                                
                'passwordError' => '',
                'confirmPasswordError' => ''               
            ];
                        
            // Die Validierung startet mit dem Klick auf "Registrieren"
            if($_SERVER['REQUEST_METHOD'] == 'POST')
            {                
                // Prüfe ob es sich einen gültigen POST handelt
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Dann übernehme die Daten aus dem Formular in das Array
                // Entferne vorher alle Zeichen am Anfang und Ende des String 
                // Alle Fehler sind inaktiv, da noch nichts validiert ist
                $data = [       
                    'title' => 'Registrierung - iKnow',        
                    'username' => trim($_POST['username']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirmPassword' => trim($_POST['confirmPassword']),
                    'usernameError' => '',
                    'userStatus' => '',
                    'emailError' => '',                        
                    'passwordError' => '',
                    'confirmPasswordError' => ''                             
                ];

                // Erlaubte Zeichen im Benutzername
                $nameValidation = '/^[a-zA-ZäöüÄÖÜ0-9.@ ]*$/';
                                                
                /**
                * Die Logik zur Benutzernamen Validierung    
                */
                // Leeres Benutzername Eingabefeld ablehnen
                if (empty($_POST['username'])) 
                {                    
                    $data['usernameError'] = 'Bitte geben Sie einen Benutzernamen ein.<br> Mindestens '.USERNAME_MIN_LENGTH.' Zeichen.';                    
                } 
                // Validiere den Benutzernamen, mit den erlaubten Zeichen
                elseif (!preg_match($nameValidation, $_POST['username'])) 
                {                    
                    $data['usernameError'] = 'Nur Zahlen, Leerzeichen und Buchstaben erlaubt.<br> Mindestens '.USERNAME_MIN_LENGTH.' Zeichen.';                    
                }
                
                /**
                * Die Logik zur E-Mail Validierung    
                */
                // Leeres E-Mail Eingabefeld ablehnen
                if (empty($_POST['email'])) 
                {
                    $data['emailError'] = 'Bitte geben Sie eine E-Mail Adresse ein.<br>Es sind keine Umlaute erlaubt.';
                } 
                // E-Mail Adresse filtern, mit PHP Filter
                elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
                {
                    $data['emailError'] = 'Bitte korrektes E-Mail Format verwenden.';
                } 
                // E-Mail Domain auf vereinbarten Wert prüfen
                elseif (!$this->validate_EmailDomain(($_POST['email'])))
                {
                    $data['emailError'] = 'Keine gültige E-Mail Domain.<br>Adresse muss auf @IUBH.de oder @IUBH-Fernstudium.de enden.<br>Gross oder Kleinschreibung ist erlaubt.';
                }
                // In Datenbank nachschauen, ob Benutzer schon existiert
                elseif ($this->userModel->findUserByEmail($_POST['email'])) 
                {
                    $data['emailError'] = 'E-Mail Adresse ist schon vorhanden.';             
                }
                                                                               
                /**
                * Die Logik zur Passwort Validierung    
                */
                // Leeres Passwort Eingabefeld ablehnen
                if(empty($_POST['password']))
                {
                    $data['passwordError'] = 'Bitte geben Sie ein Passwort ein.<br> Mindestens '.PASSWORD_MIN_LENGTH.' Zeichen.';
                } 
                
                /**
                * Die Logik zur Passwort-Wiederholen Validierung    
                */
                // Leeres Passwort erneut Eingabefeld ablehnen
                if (empty($_POST['confirmPassword'])) 
                {
                    $data['confirmPasswordError'] = 'Bitte geben Sie das Passwort erneut ein.';
                } 
                else 
                {
                    if ($_POST['password'] != $_POST['confirmPassword']) 
                    {
                        $data['confirmPasswordError'] = 'Keine Übereinstimmung. Bitte Vorgang wiederholen.';
                    }
                }

                /**
                * Nur wenn keine Fehler anstehen wird in die Datenbank geschrieben    
                */
                if (empty($data['usernameError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])) 
                {

                    // Hashe Passwort
                    $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

                    // Registriere Benutzer in Datenbank
                    if ($this->userModel->register($data)) 
                    {
                        // Weiterleitung an die Anmeldeseite
                        header('location:/public/Users/login');
                    } 
                    else 
                    {
                        die('Something went wrong.');
                    }                    
                }                
            }                             
        $this->view('users/register', $data);
        }
        
        /**
        * Diese Methode beinhaltet
        * die Logik zur Validierung
        * der E-Mail Adresse, ob diese
        * die korrekte Domain aufweist
        * 
        * @author Marco Staab
        * @access public    
        *
        * @param string $UserEmail Eine E-Mail Adresse
        *
        * @return bool Rückgabwert true bei Erfolg    
        *         
        */ 
        public function validate_EmailDomain($UserEmail) 
        {
            /**
            * Prüfe ob Inhalt in Parameter und trimme Leerzeichen
            */
            $email = isset($UserEmail) ? trim($UserEmail) : null;

            // Die erlaubten Domains
            $allowed = [
                'IUBH.de',
                'IUBH-Fernstudium.de',
                'iubh.de',
                'iubh-fernstudium.de'
            ];

            // Prüfe ob die E-Mail-Adresse gültig ist
            if (filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                // Teile String nach dem @ Zeichen 
                $parts = explode('@', $email);

                // Geben den letzten Teil zurück, dieser sollte die Domain sein
                $domain = array_pop($parts);

                // Prüfe ob die Domain erlaubt ist
                $result = (in_array($domain, $allowed));
            }
        return $result;
        }

        /**
        * Diese Methode beinhaltet
        * die Logik zur Validierung
        * des Benutzers, ob dieser
        * eingeloggt wird, oder nicht
        * 
        * @author Marco Staab
        * @access public    
        *                                     
        */ 
        public function login()
        {
            $data = [
                'title' => 'Anmeldung - iKnow',
                'email' => '',
                'password' => '',
                'emailError' => '',
                'passwordError' => ''                   
            ];
              
            // Die Validierung startet mit dem Klick auf "Einloggen"
            if($_SERVER['REQUEST_METHOD'] == 'POST') 
            {        
                // Wenn ein Inhalt im E-Mail Eingabefeld steht        
                if(!empty($_POST['email']))
                {
                    // Prüfe ob diese E-Mail Adresse schon eingeloggt ist
                    $stillLoggedIn = $this->userModel->getLoginByEmail($_POST['email']);

                    // Wenn der Benutzer schon eingeloggt ist, zeige Meldung und breche ab
                    if ($stillLoggedIn) 
                    {
                        $data['emailError'] = 'Benutzer ist schon angemeldet';
                        $data['passwordError'] = 'Benutzer ist schon angemeldet.';
                        $this->view('users/login', $data);
                        exit();
                    }
                    // Wenn er nicht eingeloggt ist
                    else
                    {
                        // aber schon eine Browser-Session besteht, zeige Meldung und breche ab
                        if(!empty($_SESSION['loggedin']))
                        {
                            $data['emailError'] = 'Nur ein Benutzer pro Session möglich.';
                            $data['passwordError'] = 'Nur ein Benutzer pro Session möglich.';
                            $this->view('users/login', $data);
                            exit();
                        }
                    }
                }
                                                
                // Prüfe ob es sich einen gültigen POST handelt
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Dann übernehme die Daten aus dem Formular in das Array
                // Entferne vorher alle Zeichen am Anfang und Ende des String 
                // Alle Fehler sind inaktiv, da noch nichts validiert ist
                $data = [
                    'title' => 'Anmeldung - iKnow',
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'emailError' => '',
                    'passwordError' => ''                
                ];

                /**
                * Die Logik zur E-Mail Adressen Validierung    
                */
                // Leeres E-Mail Eingabefeld ablehnen
                if (empty($_POST['email'])) 
                {
                    $data['emailError'] = 'Bitte geben Sie eine E-Mail Adresse ein.';
                }

                /**
                * Die Logik zur Passwort Validierung    
                */
                // Leeres Passwort Eingabefeld ablehnen
                if(empty($_POST['password']))
                {
                    $data['passwordError'] = 'Bitte geben Sie Ihr Passwort ein.';
                }

                /**
                * Nur wenn keine Fehler anstehen wird aus der Datenbank gelesen    
                */
                if (empty($data['emailError']) && empty($data['passwordError'])) 
                {
                    $loggedInUser = $this->userModel->login($_POST['email'], $_POST['password']);

                    if ($loggedInUser) 
                    {
                        $this->createUserSession($loggedInUser); 
                        $this->userModel->setLoginStatus($_POST['email']);                                                                                        
                    } 
                    else 
                    {
                        $data['passwordError'] = 'Passwort oder E-Mail Adresse sind nicht korrekt.<br>Bitte erneut versuchen.';
                    
                        $this->view('users/login', $data);
                    }
                }
            }               
            $this->view('users/login', $data);
        }

        /**
        * Diese Methode beinhaltet
        * erstellt die notwendigen
        * Session-Variablen im Browser
        * für die aktuelle Sitzung
        * 
        * @author Marco Staab
        * @access public    
        *                                     
        */ 
        public function createUserSession($user) 
        {
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $user->UserID;
            $_SESSION['username'] = $user->UserName;
            $_SESSION['email'] = $user->UserEmail;
            $_SESSION['game_id'] = 123;
            $_SESSION['opponent'] = "";            
        }
    
        /**
        * Diese Methode beseitigt die 
        * vorhandenen Session-Variablen 
        * im Browser, wenn sich der Benutzer ausloggt
        * 
        * @author Marco Staab
        * @access public    
        *                                     
        */ 
        public function logout() 
        { 
            $this->userModel->DeleteGame($_SESSION['game_id']);           
            
            $_SESSION['loggedin'] = false;
            $this->userModel->setLoginStatus($_SESSION['email']);
            
            unset($_SESSION['loggedin']);
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['email']);
            unset($_SESSION['game_id']);
            unset($_SESSION['opponent']);
            header('location:/public/Users/login');
        }
    }
