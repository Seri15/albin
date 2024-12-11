<?php
include 'includes/header.php';


$skillsFile = 'data/skills.txt';


$defaultSkills = [
    'Technical Skills' => ['HTML5', 'CSS', 'JavaScript', 'PHP', 'MySQL', 'Java'],
    'Soft Skills' => ['Problem-Solving', 'Communication', 'Teamwork', 'Adaptability', 'Critical Thinking', 'Time Management']
];


if (!file_exists($skillsFile)) {
    $defaultContent = "Technical Skills:\n" . implode(", ", $defaultSkills['Technical Skills']) . "\n\n";
    $defaultContent .= "Soft Skills:\n" . implode(", ", $defaultSkills['Soft Skills']) . "\n";
    if (file_put_contents($skillsFile, $defaultContent) === false) {
        die("<p class='error'>Error: Unable to create the skills file. Please check file permissions.</p>");
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
    $technicalSkills = array_filter(array_map('trim', explode(',', $_POST['technical_skills'] ?? '')));
    $softSkills = array_filter(array_map('trim', explode(',', $_POST['soft_skills'] ?? '')));

 
    $skillsContent = "Technical Skills:\n" . implode(", ", $technicalSkills) . "\n\n";
    $skillsContent .= "Soft Skills:\n" . implode(", ", $softSkills) . "\n";

    
    if (file_put_contents($skillsFile, $skillsContent) === false) {
        echo "<p class='error'>Error: Unable to save skills. Please check file permissions.</p>";
    } else {
        echo "<p class='success'>Skills updated successfully!</p>";
    }
}


$skills = $defaultSkills;
if (file_exists($skillsFile)) {
    $fileContent = file_get_contents($skillsFile);
    $sections = explode("\n\n", $fileContent);
    foreach ($sections as $section) {
        $lines = explode("\n", $section);
        if (strpos($lines[0], 'Technical Skills') !== false) {
            $skills['Technical Skills'] = array_filter(array_map('trim', explode(', ', $lines[1] ?? '')));
        } elseif (strpos($lines[0], 'Soft Skills') !== false) {
            $skills['Soft Skills'] = array_filter(array_map('trim', explode(', ', $lines[1] ?? '')));
        }
    }
}
?>


<section id="skills" class="skills-section">
    <h2 class="section-title">MY SKILLS</h2>
    <div class="skills-container">
        <?php foreach ($skills as $category => $skillList): ?>
            <div class="skills-box">
                <h3 class="skills-category"><?php echo htmlspecialchars($category); ?></h3>
                <ul>
                    <?php foreach ($skillList as $skill): ?>
                        <li class="skill-item"><?php echo htmlspecialchars($skill); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>
    </div>
</section>


<section id="edit-skills" class="skills-section">
    <h2 class="section-title">Edit Skills</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="technical-skills">Technical Skills (comma-separated):</label>
            <textarea id="technical-skills" name="technical_skills" rows="4"><?php echo htmlspecialchars(implode(', ', $skills['Technical Skills'])); ?></textarea>
        </div>
        <div class="form-group">
            <label for="soft-skills">Soft Skills (comma-separated):</label>
            <textarea id="soft-skills" name="soft_skills" rows="4"><?php echo htmlspecialchars(implode(', ', $skills['Soft Skills'])); ?></textarea>
        </div>
        <button type="submit" class="btn-save">Save Skills</button>
    </form>
</section>

<?php

include 'includes/footer.php';
?>
