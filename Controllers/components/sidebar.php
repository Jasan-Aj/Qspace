<div class="sidebar">

    <div class="logo-details">
        <i class="bx bxl-c-plus-plus"></i>
        <span class="logo_name">Q-SPACE</span>
    </div>
    

        <?php if(isset($_SESSION['user_id'])): ?>
          
          <?php if(getUser($_SESSION['user_id']) == 'user'): ?>
            <ul class="nav-links">
              <li>
                <a href="<?php echo addRoute('rooms') ?>" class=<?php echo $_SERVER['REQUEST_URI'] == addRoute('rooms') ? "active" : ""  ?> >
                  <i class="bx bx-grid-alt"></i>
                  <span class="links_name">Explore Rooms</span>
                </a>
              </li>

              
              <li>
                <a href="<?php echo addRoute('myrooms') ?>" class=<?php echo $_SERVER['REQUEST_URI'] == addRoute('myrooms') ? "active" : ""  ?>>
                  <i class="bx bx-grid-alt"></i>
                  <span class="links_name">My Rooms</span>
                </a>
              </li>
             
            
            <?php else: ?>

            <ul class="nav-links">
              <li>
                <a href="<?php echo addRoute('admin') ?>" class=<?php echo $_SERVER['REQUEST_URI'] == addRoute('admin') ? "active" : ""  ?> >
                  <i class="bx bx-grid-alt"></i>
                  <span class="links_name">Dashboard</span>
                </a>
              </li>

              <li>
                <a href="<?php echo addRoute('admin_rooms') ?>" class=<?php echo $_SERVER['REQUEST_URI'] == addRoute('admin_rooms') ? "active" : ""  ?> >
                  <i class="bx bx-grid-alt"></i>
                  <span class="links_name">Rooms</span>
                </a>
              </li>

              <li>
                <a href="<?php echo addRoute('admin_users') ?>" class=<?php echo $_SERVER['REQUEST_URI'] == addRoute('admin_users') ? "active" : ""  ?> >
                  <i class="bx bx-grid-alt"></i>
                  <span class="links_name">Users</span>
                </a>
              </li>

              <li>
                <a href="<?php echo addRoute('admin_topics') ?>" class=<?php echo $_SERVER['REQUEST_URI'] == addRoute('admin_topics') ? "active" : ""  ?> >
                  <i class="bx bx-grid-alt"></i>
                  <span class="links_name">Topics</span>
                </a>
              </li>

          <?php endif ?>

              <li class="log_out">
                  <a href="<?php echo addRoute('logout') ?>">
                    <i class="bx bx-log-out"></i>
                    <p class="text-white font-semibold">Logout</p>
                  </a>
              </li>
        <?php else: ?>
          
            <ul class="nav-links">
              <li>
                <a href="<?php echo addRoute('rooms') ?>" class=<?php echo $_SERVER['REQUEST_URI'] == addRoute('rooms') ? "active" : ""  ?> >
                  <i class="bx bx-grid-alt"></i>
                  <span class="links_name">Explore Rooms</span>
                </a>
              </li>
            </ul>
        <?php endif ?>
        
              
          
         

      </ul>
    </div>