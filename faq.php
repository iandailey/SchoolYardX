<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>SchoolYard Exchange</title>
  <link rel="stylesheet" href="faq.css">
  <script src="https://kit.fontawesome.com/34c6296155.js" crossorigin="anonymous"></script>
</head>

<body>
  <header class="topnav">
    <a href="index.php" id="mainpage">SchoolYard Xchange</a>
    
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


  
<body>

<main class="center">
    <h1 class="faq-title">Frequently Asked Questions</h1>
    <div class="faq-container">
        <!-- FAQ Item 1 -->
        <div class="faq-question">How do I sign up for the marketplace?</div>
        <div class="faq-answer">You can sign up by using your university email address to ensure that only students can access the marketplace.</div>

        <!-- FAQ Item 2 -->
        <div class="faq-question">What can I sell on the marketplace?</div>
        <div class="faq-answer">You can sell anything that's allowed by university policy and local laws. Common items include textbooks, lecture notes, electronics, furniture, and dorm essentials.</div>

        <!-- FAQ Item 3 -->
        <div class="faq-question">Is there a fee to use the marketplace?</div>
        <div class="faq-answer">No, our student marketplace is free to use for buying and selling items. However, certain premium features may be available for a small fee.</div>

        <!-- FAQ Item 4 -->
        <div class="faq-question">How do I ensure a transaction is safe?</div>
        <div class="faq-answer">Always meet in a public place on campus for transactions, and if possible, bring a friend. Never share personal financial information in the marketplace.</div>

        <!-- FAQ Item 5 -->
        <div class="faq-question">What should I do if an item I purchased is not as advertised?</div>
        <div class="faq-answer">Contact the seller to see if you can resolve the issue amicably. If that doesn't work, you can report the listing to our team for further assistance.</div>

        <!-- FAQ Item 6 -->
        <div class="faq-question">How do I contact a seller?</div>
        <div class="faq-answer">Once you find an item you're interested in, click on the listing to send a message to the seller directly through the marketplace.</div>

        <!-- FAQ Item 7 -->
        <div class="faq-question">Can I list services or only physical items?</div>
        <div class="faq-answer">You can list both services and physical items as long as they adhere to the marketplace guidelines.</div>

        <!-- FAQ Item 8 -->
        <div class="faq-question">What should I do if I suspect a listing is fraudulent?</div>
        <div class="faq-answer">Please report the listing immediately using the 'Report' button on the listing page, and our team will investigate.</div>

        <!-- FAQ Item 9 -->
        <div class="faq-question">How can I edit or remove my listing?</div>
        <div class="faq-answer">You can edit or remove your listing at any time by going to your Dashboard and selecting the listing you wish to modify.</div>

        <!-- FAQ Item 10 -->
        <div class="faq-question">Are there any prohibited items on the marketplace?</div>
        <div class="faq-answer">Yes, the sale of illegal items, weapons, alcohol
    </div>

    <!-- Contact Form -->
    <div class="contact-form">
        <h2>Contact Us</h2>
        <form action="/submit-contact-form" method="post">
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Your Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Your Message:</label>
            <textarea id="message" name="message" rows="4" required></textarea>

            <button type="submit">Send Message</button>
        </form>
    </div>
</main>

<script>
    document.querySelectorAll('.faq-question').forEach(item => {
        item.addEventListener('click', () => {
            const answer = item.nextElementSibling;
            answer.style.display = answer.style.display === 'none' ? 'block' : 'none';
        });
    });
</script>

</body>
</html>
