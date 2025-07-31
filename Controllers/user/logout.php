<?php
    $_SESSION=[];
    session_destroy();

    header('location: '. addRoute());
    exit();
?>