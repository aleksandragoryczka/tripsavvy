<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css?v=<%= DateTime.Now.Ticks %>">
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
            <ul>
                <li>
                    <a href="trips" class="nav-button"><i class="fa-solid fa-plane"></i>  Twoje podróże</a>
                </li>
                <li>
                    <a href="addTrip" class="nav-button"><i class="fa-solid fa-plus"></i>  Dodaj podróż</a>
                </li>
                <li>
                    
                    <a href="#" class="nav-button"><i class="fa-solid fa-map-location-dot"></i> Mapa</a>
                </li>
                <li>
                    <div class="search-bar">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input placeholder="Wyszukaj celu podróży">
                    </div>
                </li>
                <li>
                    <a href="login" class="nav-button"><i class="fa-solid fa-arrow-right-from-bracket"></i> Wyloguj się</a>
                </li>
            </ul>
        </nav>
        
        <main>
            <header>
                <div class="trip-expenses-header">

                </div>
            </header>

            <section class="expenses">
                <?php
                $tmp = new ExpenseRepository();
                $expenses = $tmp->getAllTripExpenses(1);
                foreach($expenses as $expense): ?>
                    <div class="expense-card">
                        <p><strong>Państwo: </strong><?= ($expense->getCountry());  ?></p>
                        <p><strong>Kwota: </strong><?= ($expense->getAmount())." ".($expense->getExpenseCurrency());;  ?> </p>
                        <p><strong>Kategoria: </strong><?= ($expense->getCategory());  ?></p>
                        <p><strong>Data wydatku: </strong><?= ($expense->getExpenseDate());  ?></p>
                        <?php if (!empty($expense->getNotes())): ?>
                            <p><strong>Notatka: </strong><?= ($expense->getNotes());  ?></p>
                        <?php endif; ?>
                    </div>

                <?php endforeach; ?>

            </section>
        </main>
    </div>
</body>

<template id="expense-card-template">
    <div class="expense-card">
        <p><strong>Państwo: </strong>country</p>
        <p><strong>Kwota: </strong>amount + currency </p>
        <p><strong>Kategoria: </strong>category</p>
        <p><strong>Data wydatku: </strong>data</p>
        <p><strong>Notatka: </strong>notes</p>
    </div>
</template>

