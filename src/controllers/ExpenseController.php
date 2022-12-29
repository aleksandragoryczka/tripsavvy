<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Expense.php';
require_once __DIR__.'/../repository/ExpenseRepository.php';

class ExpenseController extends AppController
{
    private $messages = [];
    private $expenseRepository;
/*
    public function __construct()
    {
        parent::__construct();
        $this->tripRepository = new TripRepository();
    }

    public function trips(){
        $trips = $this->tripRepository->getAllTrips();
        $this->render('trips', ['trips' => $trips]);
    }*/
    public function __construct()
    {
        parent::__construct();
        $this->expenseRepository = new ExpenseRepository();
    }

    public function expenses(){
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        if($contentType === "application/json"){
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);
            header('Content-type: application/json');
            http_response_code(200);
            echo $decoded;
           // echo json_encode($this->tripRepository->getTripByTitle($decoded['']))
            echo json_encode($this->expenseRepository->getAllTripExpenses(($decoded['trip_id'])));
        }

        //$expenses = $this->expenseRepository->getAllTripExpenses(1);
            //echo $id_trip;
           // echo $expenses[0];
        //$this->render('expenses', ['expenses' => $expenses]);
        //$id_trip_selected = $_GET['id'];
        //echo $id_trip_selected;
       //

    }

    public function addExpense(){
        if($this->isPost()){
            $expense = new Expense($_POST['country'], $_POST['amount'], $_POST['expense_currency'], $_POST['category'], $_POST['expense_date'], $_POST['notes']);
            $this->expenseRepository->addExpense($expense);

            return $this->render("expenses", [
                "messages" => $this->messages,
                "expenses" => $this->expenseRepository->getAllTripExpenses(1)
            ]);
        }
        $this->render("add-expense",  ["messages" => $this->messages]);
    }

}