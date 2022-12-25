<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController
{
    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }


    public function login(){
        if(!$this->isPost()){
            return $this->render('login');
        }

        $email = $_POST["email"];
        $password = $_POST["password"];

        $user = $this->userRepository->getUser($email);

        if(!$user){
            return $this->render('login', ['messages'=> ['Taki użytkownik nie istnieje!']]);
        }

        if($user->getEmail() !== $email){
            return $this->render('login', ['messages'=> ['Użytkownik z tym adresem e-mail nie istnieje!']]);
        }

        if($user->getPassword() !== $password){
            return $this->render('login', ['messages'=> ['Niepoprawne hasło!']]);
        }

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/trips");
    }


    public function register(){
        if(!$this->isPost()){
            return $this->render('register');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmedPassword = $_POST['confirmedPassword'];

        if ($password !== $confirmedPassword) {
            return $this->render('register', ['messages' => ['Podaj poprawne hasło!']]);
        }

        $user = new User($email, md5($password));

        $this->userRepository->addUser($user);

        return $this->render('login', ['messages' => ['Rejestracja zakończona sukcesem!']]);

    }
}