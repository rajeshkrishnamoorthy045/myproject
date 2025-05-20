<?php
session_start();
include('db_connect.php');

$isLoggedIn = false;
if (isset($_SESSION['client_logged_in']) && $_SESSION['client_logged_in'] == true) {
    $isLoggedIn = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Healyn- Professional Online Counseling</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    :root {
      --primary: #2a4365;
      --secondary: #4299e1;
      --accent: #f6ad55;
      --light: #ebf8ff;
      --dark: #1a365d;
      --text: #4a5568;
      --white: #ffffff;
    }

    /* General Styles */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Poppins', sans-serif;
      color: var(--text);
      line-height: 1.6;
      background-color: var(--light);
    }

    h1, h2, h3, h4 {
      font-family: 'Playfair Display', serif;
      color: var(--dark);
      font-weight: 600;
    }

    a {
      text-decoration: none;
      color: inherit;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
    }

    .btn {
      display: inline-block;
      padding: 12px 30px;
      background-color: var(--accent);
      color: var(--white);
      border-radius: 50px;
      font-weight: 500;
      transition: all 0.3s ease;
      border: none;
      cursor: pointer;
      text-align: center;
    }

    .btn:hover {
      background-color: var(--secondary);
      transform: translateY(-3px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .btn-outline {
      background: transparent;
      border: 2px solid var(--accent);
      color: var(--accent);
    }

    .btn-outline:hover {
      background: var(--accent);
      color: var(--white);
    }

    section {
      padding: 80px 0;
    }

    .section-title {
      text-align: center;
      margin-bottom: 60px;
    }

    .section-title h2 {
      font-size: 2.5rem;
      position: relative;
      display: inline-block;
    }

    .section-title h2::after {
      content: '';
      position: absolute;
      width: 70px;
      height: 3px;
      background-color: var(--accent);
      bottom: -15px;
      left: 50%;
      transform: translateX(-50%);
    }

    /* Header */
    header {
      background: linear-gradient(135deg, rgba(42, 67, 101, 0.9), rgba(66, 153, 225, 0.8)), url('images/counseling-bg.jpg');
      background-size: cover;
      background-position: center;
      color: var(--white);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 40px;
      background-color: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
    }

    .logo {
      font-size: 1.8rem;
      font-weight: 700;
      color: var(--white);
    }

    .logo span {
      color: var(--accent);
    }

    .nav-links {
      display: flex;
      list-style: none;
    }

    .nav-links li {
      margin-left: 30px;
    }

    .nav-links a {
      font-weight: 500;
      transition: color 0.3s;
      position: relative;
    }

    .nav-links a:hover {
      color: var(--accent);
    }

    .nav-links a::after {
      content: '';
      position: absolute;
      width: 0;
      height: 2px;
      background-color: var(--accent);
      bottom: -5px;
      left: 0;
      transition: width 0.3s;
    }

    .nav-links a:hover::after {
      width: 100%;
    }

    .hero-content {
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      padding: 0 20px;
    }

    .hero-content h1 {
      font-size: 3.5rem;
      margin-bottom: 20px;
      color: var(--white);
    }

    .hero-content p {
      font-size: 1.2rem;
      max-width: 700px;
      margin-bottom: 40px;
      color: rgba(255, 255, 255, 0.9);
    }

    .hero-btns {
      display: flex;
      gap: 20px;
    }

    /* Mobile Menu */
    .mobile-menu-btn {
      display: none;
      font-size: 1.5rem;
      cursor: pointer;
    }

    /* Features Section */
    .features {
      background-color: var(--white);
    }

    .features-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 30px;
    }

    .feature-card {
      background: var(--white);
      border-radius: 10px;
      padding: 30px;
      text-align: center;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .feature-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }

    .feature-icon {
      font-size: 3rem;
      color: var(--accent);
      margin-bottom: 20px;
    }

    .feature-card h3 {
      margin-bottom: 15px;
      font-size: 1.5rem;
    }

    /* Therapists Section */
    .therapists {
      background-color: var(--light);
    }

    .therapist-container {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 30px;
    }

    .therapist-card {
      background: var(--white);
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      transition: transform 0.3s;
    }

    .therapist-card:hover {
      transform: translateY(-10px);
    }

    .therapist-img {
      height: 250px;
      background-color: #ddd;
      background-size: cover;
      background-position: center;
    }

    .therapist-info {
      padding: 25px;
    }

    .therapist-info h3 {
      font-size: 1.4rem;
      margin-bottom: 10px;
      color: var(--primary);
    }

    .therapist-specialty {
      color: var(--secondary);
      font-weight: 500;
      margin-bottom: 15px;
      display: block;
    }

    .therapist-details {
      margin-bottom: 20px;
    }

    .therapist-details p {
      margin-bottom: 8px;
      font-size: 0.9rem;
    }

    .therapist-details i {
      color: var(--accent);
      margin-right: 8px;
      width: 20px;
    }

    /* Testimonials */
    .testimonials {
      background-color: var(--white);
    }

    .testimonial-slider {
      max-width: 800px;
      margin: 0 auto;
    }

    .testimonial {
      text-align: center;
      padding: 30px;
    }

    .testimonial-text {
      font-size: 1.2rem;
      font-style: italic;
      margin-bottom: 30px;
      position: relative;
    }

    .testimonial-text::before,
    .testimonial-text::after {
      content: '"';
      font-size: 3rem;
      color: var(--accent);
      opacity: 0.3;
      position: absolute;
    }

    .testimonial-text::before {
      top: -20px;
      left: -20px;
    }

    .testimonial-text::after {
      bottom: -40px;
      right: -20px;
    }

    .testimonial-author {
      font-weight: 600;
      color: var(--primary);
    }

    /* CTA Section */
    .cta {
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      color: var(--white);
      text-align: center;
    }

    .cta h2 {
      color: var(--white);
      margin-bottom: 20px;
    }

    .cta p {
      max-width: 700px;
      margin: 0 auto 40px;
      opacity: 0.9;
    }

    /* Footer */
    footer {
      background-color: var(--dark);
      color: var(--white);
      padding: 60px 0 20px;
    }

    .footer-content {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 40px;
      margin-bottom: 40px;
    }

    .footer-column h3 {
      color: var(--white);
      margin-bottom: 20px;
      font-size: 1.2rem;
    }

    .footer-links {
      list-style: none;
    }

    .footer-links li {
      margin-bottom: 10px;
    }

    .footer-links a {
      color: rgba(255, 255, 255, 0.7);
      transition: color 0.3s;
    }

    .footer-links a:hover {
      color: var(--accent);
    }

    .social-links {
      display: flex;
      gap: 15px;
    }

    .social-links a {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      background-color: rgba(255, 255, 255, 0.1);
      border-radius: 50%;
      transition: all 0.3s;
    }

    .social-links a:hover {
      background-color: var(--accent);
      transform: translateY(-3px);
    }

    .copyright {
      text-align: center;
      padding-top: 20px;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      color: rgba(255, 255, 255, 0.7);
      font-size: 0.9rem;
    }

    /* Notification Bell */
    .notification-bell {
      position: relative;
      margin-left: 30px;
    }

    .bell-icon {
      font-size: 1.3rem;
      color: var(--white);
      cursor: pointer;
      transition: color 0.3s;
    }

    .bell-icon:hover {
      color: var(--accent);
    }

    .notification-count {
      position: absolute;
      top: -8px;
      right: -8px;
      background-color: var(--accent);
      color: var(--white);
      border-radius: 50%;
      width: 20px;
      height: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.7rem;
      font-weight: bold;
    }

    /* Responsive Styles */
    @media (max-width: 992px) {
      .nav-links {
        display: none;
      }

      .mobile-menu-btn {
        display: block;
      }

      .hero-content h1 {
        font-size: 2.8rem;
      }
    }

    @media (max-width: 768px) {
      section {
        padding: 60px 0;
      }

      .hero-btns {
        flex-direction: column;
        gap: 15px;
      }

      .hero-content h1 {
        font-size: 2.5rem;
      }
    }

    @media (max-width: 576px) {
      .top-bar {
        padding: 15px 20px;
      }

      .hero-content h1 {
        font-size: 2rem;
      }

      .hero-content p {
        font-size: 1rem;
      }

      .section-title h2 {
        font-size: 2rem;
      }
    }
  </style>
</head>
<body>
  <!-- Header -->
  <header>
    <div class="top-bar">
      <div class="logo">healyn<span></span></div>
      
      <ul class="nav-links">
        <li><a href="signup.html">login</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="helpline.html">Helpline</a></li>
        <li><a href="paidfree.html">Services</a></li>
        <li><a href="therapistreglogin.html">For Therapists</a></li>
        <li><a href="quiz.html">Self Assessment</a></li>
        <?php if($isLoggedIn): ?>
          <li><a href="profileclient.php">My Profile</a></li>
        <?php endif; ?>
        <div class="notification-bell">
          <a href="login1.html" class="bell-icon"><i class="fas fa-bell"></i></a>
          <span class="notification-count">3</span>
        </div>
      </ul>
      
      <div class="mobile-menu-btn">
        <i class="fas fa-bars"></i>
      </div>
    </div>

    <div class="hero-content container">
      <h1>Professional Counseling When You Need It Most</h1>
      <p>Confidential, convenient, and compassionate therapy with licensed professionals. Get matched with the perfect therapist for your needs.</p>
      <div class="hero-btns">
        <a href="<?php echo $isLoggedIn ? 'paidfree.html' : 'signup.html'; ?>" class="btn">Get Started</a>
        <a href="about.html" class="btn btn-outline">Learn More</a>
      </div>
    </div>
  </header>

  <!-- Features Section -->
  <section class="features">
    <div class="container">
      <div class="section-title">
        <h2>Why Choose Healyn</h2>
      </div>
      
      <div class="features-grid">
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-user-shield"></i>
          </div>
          <h3>Confidential</h3>
          <p>Your privacy is our priority. All sessions are completely confidential and secure.</p>
        </div>
        
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-calendar-check"></i>
          </div>
          <h3>Flexible Scheduling</h3>
          <p>Book sessions at your convenience, day or night, from anywhere.</p>
        </div>
        
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-certificate"></i>
          </div>
          <h3>Licensed Professionals</h3>
          <p>All our therapists are fully licensed and vetted for quality care.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Therapists Section -->
  <section class="therapists">
    <div class="container">
      <div class="section-title">
        <h2>Our Professional Therapists</h2>
        <p>Meet our team of compassionate and experienced mental health professionals</p>
      </div>
      
      <div class="therapist-container">
        <?php
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "onlinecounselling";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        // Fetch therapist details
        $sql = "SELECT id, full_name, specialization, consultation_fee, gender, bio FROM therapist_detail";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo '<div class="therapist-card">';

            echo '<div class="therapist-info">';
            echo '<h3>' . htmlspecialchars($row["full_name"]) . '</h3>';
            echo '<span class="therapist-specialty">' . htmlspecialchars($row["specialization"]) . '</span>';
            echo '<div class="therapist-details">';
            echo '<p><i class="fas fa-venus-mars"></i> ' . htmlspecialchars($row["gender"]) . '</p>';
            echo '<p><i class="fas fa-dollar-sign"></i> ' . htmlspecialchars($row["consultation_fee"]) . ' per session</p>';
            echo '<p><i class="fas fa-info-circle"></i> ' . substr(htmlspecialchars($row["bio"]), 0, 100) . '...</p>';
            echo '</div>';
            echo '<a href="therapist_contact.php?id=' . urlencode($row['id']) . '&fee=' . urlencode($row['consultation_fee']) . '" class="btn" style="width: 100%;">Book Session</a>';
            echo '</div>';
            echo '</div>';
          }
        } else {
          echo "<p>No therapists registered yet.</p>";
        }

        $conn->close();
        ?>
      </div>
    </div>
  </section>

  <!-- Testimonials Section -->
  <section class="testimonials">
    <div class="container">
      <div class="section-title">
        <h2>Client Testimonials</h2>
        <p>Hear what our clients say about their experience</p>
      </div>
      
      <div class="testimonial-slider">
        <div class="testimonial">
          <div class="testimonial-text">
            NERIN CARE connected me with a therapist who truly understands my struggles. The convenience of online sessions has made it possible for me to continue therapy despite my busy schedule.
          </div>
          <div class="testimonial-author">- Sarah J., 34</div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="cta">
    <div class="container">
      <h2>Ready to Start Your Healing Journey?</h2>
      <p>Take the first step towards better mental health today. Our therapists are ready to help.</p>
      <a href="<?php echo $isLoggedIn ? 'paidfree.html' : 'signup.html'; ?>" class="btn">Begin Counseling</a>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="footer-content">
        <div class="footer-column">
          <h3>HEALYN</h3>
          <p>Professional online counseling platform connecting clients with licensed therapists for convenient, confidential mental health care.</p>
        </div>
        
        <div class="footer-column">
          <h3>Quick Links</h3>
          <ul class="footer-links">
            <li><a href="homepage.php">Home</a></li>
            <li><a href="about.html">About Us</a></li>
            <li><a href="paidfree.html">Services</a></li>
            <li><a href="quiz.html">Self Assessment</a></li>
          </ul>
        </div>
        
        <div class="footer-column">
          <h3>Resources</h3>
          <ul class="footer-links">
            <li><a href="helpline.html">Crisis Helplines</a></li>
            <li><a href="blogs.html">Mental Health Blog</a></li>
            <li><a href="#">Privacy Policy</a></li>
          </ul>
        </div>
        
        <div class="footer-column">
          <h3>Connect With Us</h3>
          <div class="social-links">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
          </div>
        </div>
      </div>
      
      <div class="copyright">
        <p>&copy; 2024 Healyn All Rights Reserved.</p>
      </div>
    </div>
  </footer>

  <script>
    // Mobile menu toggle
    document.querySelector('.mobile-menu-btn').addEventListener('click', function() {
      <?php if ($isLoggedIn): ?>
        document.querySelector('.nav-links').classList.toggle('active');
      <?php else: ?>
        alert('Please sign up or log in first.');
        window.location.href = 'signup.html';
      <?php endif; ?>
    });

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        
        document.querySelector(this.getAttribute('href')).scrollIntoView({
          behavior: 'smooth'
        });
      });
    });
  </script>
</body>
</html>