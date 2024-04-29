<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>SchoolYard Exchange</title>
    <link rel="stylesheet" href="home-layout.css">
</head>

<body>
    <header class="topnav">
        <div class="left-items">
            <a href="index.php" id="mainpage">SchoolYard Exchange</a>
            <a id="dashtitle">USERNAME's Dashboard</a>
        </div>
        <div class="right-items">

            <?php
            session_start();

            // Check if user is logged in
            if (isset($_SESSION['Email'])) {
                $fname = $_SESSION['fname'];
                echo "<a href='user.php' id='loginlink'>$fname's Account</a>";

            } else {
                // force login
                header('login.html');
                echo "<a href='login.html' id='loginlink'>Login</a>";
            }

            error_reporting(E_ALL);
            ini_set('display_errors', 1);


            ?>
            <a href="favorites.html" id="favlink">Favorites</a>
            <a href="dashboard.php" id="dashlink">Dashboard</a>
        </div>
    </header>


    <nav class="sidenav">
        <button>Create new Listing</button>
        <br>
        <hr>
        <strong><u>Sort By:</u></strong>
        <select name="sort" id="sort">
            <option value="recent">Most Recent</option>
            <option value="top">Highest Rated</option>
            <option value="old">Oldest</option>
        </select>
        <br>
        <hr>
        <input type="checkbox" name="oncampus" id="oncampcheck">
        <label for="oncampcheck">On-Campus</label> <br> <br>
        <input type="checkbox" name="offcampus" id="offcampcheck">
        <label for="offcampcheck">Off-Campus</label>
        <br>
        <hr>
        <br>
        <input type="checkbox" name="books" id="bookcheck" checked>
        <label for="bookcheck">Books</label> <br> <br>
        <input type="checkbox" name="furniture" id="furncheck" checked>
        <label for="furncheck">Furniture</label> <br> <br>
        <input type="checkbox" name="home" id="homecheck" checked>
        <label for="homecheck">Home</label> <br> <br>
        <input type="checkbox" name="electronics" id="elecheck" checked>
        <label for="elecheck">Electronics</label> <br> <br>
        <input type="checkbox" name="clothes" id="clothescheck" checked>
        <label for="clothescheck">Clothes</label> <br> <br>
        <input type="checkbox" name="jewel" id="jewelcheck" checked>
        <label for="jewelcheck">Jewelry / Accessories</label> <br> <br>
        <input type="checkbox" name="misc" id="misccheck" checked>
        <label for="misccheck">Miscellaneous</label> <br> <br>
        <button type="button" id="select">select all</button>
        <button type="button" id="deselect">deselect all</button>
    </nav>

    <main>

        <!-- item template -->
        <div class="container">
            <?php
            include 'dbconnect.php';
            if (isset($_SESSION['userid'])) {
                $userid = $_SESSION['userid'];
            }

            $sql = 'SELECT * from Items where userID = $userid';
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // Output data of each row  
                echo '<table>';
                echo '<tr>';
                $count = 0;
                while ($row = $result->fetch_assoc()) {
                    echo '<td>';
                    $listid = "listing" . $row['ListingID'];
                    echo '<div class="listing" id="' . $listid . '">';
                    // echo '<img class="listimg" src="' . $row["image_url"] . '" /> <br />';
                    echo '<h2 class="name">' . $row["prod_name"] . '</h2>';
                    echo '<h3 class="category">' . $row["Category"] . '</h3>';
                    echo '<p class="delivery">' . $row["DeliveryPreferences"] . '</p>';
                    echo '<p class="location">' . $row["Location"] . '</p>';
                    echo '<p class="soldstatus">' . $row["SoldStatus"] . '</p>';
                    echo '</div>';
                    echo '</td>';

                    $count++;
                    if ($count % 3 == 0) {
                        echo '</tr><tr>';
                    }
                }
                echo '</tr>';
                echo '</table>';
            } else {
                echo "0 results";
            }

            $conn->close();
            ?>


        </div>
    </main>
</body>

</html>