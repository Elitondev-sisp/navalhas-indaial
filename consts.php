<?php
    define("NOME_SISTEMA", "INDASOFT - BARBER");
    define("NOME_EMPRESA", "NAVALHAS");
    define("TITULO_SISTEMA", "INDASOFT - BARBER - (NAVALHAS)");
    $rootDir = $_SERVER['PHP_SELF'];
    if ($rootDir == '/navalhas/index.php') {
        define("CAMINHO_LOGO", "assets/images/logo-icon.png");
        define("URL", "");
    } else {
        define("CAMINHO_LOGO", "../assets/images/logo-icon.png");
        define("URL", "../");
    }

    
?>