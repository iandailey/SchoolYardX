<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>SchoolYard Exchange</title>
  <link rel="stylesheet" href="home-layout.css">
  <script src="https://kit.fontawesome.com/34c6296155.js" crossorigin="anonymous"></script>
</head>

<body>
  <header class="topnav">
    <a href="index.php" id="mainpage">SchoolYard Xchange</a>
    <input type="text" placeholder="Search the SchoolYard" id="searchbar" />
    <div class="right-items">
    <a href="dashboard.php" id="dashlink"><i class="fa-solid fa-gauge"></i> Dashboard</a>
    <a href="faq.html" id="faqlink"><i class="fa-solid fa-circle-question"></i> FAQ</a>
    <?php
    session_start();

    // Check if user is logged in
    if (isset($_SESSION['Email'])) {
      $fname = $_SESSION['fname'];
      echo "<a href='user.php' id='loginlink'><i class='fa-solid fa-user'></i> Account</a>";

    } else {
      // Show login
      echo "<a href='login.html' id='loginlink'><i class='fa-solid fa-user'></i> Login</a>";
    }

    error_reporting(E_ALL);
    ini_set('display_errors', 1);


    ?>
    </div>
  </header>


  <nav class="sidenav">
    <!-- create link to take user to adding item if they are logged in --> <!-- test to see if I can push changes-->
    <?php
    

    if (isset($_SESSION['Email'])) {
      echo "<a href='createitem.php'><button>Create Listing <i class='fa-regular fa-square-plus' id='createicon'></i></button></a>";

    } else {
      // Show login
      echo "<a href='login.html' id='loginlink'><button>Create Listing <i class='fa-regular fa-square-plus' id='createicon'></i></button></a>";
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
    <label for="bookcheck"><i class="fa-solid fa-book"></i> Books</label> <br> <br>
    <input type="checkbox" class="category-checkbox" name="furniture" id="furncheck" checked>
    <label for="furncheck"><i class="fa-solid fa-couch"></i> Furniture</label> <br> <br>
    <input type="checkbox" class="category-checkbox" name="home" id="homecheck" checked>
    <label for="homecheck"><i class="fa-solid fa-kitchen-set"></i> Home</label> <br> <br>
    <input type="checkbox" class="category-checkbox" name="electronics" id="elecheck" checked>
    <label for="elecheck"><i class="fa-solid fa-calculator"></i> Electronics</label> <br> <br>
    <input type="checkbox" class="category-checkbox" name="clothes" id="clothescheck" checked>
    <label for="clothescheck"><i class="fa-solid fa-shirt"></i> Clothes</label> <br> <br>
    <input type="checkbox" class="category-checkbox" name="accessories" id="accessoriescheck" checked>
    <label for="accessoriescheck"><i class="fa-regular fa-gem"></i> Jewelry / Accessories</label> <br> <br>
    <input type="checkbox" class="category-checkbox" name="misc" id="misccheck" checked>
    <label for="misccheck"><i class="fa-solid fa-bars"></i> Miscellaneous</label> <br> <br>
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
      include 'dbconnect.php';

      // SQL query to fetch data from the database
      $sql = "SELECT * FROM Items";
      $result = $conn->query($sql);

      // Check if any rows were returned
      if ($result->num_rows > 0) {
        // Output data of each row  
        echo '<table>';
        echo '<tr>';
        $count = 0;
        while ($row = $result->fetch_assoc()) {
          echo '<td>';

          echo '<div class="listing" id="listID">';
          // echo '<img class="listimg" src="' . $row["image_url"] . '" /> <br />';
          echo '<h2 class="name">' . $row["prod_name"] . '</h2>';
          echo '<h3 class="category">' . $row["Category"] . '</h3>';
          echo '<p class="delivery">' . $row["DeliveryPreferences"] . '</p>';
          echo '<p class="location">' . $row["Location"] . '</p>';
          echo '<p class="soldstatus">' . $row["SoldStatus"] . '</p>';
          echo '</div>';
          echo '</td>';

          $count++;
          if ($count % 4 == 0) {
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
      <script src="search.js"></script>

    </div>
  </main>
</body>

</html>