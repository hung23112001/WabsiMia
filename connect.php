<?php
    $conn = new mysqli('localhost','root','','db_wabsi_mia');
    if($conn->connect_error){
        die('Error connect database');
    }
?>