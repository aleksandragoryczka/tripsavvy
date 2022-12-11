<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Trip.php';

class AddTripController extends AppController
{
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'iimage/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private $messages = [];

    public function addTrip(){
        if($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])){

            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );

            $trip = new Trip($_POST['title'], $_POST["start-date"], $_POST["end-date"], $_FILES['file']['name']);

            return $this->render("trips", ["messages" => $this->messages, 'trip'=> $trip]);
        }

        $this->render("add-trip",  ["messages" => $this->messages]);
    }

    private function validate(array $file): bool
    {
        if($file['size'] > self::MAX_FILE_SIZE){
            $this->messages[] = "Zbyt duży plik";
            return false;
        }
        if(!isset($file['type']) && !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->messages[] = "Zły format pliku";
            return false;
        }
        return true;
    }
}