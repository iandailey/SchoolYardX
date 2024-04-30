<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="create-listing.css">
        <title>Create Listing</title>
    </head>

    <body>
    <header class="topnav">
    <a href="index.php" id="mainpage">SchoolYard Exchange</a>
    <input type="text" placeholder="Search the SchoolYard" id="searchbar" />
    <div class="right-items">
    <?php
    session_start();

    // Check if user is logged in
    if (isset($_SESSION['Email'])) {
      $fname = $_SESSION['fname'];
      echo "<a href='user.php' id='loginlink'>$fname's Account</a>";

    } else {
      // Show login
      echo "<a href='login.html' id='loginlink'>Login</a>";
    }

    error_reporting(E_ALL);
    ini_set('display_errors', 1);


    ?>


    <a href="dashboard.php" id="dashlink">Dashboard</a>
    </div>
  </header>


        <main class="center">
            
            
            <?php

            if(isset($_GET['ListingID'])) {

                include 'dbconnect.php';

                $listingID = mysqli_real_escape_string($conn, $_GET['ListingID']);
                // SQL query to fetch data from the database
                $sql = "SELECT Items.*, Images.img_dir 
                        FROM Items 
                        INNER JOIN Images ON Items.imageid = Images.imageid
                        WHERE Items.ListingID = '$listingID'";
    
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of the row
                    $row = $result->fetch_assoc();
                    
                    // Display the details of the listing
                    echo '<h2>' . $row['prod_name'] . '</h2>';
                    echo '<div class="listing-details">';
                    echo '<img class="listimg" src="' . $row["img_dir"] . '" /> <br />';
                    echo '<h2 class="name">' . $row["prod_name"] . '</h2>';
                    echo '<p class="price">Price: $' . $row["price"] . '</p>'; 
                    echo '<p class="description">Description: ' . $row["Description"] . '</p>'; 
                    echo '<p class="condition">Condition: ' . $row["Condition"] . '</p>'; 
                    echo '<p class="category">Category: ' . $row["Category"] . '</p>';
                    echo '<p class="deliverypref">Delivery Preference: ' . $row["DeliveryPreferences"] . '</p>'; 
                    echo '<p class="location">Lication: ' . $row["Location"] . '</p>'; 
                    echo '<p class="soldstatus">Status: ' . $row["SoldStatus"] . '</p>';  
                    // Display other details as needed
                    echo '</div>';
                } else {
                    echo "No listing found with the provided ListingID.";
                }

            } else {
                echo "No ListingID provided.";
            }

                $conn->close();

        

                ?>
           
        </main>
    </body>
</html>
