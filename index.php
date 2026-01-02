<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Adis Abeba Real Estate</title>

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
  .mobile-nav-toggle {
    display: block;
  }
}

/* ================= HERO ================= */
.hero {
  position: relative;
  height: 100vh;
}

.hero .carousel-item {
  height: 100vh;
  position: relative;
}

.hero .carousel-item img {
  object-fit: cover;
  height: 100%;
  width: 100%;
  filter: brightness(0.6);
  transition: all 0.5s ease;
}

.hero .carousel-container {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: #fff;
  text-align: center;
}

.hero .carousel-container h2 {
  font-size: 50px;
  font-weight: 700;
  margin-bottom: 20px;
  text-transform: uppercase;
  animation: fadeInDown 1s ease forwards;
}

.hero .carousel-container p {
  font-size: 22px;
  margin-bottom: 20px;
  animation: fadeInUp 1s ease forwards;
}

.hero .btn-get-started {
  background: linear-gradient(135deg, #ff7f50, #ff6347);
  padding: 12px 30px;
  border-radius: 8px;
  color: #fff;
  font-weight: 600;
  transition: all 0.3s ease;
}

.hero .btn-get-started:hover {
  transform: translateY(-3px);
  box-shadow: 0 12px 25px rgba(255,127,80,0.5);
}

@keyframes fadeInDown {
  0% { opacity: 0; transform: translateY(-30px);}
  100% { opacity: 1; transform: translateY(0);}
}

@keyframes fadeInUp {
  0% { opacity: 0; transform: translateY(30px);}
  100% { opacity: 1; transform: translateY(0);}
}

/* ================= PAGE TITLE ================= */
.page-title {
  background: linear-gradient(135deg, #1e3c72, #2a5298);
  color: #fff;
  padding: 100px 0 50px 0;
  text-align: center;
  border-bottom-left-radius: 50% 20%;
  border-bottom-right-radius: 50% 20%;
}

.page-title h1 {
  font-weight: 700;
  margin-bottom: 15px;
  font-size: 42px;
}

.page-title p {
  font-size: 16px;
  line-height: 1.6;
}

.breadcrumbs {
  background: transparent;
  padding: 10px 0;
}

.breadcrumbs ol {
  list-style: none;
  display: flex;
  justify-content: center;
  gap: 8px;
}

.breadcrumbs ol li a {
  color: #ff7f50;
  font-weight: 500;
}

.breadcrumbs ol li.current {
  font-weight: 700;
  color: #fff;
}

/* ================= ABOUT ================= */
.about .who-we-are {
  color: #ff7f50;
  font-weight: 600;
  margin-bottom: 10px;
  text-transform: uppercase;
}

.about h3 {
  font-weight: 700;
  margin-bottom: 15px;
}

.about p.fst-italic {
  font-style: italic;
  color: #555;
}

.about ul li {
  margin-bottom: 15px;
  font-size: 16px;
  display: flex;
  align-items: center;
  gap: 10px;
  transition: all 0.3s ease;
}

.about ul li:hover i {
  color: #ff6347;
}

.about ul li i {
  color: #ff7f50;
  font-size: 22px;
}

/* ================= SERVICES ================= */
.services .section-title h2 {
  font-weight: 700;
  margin-bottom: 15px;
  text-align: center;
}

.services .section-title p {
  color: #555;
  text-align: center;
  margin-bottom: 50px;
}

.service-item {
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(8px);
  border-radius: 16px;
  padding: 30px 25px;
  box-shadow: 0 20px 40px rgba(0,0,0,0.08);
  transition: all 0.4s ease;
}

.service-item:hover {
  transform: translateY(-10px);
  box-shadow: 0 25px 50px rgba(0,0,0,0.15);
}

.service-item .icon {
  font-size: 36px;
  color: #ff7f50;
  margin-bottom: 20px;
  transition: all 0.3s ease;
}

.service-item:hover .icon {
  color: #ff6347;
}

.service-item h3 {
  font-weight: 600;
  margin-bottom: 15px;
}

.service-item p {
  color: #555;
  font-size: 15px;
  line-height: 1.6;
}

/* ================= FOOTER ================= */
.footer {
  background: #1e3c72;
  color: #fff;
  padding: 80px 0 30px 0;
  transition: all 0.4s ease;
}

.footer h4 {
  font-weight: 700;
  margin-bottom: 15px;
}

.footer p, .footer a {
  color: #fff;
  font-size: 14px;
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
}

.footer .social-links a:hover {
  background: #ff6347;
}

.footer .copyright {
  font-size: 13px;
  color: #ddd;
  margin-top: 20px;
  text-align: center;
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
}

.scroll-top:hover {
  background: #ff6347;
  transform: translateY(-3px);
}

/* ================= DARK MODE ================= */
body.dark-mode {
  background: #121212 !important;
  color: #e0e0e0 !important;
}

body.dark-mode .header {
  background: rgba(40, 40, 40, 0.95);
}

body.dark-mode .navmenu ul li a {
  color: #e0e0e0;
}

body.dark-mode .navmenu ul li a:hover,
body.dark-mode .navmenu ul li a.active {
  color: #ff7f50;
}

body.dark-mode .hero .carousel-container h2,
body.dark-mode .hero .carousel-container p {
  color: #fff;
}

body.dark-mode .service-item {
  background: rgba(30, 30, 30, 0.9);
  color: #e0e0e0;
}

body.dark-mode .footer {
  background: #111;
  color: #e0e0e0;
}

body.dark-mode .footer a {
  color: #ff7f50;
}

body.dark-mode .scroll-top {
  background: #ff7f50;
  color: #fff;
}

/* ================= RESPONSIVE ================= */
@media(max-width: 992px) {
  .hero .carousel-container h2 {
    font-size: 32px;
  }
  .hero .carousel-container p {
    font-size: 18px;
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
        <li><a href="index.php" class="active">Home</a></li>
        <li><a href="about.php">About Us</a></li>
        <li><a href="#services">Our Services</a></li>
        <li><a href="properties.php">Our Properties</a></li>
        <li><a href="contact_us.php">Contact Us</a></li>
        <li><a href="pages_login.php?login">Login</a></li>
        <li><a href="register.php?register">Register</a></li>
      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      <!-- Dark Mode Toggle Button -->
      <button id="darkModeToggle" class="btn btn-dark ms-3">🌙</button>
    </nav>
  </div>
</header>

<!-- HERO -->
<section id="hero" class="hero section">
  <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
    <div class="carousel-item active">
      <img src="assets/img/hero-carousel/hero-carousel-1.jpg" alt="">
      <div class="carousel-container">
        <div>
          <p>Real Estate Management System</p>
          <h2><span>204</span> Olive Road Two</h2>
          <a href="property-single.html" class="btn-get-started">Sale | 4M</a>
        </div>
      </div>
    </div>
    <div class="carousel-item">
      <img src="assets/img/hero-carousel/hero-carousel-2.jpg" alt="">
      <div class="carousel-container">
        <div>
          <p>Real Estate Management System</p>
          <h2><span>247</span> Venda Road Five</h2>
          <a href="property-single.html" class="btn-get-started">Sale | 2M</a>
        </div>
      </div>
    </div>
    <div class="carousel-item">
      <img src="assets/img/c1.png" alt="">
      <div class="carousel-container">
        <div>
          <p>Real Estate Management System</p>
          <h2><span>247</span> Vitra Road Three</h2>
          <a href="property-single.html" class="btn-get-started">Sale | 1M</a>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
      <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
    </a>
    <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
      <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
    </a>
  </div>
</section>

<!-- SERVICES -->
<section id="services" class="services section">
  <div class="container section-title" data-aos="fade-up">
    <h2>Our Services</h2>
    <p>Explore our Residential, Commercial, and Investment services</p>
  </div>
  <div class="container">
    <div class="row gy-4">
      <div class="col-lg-4 col-md-6" data-aos="fade-up">
        <div class="service-item position-relative">
          <div class="icon"><i class="bi bi-activity"></i></div>
          <h3>Residential</h3>
          <p>Modern villas and apartments, strategically located for convenience.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6" data-aos="fade-up">
        <div class="service-item position-relative">
          <div class="icon"><i class="bi bi-broadcast"></i></div>
          <h3>Commercial</h3>
          <p>Prime business spaces located in thriving districts to elevate your business.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6" data-aos="fade-up">
        <div class="service-item position-relative">
          <div class="icon"><i class="bi bi-easel"></i></div>
          <h3>Invest in Share Company</h3>
          <p>Become a part-owner through our high-yielding share investment structure.</p>
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
  </div>
</footer>

<!-- Scroll Top -->
<a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
AOS.init();

// Mobile menu toggle
const mobileToggle = document.querySelector('.mobile-nav-toggle');
const navMenu = document.querySelector('.navmenu ul');
mobileToggle.addEventListener('click', () => navMenu.classList.toggle('show'));

// Dark mode toggle
const darkModeToggle = document.getElementById('darkModeToggle');
darkModeToggle.addEventListener('click', () => {
  document.body.classList.toggle('dark-mode');
  darkModeToggle.textContent = document.body.classList.contains('dark-mode') ? '☀️' : '🌙';
});
</script>

</body>
</html>
