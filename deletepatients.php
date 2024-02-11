<?php

require_once 'autoloader.php';

if(isset($_GET['id'])) { 
    $id = $_GET['id'];

    $PatientManagement = new PatientManagement("datapatients.csv");
    $PatientManagement->delete($id);

    header("location: indexp.php");
} else {
    $id = '';
}
?>