<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="create-listing.css">
         <script src="https://kit.fontawesome.com/34c6296155.js" crossorigin="anonymous"></script>
        <title>Create Listing</title>
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
        <main class="center">
            <h2>Confirmation</h2>
            <p>Your listing for '<?php echo htmlspecialchars(urldecode($_GET['item'])); ?>' has been successfully created.</p>
            <a href="createitem.php"><button class="publish-button">Create Another Listing</button></a>
        </main>
    </body>
</html>
