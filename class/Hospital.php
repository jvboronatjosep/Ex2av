<?php

class Hospital{
    protected $id;
    protected $company;
    protected $investment;
    protected $date;
    protected $active;

    function __construct($id, $company, $investment, $date, $active){
        $this->id = $id;
        $this->company = $company;
        $this->investment = $investment;
        $this->date = $date;
        $this->active =$active;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->company;
    }

    public function setName($name)
    {
        $this->name = $name;
    }


    public function getAmount()
    {
        return $this->investment;
    }
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }



    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    } 



    public function getPay()
    {
        return  $this->pay;
    }

    public function setPay($pay)
    {
        $this->pay = $pay;
    }

}

?>