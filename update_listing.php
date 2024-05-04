<?php
session_start();

if (!isset($_SESSION['userid'])) {
    header('Location: login.html');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'dbconnect.php';
    
    $listingID = $_POST['ListingID'] ?? null;
    $item_name = $_POST['item_name'] ?? '';
    $price = $_POST['price'] ?? '';
    $description = $_POST['description'] ?? '';
    $category = $_POST['category'] ?? '';
    $condition = $_POST['condition'] ?? '';

    if (!$listingID) {
        echo "No item specified.";
        exit();
    }

    $update_sql = "UPDATE Items SET prod_name=?, Price=?, Description=?, Category=?, `Condition`=? WHERE ListingID=?";
    $update_stmt = $conn->prepare($update_sql);
    if ($update_stmt === false) {
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
        exit;
    }
    
    $update_stmt->bind_param("sssssi", $item_name, $price, $description, $category, $condition, $listingID);
    $update_stmt->execute();

    if ($update_stmt->affected_rows > 0) {
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Error updating item or no changes made: " . $update_stmt->error;
    }
} else {
    echo "Invalid request.";
}
?>
