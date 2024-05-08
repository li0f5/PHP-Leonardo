<?php
$servername = "localhost";
$username = "root";
$password = "root";
$nomeDB = "utenti_5h";

$conn = new mysqli($servername, $username, $password,$nomeDB);
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
?>