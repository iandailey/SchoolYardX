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
                        <input type="file" id="img" name="img" accept="image/*">
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

                    <br><br>
                    <label for="condition">Select the condition:</label>
                    <select id="condition" name="condition">
                      <option value="new">new</option>
                      <option value="used - like new">used - like new</option>
                      <option value="used - good">used - good</option>
                      <option value="used - fair">used - fair</option>
                    </select><br><br>

                    
                    <label for="delivery">Select an delivery preference:</label>
                    <select id="delivery" name="delivery">
                        <option value="pickup">pickup</option>
                        <option value="dropoff">dropoff</option>
                        <option value="shipping">shipping</option>
                    </select><br><br>
                
                    <label for="location">Select a location:</label>
                    <select id="location" name="location">
                        <option value="on-campus">on campus</option>
                        <option value="off-campus">off campus</option>
                    </select><br><br>
                
                    <label for="sold">Select an sold status:</label>
                    <select id="sold" name="sold">
                        <option value="available">available</option>
                        <option value="sold">sold</option>
                    
                    </select><br><br>



                    <!-- Submit button adjusted to match the "Publish" button in the screenshot -->
                    <button type="submit" class="publish-button">Publish</button>
                </fieldset>
            </form>
        </main>
    </body>
</html>
