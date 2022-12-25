<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController
{
    public function login(){
        //stworzenie fikcyjnego uzytkownika bo baza jeszcze nie podopieta
        $userRepository = new UserRepository();

        if(!$this->isPost()){
            return $this->render('login');
        }

        $email = $_POST["email"];
        $password = $_POST["password"];

        $user = $userRepository->getUser($email);

        if(!$user){
            return $this->render('login', ['messages'=> ['User not exists!']]);
        }

        if($user->getEmail() !== $email){
            return $this->render('login', ['messages'=> ['User with this email not exists!']]);
        }

        if($user->getPassword() !== $password){
            return $this->render('login', ['messages'=> ['Wrong password!']]);
        }

        // return $this->render('trips');

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/trips");
    }
}