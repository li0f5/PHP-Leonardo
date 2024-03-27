<!--
c.	Update
    i.	Permettere la restituzione di un libro da parte di un utente
-->

<?php
$conn = $_GET['conn'];
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully<br>";

//prepare and execute query
$smt = $conn->prepare("SELECT * FROM libri WHERE IDLIBRO = ?");
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
    <input type='number' name='nome' value='<?php echo $row['IDprestito']; ?>' readonly><br>
    <input type='number' name='specie' value='<?php echo $row['IDLibro']; ?>' readonly><br>
    <input type='date' name='eta' value='<?php echo $row['DataPrestito']; ?>' readonly><br>
    <input type="date" step="0.01" name='prezzo' value='<?php echo $row['DataRitornoPrevista']; ?>' readonly><br>
    <input type="date" step="0.01" name='prezzo' value='<?php echo $row['DataRitornoReale']; ?>' readonly><br>
    <input type='submit' name="restituire" value="Restituire">
</form>
</body>
</html>
<?php
$toDay = date_create('now');
//prepare and execute query
$smt = $conn->prepare("update prestiti set DataRitornoReale = ? where IDPrestito = ?");
$smt->bind_param("bi", $toDay,$row['IDprestito']);
$smt->execute();
$smt = $conn->prepare("update libri set Stato='disponibile' where IDLibro = ?");
$smt->bind_param("i", $row['IDLibro']);
$smt->execute();
if ($smt->affected_rows > 0) {
    echo "Record modifyed successfully<br>";
} else {
    echo "Error modifying record:" . $conn->error . "<br>";
}
?>
<body>
<input type="button" onclick="window.location.href = 'index.html';" value="Home">
</body>
