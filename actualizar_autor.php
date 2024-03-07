<?php
// Verificar si se recibieron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se recibió el ID del autor y la cantidad a actualizar
    if (isset($_POST["id_autor"]) && isset($_POST["cantidad"])) {
        // Conectar a la base de datos (reemplaza los valores con los de tu configuración)
        require '../bd.php';

        // Escapar y sanitizar los datos recibidos del formulario para evitar inyección de SQL
        $id_autor = mysqli_real_escape_string($conexion, $_POST["id_autor"]);
        $cantidad = mysqli_real_escape_string($conexion, $_POST["cantidad"]);

        // Actualizar la cantidad del autor en la base de datos
        $sql = "UPDATE autor SET Canciones_Musica = '$cantidad' WHERE ID = '$id_autor'";
        echo $sql;

        if ($conexion->query($sql) === TRUE) {
            echo "La cantidad del autor se actualizó correctamente.";
        } else {
            echo "Error al actualizar la cantidad del autor: " . $conexion->error;
        }

        // Cerrar conexión
        $conexion->close();
    } else {
        echo "Falta el ID del autor o la cantidad a actualizar.";
    }
} else {
    echo "El formulario no fue enviado correctamente.";
}

header("Location: autor.php");
exit();
