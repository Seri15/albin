<?php
$aboutFile = "about.txt";
$contactFile = "contact.txt";
$softFile = "soft.txt";
$technicalFile ="tecnical.txt";


// Handle form submissions for each section
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['about'])) {
        file_put_contents($aboutFile, $_POST['about']);
        header("Location: about.php"); // Redirect to prevent form resubmission
        exit();
    }

    if (isset($_POST['soft'])) {
        file_put_contents($softFile, $_POST['soft']);
        header("Location: skills.php"); // Redirect to prevent form resubmission
        exit();
    }
    if (isset($_POST['technical'])) {
        file_put_contents($technicalFile, $_POST['technical']);
        header("Location: skills.php"); // Redirect to prevent form resubmission
        exit();
    }

    // Handle contact form submission for Facebook, Email, and Phone
    if (isset($_POST['facebook']) && isset($_POST['email']) && isset($_POST['phone'])) {
        $contactData = "Facebook: " . $_POST['facebook'] . "\n";
        $contactData .= "Email: " . $_POST['email'] . "\n";
        $contactData .= "Phone: " . $_POST['phone'] . "\n";
        file_put_contents($contactFile, $contactData); // Save all contact info to one file
        header("Location: contact.php"); // Redirect to prevent form resubmission
        exit();
    }
}

// Load the current content for each section
$aboutContent = file_exists($aboutFile) ? file_get_contents($aboutFile) : "Hi, I’m Ashlie Jhea D. Decano, born on March 19, 2005, I’m 19 years old.\n I live in Dagupan City and currently study Information Technology at Universidad De Dagupan. \n I have a deep love for drawing and editing, \nwhich allows me to express my creativity and bring ideas to life.";

$technicalContent = file_exists($technicalFile) ? file_get_contents($technicalFile) : "PHP\nHTML\nJavaScrip";
$softContent = file_exists($softFile) ? file_get_contents($softFile) : "Communication\nCollaboration\nProblem-solving";

// Load the current contact info (Facebook, Email, Phone) from the contact.txt file
if (file_exists($contactFile)) {
    $contactContent = file_get_contents($contactFile);
    // Extract individual fields from the contact file (assuming each field is on a new line)
    $contactFields = explode("\n", $contactContent);
    $facebookContact = isset($contactFields[0]) ? str_replace("Facebook: ", "", $contactFields[0]) : "";
    $emailContact = isset($contactFields[1]) ? str_replace("Email: ", "", $contactFields[1]) : "";
    $phoneContact = isset($contactFields[2]) ? str_replace("Phone: ", "", $contactFields[2]) : "";
} else {
    $facebookContact = "Ash Decano";
    $emailContact = "ashliedecano@gmail.com";
    $phoneContact = "099999999";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Portfolio Sections</title>
    <link rel="stylesheet" href="assets/editstyle.css">
</head>
<body>
    <div class="container">

        <!-- Navigation Menu -->
        <nav>
            <ul>
                <li><a href="about.php">Home</a></li>
            </ul>
        </nav>

        <h1>Edit Portfolio Sections</h1>

        <!-- About Me Section -->
        <h2>About Me</h2>
        <p><strong>Current:</strong></p>
        <p><?php echo nl2br(htmlspecialchars($aboutContent)); ?></p>
        <form method="POST">
            <label for="about">Edit About Me:</label><br>
            <textarea id="about" name="about" rows="4" cols="50"><?php echo htmlspecialchars($aboutContent); ?></textarea><br>
            <button type="submit">Save</button>
        </form>

        <!-- Skills Section -->
        <h2>Soft Skills</h2>
        <p><strong>Current:</strong></p>
        <p><?php echo nl2br(htmlspecialchars($softContent)); ?></p>
        <form method="POST">
            <label for="soft">Edit Skills:</label><br>
            <textarea id="soft" name="soft" rows="4" cols="50"><?php echo htmlspecialchars($softContent); ?></textarea><br>
            <button type="submit">Save</button>
        </form>

        <h2>Technical Skills</h2>
        <p><strong>Current:</strong></p>
        <p><?php echo nl2br(htmlspecialchars($technicalContent)); ?></p>
        <form method="POST">
            <label for="technicalskills">Edit Skills:</label><br>
            <textarea id="technicalskills" name="technicalskills" rows="4" cols="50"><?php echo htmlspecialchars($technicalContent); ?></textarea><br>
            <button type="submit">Save</button>
        </form>


        <!-- Contact Section -->
        <h2>Contact</h2>

        <!-- Contact Form for Facebook, Email, and Phone -->
        <form method="POST">
            <h3>Facebook</h3>
            <label for="facebook">Facebook:</label><br>
            <textarea id="facebook" name="facebook" rows="2" cols="50"><?php echo htmlspecialchars($facebookContact); ?></textarea><br>

            <h3>Email</h3>
            <label for="email">Email:</label><br>
            <textarea id="email" name="email" rows="2" cols="50"><?php echo htmlspecialchars($emailContact); ?></textarea><br>

            <h3>Phone</h3>
            <label for="phone">Phone:</label><br>
            <textarea id="phone" name="phone" rows="2" cols="50"><?php echo htmlspecialchars($phoneContact); ?></textarea><br>

            <button type="submit">Save</button>
        </form>

    </div>
</body>
</html>
