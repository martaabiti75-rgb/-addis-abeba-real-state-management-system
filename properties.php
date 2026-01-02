
<?php

  // require __DIR__.'../CommonFunction/CommenForEveryUserFunction.php';
  require __DIR__.'\Auth\auth.php';
  $CommonOBJ = new Auth();

  session_start();


?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Properties - Adis Abeba Real Estate</title>

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

/* ================= SEARCH SECTION ================= */
.search-section {
  background: white;
  padding: 40px 0;
  box-shadow: 0 5px 20px rgba(0,0,0,0.1);
  margin-bottom: 40px;
}

.search-container {
  max-width: 800px;
  margin: 0 auto;
}

.search-form {
  background: #f8f9fa;
  border-radius: 15px;
  padding: 30px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.search-form h3 {
  color: #004aad;
  font-weight: 700;
  margin-bottom: 25px;
  text-align: center;
}

.form-control, .form-select {
  border-radius: 10px;
  border: 2px solid #e9ecef;
  padding: 12px 15px;
  font-size: 16px;
  transition: all 0.3s ease;
  margin-bottom: 15px;
}

.form-control:focus, .form-select:focus {
  border-color: #004aad;
  box-shadow: 0 0 0 0.2rem rgba(0, 74, 173, 0.25);
  outline: none;
}

.btn-search {
  background: linear-gradient(135deg, #004aad, #0066cc);
  border: none;
  border-radius: 10px;
  padding: 12px 30px;
  font-weight: 600;
  font-size: 16px;
  transition: all 0.3s ease;
  width: 100%;
}

.btn-search:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 25px rgba(0, 74, 173, 0.3);
}

/* ================= PROPERTIES SECTION ================= */
.properties-section {
  padding: 60px 0;
}

.property-card {
  background: white;
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 15px 35px rgba(0,0,0,0.1);
  transition: all 0.4s ease;
  margin-bottom: 30px;
  height: 100%;
}

.property-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 25px 50px rgba(0,0,0,0.15);
}

.property-card img {
  width: 100%;
  height: 250px;
  object-fit: cover;
  transition: all 0.3s ease;
}

.property-card:hover img {
  transform: scale(1.05);
}

.property-card .card-body {
  padding: 25px;
}

.sale-badge {
  position: absolute;
  top: 15px;
  left: 15px;
  background: linear-gradient(135deg, #ff7f50, #ff6347);
  color: white;
  padding: 8px 15px;
  border-radius: 20px;
  font-weight: 600;
  font-size: 12px;
  text-transform: uppercase;
}

.property-title {
  font-weight: 700;
  color: #333;
  margin-bottom: 15px;
  font-size: 20px;
}

.property-title a {
  color: inherit;
  text-decoration: none;
  transition: all 0.3s ease;
}

.property-title a:hover {
  color: #004aad;
}

.property-info {
  background: #f8f9fa;
  border-radius: 10px;
  padding: 15px;
  margin-top: 15px;
}

.property-info .row {
  margin: 0;
}

.property-info .col {
  padding: 5px;
  text-align: center;
  font-size: 14px;
}

.property-info .col:first-child {
  font-weight: 600;
  color: #666;
  border-bottom: 1px solid #dee2e6;
  margin-bottom: 8px;
}

.property-info .col:last-child {
  font-weight: 700;
  color: #004aad;
}

.price-tag {
  font-size: 24px;
  font-weight: 700;
  color: #ff7f50;
  margin-top: 10px;
}

/* ================= NO RESULTS ================= */
.no-results {
  text-align: center;
  padding: 60px 20px;
  background: white;
  border-radius: 20px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.no-results i {
  font-size: 4rem;
  color: #ccc;
  margin-bottom: 20px;
}

.no-results h3 {
  color: #666;
  margin-bottom: 15px;
}

.no-results p {
  color: #999;
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
  .search-form {
    padding: 20px;
  }
  .property-card img {
    height: 200px;
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
        <li><a href="properties.php" class="active">Our Properties</a></li>
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
    <h1>Our Properties</h1>
    <p>Discover premium real estate opportunities in Addis Ababa. Browse through our carefully curated selection of properties.</p>
  </div>
</section>

<!-- SEARCH SECTION -->
<section class="search-section">
  <div class="container">
    <div class="search-container">
      <form class="search-form" method="GET" action="" id="searchForm">
        <h3><i class="bi bi-search me-2"></i>Find Your Perfect Property</h3>
        
        <!-- Search Results Summary -->
        <?php if (!empty($_GET)): ?>
          <div class="alert alert-info mb-3">
            <i class="bi bi-info-circle me-2"></i>
            <strong>Search Results:</strong> 
            <?php 
            $activeFilters = [];
            if (!empty($search_owner)) $activeFilters[] = "Owner: " . htmlspecialchars($search_owner);
            if (!empty($search_block)) $activeFilters[] = "Block: " . htmlspecialchars($search_block);
            if (!empty($search_floor)) $activeFilters[] = "Floor: " . htmlspecialchars($search_floor);
            if ($min_price > 0) $activeFilters[] = "Min Price: ETB " . number_format($min_price);
            if ($max_price > 0) $activeFilters[] = "Max Price: ETB " . number_format($max_price);
            
            if (!empty($activeFilters)) {
              echo implode(" | ", $activeFilters);
            } else {
              echo "All Properties";
            }
            ?>
            <span class="badge bg-primary ms-2"><?= count($filteredProperties) ?> found</span>
          </div>
        <?php endif; ?>
        
        <div class="row">
          <div class="col-md-4 mb-3">
            <label for="search_owner" class="form-label">
              <i class="bi bi-person me-1"></i>Owner Name
            </label>
            <input type="text" class="form-control" id="search_owner" name="search_owner" 
                   placeholder="Search by owner name..." 
                   value="<?= isset($_GET['search_owner']) ? htmlspecialchars($_GET['search_owner']) : '' ?>"
                   autocomplete="off">
            <div class="form-text">Enter full or partial owner name</div>
          </div>
          <div class="col-md-4 mb-3">
            <label for="search_block" class="form-label">
              <i class="bi bi-building me-1"></i>Block Number
            </label>
            <input type="text" class="form-control" id="search_block" name="search_block" 
                   placeholder="Enter block number..." 
                   value="<?= isset($_GET['search_block']) ? htmlspecialchars($_GET['search_block']) : '' ?>"
                   autocomplete="off">
            <div class="form-text">e.g., A1, B2, C3</div>
          </div>
          <div class="col-md-4 mb-3">
            <label for="search_floor" class="form-label">
              <i class="bi bi-layers me-1"></i>Floor Number
            </label>
            <input type="text" class="form-control" id="search_floor" name="search_floor" 
                   placeholder="Enter floor number..." 
                   value="<?= isset($_GET['search_floor']) ? htmlspecialchars($_GET['search_floor']) : '' ?>"
                   autocomplete="off">
            <div class="form-text">Ground floor, 1st, 2nd, etc.</div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="min_price" class="form-label">
              <i class="bi bi-currency-dollar me-1"></i>Minimum Price (ETB)
            </label>
            <input type="number" class="form-control" id="min_price" name="min_price" 
                   placeholder="0" min="0" step="1000"
                   value="<?= isset($_GET['min_price']) ? htmlspecialchars($_GET['min_price']) : '' ?>">
            <div class="form-text">Enter minimum price in Ethiopian Birr</div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="max_price" class="form-label">
              <i class="bi bi-currency-dollar me-1"></i>Maximum Price (ETB)
            </label>
            <input type="number" class="form-control" id="max_price" name="max_price" 
                   placeholder="No limit" min="0" step="1000"
                   value="<?= isset($_GET['max_price']) ? htmlspecialchars($_GET['max_price']) : '' ?>">
            <div class="form-text">Enter maximum price in Ethiopian Birr</div>
          </div>
        </div>
        
        <!-- Quick Price Filters -->
        <div class="row mb-3">
          <div class="col-12">
            <label class="form-label">
              <i class="bi bi-lightning me-1"></i>Quick Price Ranges
            </label>
            <div class="btn-group d-flex flex-wrap gap-2" role="group">
              <button type="button" class="btn btn-outline-primary btn-sm quick-price" data-min="0" data-max="500000">
                Under 500K
              </button>
              <button type="button" class="btn btn-outline-primary btn-sm quick-price" data-min="500000" data-max="1000000">
                500K - 1M
              </button>
              <button type="button" class="btn btn-outline-primary btn-sm quick-price" data-min="1000000" data-max="2000000">
                1M - 2M
              </button>
              <button type="button" class="btn btn-outline-primary btn-sm quick-price" data-min="2000000" data-max="5000000">
                2M - 5M
              </button>
              <button type="button" class="btn btn-outline-primary btn-sm quick-price" data-min="5000000" data-max="0">
                Above 5M
              </button>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-12">
            <div class="d-flex gap-2 flex-wrap">
              <button type="submit" class="btn btn-search text-white flex-fill">
                <i class="bi bi-search me-2"></i>Search Properties
              </button>
              <?php if (!empty($_GET)): ?>
                <a href="properties.php" class="btn btn-outline-secondary">
                  <i class="bi bi-arrow-clockwise me-2"></i>Clear All
                </a>
              <?php endif; ?>
              <button type="button" class="btn btn-outline-info" id="advancedToggle">
                <i class="bi bi-gear me-2"></i>Advanced
              </button>
            </div>
          </div>
        </div>
        
        <!-- Advanced Search Options (Hidden by default) -->
        <div class="row mt-3 d-none" id="advancedOptions">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h6 class="mb-0"><i class="bi bi-sliders me-2"></i>Advanced Search Options</h6>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-4 mb-3">
                    <label for="sort_by" class="form-label">Sort By</label>
                    <select class="form-select" id="sort_by" name="sort_by">
                      <option value="">Default</option>
                      <option value="price_low" <?= (isset($_GET['sort_by']) && $_GET['sort_by'] == 'price_low') ? 'selected' : '' ?>>Price: Low to High</option>
                      <option value="price_high" <?= (isset($_GET['sort_by']) && $_GET['sort_by'] == 'price_high') ? 'selected' : '' ?>>Price: High to Low</option>
                      <option value="owner_name" <?= (isset($_GET['sort_by']) && $_GET['sort_by'] == 'owner_name') ? 'selected' : '' ?>>Owner Name A-Z</option>
                      <option value="block_number" <?= (isset($_GET['sort_by']) && $_GET['sort_by'] == 'block_number') ? 'selected' : '' ?>>Block Number</option>
                    </select>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="room_size_min" class="form-label">Min Room Size (m²)</label>
                    <input type="number" class="form-control" id="room_size_min" name="room_size_min" 
                           placeholder="0" min="0"
                           value="<?= isset($_GET['room_size_min']) ? htmlspecialchars($_GET['room_size_min']) : '' ?>">
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="room_size_max" class="form-label">Max Room Size (m²)</label>
                    <input type="number" class="form-control" id="room_size_max" name="room_size_max" 
                           placeholder="No limit" min="0"
                           value="<?= isset($_GET['room_size_max']) ? htmlspecialchars($_GET['room_size_max']) : '' ?>">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>

<!-- PROPERTIES SECTION -->
<section class="properties-section">
  <div class="container">
    <div class="row">

      <?php 
      // Get search parameters
      $search_owner = isset($_GET['search_owner']) ? trim($_GET['search_owner']) : '';
      $search_block = isset($_GET['search_block']) ? trim($_GET['search_block']) : '';
      $search_floor = isset($_GET['search_floor']) ? trim($_GET['search_floor']) : '';
      $min_price = isset($_GET['min_price']) ? (int)$_GET['min_price'] : 0;
      $max_price = isset($_GET['max_price']) ? (int)$_GET['max_price'] : 0;
      $sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : '';
      $room_size_min = isset($_GET['room_size_min']) ? (int)$_GET['room_size_min'] : 0;
      $room_size_max = isset($_GET['room_size_max']) ? (int)$_GET['room_size_max'] : 0;

      // Get properties
      $dataQ = $CommonOBJ->getProperties();
      $filteredProperties = [];

      // Filter properties based on search criteria
      if ($dataQ) {
        foreach ($dataQ as $property) {
          $matches = true;
          
          // Filter by owner name (case-insensitive partial match)
          if (!empty($search_owner) && stripos($property['OwnerName'], $search_owner) === false) {
            $matches = false;
          }
          
          // Filter by block number (case-insensitive partial match)
          if (!empty($search_block) && stripos($property['BlockNo'], $search_block) === false) {
            $matches = false;
          }
          
          // Filter by floor number (case-insensitive partial match)
          if (!empty($search_floor) && stripos($property['FloorNumber'], $search_floor) === false) {
            $matches = false;
          }
          
          // Filter by price range
          $price = (int)$property['SalePrice'];
          if ($min_price > 0 && $price < $min_price) {
            $matches = false;
          }
          if ($max_price > 0 && $price > $max_price) {
            $matches = false;
          }
          
          // Filter by room size range
          $roomSize = (int)$property['RoomSize'];
          if ($room_size_min > 0 && $roomSize < $room_size_min) {
            $matches = false;
          }
          if ($room_size_max > 0 && $roomSize > $room_size_max) {
            $matches = false;
          }
          
          if ($matches) {
            $filteredProperties[] = $property;
          }
        }
        
        // Sort properties based on sort_by parameter
        if (!empty($sort_by) && !empty($filteredProperties)) {
          switch ($sort_by) {
            case 'price_low':
              usort($filteredProperties, function($a, $b) {
                return (int)$a['SalePrice'] - (int)$b['SalePrice'];
              });
              break;
            case 'price_high':
              usort($filteredProperties, function($a, $b) {
                return (int)$b['SalePrice'] - (int)$a['SalePrice'];
              });
              break;
            case 'owner_name':
              usort($filteredProperties, function($a, $b) {
                return strcasecmp($a['OwnerName'], $b['OwnerName']);
              });
              break;
            case 'block_number':
              usort($filteredProperties, function($a, $b) {
                return strcasecmp($a['BlockNo'], $b['BlockNo']);
              });
              break;
          }
        }
      }

      if (!empty($filteredProperties)): 
        foreach ($filteredProperties as $key => $value): ?>

        <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="<?= ($key % 3) * 100 + 100 ?>">
          <div class="property-card">
            <div class="position-relative">
              <img src="files/rooms/<?= isset($value['Block_Url']) ? $value['Block_Url'] : 'default.jpg' ?>" 
                   alt="Property Image" class="img-fluid">
              <span class="sale-badge">FOR SALE</span>
            </div>
            <div class="card-body">
              <h3 class="property-title">
                <a href="#" class="stretched-link"><?= htmlspecialchars($value['OwnerName']) ?></a>
              </h3>
              <div class="price-tag">
                ETB <?= number_format($value['SalePrice']) ?>
              </div>
              <div class="property-info">
                <div class="row">
                  <div class="col">Area</div>
                  <div class="col">Block</div>
                  <div class="col">Floor</div>
                  <div class="col">Status</div>
                </div>
                <div class="row">
                  <div class="col"><?= htmlspecialchars($value['RoomSize']) ?> m²</div>
                  <div class="col"><?= htmlspecialchars($value['BlockNo']) ?></div>
                  <div class="col"><?= htmlspecialchars($value['FloorNumber']) ?></div>
                  <div class="col">Available</div>
                </div>
              </div>
            </div>
          </div>
        </div>

      <?php endforeach; 
      else: ?>

        <div class="col-12">
          <div class="no-results">
            <i class="bi bi-house-x"></i>
            <h3>No Properties Found</h3>
            <p>
              <?php if (!empty($_GET)): ?>
                No properties match your search criteria. Try adjusting your filters or <a href="properties.php">view all properties</a>.
              <?php else: ?>
                No properties are currently available. Please check back later.
              <?php endif; ?>
            </p>
            <?php if (!empty($_GET)): ?>
              <div class="mt-3">
                <a href="properties.php" class="btn btn-primary">
                  <i class="bi bi-arrow-left me-2"></i>View All Properties
                </a>
              </div>
            <?php endif; ?>
          </div>
        </div>

      <?php endif; ?>

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

// Search form enhancements
const searchForm = document.querySelector('.search-form');
if (searchForm) {
  // Auto-submit on Enter key
  searchForm.addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
      e.preventDefault();
      this.submit();
    }
  });
  
  // Price validation
  const minPrice = document.getElementById('min_price');
  const maxPrice = document.getElementById('max_price');
  
  if (minPrice && maxPrice) {
    function validatePrices() {
      const min = parseInt(minPrice.value) || 0;
      const max = parseInt(maxPrice.value) || 0;
      
      if (min > 0 && max > 0 && min > max) {
        maxPrice.setCustomValidity('Maximum price must be greater than minimum price');
        maxPrice.classList.add('is-invalid');
      } else {
        maxPrice.setCustomValidity('');
        maxPrice.classList.remove('is-invalid');
      }
    }
    
    minPrice.addEventListener('input', validatePrices);
    maxPrice.addEventListener('input', validatePrices);
  }
  
  // Room size validation
  const minRoomSize = document.getElementById('room_size_min');
  const maxRoomSize = document.getElementById('room_size_max');
  
  if (minRoomSize && maxRoomSize) {
    function validateRoomSizes() {
      const min = parseInt(minRoomSize.value) || 0;
      const max = parseInt(maxRoomSize.value) || 0;
      
      if (min > 0 && max > 0 && min > max) {
        maxRoomSize.setCustomValidity('Maximum room size must be greater than minimum room size');
        maxRoomSize.classList.add('is-invalid');
      } else {
        maxRoomSize.setCustomValidity('');
        maxRoomSize.classList.remove('is-invalid');
      }
    }
    
    minRoomSize.addEventListener('input', validateRoomSizes);
    maxRoomSize.addEventListener('input', validateRoomSizes);
  }
}

// Quick price filter buttons
const quickPriceButtons = document.querySelectorAll('.quick-price');
quickPriceButtons.forEach(button => {
  button.addEventListener('click', function() {
    const minPrice = this.dataset.min;
    const maxPrice = this.dataset.max;
    
    document.getElementById('min_price').value = minPrice > 0 ? minPrice : '';
    document.getElementById('max_price').value = maxPrice > 0 ? maxPrice : '';
    
    // Remove active class from all buttons
    quickPriceButtons.forEach(btn => btn.classList.remove('active'));
    // Add active class to clicked button
    this.classList.add('active');
    
    // Auto-submit form
    document.getElementById('searchForm').submit();
  });
});

// Advanced options toggle
const advancedToggle = document.getElementById('advancedToggle');
const advancedOptions = document.getElementById('advancedOptions');

if (advancedToggle && advancedOptions) {
  advancedToggle.addEventListener('click', function() {
    if (advancedOptions.classList.contains('d-none')) {
      advancedOptions.classList.remove('d-none');
      this.innerHTML = '<i class="bi bi-gear-fill me-2"></i>Hide Advanced';
      this.classList.add('active');
    } else {
      advancedOptions.classList.add('d-none');
      this.innerHTML = '<i class="bi bi-gear me-2"></i>Advanced';
      this.classList.remove('active');
    }
  });
}

// Auto-complete suggestions for owner names (if you have a list)
const ownerInput = document.getElementById('search_owner');
if (ownerInput) {
  // You can implement autocomplete here if you have a list of owner names
  ownerInput.addEventListener('input', function() {
    // Implement autocomplete logic here
  });
}

// Real-time search counter
function updateSearchCounter() {
  const propertyCards = document.querySelectorAll('.property-card');
  const counter = propertyCards.length;
  
  // Update page title with count
  if (counter > 0) {
    document.title = `Properties (${counter} found) - Adis Abeba Real Estate`;
  } else {
    document.title = 'Properties - Adis Abeba Real Estate';
  }
}

// URL parameter management
function updateURL() {
  const form = document.getElementById('searchForm');
  const formData = new FormData(form);
  const params = new URLSearchParams();
  
  for (let [key, value] of formData.entries()) {
    if (value.trim() !== '') {
      params.append(key, value);
    }
  }
  
  const newURL = window.location.pathname + (params.toString() ? '?' + params.toString() : '');
  window.history.replaceState({}, '', newURL);
}

// Initialize search counter
updateSearchCounter();

// Property card animations
const propertyCards = document.querySelectorAll('.property-card');
propertyCards.forEach(card => {
  card.addEventListener('mouseenter', function() {
    this.style.transform = 'translateY(-10px) scale(1.02)';
  });
  
  card.addEventListener('mouseleave', function() {
    this.style.transform = 'translateY(0) scale(1)';
  });
});

// Search results counter
const searchResults = document.querySelectorAll('.property-card').length;
if (searchResults > 0) {
  console.log(`Found ${searchResults} properties`);
}
</script>

</body>
</html>