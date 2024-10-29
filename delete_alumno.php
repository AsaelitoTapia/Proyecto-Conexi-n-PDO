<?php
require("connection.php");

// Validamos y sanitizamos el valor de Alumno_ID
$alumno_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$alumno_id) {
    // Manejo del error si no se ha proporcionado un Alumno_ID válido
    echo "SE HA PRODUCIDO UN ERROR EN EL ID DEL ALUMNO QUE SE QUIERE BORRAR";
    die();   
}

try {
    $con = connection();

    // Actualizamos la consulta para borrar desde la tabla 'alumnos'
    $sql = "DELETE FROM alumnos WHERE Alumno_ID = ?";
    $stmt = $con->prepare($sql);

    // Nos aseguramos de que $alumno_id es un entero
    $stmt->bindParam(1, $alumno_id, PDO::PARAM_INT);
    $stmt->execute();

    // Redirigimos de vuelta al index.php tras la eliminación
    Header("Location: index.php");

} catch (PDOException $e) {
    // Mensaje de error si falla la eliminación
    echo "SE HA PRODUCIDO UN ERROR AL ELIMINAR EL ALUMNO";
    die();

} finally {
    // Cerrar la conexión
    $con = null;
}
?>
