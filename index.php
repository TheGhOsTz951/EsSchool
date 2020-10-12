<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | AleSite</title>

    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div class="title">
        <h1>Benvenuto nel mio sito</h1>
        <hr>
    </div>

    <div class="es-list">
        <h2>Ecco la lista dei miei esercizi</h2>
        <ol>
            <?php @createList(); ?>
        </ol>
    </div>

    <p class="p-btn"><input class="btn add" type="button" value="Aggiungi esercizio" onclick="showAdd()"></p>

    <div id="add-es-div" class="add-es">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <p>Password: <input type="password" name="pw"></p>
            <p>Nome: <input type="text" name="nome"></p>
            <p>Descrizione: <input type="text" name="desc"></p>
            <p>Link: <input type="text" name="link"></p>
            <p><input class="btn add" type="submit" value="Aggiungi"></p>
        </form>
    </div>
</body>

<script src="js/index.js"></script>
</html>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        @createLink();
    }

    function createLink() {
        $servername = "localhost";
        $username = "bottegasasso";
        $password = "";
        $dbname = "my_bottegasasso";

        $pw = test_input($_POST["pw"]);
        $name = test_input($_POST["nome"]);
        $descri = test_input($_POST["desc"]);
        $link = test_input($_POST["link"]);

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Check connection
        if (!$conn) {
            die("<p>Connessione col database non riuscita!</p>");
        }

        // Check password
        $sql = "SELECT pw FROM utenti WHERE id='0'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $password = $row['pw'];

        if (strcmp($pw, $password) != 0) {
            //echo "<p>Password errata!</p>";
            return;
        }

        $id = 0;
        $sql = "SELECT id FROM esercizi";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                echo $row['id'];
                if ($row['id'] > $id) {
                    $id = $row['id'];
                }
            }
            
        }
        
        $id ++;

        $sql = "INSERT INTO esercizi (id, nome, descri, link) VALUES
        ('$id', '$name', '$descri', '$link')";

        mysqli_query($conn, $sql);

        header("Refresh:0");
        mysqli_close($conn);
    }

    function createList() {
        $servername = "localhost";
        $username = "bottegasasso";
        $password = "";
        $dbname = "my_bottegasasso";

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Check connection
        if (!$conn) {
            die("<p>Connessione col database non riuscita!</p>");
        }

        $sql = "SELECT id, nome, descri, link FROM esercizi";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                echo '<li><a href="' . $row['link'] . '">' . $row['nome'] 
                . ' - ' . $row['descri'] . '</a></li>';
            }
            
        } else {
            echo "<p>Non ci sono esercizi nel database!</p>";
        }

        mysqli_close($conn);
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?> 