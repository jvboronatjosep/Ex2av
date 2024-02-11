<?php

class PatientManagement{
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
                new Patient(...$element) //Spread Operator
            );
        }

        fclose($manager);
    }



    function drawList(){
        $output = "";        
        
        foreach ($this->patients as $patient) {

            $id = $patient->getId();

            $newpatient = $this->getpatientById($id);
            
            $name = $newpatient->getName();
            $address = $newpatient->getAddress();

            $output .= "<tr class='text-center'>";
            $output .= "<td>" . $id . "</td>";
            $output .= "<td>" . $name . "</td>";
            $output .= "<td>" . $address . "</td>";
            

            $output .= "<td>" . "<a href='deletepatients.php?id=". $id ."'><img src='img/borrar.png' width='25'></a></td>";
            $output .= "<td><a href='edit.php?id=" . $id . "'><img src='img/editar.png' width='25'></a></td>";        
            
            $output .= "</tr>";
        }

        $output .= "</table>";
        return $output;
    }

    public function getpatientById($idpatient)
    {
        foreach ($this->patients as $patient) {

            if ($patient->getId() == $idpatient) {
                $patientwanted = $patient;
            }
        }

        return $patientwanted;
    }



    public function delete($id){
        $newpatients = [];
    
        foreach ($this->patients as $patient) {

            if ($patient->getId() !== $id) {
                $newpatients[] = $patient;
            }
        }
        
        $this->patients = $newpatients;

        $this->persist();
    }      
    
/*
    
    function update($Updateddata) {   
        // Obtener el cliente con $id
        $visit = $this->getvisitById($Updateddata['id']);
        
        $NameNew = $Updateddata['name'];
        $AmountNew = $Updateddata['amount'];
        $DateNew = $Updateddata['date'];
        
        if (isset($Updateddata['pay']))
        {
            $PayNew = "True";
        }
        else
        {
            $PayNew = "False";
        }          

        // Actualizar el cliente con datosActualizados            
        $visit->setName($NameNew);
        $visit->setAmount($AmountNew);
        $visit->setDate($DateNew);
        $visit->setPay($PayNew);

        // Llamar a persist
        $this->persist();
    }
    

    function new($Newvisitdata) {

        $allowedcharacters = '0123456789';
        
        $id = strtoupper(substr(str_shuffle($allowedcharacters), 0, 100000000));
                    
        $nameNew = $Newvisitdata['name'];
        $amountNew = $Newvisitdata['amount'];
        $dateNew = $Newvisitdata['date'];
        
        if (isset($Newvisitdata['pay']))
        {
            $payNew = "True";
        }
        else
        {
            $payNew = "False";
        }
            
        
        $visit = new Visit($id, $nameNew, $amountNew, $dateNew, $payNew );

        $this->visits[] = $visit;

        // Llamar a persist
        $this->persist();
    }
*/
    
        public function persist(){
            
        $handle = fopen($this->file, 'w');
        
        foreach ($this->patients as $patient) {
                
            fputcsv($handle, [$patient->getId(), $patient->getName(), $patient->getAddress()]);
        }
        
        fclose($handle);
    }


}
?>