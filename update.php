<?php
require("connection.php");
try {

    $pdo = connection();

    $id = $_GET['id'];

    // Preparamos la sentencia, buscando el alumno por su ID, recibida por GET
    $stmt = $pdo->prepare("SELECT * FROM alumnos WHERE Alumno_ID=:id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);  // Aseguramos que el ID es un entero
    $stmt->execute();

    // Almacenamos los resultados de la consulta en $row, para mostrarlos en el formulario
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

} catch(PDOException $e) {

    // Manejo de excepción
    echo "Error: " . $e->getMessage();
    die();

} finally {
    // Cerrar la conexión
    $pdo = null;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device=width, initial-scale=1">
    <link href="style.css" rel="stylesheet">
    <link rel="icon" type="image/jpg" href="./Img/favicon.ico" />
    <title>Editar Alumno</title>
</head>

<body>
    <div class="wrapper">
        <header>
            <div class="titulo">EDICIÓN DE ALUMNO</div>
        </header>
        <main>
            <div class="users-form">
                <!-- Formulario para la edición de alumnos -->
                <form action="edit_alumno.php" method="POST">
                    <input type="hidden" name="id" value="<?= $row['Alumno_ID'] ?>">
                    <input type="text" name="name" placeholder="Nombre" value="<?= $row['Nombre'] ?>">
                    <input type="text" name="lastname" placeholder="Apellidos" value="<?= $row['Apellidos'] ?>">
                    <input type="number" name="age" placeholder="Edad" value="<?= $row['Edad'] ?>">
                    <input type="text" name="domicilio" placeholder="Domicilio" value="<?= $row['Domicilio'] ?>">
                    <input type="tel" name="telefono" placeholder="Teléfono" value="<?= $row['Telefono'] ?>">
                    <input type="email" name="email" placeholder="Correo Electrónico" value="<?= $row['Correo_Electronico'] ?>">
                    <input type="submit" value="Actualizar">
                </form>
                <p><button class="back-btn" onclick="window.history.back()">Volver</button></p>
            </div>
        </main> 
        <footer> 
            <span><a target="_blank">CRUD</a></span>
        </footer>
    </div>
</body>
</html>
