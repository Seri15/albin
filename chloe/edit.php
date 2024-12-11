<?php
$portfolioDir = "portfolio_files"; // Directory where images will be uploaded
$projectDescriptionsFile = "project_descriptions.txt"; // File to store project descriptions

// Check if the description file exists, if not create it with default values
if (!file_exists($projectDescriptionsFile)) {
    $defaultDescriptions = [
        "Project 1 Description",
        "Project 2 Description",
        "Project 3 Description"
    ];
    file_put_contents($projectDescriptionsFile, implode("\n", $defaultDescriptions));
}

// Read project descriptions from file
$descriptions = file($projectDescriptionsFile, FILE_IGNORE_NEW_LINES);
if ($descriptions === false) {
    die("Error: Unable to read descriptions file.");
}

// Handle saving edited descriptions
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_description'])) {
    // Ensure descriptions are updated correctly
    $updatedDescriptions = [];
    foreach ($descriptions as $index => $description) {
        // Get the new description or keep the existing one
        $updatedDescriptions[] = isset($_POST['description_' . $index]) ? $_POST['description_' . $index] : $description;
    }

    // Save the updated descriptions back to the file
    if (file_put_contents($projectDescriptionsFile, implode("\n", $updatedDescriptions)) === false) {
        die("Error: Unable to save updated descriptions.");
    }

    // Update the descriptions in memory
    $descriptions = $updatedDescriptions;
}

// Handle image upload
$uploadError = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['upload_image'])) {
    $image = $_FILES['upload_image'];
    
    // Validate the image
    if ($image['error'] === UPLOAD_ERR_OK) {
        $imageName = basename($image['name']);
        $targetPath = $portfolioDir . '/' . $imageName;
        
        // Check if file already exists
        if (file_exists($targetPath)) {
            $uploadError = "Error: The image already exists.";
        } else {
            // Move the uploaded file to the portfolio directory
            if (move_uploaded_file($image['tmp_name'], $targetPath)) {
                $uploadError = "Success: Image uploaded.";
            } else {
                $uploadError = "Error: Failed to upload image.";
            }
        }
    } else {
        $uploadError = "Error: " . $image['error'];
    }
}

// Fetch the uploaded images for display
$projectImages = scandir($portfolioDir);
$projectImages = array_diff($projectImages, array('.', '..')); // Remove '.' and '..' from the list
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Portfolio</title>
    <style>
        /* Your CSS styles */
        body {
            font-family: 'Arial';
            background: url('pics/bg.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            position: relative;
        }

        .left-buttons {
            position: absolute;
            top: 20px;
            left: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .left-buttons button {
            background-color: #ff99cc;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 10px;
            cursor: pointer;
            width: 120px;
            font-size: 14px;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .left-buttons button:hover {
            background-color: #ff66b3;
        }

        .container {
            width: 90%; /* Adjust width */
            max-width: 1200px;
            height: auto;
            max-height: 600px;
            background: rgba(250, 250, 250, 0.8);
            padding: 30px;
            border-radius: 25px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin: 20px auto;
            overflow-y: auto;
        }

        .project-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin-top: 40px;
        }

        .project {
            width: 250px;
            text-align: center;
            padding: 15px;
            border-radius: 10px;
            border: 5px solid #ddd;
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .project img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }

        .project textarea {
            width: 90%;
            height: 150px;
            margin-top: 10px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 14px;
            resize: vertical;
        }

        .project button {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #ff99cc;
            color: white;
            border: none;
            border-radius: 7px;
            cursor: pointer;
        }

        .project button:hover {
            background-color: #ff66b3;
        }

        .upload-container {
            margin-top: 20px;
        }

        .upload-container input[type="file"] {
            padding: 10px;
        }

        .upload-container button {
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #ff99cc;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .upload-container button:hover {
            background-color: #ff66b3;
        }

        .upload-status {
            margin-top: 10px;
            font-weight: bold;
            color: #ff6666;
        }
    </style>
</head>
<body>

    <div class="left-buttons">
        <a href="index.php"><button>Home</button></a>
    </div>

    <div class="container">
        <h1>My Portfolio</h1>

        <div class="upload-container">
            <form method="post" enctype="multipart/form-data">
                <input type="file" name="upload_image" required>
                <button type="submit">Upload Image</button>
            </form>
            <div class="upload-status"><?php echo $uploadError; ?></div>
        </div>

        <form method="post">
            <div class="project-container">
                <?php
                foreach ($projectImages as $index => $image) {
                    $description = isset($descriptions[$index]) ? $descriptions[$index] : 'This is my project from my first year';
                ?>
                    <div class="project">
                        <img src="<?php echo $portfolioDir . '/' . $image; ?>" alt="Project Image">
                        <textarea name="description_<?php echo $index; ?>" placeholder="Edit project description..."><?php echo htmlspecialchars($description); ?></textarea>
                    </div>
                <?php } ?>
            </div>
            <button type="submit" name="save_description">Save Descriptions</button>
        </form>
    </div>

</body>
</html>
