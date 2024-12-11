<?php  
$contactFile = "contact.txt"; // File to store Facebook, Email, and Phone contact info

// Load contact info from contact.txt file
$contactContent = file_exists($contactFile) ? file_get_contents($contactFile) : "Facebook: Ashdecano\nEmail: ashliedecano@gmail.com\nPhone: 099999999";
$contactFields = explode("\n", $contactContent);
$facebookContact = isset($contactFields[0]) ? str_replace("Facebook: ", "", $contactFields[0]) : "";
$emailContact = isset($contactFields[1]) ? str_replace("Email: ", "", $contactFields[1]) : "";
$phoneContact = isset($contactFields[2]) ? str_replace("Phone: ", "", $contactFields[2]) : "";

// File to store submissions<?php
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
            echo "<script>alert('Your message has been sent successfully!');</script>";
        } else {
            $errors[] = "Failed to save the submission.";
        }
    }
}

// If there are errors, display them
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<script>alert('$error'); </script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="assets/about.css">
</head>
<style>
    body {
        background-image: url('images/white.jpg');
        background-size: cover;
        background-attachment: fixed;
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
        <h1>Contact Information</h1>
        <p><strong>Facebook:</strong> <?php echo htmlspecialchars($facebookContact); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($emailContact); ?></p>
        <p><strong>Phone:</strong> <?php echo htmlspecialchars($phoneContact); ?></p>
        <a href="edit.php" class="edit-button">Edit</a>
    </div>

   
            <!-- Contact Form -->
            <div class="contact-form">
                <h2>Drop Us a Message</h2>
                <form action="contact.php" method="POST" enctype="multipart/form-data">
                    <!-- Improved Name and Email Fields -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" placeholder="Enter your name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Enter your email" required>
                        </div>
                    </div>
                    
                    <!-- Message Field -->
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="5" placeholder="Tell us more about your needs..." required></textarea>
                    </div>
                    
                    <!-- File Upload Field -->
                    <div class="form-group">
                        <label for="attachment">Upload File</label>
                        <input type="file" id="attachment" name="attachment" accept=".jpg, .jpeg, .png, .pdf">
                    </div>
                    
                    <!-- Submit Button -->
                    <button type="submit">Send Message</button>
                </form>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.navbar ul li a');

            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    // Remove the active class from all links
                    navLinks.forEach(nav => nav.classList.remove('active'));

                    // Add the active class to the clicked link
                    this.classList.add('active');
                });
            });
        });
    </script>
</body>
<footer>&copy; <?php echo date("Y"); ?> Ashlie Jhea Decano</footer>
</html>
