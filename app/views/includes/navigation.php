<!-- Dies ist der Inhalt der Navigationsleiste -->
<!--                                           -->
<nav class="navbar navbar-dark navbar-expand-md fixed-top bg-dark navbar-shrink py-3" id="mainNav">
        <div class="container">
            <!-- Start: Icon -->
            <a class="navbar-brand d-flex align-items-center" href="/public/Start">
            <span class="bs-icon-md shadow d-flex justify-content-center align-items-center me-2 bs-icon" style="background:url('/public/img/Icon.png') center / cover";></span>
            <span style="font-family: Amaranth, sans-serif;">iKnow</span></a>
            <!-- Ende: Icon -->                
                <!-- Start: Hamburger-Button bei Mobile-Ansicht -->
                <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <!-- Ende: Hamburger-Button bei Mobile-Ansicht -->
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <!-- Startseite -->
                        <a class="nav-link <?php echo $data['StartIsActive']; ?>" href="/public/Start">Startseite</a>
                        <!-- Startseite -->
                    </li>
                    <li class="nav-item">
                        <!-- Spielseite -->
                        <a class="nav-link <?php echo $data['GameIsActive']; ?>" href="/public/Games/index">Spielseite</a>
                        <!-- Spielseite -->
                    </li>
                    <li class="nav-item">
                        <!-- Fragen -->
                        <a class="nav-link <?php echo $data['QuestionsIsActive']; ?>" href="/public/Questions">Fragen</a>
                        <!-- Fragen -->
                    </li>
                </ul>                
                <?php
                    if (isset($_SESSION['loggedin']) == true) 
                    {
                        printf('<h2 class="text-center text-white mx-auto" style=font-size: 12px;>'.$_SESSION['username'].'</h2>');
                        printf('<a class="nav-link" id="logout" href="/public/Users/logout">Log Out</a>');
                    }
                    elseif(!isset(($_SESSION['loggedin'])))
                    {
                        printf('<a class="nav-link" id="login" href="/public/Users/login">Log In</a>');
                    }   
                ?>             
                <a class="btn btn-sm" style="background: mediumvioletred; color: whitesmoke" role="button" id="register" href="/public/Users/register">Registrieren</a>
            </div>
        </div>
    </nav>
    <!-- Ende der Navigationsleiste -->  


