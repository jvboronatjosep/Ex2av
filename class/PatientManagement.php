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
            $output .= "<td><a href='editpatients.php?id=" . $id . "'><img src='img/editar.png' width='25'></a></td>";
            $output .= "<td><a href='newpatients.php?id=" . $id . "'><img src='img/new.png' width='25'></a></td>";   
            $output .= "<td><a href='search.php?name=" . $name . "'><img src='img/buscar.png' width='25'></a></td>";        
            
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
    
    public function getVisitsByPatientName($patientName) {
        $foundVisits = [];
        $visitManagement = new VisitManagement("datanew.csv"); // Supongo que tienes una clase VisitManagement
        
        foreach ($visitManagement->getVisits() as $visit) {
            if ($visit->getPatientName() === $patientName) {
                $foundVisits[] = $visit;
            }
        }
        
        return $foundVisits;
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
        $patient = $this->getpatientById($Updateddata['id']);
        
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
                    
        $nameNew = $Newpatientdata['name'];
        $addressNew = $Newpatientdata['address'];
            
        
        $patient = new Patient($id, $nameNew, $addressNew);

        $this->patients[] = $patient;

        // Llamar a persist
        $this->persist();
    }

    

    function isPaid($amount) {
        if ($amount > 250) {
            return "<td class='paid'>";
        } else {
            return "<td class='nopaid'>";
        }
    }

    
    public function search($namePacientToSearch){
        $VisitsManagement = new VisitManagement("datanew.csv");

        $visits = $VisitsManagement->GetList();


        $output = "";  

        foreach ($visits as $visit) {
            
            $name = $visit->getName();            
            
            if ($namePacientToSearch === $name) {

                $id = $visit->getId();
                $amount = $visit->getAmount();
                $date = $visit->getDate();
                $pay = $visit->getPay();
    
                $output .= "<tr class='text-center'>";
                $output .= "<td>" . $id . "</td>";
                $output .= "<td>" . $name . "</td>";
                $output .= $this->isPaid($amount) . $amount . "</td>";
                $output .= "<td>" . $date . "</td>";
                
                if ($pay === "True") {
                    $output .= "<td><img class='pay' src='img/pagado.png'></td>";
                } else {
                    $output .= "<td><img class='pay' src='img/nopagado.png'></td>";
                }
                
    
                $output .= "<td>" . "<a href='deletepatients.php?id=". $name ."'><img src='img/borrar.png' width='25'></a></td>";
                $output .= "<td><a href='editpatients.php?id=" . $name . "'><img src='img/editar.png' width='25'></a></td>";
                $output .= "<td><a href='newpatients.php?id=" . $name . "'><img src='img/new.png' width='25'></a></td>";   
                
                $output .= "</tr>";

                
                
            }
    
            

            }

            return $output;

    }


    public function persist(){
            
    $handle = fopen($this->file, 'w');
        
    foreach ($this->patients as $patient) {
                
        fputcsv($handle, [$patient->getId(), $patient->getName(), $patient->getAddress()]);
        }
        
    fclose($handle);
    }

    public function total_patients() {
        $uniqueNames = [];
        $repeated = [];
    
        foreach ($this->patients as $patient) {
            if (!isset($uniqueNames[$patient->getName()])) {
                // Agregar el nombre al array de nombres únicos
                $uniqueNames[$patient->getName()] = true;
            } else {
                // El nombre ya existe, agregarlo al array de repetidos
                $repeated[] = $patient->getName();
            }
        }
    
        return count($uniqueNames);
    }

    public function unpaid_paid_visits(){
        $paid = [];
        $no_paid = [];
        $VisitsManagement = new VisitManagement("datanew.csv");

        $visits = $VisitsManagement->GetList();

        foreach ($this->patients as $patient){
            
            $todas_visitas_pagadas = true;

            foreach ($visits as $visit){

                if($visit->GetName() == $patient->getName()){
                    
                    if ($visit->getPay() == "False"){
                        $todas_visitas_pagadas = false;
                    }
                }
            }

            if ($todas_visitas_pagadas ===true)
            {
                if (!(in_array($patient->getName(), $paid))){
                    $paid[] = $patient->getName();
                }
            }
            else {
                if (!(in_array($patient->getName(), $no_paid))){
                    $no_paid[] = $patient->getName();
                }   
            }

        }
        $npaid = count($no_paid);
        $n_no_paid = count($paid);

        return array($npaid, $n_no_paid);
    }



    
    
    

}
?>