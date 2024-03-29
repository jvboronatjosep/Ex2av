<?php

class Patient{
    protected $id;
    protected $name;
    protected $address;
    
    function __construct($id, $name, $address){
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
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


    public function getAddress()
    {
        return $this->address;
    }
    public function setAddress($address)
    {
        $this->address = $address;
    }

}

?>