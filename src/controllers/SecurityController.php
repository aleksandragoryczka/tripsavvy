<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';

class SecurityController extends AppController
{
    public function login(){
        //stworzenie fikcyjnego uzytkownika bo baza jeszcze nie pdopieta
        $user = new User('jan@op.pl','admin','Jan', 'Kowalski');

        if(!$this->isPost()){
            return $this->render('login');
        }

        $email = $_POST["email"];
        $password = $_POST["password"];

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