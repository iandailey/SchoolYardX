<!DOCTYPE html>
<html lang="en">
    <body>
<?php



$hostname = "schoolyardx.com"; 
$username = "Databaseadmin";
$password = "Ge0rg3Wa\$hingt0n";
$dbname = "SchoolYard_Exchange_GWU";

$con = mysqli_connect($hostname, $username,$password,$dbname);




if (mysqli_connect_errno()) {
    echo "Failed to connect" . mysqli_connect_error();
}
// echo "<p>" . $_SERVER['REQUEST_METHOD'] . "</p>";

if (mysqli_ping($con) && $_SERVER['REQUEST_METHOD'] =='POST') {
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $pass = mysqli_real_escape_string($con, $_POST["pass"]);


    $sql = "select count(*) from Users where Email = '$email' and Password = '$pass'";
    $result = $con->query($sql);
    

    if ($result->num_rows > 0) {

        session_start();
        $sql_name = "SELECT * FROM Users WHERE Email = '$email' AND Password = '$pass'";
        $result_name = $con->query($sql_name);

        $row = $result_name->fetch_assoc();
        var_dump($row);
        $_SESSION['Email'] = $email; // Store username in session
        $_SESSION['fname'] = $row['FirstName'];
        $_SESSION['userid'] = $row['UserID'];
        header("Location: home.php");
        exit();
    }
    else {
        echo "<p>Username or password incorrect.</p>";
        echo "<p><a href='login.html'>Click here to return to login page</a></p>";
    }
}

$conn->close();
    






?>
</body>
</html>
