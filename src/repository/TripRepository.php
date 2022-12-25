<?php

require_once "Repository.php";
require_once __DIR__."/../models/Trip.php";

class TripRepository extends Repository{

    public function getTrip(int $id): ?Trip
    {
        $stmt = $this->database->connect()->prepare("
            SELECT * FROM public.users WHERE id = :id
            ");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        $trip = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$trip){
            return null;
        }
        return new Trip(
            $trip['title'],
            $trip['start_date'],
            $trip['end_date'],
            $trip['image'],
            $trip['target_currency']
        );
    }

    public function addTrip(Trip $trip): void{
        $date = new DateTime();
        $stmt = $this->database->connect()->prepare(
            "INSERT INTO trips(title, start_date, end_date, target_currency, created_at, id_author, image) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)
                    ");

        //TODO: pobranie tej wartosci na podstawie sesji zalogowanego uzytkownika, tak aby zwrocic to ID sesji lub pobrane z bazy danych na podstawie tokenu sesji zpaisnaego w db
        $id_author = 1;
        $stmt->execute([
            $trip->getTitle(),
            $trip->getStartDate(),
            $trip->getEndDate(),
            $trip->getTargetCurrency(),
            $date->format('Y-m-d'),
            $id_author,
            $trip->getImage()
        ]);
    }

    public function getAllTrips(){
        $result = [];

        $stmt = $this->database->connect()->prepare("
            SELECT * from public.trips
        ");

        $stmt->execute();
        $trips = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($trips as $trip){
            $result[] = new Trip(
                $trip["title"],
                $trip["start_date"],
                $trip["end_date"],
                $trip["image"],
                $trip["target_currency"]
            );
        }
        return $result;
    }

    public function getProjectByTitle(string $searchString)
    {
        $searchString = "%".strtolower($searchString)."%";

        $stmt = $this->database->connect()->prepare("
            SELECT * from public.trips WHERE LOWER(title) LIKE :search
        ");

        $stmt->bindParam(":search", $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}