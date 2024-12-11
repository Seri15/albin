<?php
$portfolioDir = "portfolio_files"; 
$projectDescriptionsFile = "project_descriptions.txt"; 

if (!file_exists($projectDescriptionsFile)) {
    $defaultDescriptions = [];
    file_put_contents($projectDescriptionsFile, implode("\n", $defaultDescriptions));
}

$descriptions = file($projectDescriptionsFile, FILE_IGNORE_NEW_LINES);
if ($descriptions === false) {
    die("Error: Unable to read descriptions file.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_description'])) {
    $indexToUpdate = $_POST['save_description']; 
    $updatedDescription = $_POST['description_' . $indexToUpdate];

    $descriptions[$indexToUpdate] = $updatedDescription;

    if (file_put_contents($projectDescriptionsFile, implode("\n", $descriptions)) === false) {
        die("Error: Unable to save updated descriptions.");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_description'])) {
    $indexToDelete = $_POST['delete_description']; 

    unset($descriptions[$indexToDelete]);
    $descriptions = array_values($descriptions);

    if (file_put_contents($projectDescriptionsFile, implode("\n", $descriptions)) === false) {
        die("Error: Unable to delete description.");
    }
}

$uploadError = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['upload_image'])) {
    $image = $_FILES['upload_image'];

    if ($image['error'] === UPLOAD_ERR_OK) {
        $imageName = basename($image['name']);
        $targetPath = $portfolioDir . '/' . $imageName;

        
        if (file_exists($targetPath)) {
            unlink($targetPath); 
        }
        if (move_uploaded_file($image['tmp_name'], $targetPath)) {
            $uploadError = "Success: Image uploaded.";
        } else {
            $uploadError = "Error: Failed to upload image.";
        }
    } else {
        $uploadError = "Error: " . $image['error'];
    }
}

if ($_SERVER["REQUEST_METHOD"] === 'POST' && isset($_POST['delete_image'])) {
    $imageToDelete = $_POST['delete_image'];
    $targetPath = $portfolioDir . '/' . $imageToDelete;

    if (file_exists($targetPath)) {
        unlink($targetPath); 
        $uploadError = "Success: Image deleted.";
    } else {
        $uploadError = "Error: Image not found.";
    }
}

$projectImages = scandir($portfolioDir);
$projectImages = array_diff($projectImages, array('.', '..')); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Portfolio</title>
    <style>

        body {
            font-family: Arial, sans-serif;
            background: url('pics/bg.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        .left-buttons {
            position: absolute;
            top: 15px;
            left: 10px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .left-buttons button {
            background-color: white;
            color: black;
            border: none;
            padding: 10px 15px;
            border-radius: 10px;
            cursor: pointer;
            width: 120px;
            font-size: 16px;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .left-buttons button:hover {
            background-color: gray;
        }

        .container {
            width: 90%; 
            max-width: 1000px; 
            height: auto; 
            max-height: 450px; 
            background: rgba(250, 250, 250, 0.8);
            padding: 30px;
            border-radius: 25px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin: 20px auto; 
            overflow-y: auto;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 40px;
        }

        .upload-container {
            margin-top: 25px;
        }

        .upload-container input[type="file"] {
            padding: 10px;
        }

        .upload-container button {
            margin-top: 15px;
            padding: 10px 20px;
            background-color: black;
            color: white;
            border: none;
            border-radius: 15px;
            cursor: pointer;
        }

        .upload-container button:hover {
            background-color: gray;
        }

        .upload-status {
            margin-top: 10px;
            font-weight: bold;
            color: black;
        }

        .project-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(235px, 1fr));
            gap: 20px;
            margin-top: 40px;
        }

        .project {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .project img {
            width: 100%;
            height: 175px;
            object-fit: cover;
            border-radius: 10px;
        }

        .project textarea {
            width: 90%;
            height: 135px;
            margin-top: 10px;
            padding: 10px;
            border-radius: 5px;
            border: 5px solid #ddd;
            font-size: 14px;
            resize: vertical;
        }

        .project button {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: black;
            color: white;
            border: none;
            border-radius: 15px;
            cursor: pointer;
        }

        .project button:hover {
            background-color: gray;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            .project-container {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 480px) {
            .project-container {
                grid-template-columns: 1fr;
            }

            h1 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>

    <div class="left-buttons">
        <a href="index.php"><button>Home</button></a>
    </div>

    <div class="container">
        <h1>Chloe's Portfolio</h1>

        <div class="upload-container">
            <form method="post" enctype="multipart/form-data">
                <input type="file" name="upload_image" required>
                <button type="submit">Upload New Image</button>
            </form>
            <div class="upload-status"><?php echo $uploadError; ?></div>
        </div>
        <form method="post">
            <div class="project-container">
                <?php
                foreach ($projectImages as $index => $image) {
                    $description = isset($descriptions[$index]) ? $descriptions[$index] : ''; 
                ?>
                    <div class="project">
                        <img src="<?php echo $portfolioDir . '/' . $image; ?>" alt="Project Image">
                        <textarea name="description_<?php echo $index; ?>" placeholder="Enter the description..."><?php echo htmlspecialchars($description); ?></textarea>
                        <button type="submit" name="save_description" value="<?php echo $index; ?>">Save</button>
                        <button type="submit" name="delete_description" value="<?php echo $index; ?>">Delete Description</button>
                        <form method="post" style="display: inline;">
                            <button type="submit" name="delete_image" value="<?php echo $image; ?>">Delete Image</button>
                        </form>
                    </div>
                <?php } ?>
            </div>
        </form>
    </div>

</body>
</html>
