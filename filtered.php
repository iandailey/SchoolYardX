<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>SchoolYard Exchange</title>
  <link rel="stylesheet" href="home-layout.css">
  <!-- JavaScript code for category checkboxes 
   <script>
    document.addEventListener('DOMContentLoaded', function () {
      const categoryCheckboxes = document.querySelectorAll('.category-checkbox');

      categoryCheckboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function () {
          filterItemsByCategory();
        });
      });

      function filterItemsByCategory() {
        const items = document.querySelectorAll('.listing');

        items.forEach(function(item) {
          const category = item.dataset.category;
          const categoryCheckboxes = document.querySelectorAll('.category-checkbox:checked');
          const selectedCategories = Array.from(categoryCheckboxes).map(checkbox => checkbox.value);

          if (selectedCategories.includes(category)) {
            item.style.display = '';
          } else {
            item.style.display = 'none';
          }
        });
      }
    });
  </script>
-->

</head>

<body>
  <header class="topnav">
    <a href="home.html" id="mainpage">SchoolYard Exchange</a>
    <input type="text" placeholder="Search the SchoolYard" id="searchbar" />
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
  </header>


  <nav class="sidenav">
    <!-- create link to take user to adding item if they are logged in --> <!-- test to see if I can push changes-->
    <?php
    

    if (isset($_SESSION['Email'])) {
      echo "<a href='additem.html'><button>Create new Listing</button></a>";

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
    <input type="checkbox" class="location-checkbox" name="oncampus" id="oncampcheck" <?php if (isset($_GET['oncampus'])) echo "checked"; ?>>
<label for="oncampcheck">On-Campus</label> <br> <br>
<input type="checkbox" class="location-checkbox" name="offcampus" id="offcampcheck" <?php if (isset($_GET['offcampus'])) echo "checked"; ?>>
<label for="offcampcheck">Off-Campus</label>
<br>
<hr>
<br>
<input type="checkbox" class="category-checkbox" name="books" id="bookcheck" <?php if (isset($_GET['books'])) echo "checked"; ?>>
<label for="bookcheck">Books</label> <br> <br>
<input type="checkbox" class="category-checkbox" name="furniture" id="furncheck" <?php if (isset($_GET['furniture'])) echo "checked"; ?>>
<label for="furncheck">Furniture</label> <br> <br>
<input type="checkbox" class="category-checkbox" name="home" id="homecheck" <?php if (isset($_GET['home'])) echo "checked"; ?>>
<label for="homecheck">Home</label> <br> <br>
<input type="checkbox" class="category-checkbox" name="electronics" id="elecheck" <?php if (isset($_GET['electronics'])) echo "checked"; ?>>
<label for="elecheck">Electronics</label> <br> <br>
<input type="checkbox" class="category-checkbox" name="clothes" id="clothescheck" <?php if (isset($_GET['clothes'])) echo "checked"; ?>>
<label for="clothescheck">Clothes</label> <br> <br>
<input type="checkbox" class="category-checkbox" name="accessories" id="accessoriescheck" <?php if (isset($_GET['accessories'])) echo "checked"; ?>>
<label for="accessoriescheck">Jewelry/Accessories</label> <br> <br>
<input type="checkbox" class="category-checkbox" name="misc" id="misccheck" <?php if (isset($_GET['misc'])) echo "checked"; ?>>
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
error_reporting(E_ALL);
ini_set('display_errors', 1);

$hostname = "schoolyardx.com";
$username = "Databaseadmin";
$password = "Ge0rg3Wa\$hingt0n";
$dbname = "SchoolYard_Exchange_GWU";

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Construct the SQL query
$sql = "SELECT * FROM Items WHERE ";

// Array to store selected categories
$selectedCategories = [];
$categories = ['books', 'furniture', 'home', 'electronics', 'clothes', 'accessories', 'misc']; // List of all category checkboxes

foreach ($categories as $category) {
    if (isset($_GET[$category])) {
        $selectedCategories[] = "'" . $category . "'"; // Add category name directly
    }
}

// If at least one category checkbox is selected, add them to the SQL query
if (!empty($selectedCategories)) {
    $sql .= "Category IN (" . implode(", ", $selectedCategories) . ")";
} else {
    // If no category checkbox is selected, retrieve all items
    $sql .= "1"; // Just a placeholder condition to select all items
}

// Add location filter if selected
if (isset($_GET['oncampus']) && isset($_GET['offcampus'])) {
    // Both checkboxes are selected, retrieve all items
} elseif (isset($_GET['oncampus'])) {
    $sql .= " AND Location = 'On-Campus'";
} elseif (isset($_GET['offcampus'])) {
    $sql .= " AND Location = 'Off-Campus'";
}

// Execute the SQL query
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
      <script>

        // Get references to the input field and the container for listings
        const searchInput = document.getElementById('searchbar');
        const listings = document.querySelectorAll('.listing');

        // Function to filter listings based on the search input
        function filterListings() {
          const searchTerm = searchInput.value.toLowerCase();

          // Loop through each listing
          listings.forEach((listing) => {
            const title = listing.querySelector('.name').textContent.toLowerCase();

            if (title.includes(searchTerm)) {
              // Display matching listings
              listing.style.display = 'block';
            } else {
              // Hide non-matching listings
              listing.style.display = 'none';
            }
          });
        }

        // Attach an event listener to the search input
        searchInput.addEventListener('input', filterListings);

      </script>

    </div>
  </main>
</body>

</html>