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
            <?php
            session_start();

// Check if user is logged in
            if (isset($_SESSION['Email'])) {
                $fname = $_SESSION['fname'];
                echo " <a id='dashtitle'>$fname's Dashboard</a>";
            }
            error_reporting(E_ALL);
            ini_set('display_errors', 1);


            ?>

        </div>
        <div class="right-items">
            <?php
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
    <!-- create link to take user to adding item if they are logged in --> <!-- test to see if I can push changes-->
    <?php
    

    if (isset($_SESSION['Email'])) {
      echo "<a href='createitem.php'><button>Create new Listing</button></a>";

    } else {
      // Show login
      echo "<a href='login.html' id='loginlink'><button>Create new Listing</button></a>";
    }

    error_reporting(E_ALL);
    ini_set('display_errors', 1);



    ?>
    <br>
    <hr>
    <strong><u>Sort By:</u></strong>
    <form action="filtered.php" method=GET>
    <select name="sort" id="sort">
      <option value="recent">Most Recent</option>
      <option value="top">Highest Rated</option>
      <option value="old">Oldest</option>
    </select>
    <br>
    <hr>
    <input type="checkbox" class="location-checkbox" name="oncampus" id="oncampcheck" checked>
    <label for="oncampcheck">On-Campus</label> <br> <br>
    <input type="checkbox" class="location-checkbox" name="offcampus" id="offcampcheck" checked>
    <label for="offcampcheck">Off-Campus</label>
    <br>
    <hr>
    <br>
    <input type="checkbox" class="category-checkbox" name="books" id="bookcheck" checked>
    <label for="bookcheck">Books</label> <br> <br>
    <input type="checkbox" class="category-checkbox" name="furniture" id="furncheck" checked>
    <label for="furncheck">Furniture</label> <br> <br>
    <input type="checkbox" class="category-checkbox" name="home" id="homecheck" checked>
    <label for="homecheck">Home</label> <br> <br>
    <input type="checkbox" class="category-checkbox" name="electronics" id="elecheck" checked>
    <label for="elecheck">Electronics</label> <br> <br>
    <input type="checkbox" class="category-checkbox" name="clothes" id="clothescheck" checked>
    <label for="clothescheck">Clothes</label> <br> <br>
    <input type="checkbox" class="category-checkbox" name="accessories" id="accessoriescheck" checked>
    <label for="accessoriescheck">Jewelry / Accessories</label> <br> <br>
    <input type="checkbox" class="category-checkbox" name="misc" id="misccheck" checked>
    <label for="misccheck">Miscellaneous</label> <br> <br>
    <button type="button" id="select">Select All</button>
    <button type="button" id="deselect">Deselect All</button>

    <script>
    // Get references to the select/deselect buttons and all checkboxes
    const selectButton = document.getElementById('select');
    const deselectButton = document.getElementById('deselect');
    const allCheckboxes = document.querySelectorAll('input[type="checkbox"]');

    // Function to select all checkboxes
    selectButton.addEventListener('click', function() {
        allCheckboxes.forEach(checkbox => {
            checkbox.checked = true;
        });
    });

    // Function to deselect all checkboxes
    deselectButton.addEventListener('click', function() {
        allCheckboxes.forEach(checkbox => {
            checkbox.checked = false;
        });
    });
</script>

    <button type="submit">Apply Filters</button>
    </form>
  </nav>

    <main>

        <!-- item template -->
        <div class="container">
            <?php
            
            if (isset($_SESSION['userid'])) {
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
            ?>


        </div>
    </main>
</body>

</html>
