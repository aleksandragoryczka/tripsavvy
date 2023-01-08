<?php

class Expense
{
    //private $id_trip;
    private $country;
    private $amount;
    private $category;
    private $expense_date;
    private $notes;
    private $target_currency;
    //private $title;
    //private $sum_of_expenses;
    //private $start_date;
    //private $end_date;

    public function __construct($country, $amount, $category, $expense_date, $notes, $target_currency)
    {
        $this->country = $country;
        $this->amount = $amount;
        $this->category = $category;
        $this->expense_date = $expense_date;
        $this->notes = $notes;
        $this->target_currency = $target_currency;
    }


    public function getCountry()
    {
        return $this->country;
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

    public function getTargetCurrency()
    {
        return $this->target_currency;
    }




}