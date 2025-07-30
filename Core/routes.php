<?php 
   
   $router->get('/git/Qspace/','Controllers/index.php')->only('guest');
   $router->get('/git/Qspace/rooms','Controllers/Rooms/index.php');
   $router->get('/git/Qspace/login','Controllers/user/login.php')->only('guest');
   $router->get('/git/Qspace/create-room','Controllers/Rooms/create.php')->only('auth');
   $router->get('/git/Qspace/register','Controllers/user/register.php')->only('guest');
   $router->get('/git/Qspace/join-notice/','Controllers/room/notice.php')->only('auth');
   $router->get('/git/Qspace/myrooms','Controllers/room/index.php')->only('auth');
   $router->get('/git/Qspace/chat/','Controllers/room/chat.php')->only('auth');

   $router->post('/git/Qspace/store','Controllers/Rooms/store.php');
   
   $router->post('/git/Qspace/store-user','Controllers/user/store.php');
   $router->post('/git/Qspace/session','Controllers/user/sessions.php');

   $router->delete('/git/Qspace/logout','Controllers/user/logout.php')->only('auth');

   $router->put('/git/Qspace/join-notice/store','Controllers/room/store.php');
?>