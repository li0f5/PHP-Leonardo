<!--
d.	Delete
    i.	Prevedere la possibilità di cancellare tutti i prestiti restituiti
-->

<?php
$conn = $_GET['conn'];
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully<br>";


//delete query
$smt = $conn->prepare("DELETE FROM prestiti WHERE DataRitornoReale is null");
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