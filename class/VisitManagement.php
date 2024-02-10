<?php

class VisitManagement{
    protected array $visits = [];
    private $file;

    public function __construct($file){
        
        $this->file=$file;
        $this->loadData();
    }



    public function loadData(){
        
        $manager = fopen($this->file, "r");

        while (($element = fgetcsv($manager)) !== false) {


            array_push(
                $this->visits,
                new Visit(...$element) //Spread Operator
            );
        }

        fclose($manager);
    }



    function drawList(){
        $output = "";        
        
        foreach ($this->visits as $visit) {

            $id = $visit->getId();

            $newvisit = $this->getvisitById($id);
            
            
            $name = $newvisit->getName();
            $amount = $newvisit->getAmount();
            $date = $newvisit->getDate();
            $pay = $newvisit->getPay();

            $output .= "<tr class='text-center'>";
            $output .= $this->isPaid($amount) . $name . "</td>";
            $output .= "<td>" . $amount . '&#8364' . "</td>";
            $output .= "<td>" . $date . "</td>";
            
            if ($pay === "True") {
                $output .= "<td><img class='pay' src='img/pagado.png'></td>";
            } else {
                $output .= "<td><img class='pay' src='img/nopagado.png'></td>";
            }

            $output .= "<td>" . "<a href='delete.php?id=". $id ."'><img src='img/borrar.png' width='25'></a></td>";
            $output .= "<td><a href='edit.php?id=" . $id . "'><img src='img/editar.png' width='25'></a></td>";        
            
            $output .= "</tr>";
        }

        $output .= "</table>";
        return $output;
    }

    public function getvisitById($idvisit)
    {
        foreach ($this->visits as $visit) {

            if ($visit->getId() == $idvisit) {
                $visitwanted = $visit;
            }
        }

        return $visitwanted;
    }


    function isPaid($amount) {
        if ($amount > 250) {
            return "<td class='paid'>";
        } else {
            return "<td class='nopaid'>";
        }
    }


    public function delete($id){
        $newvisits = [];
    
        foreach ($this->visits as $visit) {

            if ($visit->getId() !== $id) {
                $newvisits[] = $visit;
            }
        }
        
        $this->visits = $newvisits;

        $this->persist();
    }      
    

    
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
    
    public function persist(){
            
        $handle = fopen($this->file, 'w');
        
        foreach ($this->visits as $visit) {
                
            fputcsv($handle, [$visit->getId(), $visit->getName(), $visit->getAmount(), $visit->getDate(), $visit->getPay()]);
        }
        
        fclose($handle);
    }
}

?>
