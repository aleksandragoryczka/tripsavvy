<?php

class Expense
{
    private $country;
    private $amount;
    private $expense_currency;
    private $category;
    private $expense_date;
    private $notes;

    public function __construct($country, $amount, $expense_currency, $category, $expense_date, $notes=null)
    {
        $this->country = $country;
        $this->amount = $amount;
        $this->expense_currency = $expense_currency;
        $this->category = $category;
        $this->expense_date = $expense_date;
        $this->notes = $notes;
    }


    public function getCountry()
    {
        return $this->country;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getExpenseCurrency()
    {
        return $this->expense_currency;
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