<?php
if(!isset($_SESSION)){
    session_start();
}

if(isset($_SESSION)){
    session_destroy();
    header('Location: login.php', true, 301);
    echo '<meta http-equiv="refresh" content="0;url=login.php">';
}
?>