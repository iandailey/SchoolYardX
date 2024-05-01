<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="create-listing.css">
        <title>Confirmation</title>
    </head>
    <body>
        <header class="topnav">
            <a href="index.php" id="mainpage">SchoolYard Exchange</a>
            <input type="text" placeholder="Search the SchoolYard" id="searchbar" />
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
        <main class="center">
            <h2>Confirmation</h2>
            <p>Your listing for '<?php echo htmlspecialchars(urldecode($_GET['item'])); ?>' has been successfully created.</p>
            <a href="createitem.php"><button class="publish-button">Create Another Listing</button></a>
        </main>
    </body>
</html>
