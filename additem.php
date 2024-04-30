<?php
session_start();
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

// Check if 'img' file input field is set in $_FILES
if(isset($_FILES['img'])) {
    $uploadFile = $_FILES['img'];
    echo "Image uploaded";
} else {
    echo "No file uploaded"; 
}

include "upload_image.php";


// Prepare SQL statement
$sql = "INSERT INTO Items (UserID, imageid, prod_name, price, `Condition`, Category, CategoryID, DeliveryPreferences, Location, SoldStatus)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Prepare and bind parameters
$stmt = $conn->prepare($sql);
$stmt->bind_param("sisissssss", $userid, $imageid, $prod_name, $price, $condition, $category, $categoryid, $delivery, $location, $sold);

//making array for catids for input
$catids = array(
    "Books" => 1,
    "Furniture" => 2,
    "Home" => 3,
    "Electronics" => 4,
    "Clothes" => 5,
    "Jewelry / Accessories" => 6,
    "Miscellaneous" => 7
);

// Setting the variables



$userid = $_SESSION['userid'];
// $uploadFile = $_FILES['img'];
$prod_name = $_POST['item_name'];
$price = $_POST["price"];
$condition = $_POST['condition'];
$category = $_POST['category'];
$categoryid = null;
$delivery = $_POST['delivery'];
$location = $_POST['location'];
$sold = $_POST['sold'];

foreach($catids as $key => $value) {
    if($category == $key) {
        $categoryid = $value;
        break;
    }
}


if ($stmt->execute()) {

    //gets the listing ID from the created row
    // $listingID = mysqli_insert_id($conn);
    // create_listing_page($listingID);


        echo "New record created successfully";
        echo "<br>";
        echo "<a href='http://schoolyardx.com/createitem.php'>Click Here</a> To add a another item";
    } else {
        echo "error inserting: " . $conn->error;
    }

$stmt->close();
$conn->close();

// function create_listing_page($listingID) {

//     //creates the file of page
//     $file = "listing_" . $listingID . ".php";

//     //adds the universal content for the page
    // $content = "<?php include 'listing_details.php'; 

//     //puts the two together
//     file_put_contents($file, $content);
// } -->

?>
