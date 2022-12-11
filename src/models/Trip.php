<?php

class Trip{
    private $title;
    private $start_date;
    private $end_date;
    private $image;

    public function __construct($title, $start_date, $end_date, $image)
    {
        $this->title = $title;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->image = $image;
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


    public function getImage():string
    {
        return $this->image;
    }


    public function setImage(string $image)
    {
        $this->image = $image;
    }




}