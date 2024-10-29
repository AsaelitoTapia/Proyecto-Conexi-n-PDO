<?php
require("connection.php");

try {
    $con = connection();
    $alumno_id  = $_POST['id']; // Asumiendo que "id" es Alumno_ID
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT);
    $domicilio = filter_input(INPUT_POST, 'domicilio', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = $_POST['email'];

    // Comprobamos si el email tiene un formato válido
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('La dirección de correo electrónico no es válida');
    }

    // Actualizamos los datos del alumno en la tabla 'alumnos'
    $sql = "UPDATE alumnos SET Nombre=?, Apellidos=?, Edad=?, Domicilio=?, Telefono=?, Correo_Electronico=? WHERE Alumno_ID=?";
    $query = $con->prepare($sql);
    $values = array($name, $lastname, $age, $domicilio, $telefono, $email, $alumno_id);

    if ($query->execute($values)) {
        // Redirigimos al index.php si la actualización es exitosa
        header("Location: index.php");
    } else {
        echo "Error al actualizar el alumno";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    die();
} finally {
    $con = null; // Cerramos la conexión
}
?>
