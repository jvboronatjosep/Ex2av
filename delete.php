<?php

require_once 'autoloader.php';

if(isset($_GET['id'])) { 
    $id = $_GET['id'];

    $VisitManagement = new VisitManagement("datanew.csv");
    $VisitManagement->delete($id);

    header("location: index.php");
} else {
    $id = '';
}
?>
