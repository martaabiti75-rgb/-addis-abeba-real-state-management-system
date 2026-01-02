<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>About Us - Adis Abeba Real Estate</title>

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

/* ================= ABOUT SECTION ================= */
.about-section {
  padding: 80px 0;
}

.about-content {
  background: white;
  border-radius: 20px;
  padding: 40px;
  box-shadow: 0 20px 40px rgba(0,0,0,0.1);
  margin-bottom: 40px;
}

.who-we-are {
  color: #ff7f50;
  font-weight: 600;
  margin-bottom: 15px;
  text-transform: uppercase;
  font-size: 14px;
  letter-spacing: 1px;
}

.about-content h3 {
  font-weight: 700;
  margin-bottom: 20px;
  color: #004aad;
  font-size: 28px;
}

.about-content p.fst-italic {
  font-style: italic;
  color: #666;
  font-size: 18px;
  line-height: 1.8;
  margin-bottom: 30px;
}

.about-content ul {
  list-style: none;
  padding: 0;
}

.about-content ul li {
  margin-bottom: 20px;
  font-size: 16px;
  display: flex;
  align-items: flex-start;
  gap: 15px;
  transition: all 0.3s ease;
  padding: 15px;
  border-radius: 10px;
  background: #f8f9fa;
}

.about-content ul li:hover {
  background: #e3f2fd;
  transform: translateX(10px);
}

.about-content ul li i {
  color: #ff7f50;
  font-size: 20px;
  margin-top: 2px;
  flex-shrink: 0;
}

.about-images {
  display: flex;
  gap: 20px;
  height: 100%;
}

.about-images img {
  border-radius: 15px;
  box-shadow: 0 15px 35px rgba(0,0,0,0.1);
  transition: all 0.4s ease;
  width: 100%;
  height: auto;
  object-fit: cover;
}

.about-images img:hover {
  transform: translateY(-10px);
  box-shadow: 0 25px 50px rgba(0,0,0,0.15);
}

.image-column {
  flex: 1;
}

.image-column.large img {
  height: 400px;
}

.image-column.small img {
  height: 180px;
}

/* ================= SERVICES SECTION ================= */
.services-section {
  padding: 80px 0;
  background: white;
}

.section-title {
  text-align: center;
  margin-bottom: 60px;
}

.section-title h2 {
  font-weight: 700;
  margin-bottom: 15px;
  color: #004aad;
  font-size: 36px;
}

.section-title p {
  color: #666;
  font-size: 18px;
  max-width: 600px;
  margin: 0 auto;
  line-height: 1.6;
}

.service-item {
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(8px);
  border-radius: 20px;
  padding: 40px 30px;
  box-shadow: 0 20px 40px rgba(0,0,0,0.08);
  transition: all 0.4s ease;
  height: 100%;
  text-align: center;
}

.service-item:hover {
  transform: translateY(-15px);
  box-shadow: 0 30px 60px rgba(0,0,0,0.15);
}

.service-item .icon {
  width: 80px;
  height: 80px;
  background: linear-gradient(135deg, #ff7f50, #ff6347);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 25px;
  transition: all 0.3s ease;
}

.service-item:hover .icon {
  transform: scale(1.1);
  background: linear-gradient(135deg, #004aad, #0066cc);
}

.service-item .icon i {
  font-size: 36px;
  color: white;
}

.service-item h3 {
  font-weight: 600;
  margin-bottom: 20px;
  color: #333;
  font-size: 22px;
}

.service-item h3 a {
  color: inherit;
  text-decoration: none;
  transition: all 0.3s ease;
}

.service-item h3 a:hover {
  color: #004aad;
}

.service-item p {
  color: #666;
  font-size: 15px;
  line-height: 1.7;
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
  .about-content {
    padding: 30px 20px;
  }
  .about-images {
    flex-direction: column;
    gap: 15px;
  }
  .image-column.large img,
  .image-column.small img {
    height: 250px;
  }
  .service-item {
    padding: 30px 20px;
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
        <li><a href="about.php" class="active">About Us</a></li>
        <li><a href="#services">Our Services</a></li>
        <li><a href="properties.php">Our Properties</a></li>
        <li><a href="contact_us.php">Contact Us</a></li>
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
    <h1>About Us</h1>
    <p>Learn more about our mission to transform real estate management in Addis Ababa through innovative technology and exceptional service.</p>
  </div>
</section>

<!-- ABOUT SECTION -->
<section class="about-section">
  <div class="container">
    <div class="row gy-4">

      <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
        <div class="about-content">
          <p class="who-we-are">Who We Are</p>
          <h3>Adis Abeba City Real Estate Management System</h3>

          <p class="fst-italic">
            We are a modern digital platform dedicated to simplifying property listing, buying, selling, and renting across Addis Ababa. Our system connects users with trusted agents and verified real estate opportunities through cutting-edge technology.
          </p>

          <ul>
            <li>
              <i class="bi bi-check-circle"></i>
              <span>We provide easy access to verified residential and commercial properties with comprehensive details and high-quality images.</span>
            </li>

            <li>
              <i class="bi bi-check-circle"></i>
              <span>We help buyers, sellers, and agents connect through a seamless and transparent system that ensures trust and reliability.</span>
            </li>

            <li>
              <i class="bi bi-check-circle"></i>
              <span>Our platform offers advanced search capabilities, detailed property profiles, and secure communication channels to ensure the best real estate experience.</span>
            </li>

            <li>
              <i class="bi bi-check-circle"></i>
              <span>We maintain the highest standards of data security and privacy protection for all our users and their transactions.</span>
            </li>
          </ul>
        </div>
      </div>

      <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
        <div class="about-images">
          <div class="image-column large">
            <img src="assets/img/img1.jpg" alt="Modern Real Estate Building" class="img-fluid">
          </div>
          <div class="image-column small">
            <img src="assets/img/img4.jpg" alt="Real Estate Interior" class="img-fluid">
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- SERVICES SECTION -->
<section class="services-section">
  <div class="container">
    
    <!-- Section Title -->
    <div class="section-title" data-aos="fade-up">
      <h2>Our Services</h2>
      <p>Discover our comprehensive range of real estate services designed to meet all your property needs in Addis Ababa</p>
    </div>

    <div class="row gy-4">

      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
        <div class="service-item">
          <div class="icon">
            <i class="bi bi-house-door"></i>
          </div>
          <h3><a href="#">Residential Properties</a></h3>
          <p>Uncover a range of villas and apartments designed for modern living. From luxurious hill-side apartments to strategically located residential units, we offer more than just properties; we offer homes and opportunities for your family's future.</p>
        </div>
      </div>

      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
        <div class="service-item">
          <div class="icon">
            <i class="bi bi-building"></i>
          </div>
          <h3><a href="#">Commercial Spaces</a></h3>
          <p>Elevate your business with our prime commercial spaces. Strategically positioned in thriving business districts, these spaces are designed for success. With high foot traffic and excellent visibility, your business is positioned to thrive.</p>
        </div>
      </div>

      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
        <div class="service-item">
          <div class="icon">
            <i class="bi bi-graph-up-arrow"></i>
          </div>
          <h3><a href="#">Investment Opportunities</a></h3>
          <p>Invest in your future with our unique investment opportunities. Become a part-owner through our share investment structure and experience the rewards of high-yielding, appreciating real estate investments in Ethiopia's growing market.</p>
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

// Service item hover effects
const serviceItems = document.querySelectorAll('.service-item');
serviceItems.forEach(item => {
  item.addEventListener('mouseenter', function() {
    this.style.transform = 'translateY(-15px) scale(1.02)';
  });
  
  item.addEventListener('mouseleave', function() {
    this.style.transform = 'translateY(0) scale(1)';
  });
});

// About list items animation
const aboutListItems = document.querySelectorAll('.about-content ul li');
aboutListItems.forEach((item, index) => {
  item.style.animationDelay = `${index * 0.1}s`;
});

// Image hover effects
const aboutImages = document.querySelectorAll('.about-images img');
aboutImages.forEach(img => {
  img.addEventListener('mouseenter', function() {
    this.style.transform = 'translateY(-10px) scale(1.05)';
  });
  
  img.addEventListener('mouseleave', function() {
    this.style.transform = 'translateY(0) scale(1)';
  });
});

// Parallax effect for page title
window.addEventListener('scroll', () => {
  const scrolled = window.pageYOffset;
  const pageTitle = document.querySelector('.page-title');
  if (pageTitle) {
    pageTitle.style.transform = `translateY(${scrolled * 0.5}px)`;
  }
});
</script>

</body>
</html>