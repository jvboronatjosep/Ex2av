<?php
require_once "autoloader.php";
?>


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ex</title>
    <style></style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="stylee.css">

</head>



<body>
<div class="container">


    <nav>
        <a href="frontpage.php">Front Page</a>
        <a href="indexp.php">Patients</a>
        <a href="stats.php">Stats</a>
    </nav>


    
    <table class="table table-success table-striped-columns table-hover">
        <thead>
            <tr class='text-center'>
                <th>Name</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Pay</th>
                <th colspan="4" >Action</th>
            </tr>
        </thead>

        <?php   
                if (!isset($VisitManagement)) {
                    $VisitManagement = new VisitManagement("datanew.csv");
                    
                }
                
                echo $VisitManagement->drawList();
        ?>

        <tfoot>
            <tr>
                <td colspan="7"></td>
            </tr>
        </tfoot>
        <tbody>
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </div>
</body>

</html>