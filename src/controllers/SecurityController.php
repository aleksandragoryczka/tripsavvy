<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../repository/SessionRepository.php';

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
        $password = md5($_POST["password"]);

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

        $this->createLoginCookies($user);

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
        $name = $_POST['name'];
        $surname = $_POST['surname'];

        if ($password !== $confirmedPassword) {
            return $this->render('register', ['messages' => ['Podaj poprawne hasło!']]);
        }

        $user = new User($email, md5($password), $name, $surname);

        $this->userRepository->addUser($user);

        return $this->render('login', ['messages' => ['Rejestracja zakończona sukcesem!']]);
    }

    public function logout(){
        if(!isset($_COOKIE['session'])){
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/trips");
        }

        $session_repository = new SessionRepository();
        $session_guid = $_COOKIE['session'];
        $session_repository->deleteSession($session_guid);
        $this->clearCookies();

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/login");
    }


    private function createLoginCookies(User $user){
        //TODO: dodac rózne role (?)
       // echo $user->getId();
        $sessionRepository = new SessionRepository();
        $userRepository = new UserRepository();
        $id = $userRepository->getUserDetailsId($user);

        $guid = $sessionRepository->createSession($id);
        $cookie_name = "session";
        $cookie_value = $guid;
        $time = time() + (86400 * 30);
        setcookie($cookie_name, $cookie_value, $time, "/");
    }
}