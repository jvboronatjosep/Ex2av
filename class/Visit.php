<?php

class Visit{
    protected $id;
    protected $name;
    protected $amount;
    protected $date;
    protected $pay;

    function __construct($id, $name, $amount, $date, $pay){
        $this->id = $id;
        $this->name = $name;
        $this->amount = $amount;
        $this->date = $date;
        $this->pay =$pay;
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
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }


    public function getAmount()
    {
        return $this->amount;
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
        return $this->pay;
    }

    public function setPay($pay)
    {
        $this->pay = $pay;
    }

}

?>