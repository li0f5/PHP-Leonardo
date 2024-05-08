<?php
// devo distruggere la sessione
session_start();
session_destroy();
header("Location: login.php");
?>