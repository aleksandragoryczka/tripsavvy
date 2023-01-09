<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css?v=<%= DateTime.Now.Ticks %>">
    <script type="text/javascript" src="./public/js/script.js" defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>REJESTRACJA</title>
</head>
<body>
    <div class="container"> 
        <div class="logo">
            <img src="public/img/logo.svg">
        </div>
        <div class="register-container">
            <form class="register" action="register" method="POST">
                <div class="message">
                    <?php if(isset($messages)){
                        foreach ($messages as $message){
                            echo $message;
                        }
                    }
                    ?>
                </div>
                <h2>Uzupełnij formularz:</h2>
                <input name="email" type="text" placeholder="Adres e-mail" required>
                <input name="password" type="password" placeholder="Hasło" required>
                <input name="confirmedPassword" type="password" placeholder="Powtórz hasło" required>
                <input name="name" type="text" placeholder="Imię" required>
                <input name="surname" type="text" placeholder="Nazwisko" required>
                <button class="button">Zarejestruj się</button>
            </form>
            <div class="container-signin">
                <p>Masz już konto? <a href="login">Zaloguj się</a></p>
            </div>
        </div>
    </div>

</body>