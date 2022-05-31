<!-- Dies ist der Inhalt der Startseite -->
<!--                                    -->
<!doctype html>
<html lang="de">
<!-- Hier wird HTML-Head gerendert -->
<?php
   
   /**
   * Binde HTML Head-Template Datei ein
   */
   require APPROOT . '/views/includes/head.php';   
?>
<!-- Hier beginnt der HTML-Body -->
<body style="background-color: lightgray">
    
    <?php       
       /**
       * Binde Navigation-Template Datei ein
       */
       require APPROOT . '/views/includes/navigation.php';
    ?>

<!-- Hier beginnt der spezifische Seiteninhalt -->
<section class="py-5 mt-5" style="height: 100vh;" id="Players">
        <!-- Start: Start Game -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Start: Banner Color -->
                    <section class="py-4 py-xl-5">
                        <div class="container">
                            <div class="text-white bg-primary border rounded border-0 border-primary d-flex flex-column justify-content-between flex-lg-row p-4 p-md-5">
                                <div class="pb-2 pb-lg-1">
                                    <h2 class="fw-bold mb-2">Starten Sie hier Ihr interaktives Lernerlebnis !</h2>
                                    <p class="mb-0">Bitte zuerst einen Mitspieler wählen...</p>
                                </div>
                                <div class="my-2">
                                    <a class="btn btn-light fs-5 py-2 px-4" role="button" 
                                <?php
                                    if (isset($_SESSION['loggedin']) == true && (!empty($_SESSION['opponent']))) 
                                    {
                                        printf('href="/public/Games/modus"');
                                    }
                                    elseif(empty($_SESSION['loggedin']))
                                    {
                                        printf('href="/public/Users/login"');
                                    }   
                                ?> >Spiel starten ?</a></div>
                            </div>
                        </div>
                    </section><!-- End: Banner Color -->
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-8 align-self-start">
                    <div class="card" style="background:var(--bs-blue);">
                        <div class="border rounded border-primary" 
                            style="height: 5px;background: var(--bs-gray-500);border-style:solid;border-color:var(--bs-blue);border-radius:4;padding:0;margin:20px;">
                        </div>
                        <h4 class="text-center text-white">Verfügbare Spieler</h4>
                        <div class="border rounded border-primary" 
                            style="height: 5px;background: var(--bs-gray-500);border-style:solid;border-color:var(--bs-blue);border-radius:4;padding:0;margin:20px;">
                        </div>
                        <ul class="list-group list-group-flush" style="padding-bottom:1rem">
                        <?php
                        if(!empty($data['Players']))
                        {
                                foreach($data['Players'] as $value)
                                {
                                    printf('<li class="list-group-item text-center text-warning" style="background:var(--bs-blue); padding:1rem">');
                                    printf('<a class="btn-sm btn-warning" role="button" href="/public/Games/opponent?si='.$value[1].'&li='.$value[0].'">'.$value[0].'</a>');
                                    printf('</li>');
                                }
                        }
                            ?>                                                        
                        </ul>
                    </div>
                </div>
            </div>
        </div><!-- End: Start Game -->
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/public/js/bs-init.js"></script>
    <script src="/public/js/navbar.js"></script>        
    <script src="/public/js/availablePlayers.js"></script>
</body>

</html>