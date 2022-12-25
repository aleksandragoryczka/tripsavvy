<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css?v=<%= DateTime.Now.Ticks %>">
    <script src="https://kit.fontawesome.com/e076f466c1.js" crossorigin="anonymous"></script>
    <title>TRIP SUMMARY</title>
</head>
<body>
    <div class="container-trip-summary-page">
        <nav>
            <div class="logo">
                <img src="public/img/logo.svg">
            </div>
            <ul>
                <li>              
                    <a href="#" class="nav-button"><i class="fa-solid fa-plus"></i>  Add trip</a>
                </li>
                <li>
                    
                    <a href="#" class="nav-button"><i class="fa-solid fa-map-location-dot"></i> Map</a>
                </li>
                <li>
                    <div class="trip-dropdown-menu">
                        <div class="nav-button"><i class="fa-solid fa-caret-down"></i> Select trip</div>
                        <div class="dropdown-content">
                            <a href="#">Berlin+data</a>
                            <a href="#">Berlin+data</a>
                            <a href="#">Berlin+data</a>
                            <a href="#">Berlin+data</a>
                        </div>
                    </div>
                </li>
                <li>
                    <a href="#" class="nav-button"><i class="fa-solid fa-arrow-right-from-bracket"></i> Log out</a>
                </li>
            </ul>
        </nav>
        
        <main> 
            <section class="add-trip">
                <h1>DODAJ PODRÓŻ</h1>
                <form action="addTrip" method="POST" ENCTYPE="multipart/form-data">
                    <?php if(isset($messages)){
                        foreach ($messages as $message){
                            echo $message;
                        }
                    }
                    ?>
                    <input name="title" type="text" placeholder="Tytuł">

                    <input type="text" name="start-date" placeholder="Początek podróży" onfocusin="(this.type='date')" onfocusout="(this.type='text')">
                    <input type="text" name="end-date" placeholder="Zakończenie podróży" onfocusin="(this.type='date')" onfocusout="(this.type='text')">



                    <label for="images" class="drop-container">
                        <span class="drop-title">Upuść zdjęcie tutaj</span>
                        lub
                        <input type="file" id="images" name="file" required>
                    </label>

                    <button type="submit">Dodaj</button>
                </form>
            </section>
            <div class="all-trips">
                <a href="#">See your all trips </a>
            </div>
        </main>
    </div>

</body>