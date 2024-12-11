<?php
session_start(); // Start the session to check for success message

// File to store about me data
$dataFile = 'data/about_me.txt';

// Load current data from the file
$aboutMe = $tools = $experience = "";
if (file_exists($dataFile)) {
    $content = file_get_contents($dataFile);
    $dataParts = explode("\n---\n", $content);

    // Ensure data parts are properly initialized
    $aboutMe = $dataParts[0] ?? "I am John Alvin T. Omiles, currently 21 years old, living in Longos Central San Fabian Pangasinan. I am currently a 2nd year student at Universidad de Dagupan.";
    $tools = $dataParts[1] ?? "I use Alight Motion on my mobile phone because it is convenient. On my PC, I use Adobe Photoshop and After Effects for editing.";
    $experience = $dataParts[2] ?? "I have some experience in editing. I edited the logo of R1MC Binloc Oxygen Powerplant, and I have also edited content for social media pages and groups.";
} else {
    // Fallback to default values if the file doesn't exist
    $aboutMe = "I am John Alvin T. Omiles, currently 21 years old, living in Longos Central San Fabian Pangasinan. I am currently a 2nd year student at Universidad de Dagupan.";
    $tools = "I use Alight Motion on my mobile phone because it is convenient. On my PC, I use Adobe Photoshop and After Effects for editing.";
    $experience = "I have some experience in editing. I edited the logo of R1MC Binloc Oxygen Powerplant, and I have also edited content for social media pages and groups.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MY PROFILE</title>
    <link rel="stylesheet" href="assets/styles.css">
    <style>
        .success-popup {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            z-index: 1000;
            display: none;
        }
    </style>
</head>
<body>
<div class="navbar">
        <ul>
            <li><a href="index.php" class="active">HOME</a></li>
            <li><a href="about.php">ABOUT ME</a></li>
            <li><a href="change_profile.php" class="active">CHANGE PROFILE</a></li>
            <li><a href="My portfolio.php">MY PORTFOLIO</a></li>
            <li><a href="skills.php">SKILLS</a></li>
            <li><a href="index2.php">CONTACT ME</a></li>
        </ul>
    </div>
    <!-- Success message popup -->
    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="success-popup" id="successPopup"><?= $_SESSION['success_message'] ?></div>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <div class="container">
        <h1>MY PROFILE</h1>
        <div class="content-section">
            <h2>About Me</h2>
            <p><?= nl2br(htmlspecialchars($aboutMe)) ?></p>
        </div>

        <div class="content-section">
            <h2>What Editing Tools I Use</h2>
            <p><?= nl2br(htmlspecialchars($tools)) ?></p>
        </div>

        <div class="content-section">
            <h2>My Experience</h2>
            <p><?= nl2br(htmlspecialchars($experience)) ?></p>
        </div>
    </div>

    <script>
        // Show the success popup if it exists
        const successPopup = document.getElementById("successPopup");
        if (successPopup) {
            successPopup.style.display = "block";
            setTimeout(() => {
                successPopup.style.display = "none";
            }, 3000); // Hide the popup after 3 seconds
        }
    </script>
</body>
</html>
<?php
// Include the footer
include 'includes/footer.php';
?>

