<?php

    require_once 'autoloader.php';
    $visits = "";
    $error = "";

    if ($_SERVER["REQUEST_METHOD"] ===  "GET") {
        
    }
    else {   
        
        if (($_POST['name'] === "")
        || ($_POST['amount'] === "")
        || ($_POST['date'] === ""))
        {
            $error = "";        }
        else
        {
             // Crear objeto cartera
            $VisitManagement = new VisitManagement("datanew.csv");
            
            // Llamo a create para actualizar la lista
            $VisitManagement->new($_POST);  
            
            header("location: index.php");
            
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
        <a href="index.php">Return</a>
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
        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount">
    </div>
    <div>
        <label for="date">Date:</label>
        <input type="date" id="date" name="date">
    </div>
    <div>
        <label for="pay">Pay:</label>
        <input type="checkbox" id="pay" name="pay">
    </div>
    <div>
        <input type="submit" value="Guardar">
    </div>
</form>
</body>
</html>
