<?php
include 'db.php'; // Asegúrate de que este archivo contenga la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validación básica de datos (puedes agregar más validaciones según tus necesidades)
    if (empty($_POST['txtnombres']) || empty($_POST['txtdni']) || empty($_POST['txtfono']) || empty($_POST['btnestado']) || empty($_POST['txtprovincia']) || empty($_POST['txtemail']) || empty($_POST['txtclave']) || empty($_POST['txtcolor']) || empty($_POST['txtfecha'])) {
        die("Por favor, completa todos los campos obligatorios.");
    }

    $nombres = $_POST['txtnombres'];
    $dni = $_POST['txtdni'];
    $telefono = $_POST['txtfono'];

    // Filtrar estudios seleccionados
    $estudios = implode(',', array_filter([
        isset($_POST['chkprimaria']) ? 'Primaria' : null,
        isset($_POST['chksecundaria']) ? 'Secundaria' : null,
        isset($_POST['chktecnico']) ? 'Técnico' : null,
        isset($_POST['chkuniversitario']) ? 'Universitario' : null,
    ]));

    $estado_civil = $_POST['btnestado'];
    $provincia = $_POST['txtprovincia'];
    $correo = $_POST['txtemail'];
    $clave = password_hash($_POST['txtclave'], PASSWORD_BCRYPT); // Hashear la contraseña
    $color_preferencia = $_POST['txtcolor'];
    $fecha_nacimiento = $_POST['txtfecha'];

    // Consulta preparada para evitar inyección SQL
    $sql = "INSERT INTO usuarios (nombres, dni, telefono, estudios, estado_civil, provincia, correo, clave, color_preferencia, fecha_nacimiento) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssssssss", $nombres, $dni, $telefono, $estudios, $estado_civil, $provincia, $correo, $clave, $color_preferencia, $fecha_nacimiento);

        if ($stmt->execute()) {
            echo "Nuevo usuario registrado con éxito";
        } else {
            // Manejo de errores más detallado
            echo "Error al registrar usuario: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }

    $conn->close(); // Cerrar la conexión después de usarla
}
?>

