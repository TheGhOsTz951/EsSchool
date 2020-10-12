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
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
            <p>
                Seleziona un file da caricare:
                <select name="sel-file" id="sel-file" onchange="selShow()">
                    <option value="html">HTML</option>
                    <option value="css">CSS</option>
                    <option value="js">JS</option>
                </select>
            </p>
            <p>Password: <input type="password" name="pw"></p>
            <p id="nome">Nome: <input type="text" name="nome"></p>
            <p id="desc">Descrizione: <input type="text" name="desc"></p>
            <p><input type="file" name="fileToUpload" id="fileToUpload"></p>
            <p><input class="btn add" type="submit" value="Carica file"></p>
        </form>
    </div>
</body>

<script src="js/index.js"></script>
</html>

<?php
    include 'php/uploadFile.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $dirName = $_POST['sel-file'];
        @upload($dirName);
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
?> 