<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/mediastyle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>LOGOWANIE</title>
</head>
<body>
    <div class="container"> 
        <div class="logo">
            <img src="public/img/logo.svg">
        </div>
        <div class="login-container">
            <form class="login" action="login" method="POST">
                <div class="message">
                    <?php if(isset($messages)){
                        foreach ($messages as $message){
                            echo $message;
                        }
                    }
                    ?>
                </div>
                <p class="welcome-message"><strong>Witaj ponownie podróżniku!</strong></p>
                <input name="email" type="text" placeholder="Podaj adres e-mail" required>
                <input name="password" type="password" placeholder="Podaj hasło" required>
                <button type="submit">Zaloguj się</button>
                <button><a href="register">Zarejestruj się</a></button>
                <!-- <a href="register" class="nav-button">Zarejestruj się</a>  -->
            </form>
        </div>
    </div>

</body>