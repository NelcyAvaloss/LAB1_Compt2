<?php 
include 'conexion.php';

$id = $_GET['id'] ?? 0;
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    die("ID no válido.");
}

$stmt = $conexion->prepare("SELECT nombre, carnet, materia FROM tbl_estudiantes WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$estudiantes = $resultado->fetch_assoc();

if (!$estudiantes) {
    die("Estudiante no encontrado.");
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nom = trim($_POST['nombre']);
    $ct = trim($_POST['carnet']);
    $mat = trim($_POST['materia']);

    if ($nom && $ct && $mat) {
        $update = $conexion->prepare("UPDATE tbl_estudiantes SET nombre=?, carnet=?, materia=? WHERE id=?");
        $update->bind_param("sssi", $nom, $ct, $mat, $id);
        
        if ($update->execute()) {
            header("Location: index.php");
            exit();
        } else {
            echo "<p style='color:red;'>Error al actualizar.</p>";
        }
    } else {
        echo "<p style='color:red;'>Todos los campos son obligatorios.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Estudiante</title>
    <link rel="stylesheet" href="estilos.css">

</head>
<body class="registro-fondo"> 
    <header>
        <h1>Editar Estudiante</h1>
    </header>

    <form class="form-registro" method="post">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($estudiantes['nombre']) ?>" required>

        <label for="carnet">Carnet</label>
        <input type="text" name="carnet" id="carnet" value="<?php echo htmlspecialchars($estudiantes['carnet']) ?>" required>

        <label for="materia">Materia</label>
        <input type="text" name="materia" id="materia" value="<?php echo htmlspecialchars($estudiantes['materia']) ?>" required>

        <button type="submit">Actualizar Registro</button>
        <a href="index.php" class="cancelar">Cancelar</a>
    </form>
</body>
</html>
