<?php
// Archivo donde se guardan los nombres de los estudiantes
$archivo = 'estudiantes.txt';

// Procesar el formulario cuando se envíe
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el nombre del estudiante desde el formulario
    $nombre = trim($_POST['nombre']);
    
    if (!empty($nombre)) {
        // Guardar el nombre del estudiante en el archivo
        file_put_contents($archivo, $nombre . PHP_EOL, FILE_APPEND);
        
        // Redirigir de vuelta a la misma página para evitar reenvío del formulario
        header('Location: index.php');
        exit();
    } else {
        echo '<p>El nombre del estudiante no puede estar vacío.</p>';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Estudiantes</title>
</head>
<body>
    <h1>Registro de Estudiantes</h1>
    <form action="index.php" method="post">
        <label for="nombre">Nombre del Estudiante:</label>
        <input type="text" id="nombre" name="nombre" required>
        <button type="submit">Registrarse</button>
    </form>
    <hr>
    <h2>Estudiantes Registrados</h2>
    <?php
    // Mostrar los estudiantes registrados
    if (file_exists($archivo)) {
        $estudiantes = file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if (count($estudiantes) > 0) {
            echo '<ul>';
            foreach ($estudiantes as $estudiante) {
                echo "<li>" . htmlspecialchars($estudiante) . "</li>";
            }
            echo '</ul>';
        } else {
            echo '<p>No hay estudiantes registrados.</p>';
        }
    } else {
        echo '<p>No hay estudiantes registrados.</p>';
    }
    ?>
</body>
</html>
