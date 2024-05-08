<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}
echo "Benvenuto nella pagina riservata ".$_SESSION['user'];
?>
<a href="destroy.php">Effettua il LOGOUT</a>
