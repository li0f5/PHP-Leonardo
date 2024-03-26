<?php
//Delete:
//Un link per ogni animale nella tabella di lettura (punto B) che permette di eliminarlo dal database.
//Un file PHP che gestisce l'eliminazione dell'animale dal database.

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

//delete query
$smt = $conn->prepare("DELETE FROM animali WHERE id = ?");
$smt->bind_param("i", $id);
$smt->execute();
if ($smt->affected_rows > 0) {
    echo "Record deleted successfully<br>";
} else {
    echo "Error deleting record:" . $conn->error . "<br>";
}
?>

<body>
<input type="button" onclick="window.location.href = 'index.html';" value="Home">
</body>
