<?php include 'conexion.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $stmt = $conexion->prepare("DELETE FROM tbl_estudiantes WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error al eliminar el estudiante.";
    }

    $stmt->close();
}
?>
