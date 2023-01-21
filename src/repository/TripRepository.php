<?php

require_once "Repository.php";
require_once __DIR__."/../models/Trip.php";

class TripRepository extends Repository{

    public function getTrip(int $id_trip)
    {
        $stmt = $this->database->connect()->prepare("
            SELECT * FROM public.trips WHERE id_trip = :id_trip
            ");
        $stmt->bindParam(":id_trip", $id_trip, PDO::PARAM_INT);
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
            $trip['target_currency'],
            $trip['id_trip'],
            $trip['sum_of_expenses']
        );
    }

    public function addTrip(Trip $trip): void{
        $date = new DateTime();
        $stmt = $this->database->connect()->prepare(
            "INSERT INTO trips(title, start_date, end_date, target_currency, created_at, id_author, image) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)
                    ");

        $session_repository = new SessionRepository();
        $id_author = $session_repository->getSessionAuthorId();
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
        $session_repository = new SessionRepository();
        $id = $session_repository->getSessionAuthorId();

        $stmt = $this->database->connect()->prepare("
            SELECT * from public.trips WHERE id_author = :id
        ");

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $trips = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($trips as $trip){
            $result[] = new Trip(
                $trip["title"],
                $trip["start_date"],
                $trip["end_date"],
                $trip["image"],
                $trip["target_currency"],
                $trip["id_trip"],
                $trip['sum_of_expenses']
            );
        }
        return $result;
    }

    public function getTripByTitle(string $searchString)
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