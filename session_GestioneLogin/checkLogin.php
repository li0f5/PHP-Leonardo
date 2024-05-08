<?php
session_start();
include  "connessione.php";

//prelevo i dati del form
$user = $_POST['user'];
$password = $_POST['password'];

//verifico se l'utente esiste
$sql = "SELECT * FROM utenti WHERE user = '$user' AND password = '$password'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    //utente trovato
    echo "Utente trovato<br>";
    //creo la sessione di lavoro
    $session_name = "user";
    $session_value = $user;

    $_SESSION[$session_name] = $session_value;


    echo "La sessione di lavoro è stata creata<br>";
    echo "<a href='pagina_riservata.php'>Vai alla pagina riservata</a>";
} else {
    //utente non trovato
    echo "Utente non trovato<br>";
    echo "<a href='index2.php'>Riprova</a>";
}
?>