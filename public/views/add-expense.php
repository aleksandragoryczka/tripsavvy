<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css?v=<%= DateTime.Now.Ticks %>">
    <script src="https://kit.fontawesome.com/e076f466c1.js" crossorigin="anonymous"></script>
    <title>DODAWANIE WYDATKU</title>
</head>
<body>
<div class="container-trip-summary-page">
    <?php include("navbar.php"); ?>
    <main>
            <div class="add-trip">
                <form action="addExpense" method="POST">
                    <?php if(isset($messages)){
                        foreach ($messages as $message){
                            echo $message;
                        }
                    }
                    ?>
                    <h1>DODAJ WYDATEK</h1>
                    <div class="dropdown-menu">
                        <label for="titles">Wybierz podróż: </label>
                        <select id="trip-titles" name="titles" required>
                            <?php $tmp = new TripRepository();
                            $trips = $tmp->getAllTrips();
                            foreach($trips as $trip): ?>
                                <option name=<?= $trip->getTitle(); ?>><?= $trip->getTitle(); ?></option>
                              <!--  <option value="volvo">Volvo</option>
                                <option value="saab">Saab</option>
                                <option value="fiat">Fiat</option>
                                <option value="audi">Audi</option> -->

                            <?php endforeach; ?>
                        </select>
                    </div>

                    <input name="place" type="text" placeholder="Miejsce">
                    <input name="amount" type="text" placeholder="Kwota">
                   <!-- <input name="expense_currency" type="text" placeholder="Waluta"> -->
                    <input name="category" type="text" placeholder = "Kategoria" >
                    <input type="text" name="expense_date" placeholder="Data" onfocusin="(this.type='date')" onfocusout="(this.type='text')">
                    <textarea name="notes" rows="4" placeholder="Notatki"></textarea>

                    <button type="submit">Dodaj wydatek</button>
                </form>
            </div>
    </main>
</div>

</body>
