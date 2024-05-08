<?php
//devo creare un form per inserire user e password
?>
<html>
<body>
    <!-- form per inserire user e password -->
    <?php
    if (isset($_COOKIE['user'])) {
        header("Location: pagina_riservata.php");
    } else {
        echo "Benvenuto, effettua il login<br>";
    }
    ?>
    <form action="checkLogin.php" method="post">
        <label for="user">User:</label>
        <input type="text" id="user" name="user"><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
