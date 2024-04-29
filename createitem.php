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

    <a href="favorites.html" id="favlink">Favorites</a>
    <a href="dashboard.php" id="dashlink">Dashboard</a>
    </div>
  </header>


        <main class="center">
            <!-- Adjusted heading to match screenshot -->
            <h2>Create Listing</h2>
            <form action="additem.php" method="POST" class="create-listing-form">
                <fieldset>
                    <!-- Image upload section -->
                    <div class="upload-section">
                        <label for="image_upload">Upload a Picture of Your Item</label>
                        <input type="file" id="image_upload" name="image_upload" hidden>
                        <div class="drag-drop-area">
                            <p>Choose files to Upload or drag and drop them here</p>
                        </div>
                    </div>

                    <label for="item_name">Item Name:</label>
                    <input type="text" id="item_name" name="item_name" placeholder="What's your item called?"><br>

                    <label for="price">Price:</label>
                    <input type="text" id="price" name="price" placeholder="How much does your item cost?"><br>

                    <!-- Description section -->
                    <label for="description">Describe Your Item:</label>
                    <textarea id="description" name="description" placeholder="Describe things about the item, including condition, color, size, age, etc."></textarea>

                    <!-- Item category selection, adjusted to radio buttons -->
                    <label for="category">Item Category:</label>
                    <div class="category-radio-buttons">
                        <label><input type="radio" name="category" value="Books"> Books</label>
                        <label><input type="radio" name="category" value="Furniture"> Furniture</label>
                        <label><input type="radio" name="category" value="Home"> Home</label>
                        <label><input type="radio" name="category" value="Electronics"> Electronics</label>
                        <label><input type="radio" name="category" value="Clothes"> Clothes</label>
                        <label><input type="radio" name="category" value="Jewelry/Accessories"> Jewelry / Accessories</label>
                        <label><input type="radio" name="category" value="Miscellaneous"> Miscellaneous / Other</label>
                    </div>

                    <!-- Submit button adjusted to match the "Publish" button in the screenshot -->
                    <button type="submit" class="publish-button">Publish</button>
                </fieldset>
            </form>
        </main>
    </body>
</html>
