<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css?v=<%= DateTime.Now.Ticks %>">
    <script src="https://kit.fontawesome.com/e076f466c1.js" crossorigin="anonymous"></script>
    <title>DODAWANIE WYDATKU</title>
</head>
<body>
<div class="container-trip-summary-page">
    <nav>
        <div class="logo">
            <img src="public/img/logo.svg">
        </div>
        <ul>
            <li>
                <a href="trips" class="nav-button"><i class="fa-solid fa-plane"></i>  Twoje podróże</a>
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
        <section class="new-expense">
            <div class="single-trip">
                <div class="trip-flip-card">
                    <div class="trip-flip-card-inner">
                        <div class="trip-flip-card-front">
                            <img src="public/uploads/" alt="photo" style="width:300px; height:300px; border-radius: 36px;">
                        </div>
                        <div class="trip-flip-card-back">
                            <h1>title</h1>
                            <p> daty </p>
                        </div>
                    </div>
                </div>
                <h1>suma wydatków</h1>
            </div>

            <div class="add-expense">
                <form action="addExpense" method="POST">
                    <?php if(isset($messages)){
                        foreach ($messages as $message){
                            echo $message;
                        }
                    }
                    ?>
                    <h1>DODAJ WYDATEK</h1>
                    <input name="country" type="text" placeholder="Państwo" >
                    <input name="amount" type="text" placeholder="Kwota">
                    <input name="expense_currency" type="text" placeholder="Waluta">
                    <input name="category" type="text" placeholder = "Kategoria" >
                    <input type="text" name="expense_date" placeholder="Data" onfocusin="(this.type='date')" onfocusout="(this.type='text')">
                    <textarea name="notes" rows="4" placeholder="Notatki"></textarea>

                    <button type="submit">Dodaj wydatek</button>
                </form>
            </div>

        </section>
    </main>
</div>

</body>
