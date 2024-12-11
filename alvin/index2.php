<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <div class="navbar">
        <ul>
            <li><a href="index.php" class="active">HOME</a></li>
            <li><a href="about.php">ABOUT ME</a></li>
            <li><a href="My portfolio.php">MY PORTFOLIO</a></li>
            <li><a href="skills.php">SKILLS</a></li>
            <li><a href="index2.php">CONTACT ME</a></li>
        </ul>
    </div>

    <section id="contact">
        <div class="contact-container">
            <!-- Contact Information -->
            <div class="contact-info">
                <h2>Contact Information</h2>
                <p><strong>Address:</strong> Longos Central, San Fabian, Pangasinan</p>
                <p><strong>Phone:</strong> (060) 444-434-444</p>
                <p><strong>Email:</strong> <a href="mailto:chat@simone.com">pogisialvin@gmail.com</a></p>
            </div>

            <!-- Contact Form -->
            <div class="contact-form">
                <h2>Send Us a Note</h2>
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
</html>

<?php
// Include the footer
include 'includes/footer.php';
?>

