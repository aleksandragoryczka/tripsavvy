<?php

class Trip{
    private $title;
    private $start_date;
    private $end_date;
    private $image;
    private $target_currency;
    private $id_trip;
    private $sum_of_expenses;

    public function __construct($title, $start_date, $end_date, $image, $target_currency, $id_trip=null, $sum_of_expenses=0)
    {
        $this->title = $title;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->image = $image;
        $this->target_currency=$target_currency;
        $this->id_trip=$id_trip;
        $this->sum_of_expenses=$sum_of_expenses;
    }

    public function getIdTrip()
    {
        return $this->id_trip;
    }

    public function getSumOfExpenses()
    {
        return $this->sum_of_expenses;
    }

    //TODO: reszta niepotrzebna (?)

    public function getTargetCurrency()
    {
        return $this->target_currency;
    }

    public function setTargetCurrency($target_currency): void
    {
        $this->target_currency = $target_currency;
    }

    public function getTitle() :string
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    //TODO: add types of returned startdate and enddate

    public function getStartDate()   :string
    {
        return $this->start_date;
    }

    public function setStartDate(string $start_date)
    {
        $this->start_date = $start_date;
    }

    public function getEndDate():string
    {
        return $this->end_date;
    }


    public function setEndDate(string $end_date)
    {
        $this->end_date = $end_date;
    }


    public function getImage()
    {
        return $this->image;
    }


    public function setImage(string $image)
    {
        $this->image = $image;
    }




}