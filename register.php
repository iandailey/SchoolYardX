<!DOCTYPE html>
<html>

<body>
<?php



// making the database
$hostname = "schoolyardx.com"; 
$username = "Databaseadmin";
$password = "Ge0rg3Wa\$hingt0n";
$dbname = "SchoolYard_Exchange_GWU";

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Create a connection
$con = new mysqli($hostname, $username, $password, $dbname);


// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} else {
    echo "Connected successfully <br>";
}



// checking if it is a post and there is a connection
if(mysqli_ping($con) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pass1 = $_POST['pass1'];

    // Prepared statement to prevent SQL injection
    $sql = "INSERT INTO Users (FirstName, LastName, Email, Password) VALUES (?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssss", $fname, $lname, $email, $pass1);    

    if($stmt->execute()) {
        header("Location: home.php");
        echo "Congratulations $fname $lname! You are registered with SchoolYard. <br>";
        echo "Back to Home Page: <a href='index.php'>Home</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
    
    // Close statement
    $stmt->close();
}

// Close the database connection
$con->close();
?>

</body>
</html>
