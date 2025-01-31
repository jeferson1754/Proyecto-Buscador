<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://kit.fontawesome.com/8846655159.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Buscador General de Anime</title>
</head>

<body>
    <?php
    require 'index.php';
    ?>
    <form action="#" method="GET" class="search-form">
        <input type="search" name="query" placeholder="Buscar...">
        <button type="submit"><i class="fas fa-search"></i></button>
    </form>


    <div class="deudores">
        <?php
        require '../bd.php';

        $limit = 5;

        if (isset($_GET['query'])) {
            // Recuperar el término de búsqueda
            $query = $_GET['query'];

            // Consulta para buscar en la tabla mangas
            $sql_mangas = "SELECT * FROM manga WHERE Nombre LIKE '%$query%' ORDER BY `manga`.`ID` DESC limit $limit";
            $resultado_mangas = mysqli_query($conexion, $sql_mangas);

            // Consulta para buscar en la tabla anime
            $sql_anime = "SELECT * FROM anime WHERE Nombre LIKE '%$query%' ORDER BY `anime`.`id` DESC limit $limit";
            $resultado_anime = mysqli_query($conexion, $sql_anime);

            // Consulta para buscar en la tabla pendientes_mangas
            $sql_pendientes = "SELECT * FROM pendientes_manga WHERE Nombre LIKE '%$query%' ORDER BY `pendientes_manga`.`ID` DESC limit $limit";
            $resultado_pendientes = mysqli_query($conexion, $sql_pendientes);


            // Consulta para buscar en la tabla op
            $sql_op = "SELECT * FROM op INNER JOIN anime on op.ID_Anime = anime.id WHERE anime.Nombre LIKE '%$query%' ORDER BY `op`.`ID` DESC limit $limit";

            $resultado_op = mysqli_query($conexion, $sql_op);

            // Consulta para buscar en la tabla ed
            $sql_ed = "SELECT * FROM ed INNER JOIN anime on ed.ID_Anime = anime.id WHERE anime.Nombre LIKE '%$query%' ORDER BY `ed`.`ID` DESC limit $limit";
            $resultado_ed = mysqli_query($conexion, $sql_ed);


            // Consulta para buscar en la tabla peliculas
            $sql_peliculas = "SELECT peliculas.Nombre as nombre_pelicula, anime.Nombre FROM peliculas LEFT JOIN anime on peliculas.ID_Anime = anime.id WHERE anime.Nombre LIKE '%$query%' OR  peliculas.Nombre LIKE '%$query%' ORDER BY `peliculas`.`ID` DESC limit $limit";
            

            $resultado_peliculas = mysqli_query($conexion, $sql_peliculas);

            // Consulta para buscar en la tabla horarios
            $sql_horario = "SELECT anime.Nombre,horario.Temporada,num_horario.* FROM horario 
            INNER JOIN anime ON horario.ID_Anime = anime.id 
            INNER JOIN num_horario ON horario.num_horario = num_horario.Num 
            WHERE anime.Nombre LIKE '%$query%' ORDER BY `horario`.`ID` DESC limit $limit";

            $resultado_horario = mysqli_query($conexion, $sql_horario);


            // Variable para controlar si se encontraron resultados en cada tabla
            $resultados_encontrados_mangas = false;
            $resultados_encontrados_anime = false;
            $resultados_encontrados_pendientes = false;

            $resultados_encontrados_op = false;
            $resultados_encontrados_ed = false;
            $resultados_encontrados_peliculas = false;
            $resultados_encontrados_horario = false;

            // Mostrar los resultados de mangas
            echo "<div class='persona-container rojo'>";
            echo "<div class='nombre-persona'> Mangas </div>";
            while ($fila = mysqli_fetch_assoc($resultado_mangas)) {
                echo "<div class='contenido'><br>";
                echo "<a href='/Manga/?busqueda_manga=" . $fila['Nombre'] . "&buscar=&accion=Busqueda' target='_blanck'>";
                echo $fila['Nombre'] . "<br>";
                echo "</a>";
                echo "</div>";
                $resultados_encontrados_mangas = true;
            }
            if (!$resultados_encontrados_mangas) {
                echo "<div class='contenido'>";
                echo "No se encontraron resultados.<br>";
                echo "</div>";
            }
            echo "</div>";

            // Mostrar los resultados de anime
            echo "<div class='persona-container verde'>";
            echo "<div class='nombre-persona'> Anime<br> </div>";
            while ($fila = mysqli_fetch_assoc($resultado_anime)) {
                echo "<div class='contenido'><br>";
                echo "<a href='/Anime/?busqueda_anime=" . $fila['Nombre'] . "&buscar=' target='_blanck'>";
                echo $fila['Nombre'] . "<br>";
                echo "</a>";
                echo "</div>";
                $resultados_encontrados_anime = true;
            }
            if (!$resultados_encontrados_anime) {
                echo "<div class='contenido'>";
                echo "No se encontraron resultados.<br>";
                echo "</div>";
            }
            echo "</div>";

            // Mostrar los resultados de pendientes_mangas
            echo "<div class='persona-container cafe'>";
            echo "<div class='nombre-persona'> Pendientes Mangas<br> </div>";
            while ($fila = mysqli_fetch_assoc($resultado_pendientes)) {
                echo "<div class='contenido'><br>";
                echo "<a href='/Manga/Pendientes/?busqueda_pendientes_manga=" . $fila['Nombre'] . "&buscar=&accion=Busqueda' target='_blanck'>";
                echo $fila['Nombre'] . "<br>";
                echo "</a>";
                echo "</div>";
                $resultados_encontrados_pendientes = true;
            }
            if (!$resultados_encontrados_pendientes) {
                echo "<div class='contenido'>";
                echo "No se encontraron resultados.<br>";
                echo "</div>";
            }
            echo "</div>";

            // Mostrar los resultados de op
            echo "<div class='persona-container azul'>";
            echo "<div class='nombre-persona'> Openings<br> </div>";
            while ($fila = mysqli_fetch_assoc($resultado_op)) {
                echo "<div class='contenido'><br>";
                echo "<a href='/Anime/OP/?busqueda_op=" . $fila['Nombre'] . "&buscar=' target='_blanck'>";
                echo $fila['Nombre'] . " OP " . $fila['Opening'] . "<br>";
                echo "</a>";
                echo "</div>";
                $resultados_encontrados_op = true;
            }
            if (!$resultados_encontrados_op) {
                echo "<div class='contenido'>";
                echo "No se encontraron resultados.<br>";
                echo "</div>";
            }
            echo "</div>";

            // Mostrar los resultados de ed
            echo "<div class='persona-container naranjo'>";
            echo "<div class='nombre-persona'> Endings<br> </div>";
            while ($fila = mysqli_fetch_assoc($resultado_ed)) {
                echo "<div class='contenido'><br>";
                echo "<a href='/Anime/ED/?busqueda_ed=" . $fila['Nombre'] . "&buscar=' target='_blanck'>";
                echo $fila['Nombre'] . " ED " . $fila['Ending'] . "<br>";
                echo "</a>";
                echo "</div>";
                $resultados_encontrados_ed = true;
            }
            if (!$resultados_encontrados_ed) {
                echo "<div class='contenido'>";
                echo "No se encontraron resultados.<br>";
                echo "</div>";
            }
            echo "</div>";

            // Mostrar los resultados de peliculas
            echo "<div class='persona-container gris'>";
            echo "<div class='nombre-persona'> Peliculas<br> </div>";
            while ($fila = mysqli_fetch_assoc($resultado_peliculas)) {
                echo "<div class='contenido'><br>";
                echo "<a href='/Anime/peliculas/' target='_blanck'>";
                echo $fila['Nombre'] . " " . $fila['nombre_pelicula'] . "<br>";
                echo "</a>";
                echo "</div>";
                $resultados_encontrados_peliculas = true;
            }
            if (!$resultados_encontrados_peliculas) {
                echo "<div class='contenido'>";
                echo "No se encontraron resultados.<br>";
                echo "</div>";
            }
            echo "</div>";

            // Mostrar los resultados de horario
            echo "<div class='persona-container amarillo'>";
            echo "<div class='nombre-persona'> Horario<br> </div>";
            while ($fila = mysqli_fetch_assoc($resultado_horario)) {
                echo "<div class='contenido'><br>";
                echo "<a href='/Anime/Horarios/horarios.php?anis=" . $fila['Num'] . "&filtrar=' target='_blanck'>";
                echo $fila['Temporada'] . " " . $fila['Ano'] . "<br>";
                echo "</a>";
                echo "</div>";
                $resultados_encontrados_horario = true;
            }
            if (!$resultados_encontrados_horario) {
                echo "<div class='contenido'>";
                echo "No se encontraron resultados.<br>";
                echo "</div>";
            }
            echo "</div>";
        }

        // Cerrar la conexión
        mysqli_close($conexion);
        ?>
    </div>
</body>

</html>