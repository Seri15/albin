<?php
// Path to the text file
$file = 'aboutme.txt';

// Initialize an error message variable
$errorMessage = "";

// Initialize a variable to hold the content entered by the user
$newContent = "";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the new content from the form
    $newContent = $_POST['content'];

    // Check if the content is empty
    if (trim($newContent) === '') {
        // Set an error message if the content is empty
        $errorMessage = "Please enter some text before saving.";
    } else {
        // Save the new content to the text file
        file_put_contents($file, $newContent);

        // Redirect to avoid resubmission on page refresh
        header("Location: edit_aboutme.php");
        exit();
    }
}

// Read the current content from the text file
$currentContent = file_get_contents($file);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit About Me</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: solid black;
            color: #333;
        }
        .edit-container {
            width: 80%;
            max-width: 600px;
            background: black;
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h1 {
            font-size: 28px;
            color: white;
            margin-bottom: 20px;
            text-shadow: 1px 1px 2px #999;
        }

        .error-message {
            color: red;
            font-weight: bold;
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f8d7da;
            border-radius: 5px;
        }
        textarea {
            width: 85%;
            height: 150px;
            font-size: 20px;
            margin: 15px 0;
            padding: 10px;
            border: 2px solid #4A47A3;
            border-radius: 10px;
            background-color: #F9F9FF;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
            resize: none;
        }

        button {
            background-color: white;
            color: black;
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background-color: gray;
            transform: scale(1.05);
        }
        a {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            color: white;
            font-weight: bold;
            border-bottom: 2px solid transparent;
            transition: border-bottom 0.3s ease, color 0.3s ease;
        }

        a:hover {
            color: gray;
            border-bottom: 5px solid #3B3780;
        }
    </style>
</head>

<body>
    <div class="edit-container">
        <h1>Edit About Me</h1>

        <!-- Display error message if exists -->
        <?php if (!empty($errorMessage)) : ?>
            <p class="error-message"><?php echo htmlspecialchars($errorMessage); ?></p>
        <?php endif; ?>

        <!-- Form to submit new content -->
        <form method="post" id="editForm">
            <!-- Pre-fill textarea with the content typed by the user (or the content from the file if it's the first time) -->
            <textarea name="content" id="content"><?php echo htmlspecialchars($newContent); ?></textarea>
            <button type="submit">Save</button>
        </form>

        <a href="index.php">Go Back</a>
    </div>

    <script>
        // JavaScript to check if the form is empty before submission
        document.getElementById("editForm").onsubmit = function(event) {
            var content = document.getElementById("content").value.trim();
            
            if (content === "") {
                // Prevent form submission
                event.preventDefault();

                // Show confirmation to ensure user wants to submit empty content
                if (!confirm("You haven't entered any text. Do you still want to continue?")) {
                    // If user cancels, the form won't be submitted
                    return false;
                }
            }
        };
    </script>
</body>

</html>
