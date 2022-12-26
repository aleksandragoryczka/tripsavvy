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
        $expenses = $this->expenseRepository->getAllTripExpenses(1);
        $this->render('expenses', ['expenses' => $expenses]);
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