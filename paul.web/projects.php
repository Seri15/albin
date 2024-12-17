<?php
// Attempt to read the content from projects.txt
$projects = @file('projects.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Check if there was an error reading the file
if ($projects === FALSE) {
    $projects = ["Error: Unable to load projects."];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Projects - John Paul Oliva</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .projects-grid {
            display: flex;
            justify-content: center;
            /* Centers the items horizontally */
            gap: 20px;
            /* Adds space between the project items */
            flex-wrap: nowrap;
            /* Prevents wrapping to a new line */
        }

        .project {
            text-align: center;
            /* Centers the content within each project */
            max-width: 200px;
            /* Limits the width of each project for better alignment */
        }

        .project img {
            width: 150px;
            /* Ensures consistent image size */
            height: auto;
            display: block;
            margin: 0 auto;
            /* Centers the image */
        }

        @media (max-width: 600px) {
            .projects-grid {
                flex-wrap: wrap;
                /* Allows items to wrap */
            }

            .project {
                max-width: 100%;
                /* Each project takes full width */
            }
        }
    </style>
</head>

<body>
    <header>
        <h1>My Projects</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About Me</a></li>
                <li><a href="skills.php">Skills</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
    <section class="projects" id="projects">
    <h1 class="heading">My <span>Projects</span></h1>

    <div class="box-container">

        <!-- Project 1 -->
        <div class="box">
            <div class="image">
                <img src="nwa.jpg" alt="Project 1">
            </div>
            <div class="content">
                <h3>FINAL PROJECT DEFENSE</h3>
                <p>Final Project Defense
                For my first HTML project, I created a Sign-Up Form. This form included input fields for essential user information such as name, email, and password, along with buttons for submission and resetting the form.</p>
            </div>
        </div>

        <!-- Project 2 -->
        <div class="box">
            <div class="image">
                <img src="sss.jpg" alt="Project 2">
            </div>
            <div class="content">
                <h3>GAME PROJECT</h3>
                <p>Minesweeper is a classic single-player puzzle game where players navigate a grid containing hidden mines. The objective is to clear the board by uncovering safe squares while avoiding mines. Each square reveals a number indicating how many mines are adjacent to it, guiding players in their strategy. Players can flag suspected mines and must deduce safe squares based on the revealed numbers. The game features three difficulty levels: Beginner (8x8 grid with 10 mines), Intermediate (16x16 with 40 mines), and Expert (30x16 with 99 mines)</p>
            </div>
        </div>

        <!-- Project 3 -->
        <div class="box">
            <div class="image">
                <img src="sfsf.jpg" alt="Project 3">
            </div>
            <div class="content">
                <h3>PROGRAMMING PROJECT</h3>
                <p>This is my output in lab activity, the program first reports that the stock of "The Great Gatsby" book has been updated with 50 arguments. This suggests that the program has the ability to update the inventory levels of specific books, this was already working.</p>
            </div>
        </div>

    </div>
</section>
    </main>

    <footer>
        <p>&copy; 2024 John Paul Oliva. All rights reserved.</p><!-- Copyright notice -->
    </footer>

</body>

</html>