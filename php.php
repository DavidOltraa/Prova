<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pràctica4";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>Pràctica 6</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

</head>

<body>

    <div class="container">
        <h2 class="my-4">Pràctica 6</h2>
        
        <?php
        if (isset($_POST['save'])) {
            $nom = $_POST['Nom'];
            $cognom = $_POST['Cognom'];
            $telefon = $_POST['Telefon'];

            $sql = "INSERT INTO prova (Nom, Cognom, Telefon) VALUES ('$nom', '$cognom', '$telefon')";
            $conn->query($sql);
        }

        if (isset($_GET['delete'])) {
            $nom = $_GET['delete'];

            $sql = "DELETE FROM prova WHERE Nom = '$nom'";;
            $conn->query($sql);
        }

        if (isset($_POST['update'])) {
            $nom = $_POST['Nom'];
            $cognom = $_POST['Cognom'];
            $telefon = $_POST['Telefon'];

            $sql = "UPDATE prova SET Nom='$nom', Cognom='$cognom', Telefon='$telefon' WHERE Nom='$nom'";;
            $conn->query($sql);
        }
        ?>

        <!-- Formulario de inserción -->
        <form action="" method="post">
            <div class="form-group">
                <input type="text" name="Nom" class="form-control" placeholder="Nom" required>
            </div>
            <div class="form-group">
                <input type="text" name="Cognom" class="form-control" placeholder="Cognom" required>
            </div>
            <div class="form-group">
                <input type="text" name="Telefon" class="form-control" placeholder="Telèfon" required>
            </div>
            <button type="submit" name="save" class="btn btn-primary">Guardar</button>
        </form>

        <!-- Tabla de usuarios -->
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Cognom</th>
                    <th>Telèfon</th>
                    <th>Accions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM prova";
                $result = $conn->query($sql);

                while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['Nom']; ?></td>
                        <td><?php echo $row['Cognom']; ?></td>
                        <td><?php echo $row['Telefon']; ?></td>
                        <td>
                            <a href="php.php?edit=<?php echo $row['Nom']; ?>" class="btn btn-info btn-sm">Editar</a>
                            <a href="php.php?delete=<?php echo $row['Nom']; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <?php
    if (isset($_GET['edit'])) {
        $nom = $_GET['edit'];
        $sql = "SELECT * FROM prova WHERE Nom='$nom'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        
        ?>

        <!-- Formulario de edición -->
        <div class="container">
            <h2 class="my-4">Editar Usuari</h2>
            <form action="" method="post">
                <div class="form-group">
                    <input type="text" name="Nom" value="<?php echo $row['Nom']; ?>" required>
                </div>
                <div class="form-group">
                    <input type="text" name="Cognom" value="<?php echo $row['Cognom']; ?>" required>
                </div>
                <div class="form-group">
                    <input type="text" name="Telefon" value="<?php echo $row['Telefon']; ?>" required>
                </div>
                <button type="submit" name="update" class="btn btn-success">Actualitzar</button>
            </form>
        </div>

    <?php } ?>

</body>

</html>