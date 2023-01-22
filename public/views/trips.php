<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/mediastyle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/e076f466c1.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/search.js" defer></script>
    <title>PODRÓŻE</title>
</head>
<body>
    <div class="container-trip-summary-page">
        <nav>
            <a href="trips">
                <div class="logo">
                    <img src="public/img/logo.svg">
                </div>
            </a>
            <input id="menu-toggle" type="checkbox" />
            <label class='menu-button-container' for="menu-toggle">
                <div class='menu-button'></div>
            </label>
            <ul class="menu">
                <li>
                    <a href="trips" class="nav-button"><i class="fa-solid fa-plane"></i>  Twoje podróże</a>
                </li>
                <li>
                    <a href="addTrip" class="nav-button"><i class="fa-solid fa-plus"></i>  Dodaj podróż</a>
                </li>
                <li>
                    <a href="addExpense" class="nav-button"><i class="fa-solid fa-dollar-sign"></i>  Dodaj wydatek</a>
                </li>
                <li>
                    <div class="search-bar">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input placeholder="Wyszukaj celu podróży">
                    </div>
                </li>
                <li>
                    <a href="logout" class="nav-button"><i class="fa-solid fa-arrow-right-from-bracket"></i> Wyloguj się</a>
                </li>
            </ul>
        </nav>
        
        <main> 
            <section class="trips">

                <?php
                if(isset($_COOKIE['session'])){
                $tmp = new TripRepository();
                $trips = $tmp->getAllTrips();
                foreach($trips as $trip): ?>
                    <div class="trip-flip-card">
                        <div class="trip-flip-card-inner">
                            <div class="trip-flip-card-front">
                                <img src="public/uploads/<?= $trip->getImage(); ?>" alt="photo" style="width:300px; height:300px; border-radius: 36px;">
                            </div>
                            <div class="trip-flip-card-back">
                                <h1><?= ($trip->getTitle()); ?></h1>
                                <p><?= $trip->getStartDate() ." - ". $trip->getEndDate(); ?></p>
                                <button class="more-info-button" onclick="goToTrip(<?= $trip->getIdTrip(); ?>)">Więcej informacji</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach;
                }?>


            </section>
        </main>
    </div>
</body>

<template id="trip-template">
    <div class="trip-flip-card">
        <div class="trip-flip-card-inner">
            <div class="trip-flip-card-front">
                <img src="" alt="photo" style="width:300px; height:300px; border-radius: 36px;">
            </div>
            <div class="trip-flip-card-back">
                <h1>title</h1>
                <p id="dates">start_date - end_date</p>
                <button class="more-info-button">Więcej informacji</button>
            </div>
        </div>
    </div>
</template>
