<?php

    require_once 'autoloader.php';
    $patients = "";
    $error = "";

    if ($_SERVER["REQUEST_METHOD"] ===  "GET") {
        
    }
    else {   
        
        if (($_POST['name'] === "")
        || ($_POST['address'] === ""))
        {
            $error = "";        }
        else
        {
             // Crear objeto cartera
            $PatientManagement = new PatientManagement("datapatient.csv");
            
            // Llamo a create para actualizar la lista
            $PatientManagement->new($_POST);  
            
            header("location: indexp.php");
            
            exit;
            }
    }
?>
<h3><?php echo $error?></h3>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="formm.css">
</head>
<body>
    
<nav>
        <a href="indexp.php">Return</a>
</nav>


<form action="" method="POST" name="Visits">
    <div>
        <label for="id">Id:</label>
        <input type="text" id="id" name="id" hidden>
    </div>
    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name">
    </div>
    <div>
        <label for="address">Address:</label>
        <input type="text" id="address" name="address">
    </div>
    <div>
        <input type="submit" value="Guardar">
    </div>
</form>
</body>
</html>

