<?php 
    $connect = mysqli_connect("localhost", "root", "mysql", "store_loctv");

    if (!$connect) {
        die ("Could not connect to the database: " .mysqli_connect_error());
    }
?>