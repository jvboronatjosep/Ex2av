<?php

    require_once 'autoloader.php';

    if ($_SERVER["REQUEST_METHOD"] ===  "GET") {

        // Obtener id de la URL
        if(isset($_GET['id'])) { 
            $id = $_GET['id'];

        // Crear objeto cartera
        $visit = new Visit("datanew.csv");

        // Obtener datos del cliente con id pasado(*)
        $patient = $visit->getPatientById($id);     
        }
    }
    else {        

       // Cuando cargo este arhivo con un método POST
        $UpdatedPatientsdata = $_POST;

        // Crear objeto cartera
        $visit = new Visit("datanew.csv");
        
        // Llamo a update para actualizar la lista
        $visit->update($UpdatedPatientsdata);  
        
        header("location: index.php");
        
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
    
</body>
</html>
<form action="" method="POST" name="Patients">
    <div>
        <label for="id">Id:</label>
        <input type="text" id="id" name="id" hidden value="<?php echo $patient->getId() ?>">
    </div>
    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $patient->getName() ?>">
    </div>
    <div>
        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" value="<?php echo $patient->getAmount() ?>">
    </div>
    <div>
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" value="<?php echo $patient->getDate() ?>">
    </div>
    <div>
        <label for="pay">Pay:</label>
        <input type="checkbox" id="pay" name="pay" <?php echo ($patient->getPay() === "True" ? 'checked' : ''); ?>>
    </div>
    <div>
        <input type="submit" value="Guardar">
    </div>
</form>
