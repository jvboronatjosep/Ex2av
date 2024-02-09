<?php

class Visit{
    protected array $patients = [];
    private $file;

    public function __construct($file){
        
        $this->file=$file;
        $this->loadData();
    }



    public function loadData(){
        
        $manager = fopen($this->file, "r");

        while (($element = fgetcsv($manager)) !== false) {


            array_push(
                $this->patients,
                new Hospital(...$element) //Spread Operator
            );
        }

        fclose($manager);
    }



    function drawList(){
        $output = "";        
        
        foreach ($this->patients as $patient) {

            $id = $patient->getId();

            $newpatient = $this->getCustomerById($id);
            
            
            $name = $newpatient->getName();
            $amount = $newpatient->getAmount();
            $date = $newpatient->getDate();
            $pay = $newpatient->getPay();

            $output .= "<tr>";
            $output .= $this->isPaid($amount) . $name . "</td>";
            $output .= "<td>" . $amount . "</td>";
            
            $output .= "<td>" . $date . "</td>";
            
            if ($pay === "True") {
                $output .= "<td><img class='activo' src='img/img05.gif'></td>";
            } else {
                $output .= "<td><img class='activo' src='img/.png'></td>";
            }

            $output .= "<td>" . "<a href='delete.php?id=". $id ."'><img src='img/borrar.png' width='25'></a></td>";
            $output .= "<td><a href='edit.php?id=" . $id . "'><img src='img/editar.png' width='25'></a></td>";        
            
            $output .= "</tr>";
        }

        $output .= "</table>";
        return $output;
    }

    public function getCustomerById($idpatient)
    {
        foreach ($this->patients as $patient) {

            if ($patient->getId() == $idpatient) {
                $patientwanted = $patient;
            }
        }

        return $patientwanted;
    }


    public function setClientes($patients, $num)
    {
        $this->clientes[$num] = $clientes;
    }

    function isPaid($amount) {
        if ($amount > 250) {
            return "<td class='paid'>";
        } else {
            return "<td class='nopaid'>";
        }
    }


    public function delete($id){
        $newPatients = [];
    
        foreach ($this->patients as $patient) {

            if ($patient->getId() !== $id) {
                $newPatients[] = $patient;
            }
        }
        
        $this->patients = $newPatients;

        $this->persist();
    }      
    
    
    
    public function persist(){
            
        $handle = fopen($this->file, 'w');
        
        foreach ($this->patients as $patient) {
                
            fputcsv($handle, [$patient->getId(), $patient->getName(), $patient->getAmount(), $patient->getDate(), $patient->getPay()]);
        }
        
        fclose($handle);
    }
}

?>
