<?php
$servername = "localhost";
$username = "root";
$password = "";
$nomeDB = "utenti_5T";

$conn = new mysqli($servername, $username, $password,$nomeDB);
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
?>