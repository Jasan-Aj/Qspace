<?php
    require base_path("Controllers/components/header.php");
    require base_path("Controllers/components/sidebar.php");

    $config = require base_path('Core/config.php');
    $db = new Database($config);

    $user_count = $db->query("SELECT COUNT(*) as user_count FROM user")->fetch();
    $room_count = $db->query("SELECT COUNT(*) as room_count FROM rooms")->fetch();
    $message_count = $db->query("SELECT COUNT(*) as message_count FROM messages")->fetch();

    $rooms = $db->query("SELECT * FROM rooms")->fetchAll();
    $users = $db->query("SELECT * FROM user")->fetchAll();
    $default_dp = "pic.png";
 ?>
  
  <section class="home-section">
    <?php require base_path("Controllers/components/nav_without_search.php") ?>
    <div class="home-content">
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Users</div>
            <div class="number"><?php echo $user_count['user_count'] ?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">Up from yesterday</span>
            </div>
          </div>
          <i class='bx bx-cart-alt cart'></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Rooms</div>
            <div class="number"><?php echo $room_count['room_count'] ?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">Up from yesterday</span>
            </div>
          </div>
          <i class='bx bxs-cart-add cart two' ></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Messages</div>
            <div class="number"><?php echo $message_count['message_count'] ?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">Up from yesterday</span>
            </div>
          </div>
          <i class='bx bx-cart cart three' ></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Revanue</div>
            <div class="number">0</div>
            <div class="indicator">
              <i class='bx bx-down-arrow-alt down'></i>
              <span class="text">Down From Today</span>
            </div>
          </div>
          <i class='bx bxs-cart-download cart four' ></i>
        </div>
      </div>
      <div class="sales-boxes">
        <div class="recent-sales box">
          <div class="title">Available Rooms</div>
          <div class="sales-details">
            <ul class="details">
                <li class="topic">Created</li>
                <?php foreach($rooms as $room): ?>
                    <li><p><?php echo $room['created_date'] ?></p></li>
                <?php endforeach ?>
              
            </ul>
            <ul class="details">
            <li class="topic">Name</li>
            <?php foreach($rooms as $room): ?>
                <li><p class="truncate w-22"><?php echo $room['name'] ?></p></li>
            <?php endforeach ?>
          </ul>
          <ul class="details">
            <li class="topic">Topic</li>
            <?php foreach($rooms as $room): ?>
                <li><p><?php echo $room['topic'] ?></p></li>
            <?php endforeach ?>
          </ul>
          <ul class="details">
            <li class="topic">Participants</li>
            <?php foreach($rooms as $room): ?>
                <li><p><?php echo getRoomMemberCount($room['id']) ?></p></li>
            <?php endforeach ?>
          </ul>
          </div>
          <div class="button">
            <a href="<?php echo addRoute('admin_rooms') ?>">See All</a>
          </div>
        </div>
        <div class="top-sales box">
          <div class="title">Users</div>
          <ul class="top-sales-details">
        
            <?php foreach($users as $user): ?>

                <li>
                    <a>
                    <img src="assets/uploads/<?php echo $user['profile_pic'] ? $user['profile_pic'] : $default_dp ?>" alt="">
                    <span class="product truncate w-27"><?php echo $user['username'] ?></span>
                    </a>
                    <span class="price"><?php echo $user['role'] ?></span>
                </li>

            <?php endforeach ?>

          </ul>
        </div>
      </div>
    </div>
  </section>
  <script>
   let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function() {
  sidebar.classList.toggle("active");
  if(sidebar.classList.contains("active")){
  sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
}else
  sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
}
 </script>
</body>
</html>