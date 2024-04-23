<?php
error_reporting(E_ALL);
      ini_set('display_errors', 1);
    $hostname = "schoolyardx.com"; 
    $username = "Databaseadmin";
    $password = "Ge0rg3Wa\$hingt0n";
    $dbname = "SchoolYard_Exchange_GWU";

    // Create connection
    $conn = new mysqli($hostname, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>
