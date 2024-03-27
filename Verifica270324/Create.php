<!--
 a.	Create
    i.	Aggiungere nuovi libri al sistema
    ii.	Permettere ad un utente di prenotare un libro.
-->
<html lang="it">
<head>
    <title>Negozio animali</title>
</head>
<body>
<form action='create.php' method='post'>
    <input type='text' name='Titolo'><br>
    <input type='text' name='Autore'><br>
    <input type='number' name='AnnoPublicitario'><br>
    <input type="number" name='Categoria'><br>
    <input type='submit'>
</form>
</body>
</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //change special characters
    $Titolo = htmlspecialchars($_POST['Titolo']);
    $Autore = htmlspecialchars($_POST['Autore']);
    $AnnoPublicitario = htmlspecialchars($_POST['AnnoPublicitario']);
    $Categoria = htmlspecialchars($_POST['Categoria']);
    //check if fields are empty
    if (empty($Titolo) || empty($Autore) || empty($AnnoPublicitario) || empty($Categoria)) {
        echo "Some fields are empty: " . $Titolo . " " . $Autore . " " . $AnnoPublicitario . " " . $Categoria . "<br>";
    } else {
        $Titolo = $_POST['Titolo'];
        $Autore = $_POST['Autore'];
        $AnnoPublicazione = $_POST['AnnoPublicazione'];
        $Categoria = $_POST['Categoria'];

        //prepare and execute query
        $conn = $_GET['conn'];
        $smt = $conn->prepare("INSERT INTO libri (Titolo, Autore, AnnoPlublicitario, Stato, Categoria) VALUES (?, ?, ?, 'disponibile', ?)");
        $smt->bind_param("ssid", $Titolo, $Autore, $AnnoPublicitario, $Categoria);
        $smt->execute();
        if ($smt->affected_rows > 0) {
            echo "New record created successfully<br>";
        } else {
            echo "Error: " . $smt->error . "<br>";
        }
    }
}
?>



