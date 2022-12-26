<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css?v=<%= DateTime.Now.Ticks %>">
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
                <button>Utwórz nowe konto</button>
            </form>
        </div>
    </div>
</body>