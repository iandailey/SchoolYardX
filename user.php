<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>SchoolYard Exchange</title>
    <link rel="stylesheet" href="user.css">
</head>
<body>
    <header class="topnav">
        <a href="index.php" id="mainpage">SchoolYard Exchange</a>
        <div class="right-items">
            <?php
            session_start();
            if (isset($_SESSION['Email'])) {
                $fname = $_SESSION['fname'];
                echo "<a href='user.php' id='loginlink'>$fname's Account</a>";
            } else {
                echo "<a href='login.html' id='loginlink'>Login</a>";
            }
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
        if (isset($_SESSION['userid'])) {
            $userid = $_SESSION['userid'];
            include 'dbconnect.php';
            $sql = "SELECT * FROM Users where UserID = '$userid'";
            $qresult = $conn->query($sql);
            if ($qresult->num_rows > 0) {
                $row = $qresult->fetch_assoc();
                echo "<h1>User Information</h1>" .
                    "<p><strong>Address:</strong> " . htmlspecialchars($row['Address']) . "</p>" .
                    "<p><strong>Phone:</strong> " . htmlspecialchars($row['Phone']) . "</p>" .
                    "<p><strong>Graduation Year:</strong> " . htmlspecialchars($row['GraduationYear']) . "</p>" .
                    "<p><strong>Profile Picture:</strong> <img src='" . htmlspecialchars($row['ProfilePictureURL']) . "' alt='Profile Picture'></p>" .
                    "<p><strong>Campus Location:</strong> " . htmlspecialchars($row['CampusLocation']) . "</p>";
            }
            $conn->close();
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
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['prod_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Category']) . "</td>";
        echo "<td>" . htmlspecialchars($row['SoldStatus']) . "</td>";
        echo "<td>
                <form action='delete_item.php' method='post'>
                    <input type='hidden' name='id' value='" . $row['ListingID'] . "'>
                    <button type='submit' class='delete-btn' onclick='return confirm(\"Are you sure you want to delete this item?\");'>Delete</button>
                </form>
              </td>";
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
    </main>
</body>
</html>
