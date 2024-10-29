<?php
require("connection.php");

try {

    $pdo = connection();

    // Limpiamos los datos que llegan por $_POST
    $name = filter_var($_POST['Nombre'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['Apellidos'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $age = filter_var($_POST['Edad'], FILTER_VALIDATE_INT);
    $domicilio = filter_var($_POST['Domicilio'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $telefono = filter_var($_POST['Telefono'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['Correo_Electronico'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Comprobamos si el email tiene un formato válido
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('La dirección de correo electrónico no es válida');
    }

    // Preparamos la sentencia
    $stmt = $pdo->prepare("INSERT INTO alumnos (Nombre, Apellidos, Edad, Domicilio, Telefono, Correo_Electronico) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $lastname);
    $stmt->bindParam(3, $age, PDO::PARAM_INT); // Usamos PDO::PARAM_INT para la edad
    $stmt->bindParam(4, $domicilio);
    $stmt->bindParam(5, $telefono);
    $stmt->bindParam(6, $email);

    // Ejecutamos la sentencia con sus correspondientes valores
    $stmt->execute();

    // Redirigimos de vuelta al index.php
    header("Location: index.php");

} catch (PDOException $e) {

    echo "Error: " . $e->getMessage();
    die();

} catch (Exception $e) {

    echo "Error: " . $e->getMessage();
    die();

} finally {

    // Cerramos la conexión
    $pdo = null;

}
?>
