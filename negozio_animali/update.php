<!--
//Update:
//Una pagina PHP che permette di modificare i dati di un animale.
//La pagina deve essere pre-compilata con i dati dell'animale selezionato.
//Un file PHP che gestisce l'invio del form e aggiorna i dati dell'animale nel database.
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

//taking id from url
$id = $_GET['id'];

//prepare and execute query
$smt = $conn->prepare("SELECT * FROM animali WHERE id = ?");
$smt->bind_param("i", $id);
$smt->execute();
$result = $smt->get_result();
$row = $result->fetch_assoc();
?>

<html lang="it">
<head>
<title>Negozio animali</title>
</head>
<body>
<form action='update.php' method='post'>
    <input type='text' name='nome' value='<?php echo $row['nome']; ?>'><br>
    <input type='text' name='specie' value='<?php echo $row['specie']; ?>'><br>
    <input type='number' name='eta' value='<?php echo $row['eta']; ?>'><br>
    <input type="number" step="0.01" name='prezzo' value='<?php echo $row['prezzo']; ?>'><br>
    <input type='submit'>
</form>
</body>
</html>

<body>
<input type="button" onclick="window.location.href = 'index.html';" value="Home">
</body>
