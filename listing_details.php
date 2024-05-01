<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="listing_details.css">
        <title>Listing Details</title>
        <script src="https://kit.fontawesome.com/34c6296155.js" crossorigin="anonymous"></script>
    </head>

    <body>
        <header class="topnav">
            <a href="index.php" id="mainpage">SchoolYard Xchange</a>
            <div class="right-items">
            <a href="dashboard.php" id="dashlink"><i class="fa-solid fa-gauge"></i> Dashboard</a>
            <a href="faq.php" id="faqlink"><i class="fa-solid fa-circle-question"></i> FAQ</a>
                <?php
                session_start();
                if (isset($_SESSION['Email'])) {
                    $fname = $_SESSION['fname'];
                    echo "<a href='user.php' id='loginlink'><i class='fa-solid fa-user'></i> Account</a>";
                } else {
                    echo "<a href='login.html' id='loginlink'>Login</a>";
                }
                ?>
                
            </div>
        </header>

        <main class="center">
            <?php
            include 'dbconnect.php';
            if(isset($_GET['ListingID'])) {
                $listingID = mysqli_real_escape_string($conn, $_GET['ListingID']);
                // Adjusted SQL query to include the seller's email using the correct column name
                $sql = "SELECT Items.*, Images.img_dir, Users.email 
                        FROM Items 
                        INNER JOIN Images ON Items.imageid = Images.imageid
                        INNER JOIN Users ON Items.UserID = Users.userid
                        WHERE Items.ListingID = '$listingID'";

                $result = $conn->query($sql);
                if (!$result) {
                    die('SQL Error: ' . mysqli_error($conn));
                }

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo '<div class="listing-details">';
                    echo '<h2>' . $row['prod_name'] . '</h2>';
                    echo '<img class="listimg" src="' . $row["img_dir"] . '" /><br />';
                    echo '<p class="price">Price: $' . $row["price"] . '</p>';
                    echo '<p class="description">Description: ' . $row["Description"] . '</p>';
                    echo '<p class="condition">Condition: ' . $row["Condition"] . '</p>';
                    echo '<p class="category">Category: ' . $row["Category"] . '</p>';
                    echo '<p class="deliverypref">Delivery Preference: ' . $row["DeliveryPreferences"] . '</p>';
                    echo '<p class="location">Location: ' . $row["Location"] . '</p>';
                    echo '<p class="soldstatus">Status: ' . $row["SoldStatus"] . '</p>';
                     echo '<p class="email">Seller Email: ' . $row["email"] . ' <a href="mailto:' . $row["email"] . '" class="email-button">Contact Seller</a></p>';
    echo '</div>';
} else {
    echo "No listing found with the provided ListingID.";
}
                $conn->close();
            } else {
                echo "No ListingID provided.";
            }
            ?>
        </main>
    </body>
</html>
