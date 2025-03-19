<?php include 'conexion.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Estudiantes</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>Datos del estudiante</h1>
    <a href="registrar.php"><button>Nuevo Estudiante</button></a>
    
    <?php 

    $resultado = $conexion->query("SELECT * FROM tbl_estudiantes");

    echo '<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Carnet</th>
            <th>Materia</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>';

    while ($row = $resultado->fetch_assoc()) {
        echo "
        <tr>
            <td>{$row['nombre']}</td>
            <td>{$row['carnet']}</td>
            <td>{$row['materia']}</td>
            <td>
                <a href='editar.php?id={$row['id']}'><button>Editar</button></a> 
                <a href='eliminar.php?id={$row['id']}' onclick='return confirm(\"¿Eliminar este estudiante?\")'>
                    <button>Eliminar</button>
                </a>
            </td>
        </tr>";
    }
    echo '</tbody></table>';
    ?>
</body>
</html>
