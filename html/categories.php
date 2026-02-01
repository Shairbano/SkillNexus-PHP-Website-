<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Categories</title>
    <link rel="stylesheet" href="/NUST/Portal/css/style.css" type="text/css">
    <link rel="stylesheet" href="/NUST/Portal/css/categories.css" type="text/css">
</head>

<body>
    <?php include_once '../php/header.php'; ?>
    <h2 style="text-align:center; font-weight:bold; font-size:40px; color:green; margin-top:50px;">
        Browse Categories
    </h2>
    <p style="text-align:center; color:black; font-size:18px; width:70%; margin:auto; margin-top:20px;margin-bottom:50px;font-size:28px">
        Explore a diverse range of categories and discover opportunities to connect, collaborate, and grow
        within the SkillNexus ecosystem. Whether you're an educational institute seeking partnerships or
        an industry professional looking to expand your network, our categories provide a gateway to
        meaningful affiliations and collaborations. Browse through our curated categories to find the
        perfect match for your goals and aspirations.

    <div class="categories-container">

        <!-- Educational Institutes -->
        <div class="category-card">
            <h3>Educational Institutes</h3>
            <p>
                Explore top educational institutions affiliated with SkillNexus. Connect with universities,
                colleges, and research centers to collaborate on innovative projects and research opportunities.
                Partner with leading academic experts to exchange knowledge, conduct joint studies, and develop
                cutting-edge solutions. Engage with a vibrant learning ecosystem that fosters innovation, skill
                development, and impactful research collaborations. Strengthen your academic network by working
                closely with institutions committed to excellence and growth.
            </p>
        </div>

        <!-- Industry Partners -->
        <div class="category-card">
            <h3>Industry Partners</h3>
            <p>
                Discover leading industry partners in technology, agriculture, aerospace, manufacturing, and more.
                Build professional relationships, apply for affiliations, and expand your network. Connect with
                top organizations to explore collaboration, innovation, and growth opportunities across diverse
                sectors. Access exclusive programs, resources, and support designed to help businesses and professionals
                thrive. Join a growing ecosystem where companies, experts, and entrepreneurs come together to drive
                impactful change.
            </p>
        </div>

    </div>

    <div class="hero-buttons" style="margin-top:30px;">
        <a href="/NUST/Portal/php/affiliation.php" class="hero-btn" style="background-color:darkgreen;color:white">Apply for Affiliation</a>
    </div>

    <!-- EMPLOYEE SECTION -->
    <h2 style="text-align:center; font-weight:bold; font-size:40px; color:green; margin-top:70px;">
        Become an Employee at NSTP
    </h2>

    <p style="text-align:center; color:black; font-size:18px; width:70%; margin:auto; margin-top:20px;border-style: solid; border-width: 20px; border-color: darkgreen; padding:15px; border-radius:10px;">
        Join the NSTP workforce and become part of a dynamic, innovative, and growth-oriented environment.
        As an employee, you will contribute to cutting-edge projects, work alongside industry and academic experts,
        and develop your professional skills through real-world opportunities. Whether you specialize in
        technology, research, design, engineering, or management — NSTP provides a platform where talent and vision meet.
    </p>

    <div class="hero-buttons" style="margin-top:30px; margin-bottom:50px;">
        <a href="/NUST/Portal/php/expertise.php" class="hero-btn"style="background-color:darkgreen;color:white">Register as Employee</a>
    </div>

    <?php include_once '../php/footer.php'; ?>
</body>
</html>
