<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombres = $_POST['txtnombres'];
    $dni = $_POST['txtdni'];
    $telefono = $_POST['txtfono'];
    $estudios = implode(',', array_filter([
        isset($_POST['chkprimaria']) ? 'Primaria' : null,
        isset($_POST['chksecundaria']) ? 'Secundaria' : null,
        isset($_POST['chktecnico']) ? 'Técnico' : null,
        isset($_POST['chkuniversitario']) ? 'Universitario' : null,
    ]));
    $estado_civil = $_POST['btnestado'];
    $provincia = $_POST['txtprovincia'];
    $correo = $_POST['txtemail'];
    $clave = password_hash($_POST['txtclave'], PASSWORD_BCRYPT);
    $color_preferencia = $_POST['txtcolor'];
    $fecha_nacimiento = $_POST['txtfecha'];

    $sql = "INSERT INTO usuarios (nombres, dni, telefono, estudios, estado_civil, provincia, correo, clave, color_preferencia, fecha_nacimiento)
            VALUES ('$nombres', '$dni', '$telefono', '$estudios', '$estado_civil', '$provincia', '$correo', '$clave', '$color_preferencia', '$fecha_nacimiento')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo usuario registrado con éxito";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
