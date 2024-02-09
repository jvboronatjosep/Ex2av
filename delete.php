<?php

require_once 'autoloader.php';

if(isset($_GET['id'])) { 
    $id = $_GET['id'];

    $patients = new Visit("datanew.csv");
    $patients->delete($id);

    header("location: index.php");
} else {
    $id = '';
}
?>
