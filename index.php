<?php
require_once "connection.php";
try {
    $pdo = connection();
    $sql = "SELECT * FROM alumnos"; // Buscamos todos los alumnos de la base de datos
    $stmt = $pdo->query($sql);

    // Obtenemos los resultados de la consulta
    $alumnos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Cerramos la conexión
    $pdo = null;
    
} catch (PDOException $e) {
    // Manejo de errores
    echo "Error: " . $e->getMessage();
    die();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device=width, initial-scale=1">
    <link href="style.css" rel="stylesheet">
    <link rel="icon" type="image/jpg" href="./Img/favicon.ico" />
    <title>ALUMNOS</title>
</head>

<body>
    <div class="wrapper">
        <header>
            <div class="titulo">REGISTRO DE ALUMNOS <br/> CON PHP (PDO), MySQL, <br/> ETC </div>
            <p>
                <button id="open-modal" class="metro-button">+ Añadir alumno</button>
            </p>
        </header>
        <main>
            <br />
            <div class="users-table">
                <h2>Alumnos registrados</h2>
                <table>
                    <thead>
                        <!-- Cabeceras de la tabla de resultados -->
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Edad</th>
                            <th>Domicilio</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th colspan="2">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($alumnos as $row) : ?>
                            <tr>
                                <td data-column='Alumno_ID'><?= $row['Alumno_ID'] ?></td>
                                <td data-column='Nombre'><?= $row['Nombre'] ?></td>
                                <td data-column='Apellidos'><?= $row['Apellidos'] ?></td>
                                <td data-column='Edad'><?= $row['Edad'] ?></td>
                                <td data-column='Domicilio'><?= $row['Domicilio'] ?></td>
                                <td data-column='Telefono'><?= $row['Telefono'] ?></td>
                                <td data-column='Correo Electronico'><?= $row['Correo_Electronico'] ?></td>
                                <td data-column='Opción #1'><a href="update.php?id=<?= $row['Alumno_ID'] ?>" class="users-table--edit">Editar</a></td>
                                <td data-column='Opción #2'><a href="#" onclick="confirmDelete(<?= $row['Alumno_ID'] ?>)" class="users-table--delete">Eliminar</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
        <footer>
            <script>
                // Función para eliminar el alumno
                function confirmDelete(alumnoId) {
                    if (confirm("¿Está seguro de que desea eliminar este alumno?")) {
                        window.location.href = "delete_alumno.php?id=" + alumnoId;
                    }
                }

                // Obtener el botón para abrir la ventana modal
                var btn = document.getElementById("open-modal");

                // Obtener la ventana modal
                var modal = document.createElement("div");
                modal.className = "modal";

                // Agregar el contenido del formulario en la ventana modal
                modal.innerHTML = `
                                <div class="users-form">
                                    <h1 class="titulo">Registrar alumnos</h1>
                                    <form action="insert_alumno.php" method="POST">
                                    <input type="text" name="Nombre" placeholder="Nombre">
                                    <input type="text" name="Apellidos" placeholder="Apellidos">
                                    <input type="number" name="Edad" placeholder="Edad">
                                    <input type="text" name="Domicilio" placeholder="Domicilio">
                                    <input type="tel" name="Telefono" placeholder="Teléfono">
                                    <input type="email" name="Correo_Electronico" placeholder="Correo Electrónico">
                                    <input type="submit" value="Añadir">
                                    </form>
                                </div>
                                `;

                // Obtener el botón para cerrar la ventana modal
                var closeButton = document.createElement("button");
                closeButton.className = "close-button";
                closeButton.textContent = "X Cerrar ventana";
                modal.appendChild(closeButton);

                // Agregar la ventana modal al documento
                document.body.appendChild(modal);

                // Agregar un manejador de eventos para abrir la ventana modal
                btn.onclick = function() {
                    modal.style.display = "block";
                }

                // Agregar un manejador de eventos para cerrar la ventana modal
                closeButton.onclick = function() {
                    modal.style.display = "none";
                }
            </script>
            <span><a target="_blank">CONEXION A LA BASE DE DATOS CON PHP, MYSQL Y PDO </a></span>
        </footer>
    </div>
</body>

</html>
