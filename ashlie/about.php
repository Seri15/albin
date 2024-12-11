<?php
$aboutFile = "about.txt";

// Load content from files
$aboutContent = file_exists($aboutFile) ? file_get_contents($aboutFile) : "Hi, I’m Ashlie Jhea D. Decano, born on March 19, 2005, I’m 19 years old.\n I live in Dagupan City and currently study Information Technology at Universidad De Dagupan. \n I have a deep love for drawing and editing, \nwhich allows me to express my creativity and bring ideas to life.";

// Load contact info from contact.txt file

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio - About Me</title>
    <link rel="stylesheet" href="assets/about.css">
</head>
<style>
    body {
      background-image: url('images/white.jpg');
    background-size: cover; /* Ensures the image covers the entire viewport */
    background-attachment: fixed; /* Keeps the image fixed when scrolling */
   
}

</style>
<body>
    <nav>
        <ul>
        <li><a href="index.php">Home</a></li>
            <li><a href="projects.php">Portfolio</a></li>
            <li><a href="about.php">About Me</a></li>
            <li><a href="skills.php">Skills</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>

    <div class="container">
        <h1>About Me</h1>
        <p><?php echo nl2br(htmlspecialchars($aboutContent)); ?></p>
        
        <a href="edit.php" class="edit-button">Edit</a>

    </div>

</body>
<footer>&copy; <?php echo date("Y"); ?> Ashlie Jhea Decano</footer>
</html>
