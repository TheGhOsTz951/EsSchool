
<?php
    function upload($dirName){
        $servername = "localhost";
        $username = "bottegasasso";
        $password = "";
        $dbname = "my_bottegasasso";

        $pw = test_input($_POST["pw"]);

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

        mysqli_close($conn);

        $target_file = $dirName . "/" . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            //echo "Il file e' troppo grande!";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($fileType != "html" && $fileType != "css" && $fileType != "js") {
            //echo "Puoi caricare solo file html, css, js!";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            //echo "Il file non e' stato caricato";
        } else if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            //echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        } else {
            //echo "Sorry, there was an error uploading your file.";
            $uploadOk = 0;
        }

        if ($uploadOk == 1 && $fileType == "html") {
            @createLink($target_file);
        }
    }

    // Crea dati nel database
    function createLink($link) {
        $servername = "localhost";
        $username = "bottegasasso";
        $password = "";
        $dbname = "my_bottegasasso";

        $pw = test_input($_POST["pw"]);
        $descri = test_input($_POST["desc"]);

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
                if ($row['id'] > $id) {
                    $id = $row['id'];
                }
            }
            
        }
        
        $id ++;

        $sql = "INSERT INTO esercizi (id, descri, link) VALUES
        ('$id', '$descri', '$link')";

        mysqli_query($conn, $sql);

        mysqli_close($conn);
        header("Refresh:0");
    }

    // Testa input
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>
