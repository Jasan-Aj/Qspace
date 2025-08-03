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
    <div class="search-box">
        <input type="text" id="roomSearchInput" placeholder="Search rooms..." />
        <i class="bx bx-search" id="roomSearchButton"></i>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('roomSearchInput');
    const searchButton = document.getElementById('roomSearchButton');
    
    function filterRooms() {
        const query = searchInput.value.toLowerCase().trim();
        const roomCards = document.querySelectorAll('.home-content > .flex > div'); // Select all room cards
        
        roomCards.forEach(card => {
            const roomName = card.querySelector('.text-gray-800').textContent.toLowerCase();
            const roomTopic = card.querySelector('.text-gray-600').textContent.toLowerCase();
            
            if (roomName.includes(query) || roomTopic.includes(query)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }
    
    
    searchButton.addEventListener('click', filterRooms);
    
    
    let searchTimeout;
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(filterRooms, 300);
    });
    
    
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            filterRooms();
        }
    });
});
</script>