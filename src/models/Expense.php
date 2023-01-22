<?php

class Expense
{
    //private $id_trip;
    private $place;
    private $amount;
    private $category;
    private $expense_date;
    private $notes;
    //private $target_currency;
    //private $title;
    //private $sum_of_expenses;
    //private $start_date;
    //private $end_date;

    public function __construct($place, $amount, $category, $expense_date, $notes)
    {
        $this->place = $place;
        $this->amount = $amount;
        $this->category = $category;
        $this->expense_date = $expense_date;
        $this->notes = $notes;
    }


    public function getPlace()
    {
        return $this->place;
    }


    public function getAmount()
    {
        return $this->amount;
    }


    public function getCategory()
    {
        return $this->category;
    }


    public function getExpenseDate()
    {
        return $this->expense_date;
    }


    public function getNotes()
    {
        return $this->notes;
    }





}