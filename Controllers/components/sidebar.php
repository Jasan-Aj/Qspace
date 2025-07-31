<div class="sidebar">
      <div class="logo-details">
        <i class="bx bxl-c-plus-plus"></i>
        <span class="logo_name">Q-SPACE</span>
      </div>
      <ul class="nav-links">
        <li>
          <a href="<?php echo addRoute('rooms') ?>" class=<?php echo $_SERVER['REQUEST_URI'] == addRoute('rooms') ? "active" : ""  ?> >
            <i class="bx bx-grid-alt"></i>
            <span class="links_name">Explore Rooms</span>
          </a>
        </li>

        <?php if(isset($_SESSION['user'])):?>
        <li>
          <a href="<?php echo addRoute('myrooms') ?>" class=<?php echo $_SERVER['REQUEST_URI'] == addRoute('myrooms') ? "active" : ""  ?>>
            <i class="bx bx-grid-alt"></i>
            <span class="links_name">My Rooms</span>
          </a>
        </li>
        <?php endif ?>
        

        <?php if(isset($_SESSION['user'])): ?>
        <li class="log_out">
          <form  action="<?php echo addRoute('logout') ?>" method="post">
            <a>
              <i class="bx bx-log-out"></i>
              <input type="hidden" value="DELETE" name="__method">
              <input class="links_name" style="background-color: #0A2558; color:white; font-family: 'Poppins', sans-serif; border:none; font-weight:bold; cursor:pointer; " type="submit" value="Log out">
            </a>
          </form>
        </li>
        <?php endif ?>

      </ul>
    </div>