<?php
//Read:

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
echo "Connected successfully";

//TODO Una pagina PHP che mostra una tabella con tutti gli animali presenti nel negozio.
//TODO La tabella deve includere il nome, la specie, l'età e il prezzo.

$sql = "SELECT id, nome, specie, eta, prezzo FROM animali";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["nome"]. " " . $row["specie"]. " - Age: " . $row["eta"]. " - Price: " . $row["prezzo"]. "<br>";
    }
} else {
    echo "0 results";
}


//TODO Deve essere presente un link per ogni animale per visualizzare i dettagli (vedi punto C).
?>