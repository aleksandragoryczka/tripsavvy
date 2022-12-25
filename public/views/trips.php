<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css?v=<%= DateTime.Now.Ticks %>">
    <script src="https://kit.fontawesome.com/e076f466c1.js" crossorigin="anonymous"></script>
    <title>PODRÓŻE</title>
</head>
<body>
    <div class="container-trip-summary-page">
        <nav>
            <div class="logo">
                <img src="public/img/logo.svg">
            </div>
            <ul>
                <li>              
                    <a href="#" class="nav-button"><i class="fa-solid fa-plus"></i>  Dodaj podróż</a>
                </li>
                <li>
                    
                    <a href="#" class="nav-button"><i class="fa-solid fa-map-location-dot"></i> Mapa</a>
                </li>
                <li>
                    <div class="search-bar">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input placeholder="Wyszukaj podróży">
                    </div>
                </li>
                <li>
                    <a href="#" class="nav-button"><i class="fa-solid fa-arrow-right-from-bracket"></i> Wyloguj się</a>
                </li>
            </ul>
        </nav>
        
        <main> 
            <section class="trips">
                <?php foreach($trips as $trip): ?>
                <div class="trip-flip-card">
                    <div class="trip-flip-card-inner">
                      <div class="trip-flip-card-front">
                        <img src="public/uploads/<?= $trip->getImage(); ?>" alt="photo" style="width:300px; height:300px; border-radius: 36px;">
                      </div>
                      <div class="trip-flip-card-back">
                        <h1><?= $trip->getTitle(); ?></h1>
                        <p><?= $trip->getStartDate() ." - ". $trip->getEndDate(); ?></p>
                        <button>Więcej informacji</button>
                      </div>
                    </div>
                  </div>

                <?php endforeach; ?>

            </section>
            <div class="all-trips">
                <a href="#">See your all trips </a>
            </div>
        </main>
    </div>

</body>