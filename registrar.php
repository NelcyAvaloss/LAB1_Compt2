<?php include 'conexion.php'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Estudiante</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<?php include 'header.php'; ?> 

<form action="" method="post">
    <label for="estudiante">Nombre de estudiante</label>
    <input type="text" name="estudiante" required>
    
    <label for="carnet">Carnet</label>
    <input type="text" name="carnet" required>
    
    <label for="materia">Materia</label>
    <input type="text" name="materia" required>

    <button type="submit">Registrar</button>
</form>

<?php include 'footer.php'; ?> 

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!empty($_POST['estudiante']) && !empty($_POST['carnet']) && !empty($_POST['materia'])) {
            $nombre = $_POST['estudiante'];
            $carnet = $_POST['carnet'];
            $materia = $_POST['materia'];

            $insertar = $conexion->prepare("INSERT INTO tbl_estudiantes (nombre, carnet, materia) VALUES (?, ?, ?)");
            $insertar->bind_param("sss", $nombre, $carnet, $materia);

            if ($insertar->execute()) {
                echo "<p>Registro exitoso.</p>";
                header("Location: index.php");
                exit();
            } else {
                echo "<p>Error al registrar: " . $insertar->error . "</p>";
            }

            $insertar->close();
        } else {
            echo "<p>Por favor, completa todos los campos.</p>";
        }
    }
    ?>

   
</body>
</html>
