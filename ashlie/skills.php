<?php
$softFile = "soft.txt";
$technicalFile ="tecnical.txt";


// Load content from files
$technicalContent = file_exists($technicalFile) ? file_get_contents($technicalFile) : "PHP\nHTML\nJavaScrip";
$softContent = file_exists($softFile) ? file_get_contents($softFile) : "Communication\nCollaboration\nProblem-solving";

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
        <title>Skills</title>

        <h1>Soft Skills</h1>
        <p><?php echo nl2br(htmlspecialchars($softContent)); ?></p>
        
  
    
        <h2>Technical Skills</h2>
        <p><?php echo nl2br(htmlspecialchars($technicalContent)); ?></p>

        
        <a href="edit.php" class="edit-button">Edit</a>
   

    
    
    </div>

</body>
<footer>&copy; <?php echo date("Y"); ?> Ashlie Jhea Decano</footer>
</html>
