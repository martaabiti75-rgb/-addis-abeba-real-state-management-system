<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="dashboard">
          <i class="bi bi-grid"></i>
          <span>DASHBOARD</span>
        </a>
      </li>
      <!-- End Dashboard Nav -->


    <!-- <li class="nav-heading">Pages</li> -->

      <li class="nav-item">

         <?php
            $param = 1;
            $param2 = $cid;
            $CartQuantity = $isPerformCustOBJ->getCartQuantity($param,$param2);
          ?>
        <a class="nav-link collapsed" href="carts">
          <i class="bi bi-cart"></i>
          <span>Carts </span><span>&nbsp;<?=$Q = $CartQuantity ? $CartQuantity : 0 ?></span>
        </a>
      </li>

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-people"></i><span>My Account</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
         <li>
          <a href="link_account">
            <i class="bi bi-circle"></i><span>Link Account</span>
          </a>
        </li> 

        <li>
          <a href="linked_account">
            <i class="bi bi-circle"></i><span>Linked Accounts</span>
          </a>
        </li>

      </ul>
    </li>


     <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav1" data-bs-toggle="collapse" href="#">
          <i class="bi bi-egg-fried"></i><span>Properties Module</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav1" class="nav-content collapse " data-bs-parent="#sidebar-nav">
         <!--  <li>
            <a href="new_products">
              <i class="bi bi-circle"></i><span>New Products</span>
            </a>
          </li> -->
          <li>
            <a href="properties">
              <i class="bi bi-circle"></i><span>Properties List</span>
            </a>
          </li>

        </ul>
      </li>


      <li class="nav-item">
  <a class="nav-link collapsed" data-bs-target="#sales-nav" data-bs-toggle="collapse" href="#">
    <i class="bi bi-receipt-cutoff"></i>
    <span>Sales Management</span>
    <i class="bi bi-chevron-down ms-auto"></i>
  </a>

  <ul id="sales-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">

    <li>
      <a href="pending_orders">
        <i class="bi bi-bag-check"></i><span>Pending Orders</span>
      </a>
    </li>

    <li>
      <a href="recent_orders">
        <i class="bi bi-clock-history"></i><span>Recent Orders</span>
      </a>
    </li>

     <li>
      <a href="recent_carts">
        <i class="bi bi-clock-history"></i><span>Recent Carts</span>
      </a>
    </li>

    <li>
      <a href="transactions">
        <i class="bi bi-credit-card-2-back"></i><span>Transactions</span>
      </a>
    </li>

  </ul>
</li>


      <li class="nav-heading">Pages</li>

        <li class="nav-item">
        <a class="nav-link collapsed" href="contact_us">
          <i class="bi bi-envelope"></i>
          <span>Contact Us</span>
        </a>
      </li>

        <li class="nav-item">
        <a class="nav-link collapsed" href="settings">
          <i class="bi bi-question-circle"></i>
          <span>Setting</span>
        </a>
      </li>
   
      <li class="nav-item">
        <a class="nav-link collapsed" href="authpass">
          <i class="bi bi-info-circle"></i>
          <span>Change Password ?</span> 
        </a>
      </li>
    
    <li class="nav-item">
        <a class="nav-link collapsed" href="../pages-logout.php">
          <i class="bi bi-info-circle"></i>
          <span>Sign Out ?</span> 
        </a>
    </li>
    

    </ul>

  </aside>