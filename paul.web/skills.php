<?php
$skills = @file('skills.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
if ($skills === FALSE) {
    $skills = ["Error: Unable to load skills."];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Skills - John Paul Oliva</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <header>
        <h1>My Skills</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About Me</a></li>
                <li><a href="projects.php">Projects</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="skills-list">
            <h2>Skills Overview</h2>
            <p>Technical Skills
                 Programming Languages:
                - HTML
                - CSS
                - JavaScript
                - PHP
                - SQL

                 Frameworks and Libraries:
                - Bootstrap
                - jQuery
                - React

                 Tools and Technologies:
                - Git (Version Control)
                - XAMPP (Local Development)
                - APIs (RESTful services)
                - MySQL (Database Management)

                  Web Development Concepts:
                - Responsive Design
                - User Experience (UX) Design
                - Search Engine Optimization (SEO)
                - Testing and Debugging


                Soft Skills
                 Interpersonal Skills:
                - Effective Communication
                - Team Collaboration
                - Active Listening

                 Problem-Solving Skills:
                - Critical Thinking
                - Adaptability to Change

                 Project Management:
                - Time Management
                - Organization and Planning

                 Creativity:
                - Innovative Thinking
                - Visual Design Sensibility
            </p>
            <ul>
            </ul><!-- End of skills list -->
        </section><!-- End of skills section -->
    </main>

    <footer>
        <p>&copy; 2024 John Paul Oliva. All rights reserved.</p><!-- Copyright notice -->
    </footer>

</body>

</html>