<?php
// Include simple contact handler
include 'simple_contact_handler.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact Us - Adis Abeba Real Estate</title>

<!-- Favicons -->
<link href="assets/img/aacitylogo.jpg" rel="icon">
<link href="assets/img/aacitylogo.jpg" rel="apple-touch-icon">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

<!-- Bootstrap & Vendor CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

<!-- Main CSS -->
<style>
/* ================= GLOBAL ================= */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  scroll-behavior: smooth;
}

body {
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(135deg, #e0eafc, #cfdef3);
  color: #333;
  transition: all 0.4s ease;
}

/* ================= HEADER ================= */
.header {
  background: rgba(20, 56, 97, 0.9);
  backdrop-filter: blur(10px);
  box-shadow: 0 8px 30px rgba(0,0,0,0.1);
  padding: 15px 0;
  position: fixed;
  width: 100%;
  z-index: 1000;
  transition: all 0.4s ease;
}

.logo img {
  max-height: 65px;
  transition: all 0.3s ease;
}

.navmenu ul {
  list-style: none;
  display: flex;
  gap: 25px;
  align-items: center;
}

.navmenu ul li a {
  font-weight: 500;
  color: #e4e9f3ff;
  padding: 6px 10px;
  transition: all 0.3s ease;
  text-decoration: none;
}

.navmenu ul li a:hover,
.navmenu ul li a.active {
  color: #ff7f50;
  transform: scale(1.1);
}

/* Mobile menu */
.mobile-nav-toggle {
  font-size: 1.5rem;
  cursor: pointer;
  display: none;
  color: #fff;
  background: none;
  border: none;
}

@media(max-width: 992px) {
  .navmenu ul {
    flex-direction: column;
    background: rgba(255,255,255,0.95);
    position: absolute;
    top: 65px;
    right: -250px;
    width: 220px;
    border-radius: 12px;
    padding: 15px 0;
    transition: 0.3s ease;
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
  }
  .navmenu ul.show {
    right: 15px;
  }
  .navmenu ul li a {
    color: #333;
  }
  .mobile-nav-toggle {
    display: block;
  }
}

/* ================= PAGE TITLE ================= */
.page-title {
  background: linear-gradient(135deg, #1e3c72, #2a5298);
  color: #fff;
  padding: 120px 0 80px 0;
  text-align: center;
  margin-top: 80px;
}

.page-title h1 {
  font-weight: 700;
  margin-bottom: 15px;
  font-size: 42px;
}

.page-title p {
  font-size: 18px;
  line-height: 1.6;
  opacity: 0.9;
}

/* ================= CONTACT SECTION ================= */
.contact-section {
  padding: 80px 0;
}

.map-container {
  margin-bottom: 60px;
}

.map-wrapper {
  position: relative;
  overflow: hidden;
  border-radius: 15px;
  box-shadow: 0 20px 40px rgba(0,0,0,0.1);
  transition: all 0.3s ease;
}

.map-wrapper:hover {
  transform: translateY(-5px);
  box-shadow: 0 25px 50px rgba(0,0,0,0.15);
}

.map-wrapper iframe {
  transition: all 0.3s ease;
}

.contact-info {
  background: linear-gradient(135deg, #004aad 0%, #0066cc 100%);
  color: white;
  border-radius: 20px;
  padding: 40px;
  height: 100%;
  box-shadow: 0 20px 40px rgba(0,0,0,0.1);
}

.contact-info h3 {
  font-weight: 700;
  margin-bottom: 30px;
  font-size: 28px;
}

.contact-item {
  margin-bottom: 30px;
  display: flex;
  align-items: flex-start;
  gap: 20px;
}

.contact-item i {
  font-size: 28px;
  color: #ffd700;
  margin-top: 5px;
  flex-shrink: 0;
}

.contact-item div h5 {
  font-weight: 600;
  margin-bottom: 8px;
  font-size: 18px;
}

.contact-item div p {
  margin: 0;
  opacity: 0.9;
  line-height: 1.6;
}

.contact-form {
  background: white;
  border-radius: 20px;
  padding: 40px;
  box-shadow: 0 20px 40px rgba(0,0,0,0.1);
  height: 100%;
}

.contact-form h3 {
  font-weight: 700;
  margin-bottom: 30px;
  color: #333;
  font-size: 28px;
}

.form-control {
  border-radius: 12px;
  border: 2px solid #e9ecef;
  padding: 15px 20px;
  font-size: 16px;
  transition: all 0.3s ease;
  margin-bottom: 20px;
}

.form-control:focus {
  border-color: #004aad;
  box-shadow: 0 0 0 0.2rem rgba(0, 74, 173, 0.25);
  outline: none;
}

.form-label {
  font-weight: 600;
  color: #333;
  margin-bottom: 8px;
}

.btn-primary {
  background: linear-gradient(135deg, #004aad, #0066cc);
  border: none;
  border-radius: 12px;
  padding: 15px 40px;
  font-weight: 600;
  font-size: 16px;
  transition: all 0.3s ease;
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 25px rgba(0, 74, 173, 0.3);
}

.alert {
  border-radius: 12px;
  padding: 15px 20px;
  margin-bottom: 25px;
}

/* ================= FOOTER ================= */
.footer {
  background: #1e3c72;
  color: #fff;
  padding: 60px 0 30px 0;
  margin-top: 80px;
}

.footer h4 {
  font-weight: 700;
  margin-bottom: 15px;
}

.footer p, .footer a {
  color: #fff;
  font-size: 14px;
  text-decoration: none;
}

.footer .social-links a {
  font-size: 18px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  background: #ff7f50;
  color: #fff;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  margin-right: 10px;
  transition: all 0.3s ease;
  text-decoration: none;
}

.footer .social-links a:hover {
  background: #ff6347;
  transform: translateY(-2px);
}

.footer .copyright {
  font-size: 13px;
  color: #ddd;
  margin-top: 30px;
  text-align: center;
  padding-top: 20px;
  border-top: 1px solid rgba(255,255,255,0.1);
}

/* ================= SCROLL TOP ================= */
.scroll-top {
  position: fixed;
  right: 20px;
  bottom: 20px;
  background: #ff7f50;
  color: #fff;
  width: 45px;
  height: 45px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  transition: all 0.3s ease;
  z-index: 100;
  text-decoration: none;
}

.scroll-top:hover {
  background: #ff6347;
  transform: translateY(-3px);
  color: #fff;
}

/* ================= RESPONSIVE ================= */
@media(max-width: 768px) {
  .page-title h1 {
    font-size: 32px;
  }
  .contact-info, .contact-form {
    padding: 30px 25px;
  }
  .contact-info h3, .contact-form h3 {
    font-size: 24px;
  }
}
</style>
</head>

<body>

<!-- HEADER -->
<header id="header" class="header d-flex align-items-center fixed-top">
  <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
    <a href="index.php" class="logo d-flex align-items-center">
      <img src="assets/img/aacitylogo.jpg" alt="">
    </a>

    <nav id="navmenu" class="navmenu d-flex align-items-center">
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About Us</a></li>
        <li><a href="#services">Our Services</a></li>
        <li><a href="properties.php">Our Properties</a></li>
        <li><a href="contact_us.php" class="active">Contact Us</a></li>
        <li><a href="pages_login.php?login">Login</a></li>
        <li><a href="register.php?register">Register</a></li>
      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>
  </div>
</header>

<!-- PAGE TITLE -->
<section class="page-title">
  <div class="container">
    <h1>Contact Us</h1>
    <p>Get in touch with our real estate experts. We're here to help you find your dream property.</p>
  </div>
</section>

<!-- CONTACT SECTION -->
<section class="contact-section">
  <div class="container">
    <!-- Map Section -->
    <div class="row mb-5">
      <div class="col-12">
        <div class="map-container" data-aos="fade-up">
          <h3 class="text-center mb-4" style="color: #004aad; font-weight: 700;">Find Us on the Map</h3>
          <div class="map-wrapper">
            <iframe 
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3940.6177618843845!2d38.76073631478236!3d9.005401993528!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x164b85cef5ab402d%3A0x8467b6b037a24d49!2sArat%20Kilo%2C%20Addis%20Ababa%2C%20Ethiopia!5e0!3m2!1sen!2s!4v1704067200000!5m2!1sen!2s" 
              width="100%" 
              height="400" 
              style="border:0; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);" 
              allowfullscreen="" 
              loading="lazy" 
              referrerpolicy="no-referrer-when-downgrade">
            </iframe>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row g-4">
      
      <!-- Contact Information -->
      <div class="col-lg-5">
        <div class="contact-info" data-aos="fade-right">
          <h3>Get in Touch</h3>
          
          <div class="contact-item">
            <i class="bi bi-geo-alt-fill"></i>
            <div>
              <h5>Our Address</h5>
              <p>Arat Kilo, Addis Ababa<br>
              Ethiopia, Real Estate Office<br>
              Building Floor 3, Office 301</p>
            </div>
          </div>
          
          <div class="contact-item">
            <i class="bi bi-telephone-fill"></i>
            <div>
              <h5>Phone Numbers</h5>
              <p>Main Office: +251 11 123 4567<br>
              Mobile: +251 91 234 5678<br>
              Emergency: +251 92 345 6789</p>
            </div>
          </div>
          
          <div class="contact-item">
            <i class="bi bi-envelope-fill"></i>
            <div>
              <h5>Email Addresses</h5>
              <p>General: info@aarealestate.com<br>
              Support: support@aarealestate.com<br>
              Sales: sales@aarealestate.com</p>
            </div>
          </div>
          
          <div class="contact-item">
            <i class="bi bi-clock-fill"></i>
            <div>
              <h5>Business Hours</h5>
              <p>Monday - Friday: 8:00 AM - 6:00 PM<br>
              Saturday: 9:00 AM - 4:00 PM<br>
              Sunday: Closed</p>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Contact Form -->
      <div class="col-lg-7">
        <div class="contact-form" data-aos="fade-left">
          <h3>Send us a Message</h3>
          
          <?php
          require_once 'CommonFunction/ContactMessageHandler.php';
          $contactHandler = new ContactMessageHandler();
          
          $message = '';
          if ($_POST) {
              if (isset($_POST['send_message'])) {
                  $name = htmlspecialchars(trim($_POST['name']));
                  $email = htmlspecialchars(trim($_POST['email']));
                  $subject = htmlspecialchars(trim($_POST['subject']));
                  $user_message = htmlspecialchars(trim($_POST['message']));
                  
                  // Save message to database
                  if ($contactHandler->saveContactMessage($name, $email, $subject, $user_message)) {
                      $message = '<div class="alert alert-success">
                          <i class="bi bi-check-circle-fill me-2"></i>
                          Thank you for your message! We have received your inquiry and will get back to you soon. 
                          <a href="pages_login.php?login" class="btn btn-sm btn-outline-success ms-2">
                              <i class="bi bi-box-arrow-in-right me-1"></i>Login to Dashboard
                          </a>
                      </div>';
                  } else {
                      $message = '<div class="alert alert-danger">
                          <i class="bi bi-exclamation-triangle-fill me-2"></i>
                          Sorry, there was an error sending your message. Please try again later.
                      </div>';
                  }
              }
          }
          echo $message;
          ?>
          
          <?php if (isset($response)) echo $response; ?>
          
          <form method="POST" action="">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Full Name *</label>
                <input type="text" class="form-control" id="name" name="name" required placeholder="Enter your full name">
              </div>
              <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Email Address *</label>
                <input type="email" class="form-control" id="email" name="email" required placeholder="Enter your email">
              </div>
            </div>
            
            <div class="mb-3">
              <label for="subject" class="form-label">Subject *</label>
              <input type="text" class="form-control" id="subject" name="subject" required placeholder="What is this about?">
            </div>
            
            <div class="mb-4">
              <label for="message" class="form-label">Message *</label>
              <textarea class="form-control" id="message" name="message" rows="6" required placeholder="Please describe your inquiry, feedback, or any questions you have about our real estate services..."></textarea>
            </div>
            
            <button type="submit" name="send_message" class="btn btn-primary">
              <i class="bi bi-send-fill me-2"></i>Send Message
            </button>
          </form>
        </div>
      </div>
      
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer id="footer" class="footer">
  <div class="container">
    <div class="row gy-3">
      <div class="col-lg-3 col-md-6 d-flex">
        <i class="bi bi-geo-alt icon"></i>
        <div>
          <h4>Address</h4>
          <p>Arat Kilo, Adis Abeba, Ethiopia</p>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 d-flex">
        <i class="bi bi-telephone icon"></i>
        <div>
          <h4>Contact</h4>
          <p><strong>Phone:</strong> +251 911 123 456<br><strong>Email:</strong> info@addisrealestate.com</p>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 d-flex">
        <i class="bi bi-clock icon"></i>
        <div>
          <h4>Working Hours</h4>
          <p><strong>Mon–Fri:</strong> 8:00–17:00<br><strong>Sat:</strong> 8:00–12:00<br><strong>Sun:</strong> Closed</p>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <h4>Follow Us</h4>
        <div class="social-links d-flex">
          <a href="#"><i class="bi bi-twitter"></i></a>
          <a href="#"><i class="bi bi-facebook"></i></a>
          <a href="#"><i class="bi bi-instagram"></i></a>
          <a href="#"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>
    </div>
    <div class="copyright">
      &copy; Copyright <strong><span>Adis Abeba Real Estate Management System</span></strong>. All rights reserved.
      <br>Powered By <a href="https://t.me/zolaoff/" style="color: #ff7f50;">IT Students</a>
    </div>
  </div>
</footer>

<!-- Scroll Top -->
<a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
AOS.init({
  duration: 1000,
  once: true
});

// Mobile menu toggle
const mobileToggle = document.querySelector('.mobile-nav-toggle');
const navMenu = document.querySelector('.navmenu ul');
if (mobileToggle) {
  mobileToggle.addEventListener('click', () => navMenu.classList.toggle('show'));
}

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute('href'));
    if (target) {
      target.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
      });
    }
  });
});

// Form validation
const form = document.querySelector('form');
if (form) {
  form.addEventListener('submit', function(e) {
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const subject = document.getElementById('subject').value.trim();
    const message = document.getElementById('message').value.trim();
    
    if (!name || !email || !subject || !message) {
      e.preventDefault();
      alert('Please fill in all required fields.');
      return false;
    }
    
    // Email validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
      e.preventDefault();
      alert('Please enter a valid email address.');
      return false;
    }
  });
}
</script>

</body>
</html>