<?php
if (!isset($_COOKIE['user'])) {
    header("Location: index2.php");
}
echo "Benvenuto nella pagina riservata ".$_COOKIE['user'];