<!-- Estensioni:
Aggiungere la possibilità di ordinare e filtrare la tabella degli animali.
Implementare la ricerca di animali per nome, specie o età.
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
echo "Connected successfully <br>";
?>

<body>
<!--text fields for searching and filtering a specific animal by data-->
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
    <input type="text" name="data" placeholder="data">
    <input type="submit" name="search" value="Search/Filter">
    <input type="submit" name="order" value="order">
</form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
</body>

<?php
//Read:
//Una pagina PHP che mostra una tabella con tutti gli animali presenti nel negozio.
//La tabella deve includere il nome, la specie, l'età e il prezzo.
//Deve essere presente un link per ogni animale per visualizzare i dettagli (vedi punto C).

//get post data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //get post
    $data = $_POST['data'];
    //get post
    $search = $_POST['search'];
    //get post
    $order = $_POST['order'];
}


//prepare and execute query
//if SEARCH button is pressed
if(isset($search)){
    $smt = $conn->prepare("SELECT id, nome, specie, eta, prezzo FROM animali where nome = ? or specie = ? or eta = ? or prezzo = ?");
    $smt->bind_param("s", $data);
}
//if ORDER button is pressed
else if(isset($order)){
    $smt = $conn->prepare("SELECT id, nome, specie, eta, prezzo FROM animali order by ?");
    $smt->bind_param("s", $data);
}
else{
    $smt = $conn->prepare("SELECT id, nome, specie, eta, prezzo FROM animali");
}
$smt->execute();
$result = $smt->get_result();




if ($result->num_rows > 0) {
    echo "<table border='1' cellspacing='0'><tr><th>ID</th><th>Nome</th><th>Specie</th><th>Eta'</th><th>Prezzo</th><th>Elimina</th><th>Modifica</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>" . $row["id"]. "</td>
        <td>" . $row["nome"]. "</td>
        <td>" . $row["specie"]. "</td>
        <td>" . $row["eta"]. "</td>
        <td>" . $row["prezzo"]. "</td>
        <td> <a href='delete.php?id=" . $row["id"] ."'>Elimina</a></td>
        <td> <a href='update.php?id=" . $row["id"] ."'>Modifica</a></td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "0 results <br>";
}


?>

<body>
<br>
<br>
<input type="button" onclick="window.location.href = 'index.html';" value="Home">
</body>
