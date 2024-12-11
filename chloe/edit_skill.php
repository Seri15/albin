<?php
// Path to the text file
$file = 'skill.txt';

// Initialize an error message variable
$errorMessage = "";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the new content from the form
    $newContent = $_POST['content'];

    // Check if the content is empty
    if (trim($newContent) === '') {
        // Set an error message if the content is empty
        $errorMessage = "The content cannot be empty. Please enter some text.";
    } else {
        // Save the new content to the text file
        file_put_contents($file, $newContent);

        // Redirect to avoid resubmission on page refresh
        header("Location: edit_skill.php");
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
        /* General Body Styling */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: white(135deg, #6863D9, #D4D963);
            color: #333;
        }

        .edit-container {
            width: 80%;
            max-width: 600px;
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h1 {
            font-size: 25px;
            color: black;
            margin-bottom: 20px;
            text-shadow: 1px 1px 2px #999;
        }

        .error-message {
            color: red;
            font-weight: bold;
            margin-bottom: 10px;
        }

        textarea {
            width: 95%;
            height: 150px;
            font-size: 18px;
            margin: 15px 0;
            padding: 15px;
            border: 4px solid black;
            border-radius: 10px;
            background-color: white;
            box-shadow: 4px 4px 5px rgba(0, 0, 0, 0.1);
            resize: none;
        }

        button {
            background-color: black;
            color: white;
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
            color: black;
            font-weight: bold;
            border-bottom: 2px solid transparent;
            transition: border-bottom 0.3s ease, color 0.3s ease;
        }

        a:hover {
            color: black;
            border-bottom: 5px solid #3B3780;
        }
    </style>
</head>

<body>
    <div class="edit-container">
        <h1>Edit Skills</h1>

        <!-- Display error message if exists -->
        <?php if (!empty($errorMessage)) : ?>
            <p class="error-message"><?php echo htmlspecialchars($errorMessage); ?></p>
        <?php endif; ?>

        <!-- Form to submit new content -->
        <form method="post" id="editForm">
            <textarea name="content"><?php echo htmlspecialchars($currentContent); ?></textarea>
            <button type="submit">Save</button>
        </form>

        <a href="index.php">Go Back</a>
    </div>

    <script>
        // JavaScript to show alert when the form is empty
        document.getElementById("editForm").onsubmit = function(event) {
            var content = document.querySelector("textarea[name='content']").value.trim();
            
            if (content === "") {
                // Prevent form submission
                event.preventDefault();
                
                // Show the error alert with a single "OK" button
                alert("The content cannot be empty. Please enter some text.");
            }
        };
    </script>
</body>

</html>
