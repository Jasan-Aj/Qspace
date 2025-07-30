<?php
    $username = $_SESSION['user'];
    $room_id = $_GET['id'];
    $config = require base_path('Core/config.php');
    $db = new Database($config);

    $res = $db->query("SELECT * FROM rooms WHERE id=:id",[
      'id' => $room_id
    ])->fetchAll();
    
    $room = $res[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://cdn.tailwindcss.com"></script>
  
  <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    /* Add the sidebar CSS from the working example */
    *{
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }
    .sidebar{
      position: fixed;
      height: 100%;
      width: 240px;
      background: #0A2558;
      transition: all 0.5s ease;
      z-index: 1000;
    }
    .sidebar.active{
      width: 60px;
    }
    .sidebar .logo-details{
      height: 80px;
      display: flex;
      align-items: center;
    }
    .sidebar .logo-details i{
      font-size: 28px;
      font-weight: 500;
      color: #fff;
      min-width: 60px;
      text-align: center
    }
    .sidebar .logo-details .logo_name{
      color: #fff;
      font-size: 24px;
      font-weight: 500;
    }
    .sidebar .nav-links{
      margin-top: 10px;
    }
    .sidebar .nav-links li{
      position: relative;
      list-style: none;
      height: 50px;
    }
    .sidebar .nav-links li a{
      height: 100%;
      width: 100%;
      display: flex;
      align-items: center;
      text-decoration: none;
      transition: all 0.4s ease;
      color: white;
    }
    .sidebar .nav-links li a.active{
      background: #081D45;
    }
    .sidebar .nav-links li a:hover{
      background: #081D45;
    }
    .sidebar .nav-links li i{
      min-width: 60px;
      text-align: center;
      font-size: 18px;
      color: #fff;
    }
    .sidebar .nav-links li a .links_name{
      color: #fff;
      font-size: 15px;
      font-weight: 400;
      white-space: nowrap;
    }
    .sidebar .nav-links .log_out{
      position: absolute;
      bottom: 0;
      width: 100%;
    }
    
    /* Adjust the main content area */
    main {
      position: relative;
      min-height: 100vh;
      width: calc(100% - 240px);
      left: 240px;
      transition: all 0.5s ease;
      background: white;
    }
    .sidebar.active ~ main {
      width: calc(100% - 60px);
      left: 60px;
    }
    
    /* Style for the sidebar toggle button in main */
    .sidebar-toggle {
      position: fixed;
      top: 20px;
      left: 260px;
      z-index: 1001;
      cursor: pointer;
      transition: all 0.5s ease;
    }
    .sidebar.active ~ main .sidebar-toggle {
      left: 80px;
    }
    
    /* Responsive adjustments */
    @media (max-width: 1240px) {
      .sidebar{
        width: 60px;
      }
      .sidebar.active{
        width: 220px;
      }
      main {
        width: calc(100% - 60px);
        left: 60px;
      }
      .sidebar.active ~ main {
        left: 220px;
        width: calc(100% - 220px);
      }
      .sidebar-toggle {
        left: 80px;
      }
      .sidebar.active ~ main .sidebar-toggle {
        left: 240px;
      }
    }
  </style>
</head>

<body>
  <div class="sidebar">
    <div class="logo-details">
      <i class="bx bxl-c-plus-plus"></i>
      <span class="logo_name">Q-SPACE</span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="/QSPACE/rooms" class="<?php echo $_SERVER['REQUEST_URI'] == '/QSPACE/rooms' ? 'active' : '' ?>">
          <i class="bx bx-grid-alt"></i>
          <span class="links_name">Explore Rooms</span>
        </a>
      </li>

      <li>
        <a href="/QSPACE/myrooms" class="<?php echo $_SERVER['REQUEST_URI'] == '/QSPACE/myrooms' ? 'active' : '' ?>">
          <i class="bx bx-box"></i>
          <span class="links_name">My Rooms</span>
        </a>
      </li>
      
      <?php if(isset($_SESSION['user'])): ?>
      <li class="log_out">
        <form action="/QSPACE/logout" method="post">
          <a style="display: flex; align-items: center;">
            <i class="bx bx-log-out"></i>
            <input type="hidden" value="DELETE" name="__method">
            <input class="links_name" style="background: transparent; color: white; border: none; font-weight: 400; cursor: pointer; padding: 0; margin-left: 10px;" type="submit" value="Log out">
          </a>
        </form>
      </li>
      <?php endif ?>
    </ul>
  </div>
  
  <main class="grid h-screen grid-cols-[70%_30%] fixed">
    <!-- Sidebar toggle button -->
    <div class="sidebar-toggle">
      <i class="bx bx-menu sidebarBtn text-3xl"></i>
    </div>
    
    <!-- body-->
    <div class="bg-white mx-3 my-3 grid grid-rows-[11%_80%_9%] overflow-hidden shadow-lg rounded-lg">
      <div class="mt-1 flex items-center justify-center">
        <div class="bg-white w-[75%] rounded-lg flex justify-between shadow-md p-3">
          <div class="flex gap-3 items-center">
            <img src="assets\pic.jpg" class="w-[40px] h-[40px] rounded-full">
            <p class="text-lg font-bold"><?php echo $room['name'] ?></p>
          </div>
          <div class="flex items-center">
            <button><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
          </svg></button>
          </div>
        </div>
      </div>

      <div class="mt-1 overflow-y-auto">
      </div>
      
      <form action="" class="mt-1 flex">
        <div class="w-[80%] bg-white ml-9 mb-4 border-2 border-gray-300 rounded-full grid grid-cols-[10%_80%_10%] shadow-lg p-1">
          <div class="flex items-center">
            <button class="bg-gray-100 flex justify-center items-center rounded-full mx-4 my-1"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a6 6 0 0 0 6-6v-1.5m-6 7.5a6 6 0 0 1-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 0 1-3-3V4.5a3 3 0 1 1 6 0v8.25a3 3 0 0 1-3 3Z" />
            </svg>
            </button>
          </div>
          <input class="ml-1 m-1 outline-white" type="text" placeholder="Type your message">
          <button class="bg-gray-100 flex justify-center items-center rounded-full mx-4 my-1"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15m0-3-3-3m0 0-3 3m3-3V15" />
          </svg>
          </button>
        </div>
        <div class="w-[10%] bg-gray-100 ml-3 mb-4 rounded-full flex justify-center items-center shadow-lg">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
          </svg>
        </div>
      </form> 
    </div>

    <div class="grid grid-rows-[10%_90%]">
      <div class="bg-gray-100 mt-3 grid grid-cols-[30%_70%] mx-9 rounded-full shadow-md">
        <div class="mr-1 flex justify-end items-center pr-1">
          <img src="assets/pic.jpg" class="w-[50px] h-[50px] rounded-full">
        </div>
        <div class="flex justify-start items-center pl-1">
          <p class="font-semibold font-mono text-lg"><?php echo $username ?></p>
        </div>
      </div>

      <div class="m-1 px-2">
        <div class="h-[87%] bg-gray-100 mt-[25%] rounded-lg shadow-lg">
          <div class="relative">
            <img src="assets/pic.jpg" class="w-[60px] h-[60px] rounded-full absolute translate-y-[-32px] left-[36%]">
            <div class="flex justify-center pt-[45px]">
              <p class="font-semibold font-mono text-lg">Room Members</p>
            </div>
          </div>

          <div class="grid grid-rows-[40%_30%_20%] h-[80%]">
            <div class="mt-1 flex flex-col items-center">
              <div class="p-1 m-1">
                <div class="grid grid-cols-[26%_74%] w-full pt-3">
                  <img src="assets/pic.jpg" class="w-[65px] h-[65px] rounded-full border-2 border-white">
                  <div class="flex gap-1 flex-wrap pl-2">
                    <img src="assets/pic.jpg" class="w-[40px] h-[40px] rounded-full border-2 border-white">
                    <img src="assets/pic.jpg" class="w-[40px] h-[40px] rounded-full border-2 border-white">
                    <img src="assets/pic.jpg" class="w-[40px] h-[40px] rounded-full border-2 border-white">
                    <img src="assets/pic.jpg" class="w-[40px] h-[40px] rounded-full border-2 border-white">
                    <img src="assets/pic.jpg" class="w-[40px] h-[40px] rounded-full border-2 border-white">
                  </div>
                </div>

                <div class="grid grid-cols-[32%_64%] w-full">
                  <div class="flex items-center flex-col px-1">
                    <p class="font-semibold font-mono text-lg">Username</p>
                    <p class="text-sm">Admin</p>
                  </div>
                  <div class="flex justify-center items-center">
                    <button class="px-4"><</button> <p>1</p>/<p>10</p> <button class="px-4">></button>
                  </div>
                </div>
              </div>
            </div>
            <div class="mt-1"></div>
            <div class="mt-1"></div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- <script>
    // Add the sidebar toggle functionality
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".sidebarBtn");
    if(sidebarBtn) {
      sidebarBtn.onclick = function() {
        sidebar.classList.toggle("active");
        if(sidebar.classList.contains("active")) {
          sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        } else {
          sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        }
      };
    }
  </script> -->
</body>
</html>