<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM usuarios WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No se encontraron datos para este usuario.";
        exit();
    }
} else {
    echo "No se proporcionó un ID válido.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nombres = $_POST['txtnombres'];
    $dni = $_POST['txtdni'];
    $telefono = $_POST['txtfono'];
    $estudios = implode(',', array_filter([
        isset($_POST['chkprimaria']) ? 'Primaria' : null,
        isset($_POST['chksecundaria']) ? 'Secundaria' : null,
        isset($_POST['chktecnico']) ? 'Técnico' : null,
        isset($_POST['chkuniversitario']) ? 'Universitario' : null
    ]));
    $estado_civil = $_POST['btnestado'];
    $provincia = $_POST['txtprovincia'];
    $correo = $_POST['txtemail'];
    $clave = $_POST['txtclave'];
    $color_preferencia = $_POST['txtcolor'];
    $fecha_nacimiento = $_POST['txtfecha'];

    $sql = "UPDATE usuarios SET 
            nombres='$nombres', 
            dni='$dni', 
            telefono='$telefono', 
            estudios='$estudios', 
            estado_civil='$estado_civil', 
            provincia='$provincia', 
            correo='$correo', 
            clave='$clave', 
            color_preferencia='$color_preferencia', 
            fecha_nacimiento='$fecha_nacimiento' 
            WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Registro actualizado con éxito";
    } else {
        echo "Error actualizando el registro: " . $conn->error;
    }
}
?>
