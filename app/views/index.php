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
<body>    
    
    <?php
       /**
       * Binde Navigation-Template Datei ein
       */
       require APPROOT . '/views/includes/navigation.php';
    ?>

<!-- Hier beginnt der spezifische Seiteninhalt -->
<header class="bg-primary-gradient pt-5" style="height: 80vh; background: url(&quot;/public/img/header_image.jpg&quot;) center no-repeat;">        
        <div class="container pt-4 pt-xl-5" style="margin-top: 300px;">
            <div class="row pt-5">
                <div class="col-md-8 col-xl-6 text-center text-md-start mx-auto">
                    <div class="text-center" style="margin-top: 15%;">
                        <p class="text-lowercase fw-bold text-light border rounded border-0 d-xl-flex ms-auto justify-content-xl-center mb-2" style="font-family: Inter, sans-serif;background: rgba(206,212,218,0.47);width: 300px;border-style: none;border-right-style: none;border-right-color: rgba(222,226,230,0);">Projekt Software Engineering</p>
                        <h4 class="fw-bold text-white border rounded border-0 border-primary" style="background: mediumvioletred;border-style: none;border-right-style: none;margin-top: 20px;">Lern-App für Studenten der IU</h4>
                    </div>
                </div>
            </div>
        </div>        
        <p class="text-white" style="text-align: center;font-size: 12px;padding-top: 2rem;">Photo by <a href="https://unsplash.com/@mdesign85?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText">MD Duran</a> on <a href="https://unsplash.com/s/photos/education?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText">Unsplash</a><br></p>
    </header>
    <!-- Start: Footer -->    
    <footer class="bg-primary-gradient pt-5">
        <div class="container py-4 py-lg-5" style="color: var(--bs-indigo); padding">
            <div class="row d-xl-flex justify-content-center">
                <div class="col-auto">
                    <div class="fw-bold d-flex justify-content-center align-items-xl-center mb-2"><span class="bs-icon-sm bs-icon-circle bs-icon-primary d-flex justify-content-center align-items-center bs-icon me-2"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-github">
                                <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"></path>
                            </svg></span><span><a href="http://github.com/GrosserKaese/iKnow">GitHub Repository zum Projekt</a></span></div>
                    <p class="text-center text-muted copyright">Dies ist eine unkommerzielle Projektarbeit zu Studienzwecken</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- Ende: Footer -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/public/js/bs-init.js"></script>
    <script src="/public/js/navbar.js"></script>
</body>
<!-- Hier endet der HTML-Body -->
</html>
<!-- Hier endet die HTML-Seite -->
    
