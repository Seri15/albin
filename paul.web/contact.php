<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $data = "Name: $name\nEmail: $email\nMessage: $message\n\n";
    
    // Attempt to write the data to contacts.txt file.
    if (file_put_contents('contacts.txt', $data, FILE_APPEND) === FALSE) {
        $error_message = "Error: Unable to save your message.";
    } else {
        $success_message = "Thank you for your message!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact - John Paul Oliva</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <h1>Contact</h1>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="projects.php">Projects</a></li>
            <li><a href="skills.php">Skills</a></li>
        </ul>
    </nav>
</header>
<main>
    <section id="contact-form">
        <h2>Contact Me</h2>
        <p>You can reach out to me via email or by filling out the form below.</p> <!-- Added note -->
        <p>You can also reach me at: <strong>JohnPaulOliva@gmail.com</strong></p> <!-- Email contact -->
        <form method="post" action="">
            Name: <input type="text" name="name" required><br>
            Email: <input type="email" name="email" required><br>
            Message:<br><textarea name="message" required></textarea><br>
            <input type="submit" value="Send">
        </form>

        <?php if (isset($success_message)): ?>
            <p><?php echo $success_message; ?></p><!-- Confirmation message -->
        <?php endif; ?>
        <?php if (isset($error_message)): ?>
            <p><?php echo $error_message; ?></p><!-- Error message -->
        <?php endif; ?>
    </section><!-- End of contact form section -->
</main>

<footer>
    <p>&copy; 2024 John Paul Oliva. All rights reserved.</p><!-- Copyright notice -->
</footer>

</body>
</html>