<?php

if (!isset($_SESSION['userid'])) {
    header('Location: login.html');
    exit();
}

$listingID = $_GET['ListingID'] ?? null;
if (!$listingID) {
    echo "No item specified.";
    exit();
}

include 'dbconnect.php';
$sql = "SELECT * FROM Items WHERE ListingID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $listingID);
$stmt->execute();
$result = $stmt->get_result();
$item = $result->fetch_assoc();
if (!$item) {
    echo "Item not found.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Update item details based on the form inputs
    $item_name = $_POST['item_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $condition = $_POST['condition'];

    // Prepare the update query
    $update_sql = "UPDATE Items SET prod_name=?, Price=?, Description=?, Category=?, Condition=? WHERE ListingID=?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sssssi", $item_name, $price, $description, $category, $condition, $listingID);
    $update_stmt->execute();
    
    if ($update_stmt->affected_rows > 0) {
        echo "Item updated successfully.";
        // Optionally redirect back to the dashboard
        header("Location: dashboard.php");
    } else {
        echo "Error updating item: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Item</title>
    <link rel="stylesheet" href="create-listing.css"> <!-- Assuming the CSS for createitem.php is create-listing.css -->
    <script src="https://kit.fontawesome.com/34c6296155.js" crossorigin="anonymous"></script>
</head>
<body>
    <header class="topnav">
        <a href="index.php" id="mainpage">SchoolYard Xchange</a>
        <input type="text" placeholder="Search the SchoolYard" id="searchbar" />
        <div class="right-items">
            <a href="dashboard.php" id="dashlink"><i class="fa-solid fa-gauge"></i> Dashboard</a>
            <a href="faq.php" id="faqlink"><i class="fa-solid fa-circle-question"></i> FAQ</a>
            <?php
            session_start();
            if (isset($_SESSION['Email'])) {
                echo "<a href='user.php' id='loginlink'><i class='fa-solid fa-user'></i> Account</a>";
            } else {
                echo "<a href='login.html' id='loginlink'><i class='fa-solid fa-user'></i> Login</a>";
            }
            ?>
        </div>
    </header>
    <main class="center">
        <h2>Edit Listing</h2>
        <form action="edit_item.php?ListingID=<?php echo $listingID; ?>" method="POST" class="create-listing-form" enctype="multipart/form-data">
            <fieldset>
                <!-- Image upload section, assuming image is not edited -->
                <div class="upload-section">
                    <label for="image_upload">Current Picture of Your Item</label>
                    <img src="<?php echo $item['img_dir']; ?>" alt="Item Image" style="width: 100px; height: auto;">
                </div>

                <label for="item_name">Item Name:</label>
                <input type="text" id="item_name" name="item_name" value="<?php echo htmlspecialchars($item['prod_name']); ?>"><br>

                <label for="price">Price:</label>
                <input type="text" id="price" name="price" value="<?php echo htmlspecialchars($item['Price']); ?>"><br>

                <label for="description">Describe Your Item:</label>
                <textarea id="description" name="description"><?php echo htmlspecialchars($item['Description']); ?></textarea><br>

                <label for="category">Item Category:</label>
                <div class="category-radio-buttons">
                    <!-- Categories as radio buttons -->
                    <?php
                    $categories = ['books', 'furniture', 'home', 'electronics', 'clothes', 'accessories', 'misc'];
                    foreach ($categories as $category) {
                        echo '<label><input type="radio" name="category" value="' . $category . '" ' . ($item['Category'] == $category ? 'checked' : '') . '> ' . ucfirst($category) . '</label>';
                    }
                    ?>
                </div><br>

                <label for="condition">Select the condition:</label>
                <select id="condition" name="condition">
                    <option value="new" <?php echo $item['Condition'] == 'new' ? 'selected' : ''; ?>>New</option>
                    <option value="used - like new" <?php echo $item['Condition'] == 'used - like new' ? 'selected' : ''; ?>>Used - Like New</option>
                    <option value="used - good" <?php echo $item['Condition'] == 'used - good' ? 'selected' : ''; ?>>Used - Good</option>
                    <option value="used - fair" <?php echo $item['Condition'] == 'used - fair' ? 'selected' : ''; ?>>Used - Fair</option>
                </select><br><br>

                <button type="submit" class="publish-button">Update Listing</button>
            </fieldset>
        </form>
    </main>
</body>
</html>


