<?php
//devo connettermi al data base
$servername = "localhost";
$username = "root";
$password = "root";
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}


//voglio creare un database con una tabella utenti
$sql = "CREATE DATABASE IF NOT EXISTS utenti_5h";
if ($conn->query($sql) === TRUE) {
    echo "Database creato correttamente<br>";
} else {
    echo "Errore nella creazione del database: " . $conn->error . "<br>";
}
$sql = "USE utenti_5h";
if ($conn->query($sql) === TRUE) {
    echo "Database selezionato correttamente<br>";
} else {
    echo "Errore nella selezione del database: " . $conn->error . "<br>";
}
$sql = "CREATE TABLE IF NOT EXISTS utenti (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user VARCHAR(30) NOT NULL,
    password VARCHAR(30) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Tabella creata correttamente<br>";
} else {
    echo "Errore nella creazione della tabella: " . $conn->error . "<br>";
}
//voglio inserire degli utenti in modo casuale
$sql = "INSERT INTO utenti (user, password) VALUES ('giovanni', 'giovanni')
, ('mario', 'mario'), ('luca', 'luca')";


if ($conn->query($sql) === TRUE) {
    echo "Utente inserito correttamente<br>";
} else {
    echo "Errore nell'inserimento dell'utente: " . $conn->error . "<br>";
}

?>