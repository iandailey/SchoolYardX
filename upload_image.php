<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include "dbconnect.php";

$uploadDirectory = "/images/itemimages";

$uploadFile = $_FILES['img'];

$ogfilename = $uploadFile['name'];

$hash = md5(uniqid());

$fileExtension = pathinfo($ogfilename, PATHINFO_EXTENSION);

$newfilename = $hash . '.' . $fileExtension;

if (move_uploaded_file($uploadFile['tmp_name'], $uploadDirectory . $newfilename)) {

    //adding new name into the database along with the path
    $sql = "insert into Images (name, img_dir) values (?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $ogfilename, $uploadDirectory . $newfilename);

    if ($stmt->execute()) {
        echo "Image uploaded!";
    } else {
        echo "Error inserting: " . $conn->error;
    }
} else {
    echo "Error uploading image";
}

$conn->close();

?>
