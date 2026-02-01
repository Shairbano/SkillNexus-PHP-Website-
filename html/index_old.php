 
<!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>SkillNexus</title>
   <link rel="stylesheet" href="/NUST/Portal/css/style.css" type="text/css">
 </head>
 <body>
   <?php
       include_once "../php/header.php";
   ?>
       <h2 style="text-align:center;font-weight:bold;font-size:40px;color:green;margin-top:50px;">Welcome to the SkillNexus Portal</h2>
       <h3 style="text-align:center;font-size:25px;color:black;margin-top:10px;margin-bottom:5px;">Short, action-oriented, and emphasizes the benefit for both user groups.</h3>
      <div class="content" >
        <div style="width: 800px; margin:10px; padding:10px; font-size: 20px;border:solid;color:green"class="hover-img">
         
    <p style="margin:2px;">Established in 2019, SkillNexus has grown into a dynamic platform dedicated to 
      connecting industry, innovation, and education. Designed to foster collaboration 
      and technological advancement, SkillNexus provides a supportive environment equipped 
      with modern digital tools and resources. The platform brings together renowned organizations,
       industry leaders, and emerging innovators to collaborate across multiple sectors, driving growth
        and contributing to the development of cutting-edge solutions and professional networks.</p>
          <br>
          <br>
          <br>
          <button style="padding:10px; font-size:20px; background-color:darkgreen; color:white; border:none; border-radius:5px; cursor:pointer;margin-bottom:100px">
            <a href="/NUST/Portal/html/about_us.php" style="text-decoration:none; color:white;" >About Us</a>
        </div>
        <div style=" border-style: solid; border-width: 5px; border-color: green;margin:20px;padding:5px;"class="hover-img">
          <img src="/NUST/Portal/assets/Nust Ecosystem.webp" alt="NSTP Campus" style="width:570px; height:380px;">
        </div>
</div>
 <div class="hero-section" style="margin-bottom: 50px;">
  <h1 style="margin-bottom:100px"> Partner Connect</h1>
  <p class="tagline"style="margin-bottom:100px">
    Connect with Industry and Educational Partners easily. Browse Categories, Apply for affiliation,
    and Grow your Network.
  </p>
  <div class="hero-buttons">
    <a href="/NUST/Portal/html/categories.php" class="hero-btn">Browse Categories</a>
    <a href="/NUST/Portal/php/affiliation.php" class="hero-btn">Apply for Affiliation</a>
    <?php
        // Show login button only if user not logged in
        if(!isset($_SESSION['user_id'])) {
            echo '<a href="/NUST/Portal/php/login.php" class="hero-btn">Login</a>';
        }
        ?>
    </div>
</div>
 </div>
 <h2 style="text-align:center;font-weight:bold;font-size:40px;color:green;margin-top:10px;margin-bottom:10px;">How It Works</h2>
<div class="work">
  <div style="margin: 50px;padding:50px;width:300px;border-style: solid; border-width: 10px; border-color:white;"class="hover-img">
    <h3 style="font-size:30px;color:white;text-align:center;margin-bottom: 5px;"> Browse Categories</h3>
    <p style="font-size:20px;color:white;">
      Explore various industry and educational categories
       to find potential partners that align with your goals.
      </p>
  </div>
  <div style="margin: 50px;padding:50px;width:300px;border-style: solid; border-width: 10px; border-color: white;"class="hover-img">
    <h3 style="font-size:30px;color:white;text-align:center;margin-bottom: 5px;"> Apply for Affiliation</h3>
    <p style="font-size:20px;color:white;">
      Submit your application to become an affiliated partner
       and gain access to exclusive resources and networking opportunities.
      </p>
      </div>
  <div style="margin: 50px;padding:50px;width:300px;border-style: solid; border-width: 10px; border-color: white;"class="hover-img">
    <h3 style="font-size:30px;color:white;text-align:center;margin-bottom: 5px;"> Grow your Network</h3>
    <p style="font-size:20px;color:white;">
      Connect with like-minded organizations and individuals
       to foster collaboration and drive innovation together.
      </p>
  </div>
</div>


   <?php
   include_once '../php/footer.php';
   ?>

   
 </body>
 </html>