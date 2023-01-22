<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/mediastyle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/e076f466c1.js" crossorigin="anonymous"></script>
    <title>TRIP SUMMARY</title>
</head>
<body>
    <div class="container-trip-summary-page">
        <?php include("navbar.php"); ?>
        <main> 
            <section class="add-trip">
                <form action="addTrip" method="POST" ENCTYPE="multipart/form-data">
                    <h1>DODAJ PODRÓŻ</h1>
                    <?php if(isset($messages)){
                        foreach ($messages as $message){
                            echo $message;
                        }
                    }
                    ?>
                    <input name="title" type="text" placeholder="Tytuł">

                    <input type="text" name="start-date" placeholder="Początek podróży" onfocusin="(this.type='date')" onfocusout="(this.type='text')">
                    <input type="text" name="end-date" placeholder="Zakończenie podróży" onfocusin="(this.type='date')" onfocusout="(this.type='text')">
                    <input name="target-currency" type="text" placeholder="Waluta">

                    <label for="images" class="drop-container">
                        <span class="drop-title">Upuść zdjęcie tutaj</span>
                        lub
                        <input type="file" id="images" name="file" required>
                    </label>

                    <button type="submit">Dodaj</button>
                </form>
            </section>
        </main>
    </div>
</body>