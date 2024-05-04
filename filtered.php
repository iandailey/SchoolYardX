<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>SchoolYard Xchange</title>
  <link rel="stylesheet" href="home-layout.css">
  <script src="https://kit.fontawesome.com/34c6296155.js" crossorigin="anonymous"></script>
</head>

<body>
<header class="topnav">
    <a href="index.php" id="mainpage">SchoolYard Xchange</a>
    <input type="text" placeholder="Search the SchoolYard" id="searchbar" name="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" />
    <button id="searchButton"><i class="fa-solid fa-magnifying-glass"></i></button>
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
    <!-- create link to take user to adding item if they are logged in -->
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
    <form action="filtered.php" method=GET id="filterForm">
    <select name="sort" id="sort">
    <option value="recent" <?php echo isset($_GET['sort']) && $_GET['sort'] === 'recent' ? 'selected' : ''; ?>>Most Recent</option>
    <option value="old" <?php echo isset($_GET['sort']) && $_GET['sort'] === 'old' ? 'selected' : ''; ?>>Oldest</option>
    <option value="high" <?php echo isset($_GET['sort']) && $_GET['sort'] === 'high' ? 'selected' : ''; ?>>Price: High to Low</option>
    <option value="low" <?php echo isset($_GET['sort']) && $_GET['sort'] === 'low' ? 'selected' : ''; ?>>Price: Low to High</option>
</select>
<br>
<hr>
<input type="checkbox" class="location-checkbox" name="oncampus" id="oncampcheck" <?php echo isset($_GET['oncampus']) ? 'checked' : ''; ?>>
<label for="oncampcheck">On-Campus</label> <br> <br>
<input type="checkbox" class="location-checkbox" name="offcampus" id="offcampcheck" <?php echo isset($_GET['offcampus']) ? 'checked' : ''; ?>>
<label for="offcampcheck">Off-Campus</label>
<br>
<hr>
<br>
<input type="checkbox" class="category-checkbox" name="1" id="bookcheck" <?php echo isset($_GET['1']) ? 'checked' : ''; ?>>
<label for="bookcheck"><i class="fa-solid fa-book"></i> Books</label> <br> <br>
<input type="checkbox" class="category-checkbox" name="2" id="furncheck" <?php echo isset($_GET['2']) ? 'checked' : ''; ?>>
<label for="furncheck"><i class="fa-solid fa-couch"></i> Furniture</label> <br> <br>
<input type="checkbox" class="category-checkbox" name="3" id="homecheck" <?php echo isset($_GET['3']) ? 'checked' : ''; ?>>
<label for="homecheck"><i class="fa-solid fa-kitchen-set"></i> Home</label> <br> <br>
<input type="checkbox" class="category-checkbox" name="4" id="elecheck" <?php echo isset($_GET['4']) ? 'checked' : ''; ?>>
<label for="elecheck"><i class="fa-solid fa-calculator"></i> Electronics</label> <br> <br>
<input type="checkbox" class="category-checkbox" name="5" id="clothescheck" <?php echo isset($_GET['5']) ? 'checked' : ''; ?>>
<label for="clothescheck"><i class="fa-solid fa-shirt"></i> Clothes</label> <br> <br>
<input type="checkbox" class="category-checkbox" name="6" id="accessoriescheck" <?php echo isset($_GET['6']) ? 'checked' : ''; ?>>
<label for="accessoriescheck"><i class="fa-regular fa-gem"></i> Jewelry / Accessories</label> <br> <br>
<input type="checkbox" class="category-checkbox" name="7" id="misccheck" <?php echo isset($_GET['7']) ? 'checked' : ''; ?>>
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

<!-- Function to Pull Contents of Searchbar into the form -->
<input type="hidden" id="searchInput" name="search" value="">

<script>
// Get references to the form and search input
const form = document.querySelector('form');
const searchInput = document.getElementById('searchbar');

// Add an event listener to the form submission
form.addEventListener('submit', function(event) {
    // Set the value of the hidden input field to the search input value
    document.getElementById('searchInput').value = searchInput.value;
});
</script>

    <button type="submit">Apply Filters</button>
    </form>

    <script>
document.getElementById('searchButton').addEventListener('click', function() {
  // Set the value of the hidden input field to the search input value
  document.getElementById('searchInput').value = document.getElementById('searchbar').value;
    // Submit the form when the search button is clicked
    document.getElementById('filterForm').submit();
});
</script>

  </nav>

  <main>
    <!-- item template -->
    <div class="container">
    <?php
    include 'dbconnect.php';

// Construct the SQL query
$sql = "SELECT Items.*, Images.img_dir FROM Items INNER JOIN Images ON Items.imageid = Images.imageid WHERE ";

// Array to store selected categories
$selectedCategories = [];
$categoryIDs = [1, 2, 3, 4, 5, 6, 7]; // List of all category IDs

foreach ($categoryIDs as $categoryID) {
    if (isset($_GET[$categoryID])) {
        $selectedCategories[] = $categoryID; // Add category ID directly
    }
}

// If at least one category checkbox is selected, add them to the SQL query
if (!empty($selectedCategories)) {
    $sql .= "CategoryID IN (" . implode(", ", $selectedCategories) . ")";
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

// Add search term filter if provided
if (!empty($_GET['search'])) {
  $searchTerm = $_GET['search'];
  $sql .= " AND prod_name LIKE '%$searchTerm%'"; // Match product name containing the search term
}

// Add sorting logic based on selected option
$sortOption = $_GET['sort'] ?? 'recent'; // Default to sorting by most recent if no option is selected
switch ($sortOption) {
    case 'recent':
        $sql .= "ORDER BY Timestamp DESC"; // Sort by most recent
        break;
    case 'old':
        $sql .= "ORDER BY Timestamp ASC"; // Sort by oldest
        break;
    case 'high':
        $sql .= "ORDER BY Price DESC"; // Sort by price: high to low
        break;
    case 'low':
        $sql .= "ORDER BY Price ASC"; // Sort by price: low to high
        break;
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

    echo '<div class="listing" id="' . $row["ListingID"] . '">';
    echo '<a href="listing_details.php?ListingID=' . $row["ListingID"] . '">';
    echo '<img class="listimg" src="' . $row["img_dir"] . '" /> <br />';
    echo '<h2 class="name">' . $row["prod_name"] . '</h2>';
    echo '<p class="price">$' . $row["price"] . '</p>'; 
    // echo '<h3 class="category">' . $row["Category"] . '</h3>';
    // echo '<p class="delivery">' . $row["DeliveryPreferences"] . '</p>';
    // echo '<p class="location">' . $row["Location"] . '</p>';
    // echo '<p class="soldstatus">' . $row["SoldStatus"] . '</p>';
    echo '</a></div>';
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

</div>
</main>
</body>

</html>