<?php
require_once "autoloader.php";
?>


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
    <style></style>
</head>



<body>
    <form action="new.php" method="GET">
        <input type="submit" value="Crear Nuevo cliente">
    </form>
    
    <table class="redTable">
        <thead>
            <tr>
                <th>Id</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Pay</th>
                <th colspan="2" >Action</th>
            </tr>
        </thead>

        <?php   
                if (!isset($ObjetoCartera)) {
                    $ObjetoCartera = new Visit("data.csv");
                    
                }
                
                echo $ObjetoCartera->drawList();
        ?>

        <tfoot>
            <tr>
                <td colspan="7"></td>
            </tr>
        </tfoot>
        <tbody>
        </tbody>
    </table>

</body>

</html>