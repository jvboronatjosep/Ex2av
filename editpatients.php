<?php

    require_once 'autoloader.php';

    if ($_SERVER["REQUEST_METHOD"] ===  "GET") {

        // Obtener id de la URL
        if(isset($_GET['id'])) { 
            $id = $_GET['id'];

        // Crear objeto cartera
        $PatientManagement = new PatientManagement("datapatients.csv");

        // Obtener datos del cliente con id pasado(*)
        $patient = $PatientManagement->getPatientById($id);     
        }
    }
    else {        

       // Cuando cargo este arhivo con un método POST
        $UpdatedPatientdata = $_POST;

        // Crear objeto cartera
        $PatientManagement = new PatientManagement("datapatients.csv");
        
        // Llamo a update para actualizar la lista
        $PatientManagement->update($UpdatedPatientdata);  
        
        header("location: indexp.php");
        
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    

<form action="" method="POST" name="Visit">
    <div>
        <label for="id">Id: <?php echo $patient->getId() ?></label>
        <input type="text" id="id" name="id" hidden value="<?php echo $patient->getId() ?>">
    </div>
    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $patient->getName() ?>">
    </div>
    <div>
        <label for="Address">Address:</label>
        <input type="text" id="address" name="address" value="<?php echo $patient->getAddress() ?>">
    </div>
    <div>
        <input type="submit" value="Guardar">
    </div>
</form>
</body>
</html>

