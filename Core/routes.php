<?php 
   $router->get('/QSPACE/','Controllers/index.php')->only('guest');
   $router->get('/QSPACE/rooms','Controllers/Rooms/index.php');
   $router->get('/QSPACE/login','Controllers/user/login.php')->only('guest');
   $router->get('/QSPACE/create-room','Controllers/Rooms/create.php')->only('auth');
   $router->get('/QSPACE/register','Controllers/user/register.php')->only('guest');
   $router->get('/QSPACE/join-notice/','Controllers/room/notice.php')->only('auth');
   $router->get('/QSPACE/myrooms','Controllers/room/index.php')->only('auth');
   $router->get('/QSPACE/chat/','Controllers/room/chat.php')->only('auth');

   $router->post('/QSPACE/store','Controllers/Rooms/store.php');
   
   $router->post('/QSPACE/store-user','Controllers/user/store.php');
   $router->post('/QSPACE/session','Controllers/user/sessions.php');

   $router->delete('/QSPACE/logout','Controllers/user/logout.php')->only('auth');

   $router->put('/QSPACE/join-notice/store','Controllers/room/store.php');
?>