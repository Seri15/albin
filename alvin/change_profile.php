<?php
session_start(); // Start the session to store the success message

// File to store about me data
$dataFile = 'data/about_me.txt';

// Save data if the form is submitted (after the form is submitted)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aboutMe = $_POST['about_me'] ?? '';
    $tools = $_POST['tools'] ?? '';
    $experience = $_POST['experience'] ?? '';

    // Save the updated data to the file
    $content = implode("\n---\n", [$aboutMe, $tools, $experience]);
    file_put_contents($dataFile, $content);

    // Set the success message in the session
    $_SESSION['success_message'] = "Profile settings updated successfully!";
    
    // Redirect to the About Me page after saving changes
    header("Location: about.php");
    exit; // Make sure the script stops after the redirect
}

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
    <title>Change Profile Settings</title>
    <link rel="stylesheet" href="assets/styles.css">
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

    <div class="container">
        <h1>Change Profile Settings</h1>
        <form method="POST">
            <div class="form-group">
                <label for="about_me">About Me:</label>
                <textarea id="about_me" name="about_me" rows="5"><?= htmlspecialchars($aboutMe) ?></textarea>
            </div>
            <div class="form-group">
                <label for="tools">What Editing Tools I Use:</label>
                <textarea id="tools" name="tools" rows="5"><?= htmlspecialchars($tools) ?></textarea>
            </div>
            <div class="form-group">
                <label for="experience">My Experience:</label>
                <textarea id="experience" name="experience" rows="5"><?= htmlspecialchars($experience) ?></textarea>
            </div>
            <button type="submit">Save Changes</button>
        </form>
    </div>
</body>
</html>

<?php
// Include the footer
include 'includes/footer.php';
?>





