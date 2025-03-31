<?php
require '../../bd.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    echo "No se ha proporcionado el ID del OP.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<?php include('header.php'); ?>


<body>
    <?php
    $consulta = "SELECT op.*, autor.Autor, autor.Copia_Autor, anime.Nombre FROM `op` INNER JOIN autor ON op.ID_Autor=autor.ID INNER JOIN anime ON op.ID_Anime=anime.id WHERE op.ID='$id'";
    $resultados = $conexion->query($consulta);

    if ($resultados->num_rows > 0) {
        while ($row = $resultados->fetch_assoc()) {
            $cancion = $row["Cancion"] ?? "";
            $texto1 = $row["Nombre"] . ' ' . $row["Temporada"];
            $nombre = $row["Nombre"] ?? "";
            $texto2 = $row["Opening"] ?? "";
            /*
            echo $cancion . "<br>";
            echo $texto1 . "<br>";
            echo $texto2 . "<br>";
            */


            echo "<div class='buttons-container'>";
            echo '<button title="Copiar Título" onclick="copyToClipboard(\'' . $cancion . '\')"><i class="fa-solid fa-music"></i></button>';


            if ($row["Copia_Autor"] == "SI") {
                $autor = $row["Autor"];
                echo '<button title="Copiar Artista" onclick="copyToClipboard(\'' . $autor . '\')"><i class="fa-solid fa-user"></i></button>';
            } else {
                echo '<button title="Copiar Artista" onclick="copyToClipboard(\'' . $texto1 . ' OP ' . $texto2 . '\')"><i class="fa-solid fa-user"></i></button>';
            }


            echo '<button title="Copiar Álbum" onclick="copyToClipboard(\'' . $nombre . '\')"><i class="fa-solid fa-compact-disc"></i></button>';


            echo "</div>";
        }
    } else {
        echo "<p>No se encontraron resultados en la base de datos.</p>";
    }
    ?>
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert("Texto copiado al portapapeles: " + text);
            }).catch(err => {
                console.error('Error al copiar al portapapeles:', err);
            });
        }
    </script>
</body>

</html>