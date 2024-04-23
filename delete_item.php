<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST['id'];

    include 'dbconnect.php';

    $sql = "DELETE FROM Items WHERE ListingID = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i", $id);

    $stmt->execute();
    $stmt->close();
    $conn->close();
    echo "Item deleted successfully";
} else {
    http_response_code(405);
}



?>
