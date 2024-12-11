<?php
// File to store submissions
$submissionsFile = 'submissions/contact_submissions.txt';

// Ensure the directory exists
if (!is_dir('submissions')) {
    mkdir('submissions', 0755, true);
}

// Error handling
$errors = [];

// Process the form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));
    $attachmentPath = '';

    // Validate required fields
    if (empty($name)) $errors[] = "Name is required.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email address.";
    if (empty($message)) $errors[] = "Message is required.";

    // Handle file upload if provided
    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['attachment'];
        $uploadDir = 'submissions/uploads/';
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf'];
        $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        // Ensure upload directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        if (!in_array($fileExtension, $allowedExtensions)) {
            $errors[] = "File type not allowed. Only JPG, PNG, and PDF files are allowed.";
        } else {
            $attachmentPath = $uploadDir . time() . '_' . basename($file['name']);
            if (!move_uploaded_file($file['tmp_name'], $attachmentPath)) {
                $errors[] = "Failed to upload the file.";
            }
        }
    }

    // If no errors, save the submission
    if (empty($errors)) {
        $submission = "Name: $name\nEmail: $email\nMessage: $message\n";
        if (!empty($attachmentPath)) {
            $submission .= "Attachment: $attachmentPath\n";
        }
        $submission .= "---------------------\n";

        if (file_put_contents($submissionsFile, $submission, FILE_APPEND)) {
            echo "<script>alert('Your message has been sent successfully!'); window.location.href='index.php';</script>";
        } else {
            $errors[] = "Failed to save the submission.";
        }
    }
}

// If there are errors, display them
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<script>alert('$error'); window.location.href='index.php';</script>";
    }
}
?>

