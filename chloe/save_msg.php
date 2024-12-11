<?php
// Path to the file where messages will be saved
$file = 'msgs.txt';

// Initialize error messages
$errorMessage = "";

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and sanitize the form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Check for empty fields
    if (empty($name) || empty($email) || empty($message)) {
        $errorMessage = "All fields are required. Please fill in your name, email, and message.";
    }

    // Validate email format
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "Please enter a valid email address.";
    }

    // If there are no errors, format the message and save it to the file
    elseif (empty($errorMessage)) {
        // Format the message for storage
        $formattedMessage = "Name: $name\nEmail: $email\nMessage:\n$message\n-----------------------------\n";

        // Try to append the message to the file
        if (file_put_contents($file, $formattedMessage, FILE_APPEND) === false) {
            $errorMessage = "There was an error saving your message. Please try again later.";
        } else {
            // Redirect to a thank-you page or back to the contact page
            header("Location: index.php?status=success");
            exit();
        }
    }
}

// If there are errors, display them
if (!empty($errorMessage)) {
    echo "<p style='color: red; font-weight: bold;'>$errorMessage</p>";
}
?>
