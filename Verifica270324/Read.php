<!--
 b.	Read
    i.	Visualizzare tutti i libri disponibili per il prestito.
    ii.	Cercare libri per titolo, autore o categoria.
    iii.Visualizzare la cronologia dei prestiti di un utente.
-->

<?php
//connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biblioteca_buzzi_5t";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, 3306);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully <br>";


$id = $_GET['id'];
$smt = $conn->prepare("select Ruolo from utenti where IDUtente=?");
$smt->bind_param("i", $id);
$smt->execute();
$result = $smt->get_result();
$row = $result->fetch_assoc();
if ($row["Ruolo"] == 'docente')
    $permessi = true;

?>

<body>
<!--text fields for searching and filtering a specific animal by data-->
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
    <input type="text" name="data" placeholder="data">
    <input type="submit" name="search" value="Search">
</form>
</body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //get post
    $data = $_POST['data'];
    //get post
    $search = $_POST['search'];
}
//prepare and execute query
if(isset($search)){
    $smt = $conn->prepare("SELECT IDLibro,Titolo,Autore,AnnoPubblicazione,Categoria FROM libri where Stato='disponibile' and Titolo=? or Autore=? or Categoria=?");
    $smt->bind_param("sss", $data,$data,$data);
    echo $data;
}
else{
    $smt = $conn->prepare("SELECT IDLibro,Titolo,Autore,AnnoPubblicazione,Categoria FROM libri where Stato='disponibile'");
}
$smt->execute();
$result = $smt->get_result();

if ($result->num_rows > 0) {
    if ($permessi) {
        echo "<table border='1' cellspacing='0'><tr><th>ID</th><th>Titolo</th><th>Autore</th><th>AnnoPubblicazione</th><th>Categoria</th><th>Elimina</th><th>Modifica</th></tr>";
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
        <td>" . $row["IDLibro"] . "</td>
        <td>" . $row["Titolo"] . "</td>
        <td>" . $row["Autore"] . "</td>
        <td>" . $row["AnnoPubblicazione"] . "</td>
        <td>" . $row["Categoria"] . "</td>
        <td> <a href='delete.php?id=" . $row["IDLibro"] . "'>Elimina</a></td>
        <td> <a href='update.php?id=" . $row["IDLibro"] . "'>Modifica</a></td>
        </tr>";
        }
        echo "</table>";
    }else{
        echo "<table border='1' cellspacing='0'><tr><th>ID</th><th>Titolo</th><th>Autore</th><th>AnnoPubblicazione</th><th>Categoria</th><th>Restituisci</th></tr>";
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
        <td>" . $row["IDLibro"] . "</td>
        <td>" . $row["Titolo"] . "</td>
        <td>" . $row["Autore"] . "</td>
        <td>" . $row["AnnoPubblicazione"] . "</td>
        <td>" . $row["Categoria"] . "</td>
        <td> <a href='update.php?id=" . $row["IDLibro"] . "'>Restituisci</a></td>
        </tr>";
        }
        echo "</table>";
    }
} else {
    echo "0 results <br>";
}


?>

<body>
<br>
<br>
<input type="button" onclick="window.location.href = 'index.html';" value="Home">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
    <input type="button" name="crono" value="Cronologia">
</form>
</body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //get post
    $crono = $_POST['crono'];
}
if(isset($crono)){
    $id = $_GET['id'];
    $smt = $conn->prepare("select IDPrestito,IDLibro,DataPrestito,DataRitornoPrevista,DataRitornoReale from prestiti where IDUtente=?");
    $smt->bind_param("i", $id);
    $smt->execute();
    $result = $smt->get_result();

    if ($result->num_rows > 0) {
        echo "<table border='1' cellspacing='0'><tr><th>IDPrestito</th><th>IDLibro</th><th>Data Prestito</th><th>Data Ritorno Prevista</th><th>Data Ritorno Reale</th></tr>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>
        <td>" . $row["IDPrestito"]. "</td>
        <td>" . $row["Titolo"]. "</td>
        <td>" . $row["IDLibro"]. "</td>
        <td>" . $row["DataRitornoPrevista"]. "</td>
        <td>" . $row["DataRitornoReale"]. "</td>
        </tr>";
        }
        echo "</table>";
    } else {
        echo "0 results <br>";
    }
}
?>