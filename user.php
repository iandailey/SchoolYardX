<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>SchoolYard Exchange</title>
    <link rel="stylesheet" href="home-layout.css">

  </head>
  <body>
  <header class="topnav">
    
    <a href="home.html" id="mainpage">SchoolYard Exchange</a>
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

    <a href="favorites.html" id="favlink">Favorites</a>
    <a href="dashboard.html" id="dashlink">Dashboard</a>
    </div>
  </header>

    <main>
      <?php
  
      if(isset($_SESSION['Email'])) {
            $fname = $_SESSION['fname'];
            echo "<h2> Welcome $fname! </h2>";
          
        }

        ?>
      <br><br>
      <button onclick="window.location.href = 'additem.php';">Add a new item!</button>
      <br><br>
      <h4>Edit Posted Items</h4>
      <?php
      if(isset($_SESSION['userid'])){
        $userid = $_SESSION['userid'];
        include 'dbconnect.php';

        $sql = "SELECT * FROM Items where UserID = '$userid'";

        $result = $conn->query($sql);

        if ($result->num_rows>0) {
          echo "<table>";
          echo "<thead>
          <tr>
            <th>Item</th>
            <th>Category</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>";
          while($row = $result->fetch_assoc()){
            echo "<tr>";
            echo "<td>" . $row['prod_name'] . "</td>";
            echo "<td>" . $row['Category'] . "</td>";
            echo "<td>" . $row['SoldStatus'] . "</td>";
            echo "<td><button class='delete-btn' data-id='{" . $row['ListingID'] . "}'>Delete</button></td>";
            echo "</tr>";
          }
          echo "</tbody>";
          echo "</table>";
        } else {
          echo "You have not made any posts yet.";
        }
      
        $conn->close();
      }
   



      ?>
      <script src="userjs.js"></script>
        
  </main>
  </body>
</html>
