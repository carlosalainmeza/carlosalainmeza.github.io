<?php
include 'db.php';

$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>ID</th><th>Nombres</th><th>DNI</th><th>Teléfono</th><th>Estudios</th><th>Estado Civil</th><th>Provincia</th><th>Correo</th><th>Color de Preferencia</th><th>Fecha de Nacimiento</th><th>Acciones</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["nombres"]."</td><td>".$row["dni"]."</td><td>".$row["telefono"]."</td><td>".$row["estudios"]."</td><td>".$row["estado_civil"]."</td><td>".$row["provincia"]."</td><td>".$row["correo"]."</td><td>".$row["color_preferencia"]."</td><td>".$row["fecha_nacimiento"]."</td><td><a href='update.php?id=".$row["id"]."'>Editar</a> | <a href='delete.php?id=".$row["id"]."'>Eliminar</a></td></tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron resultados.";
}

$conn->close();
?>
