<?php

if(isset($_SESSION['user'])) {
    $config = require base_path("Core/config.php");
    $db = new Database($config);
    $res = $db->query("SELECT id FROM user WHERE username = :username",[
      'username' => $_SESSION['user']
    ])->fetch();
    $id = $res['id'];

    $res = $db->query("SELECT profile_pic FROM user WHERE id = :id",[
      'id' => $id
    ])->fetch();

    $profile_pic = $res['profile_pic'];
    if($profile_pic){
      $profilePath = "assets/uploads/".$profile_pic;
    }
    else{
      $profilePath= "assets/pic.png";
    }
}
?>

<nav>
    <div class="sidebar-button">
        <i class="bx bx-menu sidebarBtn"></i>
        <span class="dashboard"><?php echo $heading ?></span>
    </div>
    <div class="search-box">
        <input type="text" placeholder="Search..." />
        <i class="bx bx-search"></i>
    </div>
    <div class="profile-details">
        <?php if(isset($_SESSION['user'])): ?>
            <a href="<?php echo addRoute('profile') ?>">
                <img src="<?php echo $profilePath ?>" alt="Profile Picture" />
            </a>
            <a href="">
                <span class="admin_name"><?php echo $_SESSION['user'] ?></span>
            </a>
            <i class="bx bx-chevron-down"></i>
        <?php else: ?>
            <div class="buttons">
                <a href="login"><button>Login</button></a>
                <a href="register"><button>Sign up</button></a>
            </div>
        <?php endif ?>
    </div>
</nav>