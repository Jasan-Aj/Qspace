<?php 
   
   $router->get(addRoute(),'Controllers/index.php')->only('guest');
   $router->get(addRoute('rooms'),'Controllers/Rooms/index.php');
   $router->get(addRoute('login'),'Controllers/user/login.php')->only('guest');
   $router->get(addRoute('create-room'),'Controllers/Rooms/create.php')->only('auth');
   $router->get(addRoute('register'),'Controllers/user/register.php')->only('guest');
   $router->get(addRoute('join-notice/'),'Controllers/room/notice.php')->only('auth');
   $router->get(addRoute('myrooms'),'Controllers/room/index.php')->only('auth');
   $router->get(addRoute('chat/'),'Controllers/room/chat.php')->only('auth');

   $router->get(addRoute('profile'),'Controllers/setting/profile.php')->only('auth');
   $router->get(addRoute('change_password'),'Controllers/setting/password.php')->only('auth');
   $router->get(addRoute('delete_account'),'Controllers/setting/delete.php')->only('auth');
   $router->get(addRoute('edit_rooms'),'Controllers/setting/edit_rooms.php')->only('auth');
   $router->get(addRoute('edit_room/'),'Controllers/setting/edit_room_form.php')->only('auth');
   $router->get(addRoute('delete_room/'),'Controllers/setting/actions/delete_room.php')->only('auth');

   $router->patch(addRoute('update_profile'),'Controllers/setting/actions/update_profile.php')->only('auth');
   $router->patch(addRoute('update_password'),'Controllers/setting/actions/update_password.php')->only('auth');
   $router->delete(addRoute('delete_account'),'Controllers/setting/actions/delete_account.php')->only('auth');
   $router->patch(addRoute('update_room'),'Controllers/setting/actions/update_room.php')->only('auth');


   $router->post(addRoute('store'),'Controllers/Rooms/store.php');
   
   $router->post(addRoute('store-user'),'Controllers/user/store.php');
   $router->post(addRoute('session'),'Controllers/user/sessions.php');

   $router->delete(addRoute('logout'),'Controllers/user/logout.php')->only('auth');

   $router->put(addRoute('store'),'Controllers/room/store.php');
?>