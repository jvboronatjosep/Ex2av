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
            $output .= "<td>" . $name . "</td>";
            $output .= "<td>" . $address . "</td>";
        
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
    

    
    function update($Updateddata) {   
        // Obtener el cliente con $id
        $patient = $this->getvisitById($Updateddata['id']);
        
        $NameNew = $Updateddata['name'];
        $AddressNew = $Updateddata['address'];         

        // Actualizar el cliente con datosActualizados            
        $patient->setName($NameNew);
        $patient->setAddress($AddressNew);

        // Llamar a persist
        $this->persist();
    }
    

    function new($Newpatientdata) {

        $allowedcharacters = '0123456789';
        
        $id = strtoupper(substr(str_shuffle($allowedcharacters), 0, 100000000));
                    
        $nameNew = $Newvisitdata['name'];
        $addressNew = $Newvisitdata['address'];
            
        
        $patient = new Patient($id, $nameNew, $addressNew);

        $this->patients[] = $patient;

        // Llamar a persist
        $this->persist();
    }
    
    public function persist(){
            
        $handle = fopen($this->file, 'w');
        
        foreach ($this->patients as $patient) {
                
            fputcsv($handle, [$patient->getId(), $patient->getName(), $patient->getAddres()]);
        }
        
        fclose($handle);
    }
}

?>
