<?php

if(isset($_SESSION['user_id'])) {
    $config = require base_path("Core/config.php");
    $db = new Database($config);
    $id = $_SESSION['user_id'];

    $res = $db->query("SELECT username FROM user WHERE id =:id",[
        'id'=> $id
    ])->fetch();

    $username = $res['username'];

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
    
    <div class="profile-details">
        <?php if(isset($_SESSION['user_id'])): ?>
            <a href="<?php echo addRoute('profile') ?>">
                <img src="<?php echo $profilePath ?>" alt="Profile Picture" />
            </a>
            <a href="<?php echo addRoute('profile') ?>">
                <span class="admin_name"><?php echo $username ?></span>
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