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

    <a href="index.php" id="mainpage">SchoolYard Exchange</a>
    <!-- <input type="text" placeholder="Search the SchoolYard" id="searchbar" /> -->

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
      <a href="dashboard.php" id="dashlink">Dashboard</a>
    </div>
  </header>

  <main>
    <?php

    if (isset($_SESSION['Email'])) {
      $fname = $_SESSION['fname'];
      echo "<h2> Welcome $fname! </h2>";

    }

    ?>
    <br><br>
    <h2>User Info:</h2>
    <?php
    //setup and trigger database request for user info.
    if (isset($_SESSION['userid'])) {
      $userid = $_SESSION['userid'];
      include 'dbconnect.php';

      $sql = "SELECT * FROM Users where UserID = '$userid'";

      $qresult = $conn->query($sql);

      //if there is data in the query
      if ($qresult->num_rows > 0) {
        $row = $qresult->fetch_assoc();
        if (isset($row['Address'])) {

          $address = $row['Address'];
          $phone = $row['Phone'];
          $gyear = $row['GraduationYear'];
          $pfp = $row['ProfilePictureURL'];
          $loc = $row['CampusLocation'];

          echo "<h1>User Information</h1>" .
            "<p><strong>Address:</strong> $address</p>" .
            "<p><strong>Phone:</strong> $phone</p>" .
            "<p><strong>Graduation Year:</strong> $gyear</p>" .
            "<p><strong>Profile Picture:</strong> $pfp</p>" .
            "<p><strong>Campus Location:</strong> $loc</p>";



        }

        $conn->close();
      }
    }
    ?>

    <div class="userform">
      <form action="user.php" method="post">
        <fieldset>
          <legend>User Information Required</legend>
          <label for="address">Address:</label>
          <input type="text" id="address" name="address" required><br>

          <label for="phone">Phone:</label>
          <input type="tel" id="phone" name="phone" required><br>

          <label for="gyear">Graduation Year:</label>
          <input type="number" id="gradYear" name="gyear" min="1900" max="2099" required><br>

          <label for="profilePic">Profile Picture:</label>
          <input type="file" id="profilePic" name="pfp" accept="image/*"><br>

          <label for="campusLocation">Campus Location:</label>
          <select id="campusLocation" name="loc" required>
            <option value="on-campus">On Campus</option>
            <option value="off-campus">Off Campus</option>
          </select><br>

          <input type="submit" value="Submit">
        </fieldset>
      </form>

      <?php
      // form handling 
      if (isset($_SESSION['userid'])) {
        $userid = $_SESSION['userid'];
        include 'dbconnect.php';
        if (isset($_POST['address'])) {
          $address = $_POST['address'];
          $phone = $_POST['phone'];
          $gyear = $_POST['gyear'];
          $pfp = $_POST['pfp'];
          $loc = $_POST['loc'];

          $sql = "UPDATE `Users` SET `Address`='$address',`Phone`='$phone',`GraduationYear`='$gyear',`ProfilePictureURL`='$pfp',`CampusLocation`='$loc' WHERE UserID = '$userid';";
          $conn->query($sql);
        }
        $conn -> close();
      }
      ?>

    </div>

    <br><br>
    <button onclick="window.location.href = 'createitem.php';">Add a new item!</button>
    <br><br>
    <h4>Edit Posted Items</h4>
    <?php
    if (isset($_SESSION['userid'])) {
      $userid = $_SESSION['userid'];
      include 'dbconnect.php';

      $sql = "SELECT * FROM Items where UserID = '$userid'";

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        echo "<table>";
        echo "<thead>
          <tr>
            <th>Item</th>
            <th>Category</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>";
        while ($row = $result->fetch_assoc()) {
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