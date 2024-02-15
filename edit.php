<?php

    require_once 'autoloader.php';

    if ($_SERVER["REQUEST_METHOD"] ===  "GET") {

        // Obtener id de la URL
        if(isset($_GET['id'])) { 
            $id = $_GET['id'];

        // Crear objeto cartera
        $VisitManagement = new VisitManagement("datanew.csv");

        // Obtener datos del cliente con id pasado(*)
        $visit = $VisitManagement->getVisitById($id);     
        }
    }
    else {        

       // Cuando cargo este arhivo con un método POST
        $UpdatedVisitdata = $_POST;

        // Crear objeto cartera
        $VisitManagement = new VisitManagement("datanew.csv");
        
        // Llamo a update para actualizar la lista
        $VisitManagement->update($UpdatedVisitdata);  
        
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
    <link rel="stylesheet" href="formm.css">
</head>
<body>
    

<nav>
        <a href="index.php">Return</a>
</nav>

<form action="" method="POST" name="Visit">
    <div>
        <label for="id">Id: <?php echo $visit->getId() ?></label>
        <input type="text" id="id" name="id" hidden value="<?php echo $visit->getId() ?>">
    </div>
    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $visit->getName() ?>">
    </div>
    <div>
        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" value="<?php echo $visit->getAmount() ?>">
    </div>
    <div>
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" value="<?php echo $visit->getDate() ?>">
    </div>
    <div>
        <label for="pay">Pay:</label>
        <input type="checkbox" id="pay" name="pay" <?php echo ($visit->getPay() === "True" ? 'checked' : ''); ?>>
    </div>
    <div>
        <input type="submit" value="Guardar">
    </div>
</form>
</body>
</html>
