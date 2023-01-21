<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Trip.php';
require_once __DIR__.'/../repository/TripRepository.php';
require_once __DIR__.'/../repository/ExpenseRepository.php';

class TripsController extends AppController
{
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg', 'image/jpg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private $messages = [];
    private $tripRepository;

    public function __construct()
    {
        parent::__construct();
        $this->tripRepository = new TripRepository();
        $this->expenseRepository = new ExpenseRepository();
    }

    public function trips(){

        if(!isset($_GET['id_trip'])){
            return $this->render('trips');
        }

        $selectTrip = $this->tripRepository->getTrip($_GET['id_trip']);

        $expensesForTrip = $this->expenseRepository->getExpensesViaTrip($selectTrip->getIdTrip());
        $this->render('expenses', [
            'trip' => $selectTrip,
            'expenses' => $expensesForTrip

        ]);
    }

    public function addTrip(){
        if($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])){
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );

            $trip = new Trip($_POST['title'], $_POST["start-date"], $_POST["end-date"], $_FILES['file']['name'], $_POST['target-currency']);
            $this->tripRepository->addTrip($trip);

            return $this->render("trips", [
                "messages" => $this->messages,
                "trips" => $this->tripRepository->getAllTrips()
            ]);
        }

        $this->render("add-trip",  ["messages" => $this->messages]);
    }

    public function search(){
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if($contentType === "application/json"){
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($this->tripRepository->getTripByTitle($decoded['search']));
        }
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

    public function addExpense(){
        if($this->isPost()) {


            $titleSelected = $_POST['titles'];
            $trips = $this->tripRepository->getTripByTitle($titleSelected);
            $trip_id = $trips[0]['id_trip'];
            //$selectTrip = $this->tripRepository->getTrip($trip_id);

            $expense = new Expense($_POST['place'], $_POST['amount'], $_POST['category'], $_POST['expense_date'], $_POST['notes']);
            $this->expenseRepository->addExpense($expense, $trip_id);


            //$expensesForTrip = $this->expenseRepository->getExpensesViaTrip($selectTrip->getIdTrip());

            return $this->render("expenses", [
                'trip' => $this->tripRepository->getTrip($trip_id),
                "messages" => $this->messages,
                "expenses" => $this->expenseRepository->getAllTripExpenses($trip_id)
            ]);
        }
        $this->render("add-expense",  ["messages" => $this->messages]);
    }

}