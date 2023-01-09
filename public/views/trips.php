<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css?v=<%= DateTime.Now.Ticks %>">
    <script src="https://kit.fontawesome.com/e076f466c1.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/search.js" defer></script>
    <title>PODRÓŻE</title>
</head>
<body>
    <div class="container-trip-summary-page">
        <?php include("navbar.php"); ?>
        
        <main> 
            <section class="trips">

                <?php
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
                <?php endforeach; ?>

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
