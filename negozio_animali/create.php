<!--
Create:
Un form HTML che permette all'utente di inserire i dati di un nuovo animale (nome, specie, età, prezzo).
Un file PHP che gestisce l'invio del form e salva i dati dell'animale nella tabella "animali" del database MySQL.
-->

<?php
//connect to database
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "negozio_animali";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, 3306);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully<br>";
?>

<html lang="it">
<head>
<title>Negozio animali</title>
</head>
<body>
<form action='create.php' method='post'>
    <input type='text' name='nome'><br>
    <input type='text' name='specie'><br>
    <input type='number' name='eta'><br>
    <input type="number" step="0.01" name='prezzo'><br>
    <input type='submit'>
</form>
</body>
</html>

<?php
//prepare and execute query
$smt = $conn->prepare("INSERT INTO animali (nome, specie, eta, prezzo) VALUES (?, ?, ?, ?)");
$smt->bind_param("ssid", $nome, $specie, $eta, $prezzo);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //change special characters
    $nome = htmlspecialchars($_POST['nome']);
    $specie = htmlspecialchars($_POST['specie']);
    $eta = htmlspecialchars($_POST['eta']);
    $prezzo = htmlspecialchars($_POST['prezzo']);
    //check if fields are empty
    if (empty($nome) || empty($specie) || empty($eta) || empty($prezzo)) {
        echo "Some fields are empty: " . $nome . " " . $specie . " " . $eta . " " . $prezzo . "<br>";
    } else {
        $nome = $_POST['nome'];
        $specie = $_POST['specie'];
        $eta = $_POST['eta'];
        $prezzo = $_POST['prezzo'];
        $smt->execute();
        if ($smt->affected_rows > 0) {
            echo "New record created successfully<br>";
        } else {
            echo "Error: " . $smt->error . "<br>";
        }
    }
}
?>

<body>
<input type="button" onclick="window.location.href = 'index.html';" value="Home">
</body>

