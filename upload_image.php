<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include "dbconnect.php";

// $uploadFile = $_FILES['img'];

$ogfilename = $uploadFile['name'];

$uploadDirectory = "/home/gl28dfz15a64/public_html/images/itemimages/";

$hash = md5(uniqid());

$fileExtension = pathinfo($ogfilename, PATHINFO_EXTENSION);

$newfilename = $hash . '.' . $fileExtension;

if (move_uploaded_file($uploadFile['tmp_name'], $uploadDirectory . $newfilename)) {

    $img_dir = $uploadDirectory . $newfilename;
    // Adding new name into the database along with the path
    $sql = "INSERT INTO Images (name, img_dir) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $ogfilename, $img_dir);

    if ($stmt->execute()) {
        echo "Image uploaded!";
    } else {
        echo "Error inserting: " . $conn->error;
    }
} else {
    echo "Error uploading image";
}

// $conn->close();

?>
