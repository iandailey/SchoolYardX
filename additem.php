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

// Prepare SQL statement
$sql = "INSERT INTO Items (UserID, prod_name, `Condition`, Category, CategoryID, DeliveryPreferences, Location, SoldStatus)
VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

// Prepare and bind parameters
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssss", $userid, $prod_name, $condition, $category, $categoryid, $delivery, $location, $sold);

// Set parameters and execute
$userid = $_POST['UserID'];
$prod_name = $_POST['prod_name'];
$condition = $_POST['condition'];
$category = $_POST['category'];
$categoryid = $_POST['CategoryID'];
$delivery = $_POST['delivery'];
$location = $_POST['location'];
$sold = $_POST['sold'];

if ($stmt->execute()) {
    echo "New record created successfully";
    echo "<br>";
    echo "<a href='http://schoolyardx.com/additem.html'>Click Here</a> To add a another item";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
