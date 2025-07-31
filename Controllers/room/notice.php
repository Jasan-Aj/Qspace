<?php 

    require base_path('Controllers/components/header.php');

?>
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

<?php include base_path('Controllers/components/sidebar.php') ?>
    <section class="home-section">

        <nav>
            <div class="sidebar-button">
            <i class="bx bx-menu sidebarBtn"></i>
            <span class="dashboard">Available Rooms</span>
            </div>
            <div class="search-box">
            <input type="text" placeholder="Search..." />
            <i class="bx bx-search"></i>
            </div>
            <div class="profile-details">
                <?php if(isset($_SESSION['user'])): ?>
                    <img src="assets/pic.jpg" alt="" />
                    <span class="admin_name"><?php echo $_SESSION['user'] ?></span>
                    <i class="bx bx-chevron-down"></i>
                <?php else: ?>
                    <div class="buttons">
                        <a href="login"><button>Login</button></a>
                        <a href="register"><button>Sign up</button></a>
                    </div>
                <?php endif ?>
            </div>
        </nav>

        <div class="home-content">

        <div class="flex items-center justify-center p-4">
            <div class="w-full max-w-md bg-white rounded-xl shadow-lg overflow-hidden">
                
                <div class="bg-indigo-600 p-6 text-center">
                <h2 class="text-2xl font-bold text-white">Room Guidelines</h2>
                <p class="text-indigo-100 mt-1">Please read and accept before joining</p>
                </div>
                
                
                <div class="p-6 space-y-4">
                <div class="bg-gray-50 p-4 rounded-lg max-h-64 overflow-y-auto">
                    <h3 class="font-semibold text-gray-800 mb-2">Community Rules:</h3>
                    <ul class="space-y-2 text-gray-600 text-sm">
                    <li class="flex items-start">
                        <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Be respectful to all participants
                    </li>
                    <li class="flex items-start">
                        <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        No abusive language or harassment
                    </li>
                    <li class="flex items-start">
                        <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Keep discussions relevant to the room topic
                    </li>
                    <li class="flex items-start">
                        <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        No spamming or self-promotion
                    </li>
                    <li class="flex items-start">
                        <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Respect privacy - don't share others' information
                    </li>
                    <li class="flex items-start">
                        <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Report any violations to moderators
                    </li>
                    </ul>
                </div>
                
                <form action="store" method="post">

                <div class="flex items-start">
                    <div class="flex items-center h-5">
                    <input id="accept-terms" name="accept-terms" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" required/>
                    </div>
                    <div class="ml-3 text-sm">
                    <label for="accept-terms" class="font-medium text-gray-700">I agree to follow these guidelines</label>
                    <p class="text-gray-500">Violations may result in removal from the room</p>
                    </div>
                </div>
                </div>
                
                <input type="hidden" value="PUT" name="__method">
                <input type="hidden" name="room_id" value="<?php echo $_GET['id'] ?>">
                
                <div class="bg-gray-50 px-6 py-4 flex flex-col sm:flex-row-reverse justify-between">
                <input  type="submit" value=" Join Room" class="w-full sm:w-auto mb-2 sm:mb-0 inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:text-sm disabled:opacity-50 disabled:cursor-not-allowed">
                </form>

                <a href="<?php echo addRoute('rooms') ?>" class="w-full sm:w-auto inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">
                    Cancel
                </a>
                </div>
            </div>
            </div>
        </div>
    </section>



<?php include base_path('Controllers/components/footer.php') ?>