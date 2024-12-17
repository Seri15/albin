<?php
$content = @file_get_contents('about.txt');
if ($content === FALSE) {
    $content = "Error: Unable to load content."; // Fallback message if file not found.
}

// Variables for dynamic image adjustments
$imageSrc = "https://i.imgur.com/Y9sRQOM.jpeg";
$imageWidth = 100; // Image width in pixels
$imageBorderRadius = 30; // Border radius percentage for circular effect
$imageBoxShadow = "0 4px 8px rgba(0, 0, 0, 0.0)"; // Shadow styling
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>About Me - John Paul Oliva</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <h1>About Me</h1>
        <!-- Dynamically adjusted image -->
        <img src="<?php echo htmlspecialchars($imageSrc); ?>" alt="John Paul Oliva" style="
                width: <?php echo $imageWidth; ?>px; 
                height: auto; 
                border-radius: <?php echo $imageBorderRadius; ?>%; 
                display: block; 
                margin: 20px auto; 
                box-shadow: <?php echo $imageBoxShadow; ?>;
            ">
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="projects.php">Projects</a></li>
                <li><a href="skills.php">Skills</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="bio">
            <h2>Biography</h2>
            <p>Hello! My name is John Paul Oliva, and I am an enthusiastic student pursuing a degree in Information
                Technology. I have a strong passion for technology and its applications in solving real-world problems.

                Biography:
                Currently, I am studying at Universidad De Dagupan, where I am gaining valuable knowledge in various
                aspects of Information Technology, including networking, cybersecurity, and software development.
                Throughout my academic journey, I have participated in several projects that have enhanced my skills in
                programming languages such as Python, Java, and SQL.

                I enjoy collaborating with classmates on group assignments and participating in hackathons to challenge
                myself and learn new technologies. My goal is to leverage my skills to contribute to innovative IT
                solutions that improve efficiency and security.

                Interests:
                - Web Development
                - Cybersecurity
                - Data Analysis
                - Cloud Computing

                In my spare time, I love exploring tech blogs, working on personal coding projects, and volunteering for
                community tech initiatives.</p>
        </section>

        <section id="background">
            <h2>Background</h2>
            <p>I’m currently a college student at Universidad De Dagupan where I’m pursuing my degree in Information
                Technology (IT). My journey into the world of technology began at ABC High School, where I discovered my
                passion for the field through engaging information technology classes.

                During my time in college, I’ve had the opportunity to participate in internships at local tech
                companies. These experiences have allowed me to contribute to real-world software development projects
                while learning about project management and the dynamics of teamwork. Each internship has not only
                reinforced my desire to build a career in IT but has also provided me with practical skills that
                complement my academic studies. I’m excited to continue growing and exploring new opportunities in the
                tech industry!
            </p>
        </section>

        <section id="skills-experience">
            <h2>Skills and Experience</h2>
            <ul>
                <li>Proficient in HTML, CSS, JavaScript, and PHP.</li>
            </ul>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 John Paul Oliva. All rights reserved.</p>
    </footer>
</body>

</html>