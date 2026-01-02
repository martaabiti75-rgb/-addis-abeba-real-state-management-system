<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="profile-image">
                <?php  if (empty($url)) { ?>
                    <img class="rounded-circle" src="../assets/img/avatar/user.jpg" width="24" alt="">
                <?php }else{ ?> 
                    <img class="rounded-circle" src="<?=$url; ?>" width="24" alt="">
                <?php } ?>
              </div>
              <div class="profile-name">
                <p class="name" style="font-size: 14px;">
                  Welcome <?=$fullname; ?>
                </p>
                <p class="designation">
                  <?=$role; ?>
                </p>
              </div>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="dashboard">
              <i class="fa fa-home menu-icon"></i>
              <span class="menu-title">ዳሽቦርድ</span>
            </a>
          </li>

           <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="fas fa-window-restore menu-icon"></i>
              <span class="menu-title">የተጠቃሚ ገጾች</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="userlist"> የተጠቃሚ ዝርዝሮች </a></li>
                <li class="nav-item"> <a class="nav-link" href="newuser"> አዲስ ተጠቃሚዎች </a></li>
                
              </ul>
            </div>
          </li>
          
           <li class="nav-item">
            <a class="nav-link" href="setting">
              <i class="fas fa-bell menu-icon"></i>
              <span class="menu-title">ቅንብሮች</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="password">
              <i class="fas fa-bell menu-icon"></i>
              <span class="menu-title">የይለፍ ቃል ይቀይሩ ?</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../pages_logout.php">
              <i class="fas fa-power-off menu-icon"></i>
              <span class="menu-title">ዘግተህ ውጣ ?</span>
            </a>
          </li>
     
        </ul>
      </nav>