<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['userid'])) {
    $id = $_POST['id'];

    include 'dbconnect.php';

    $sql = "DELETE FROM Items WHERE ListingID = ?";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        echo "Error preparing statement: " . $conn->error;
        exit;
    }

    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        // Optionally, you might want to redirect back to the user page or wherever you list the items
        header("Location: user.php");
     //   echo "Item deleted successfully";

    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    http_response_code(403); // Forbidden if not POST or no session
    echo "Unauthorized access.";
}
?>
