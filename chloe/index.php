<?php
$title = "WEBSITE PORTFOLIO";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <title><?php echo $title; ?></title>
 
</head>
<body>
    <nav>
        <div class="nav-container">
            <div class="logo" data-aos="zoom-in" data-aos-duration="1500">
                CHLOE <span>ELLAMIL</span>
            </div>
            <div class="links">
                <div class="link" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="100"><a href="#">Home</a></div>
                <div class="link" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="200"><a href="#about">About</a></div>
                <div class="link" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="300"><a href="#skills">Skills</a></div>
                <div class="link" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="500"><a href="#contact">Contact</a></div>
            </div>
            <i class="fa-solid fa-bars hamburg" onclick="hamburg()"></i>
        </div>
        <div class="dropdown">
            <div class="links">
                <a href="#">Home</a>
                <a href="#about">About</a>
                <a href="#skill">Skills</a>
                <a href="#">Contact</a>
                <i class="fa-solid fa-xmark cancel" onclick="cancel()"></i>
            </div>
        </div>
    </nav>
    <section class="home">
        <div class="main-container">
            <div class="image" data-aos="zoom-out" data-aos-duration="3000">
                <img src="pics/myme.jpg" alt="Profile Image">
            </div>
            <div class="content">
                <h1 data-aos="fade-left" data-aos-duration="1500" data-aos-delay="700">Hey I'm <span>Klowi!</span></h1>
                <div class="typewriter" data-aos="fade-right" data-aos-duration="1500" data-aos-delay="900">
                    <span class="typewriter-text"></span><label for="">|</label>
                </div>
                <p data-aos="flip-down" data-aos-duration="1500" data-aos-delay="1100">
                    Hola! My name is Chloe, 19 years of age and I live in San Fabian Pangasinan. Wanna know more about me? Feel free to browse here^^
                </p>
                <div class="social-links">
                    <a href="https://github.com/yumichvz" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="1300"><i class="fa-brands fa-github"></i></a>
                    <a href="https://www.facebook.com/itsmeklowii" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="1400"><i class="fa-brands fa-facebook"></i></a>
                    <a href="https://www.linkedin.com/in/chloe-ellamil-004309295/" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="1500"><i class="fa-brands fa-linkedin"></i></a>
                    <a href="https://twitter.com/callmearistia" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="1600"><i class="fa-brands fa-twitter"></i></a>
                </div>
                <div class="btn" data-aos="zoom-in" data-aos-duration="1500" data-aos-delay="1800">
                    <a href="/index.html" style="text-decoration: none;">
                        <button>Go To the landing page</button>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="about">
        <img class="img" src="pics/klow.jpg" alt="Chloe Ellamil's Picture" data-aos="fade-up" data-aos-delay="100">
        <div>
            <h2>About Me</h2>
            <?php
                // Path to the text file
                $file = 'aboutme.txt';

                // Error handling for reading file
                if (file_exists($file)) {
                    $content = file_get_contents($file);
                    if ($content === false) {
                        echo "<p style='color: red;'>There was an error loading the content. Please try again later.</p>";
                    } else {
                        echo "<p data-aos='fade-up' data-aos-delay='100'>" . nl2br(htmlspecialchars($content)) . "</p>";
                    }
                } else {
                    echo "<p style='color: red;'>The about me content is unavailable. Please try again later.</p>";
                }
            ?>
        </div>
        <div class="edit">
            <a href="edit_aboutme.php">Edit</a>
        </div>
    </section>

    <section id="skills" class="skills">
        <h2 data-aos="fade-up" data-aos-delay="100">My Skills</h2>
        <div class="skills-list">
            <div class="skill-card" data-aos="fade-up" data-aos-delay="100">
                <i class='bx bx-street-view'></i>
                <h3>Leadership</h3>
            </div>
            <div class="skill-card" data-aos="fade-up" data-aos-delay="200">
                <i class='bx bx-hard-hat'></i>
                <h3>Creativity</h3>
            </div>
            <div class="skill-card" data-aos="fade-up" data-aos-delay="300">
                <i class='bx bxs-donate-heart'></i>
                <h3>Active listener</h3>
            </div>
            <div class="context">
                <?php
                    // Path to the text file
                    $file = 'skill.txt';

                    // Error handling for reading file
                    if (file_exists($file)) {
                        $content = file_get_contents($file);
                        if ($content === false) {
                            echo "<p style='color: red;'>There was an error loading the skill content. Please try again later.</p>";
                        } else {
                            echo "<p data-aos='fade-up' data-aos-delay='100'>" . nl2br(htmlspecialchars($content)) . "</p>";
                        }
                    } else {
                        echo "<p style='color: red;'>The skill content is unavailable. Please try again later.</p>";
                    }
                ?>
            </div>
            <div class="edit" data-aos="fade-up" data-aos-delay="100">
                <a href="edit_skill.php">Edit</a>
            </div>
        </div>
    </section>

    <section id="contact" class="section-contact">
        <div class="contact-container">
            <!-- Contact Info Section -->
            <div class="contact-info" data-aos="fade-up" data-aos-delay="100">
                <img src="pics/klowi.jpg" alt="Your Picture" class="contact-image" data-aos="fade-up" data-aos-delay="100">
                <p>
                    <strong>Address:</strong><br>Binday, San Fabian Pangasinan<br><br>
                    <strong>Email:</strong><br>ellamilchloe@gmail.com<br><br>
                    <strong>Number:</strong><br>09922833801<br>
                </p>
            </div>
            <!-- Contact Form Section -->
            <div class="contact-form-container" data-aos="fade-up" data-aos-delay="100">
                <h2>Contact Me</h2>
                <form action="save_msg.php" method="post" class="contact-form">
                    <input type="text" name="name" placeholder="Your Name" required>
                    <input type="email" name="email" placeholder="Your Email" required>
                    <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
                    <button type="submit">Send Message</button>
                </form>
            </div>
        </div>
    </section>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({ offset: 0 });
    </script>
    <script src="script.js"></script>
</body>
</html>
