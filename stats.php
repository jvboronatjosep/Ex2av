<?php
require_once "autoloader.php";
?>


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="statstyle.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>



<body>
<div class="container">

    <nav>
        <a href="frontpage.php">Start</a>
        <a href="index.php">Visits</a>
        <a href="indexp.php">Patinets</a>
    </nav>

    <table class="table table-success table-striped-columns table-hover">
    <tr>
        <tr>
            <td>Total € in invoices</td>
            <td>
                <?php 
                $visits = new VisitManagement("datanew.csv");
                echo $visits->imovoiceamount();
                ?>
        
            </td>
        </tr>


        <tr>
            <td>Total € of visits charged</td>
            <td>
                <?php
                $visits = new VisitManagement("datanew.csv");
                $total_paid_nopaid = $visits->total_paid_nopaid();

                echo $total_paid_nopaid[0];
                ?>
            
            </td>
        </tr>
        <tr>
            <td>Total € of unpaid visits</td>
            <td>
                <?php
                $visits = new VisitManagement("datanew.csv");
                $total_paid_nopaid = $visits->total_paid_nopaid();

                echo $total_paid_nopaid[1];
                ?>
            
            </td>
        </tr>


        <tr>
            <td>Total balance</td>
            <td>
                <?php 
                $visits = new VisitManagement("datanew.csv");
                echo $visits->balance();
                ?>
        
            </td>
        </tr>


        <tr>
            <td>Number of visits charged</td>
            <td>
                <?php
                $visits = new VisitManagement("datanew.csv");
                $visits_paid_nopaid = $visits->visits_paid_nopaid();

                echo $visits_paid_nopaid[0];
                ?>
            
            </td>
        </tr>


        <tr>
            <td>Number of visits not charged</td>
            <td>
                <?php
                $visits = new VisitManagement("datanew.csv");
                $visits_paid_nopaid = $visits->visits_paid_nopaid();

                echo $visits_paid_nopaid[1];
                ?>
            
            </td>
        </tr>
        

        <tr>
            <td>Total € in invoices</td>
            <td>
                <?php 
                $patients = new PatientManagement("datapatient.csv");
                echo $patients->total_patients();
                
                ?>
            </td>
        </tr>


        <tr>
            <td>Total patients with all paid visits</td>
            <td>
                <?php 
                $patients = new PatientManagement("datapatient.csv");
                $number = $patients->unpaid_paid_visits();

                echo $number[0];
                ?>
        
            </td>
        </tr>

        <tr>
            <td>Total patients with some unpaid visits</td>
            <td>
                <?php 
                $patients = new PatientManagement("datapatient.csv");
                $number = $patients->unpaid_paid_visits();

                echo $number[1];
                ?>
        
            </td>
        </tr>

    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </div>
</body>

</html>