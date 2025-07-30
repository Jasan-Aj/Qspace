<?php
    $_SESSION=[];
    session_destroy();

    header('location: /QSPACE/');
    exit();
?>