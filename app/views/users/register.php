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
    <section class="py-5 mt-5" style="height: 600px;">
        <div class="container py-5">
            <div class="row mb-4 mb-lg-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <p class="fw-bold mb-2" style="color: mediumvioletred">Registrierung</p>
                    <h2 class="fw-bold" style="font-family: Amaranth, sans-serif;"><strong>Willkommen</strong></h2>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body text-center d-flex flex-column align-items-center">
                            <div class="bs-icon-xl bs-icon-circle bs-icon-primary shadow bs-icon my-4"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-person">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"></path>
                                </svg></div>
                            <form method="post" action="<?php echo URLROOT; ?>/Users/register"> 
                                <div class="mb-3">                                      
                                    <input                                                                                 
                                        class="form-control"
                                        type="text"                                        
                                        name="username" 
                                        data-bs-toggle="tooltip" 
                                        data-bss-tooltip="" 
                                        data-bs-placement="left" 
                                        title="Hier den Benutzernamen eingeben! Leerzeichen sind erlaubt!" 
                                        placeholder="Benutzername eingeben"   
                                        pattern="<?php echo USERNAME_PATTERN ?>"                                       
                                        minlength="<?php echo USERNAME_MIN_LENGTH ?>" 
                                        maxlength="<?php echo USERNAME_MAX_LENGTH ?>"                                                                                                                                                                                  
                                    >
                                    <div class="invalid-feedback d-block">
                                        <small><?php echo $data['usernameError'] ?></small>
                                    </div>                                    
                                </div>
                                <div class="mb-3">                                       
                                    <input                                          
                                        class="form-control"
                                        type="email"                                        
                                        name="email"
                                        data-bs-toggle="tooltip" 
                                        data-bss-tooltip="" 
                                        data-bs-placement="left" 
                                        title="Hier die E-Mail Adresse eingeben! Keine Umlaute und Leerzeichen erlaubt!"                                          
                                        placeholder="E-Mail Adresse eingeben" 
                                        pattern="<?php echo EMAIL_PATTERN ?>"                                              
                                    >
                                    <div class="invalid-feedback d-block">
                                        <small><?php echo $data['emailError'] ?></small>
                                    </div>                                    
                                </div>
                                <div class="mb-3">                                                                    
                                    <input                                             
                                        class="form-control" 
                                        type="password" 
                                        name="password" 
                                        data-bs-toggle="tooltip" 
                                        data-bss-tooltip="" 
                                        data-bs-placement="left" 
                                        title="Hier ein Passwert eingeben! Mindestens 8 Zeichen!" 
                                        placeholder="Passwort eingeben" 
                                        pattern="<?php echo PASSWORD_PATTERN ?>" 
                                        minlength="<?php echo PASSWORD_MIN_LENGTH ?>" 
                                        maxlength="<?php echo PASSWORD_MAX_LENGTH ?>"                                                                                                                                                                 
                                    >
                                    <div class="invalid-feedback d-block">
                                        <small><?php echo $data['passwordError'] ?></small>
                                    </div>
                                </div>
                                <div class="mb-3">                                     
                                    <input                                                             
                                        class="form-control" 
                                        type="password"
                                        name="confirmPassword" 
                                        data-bs-toggle="tooltip" 
                                        data-bss-tooltip="" 
                                        data-bs-placement="left" 
                                        title="Hier das Passwort exakt wiederholen!" 
                                        placeholder="Passwort erneut eingeben" 
                                        pattern="<?php echo PASSWORD_PATTERN; ?>" 
                                        minlength="<?php echo PASSWORD_MIN_LENGTH; ?>" 
                                        maxlength="<?php echo PASSWORD_MAX_LENGTH; ?>"                                                                                 
                                    >
                                    <div class="invalid-feedback d-block">
                                        <small><?php echo $data['confirmPasswordError']; ?></small>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button class="btn shadow d-block w-100" value="submit" style="background: mediumvioletred; color: whitesmoke" type="submit">Registrieren</button>
                                </div>
                                <p class="text-muted">Sie sind schon registriert?&nbsp;<a href="/public/Users/login">Zur Anmeldung</a></p>                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/public/js/bs-init.js"></script>
    <script src="/public/js/navbar.js"></script>
    <script src="/public/js/validation.js"></script>
</body>

</html>
