<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime Search Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8846655159.js" crossorigin="anonymous"></script>
    <style>
        .result-category {
            transition: all 0.3s ease;
        }

        .result-category:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .text-brown-600 {
            color: brown;
        }

        .text-orange-600 {
            color: orange;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen">
    <?php
    require 'index.php';
    ?>
    <div class="container mx-auto px-4 py-8">
        <form action="#" method="GET" class="mb-8 max-w-xl mx-auto">
            <div class="flex">
                <input
                    type="search"
                    name="query"
                    placeholder="Buscar Anime, Manga, Openings..."
                    class="flex-grow px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="<?php echo isset($_GET['query']) ? htmlspecialchars($_GET['query']) : ''; ?>">
                <button
                    type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-r-lg hover:bg-blue-600 transition-colors">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>

        <?php

        require '../bd.php';

        $limit = 5;
        if (isset($_GET['query'])):

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

        ?>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php
                $categories = [
                    ['name' => 'Mangas', 'color' => 'red', 'icon' => 'book', 'results' => $resultado_mangas, 'link' => '/Manga/?busqueda_manga='],
                    ['name' => 'Anime', 'color' => 'green', 'icon' => 'tv', 'results' => $resultado_anime, 'link' => '/Anime/?busqueda_anime='],
                    ['name' => 'Pendientes Mangas', 'color' => 'brown', 'icon' => 'list-alt', 'results' => $resultado_pendientes, 'link' => '/Manga/Pendientes/?busqueda_pendientes_manga='],
                    ['name' => 'Openings', 'color' => 'blue', 'icon' => 'music', 'results' => $resultado_op, 'link' => '/Anime/OP/?busqueda_op='],
                    ['name' => 'Endings', 'color' => 'orange', 'icon' => 'headphones', 'results' => $resultado_ed, 'link' => '/Anime/ED/?busqueda_ed='],
                    ['name' => 'Peliculas', 'color' => 'gray', 'icon' => 'film', 'results' => $resultado_peliculas, 'link' => '/Anime/peliculas/'],
                    ['name' => 'Horario', 'color' => 'yellow', 'icon' => 'calendar-alt', 'results' => $resultado_horario, 'link' => '/Anime/Horarios/horarios.php?anis=']
                ];

                foreach ($categories as $category):
                    echo "<div class='result-category bg-white rounded-lg shadow-md p-4'>";
                    echo "<div class='flex items-center mb-3'>";
                    echo "<i class='fas fa-{$category['icon']} text-2xl text-{$category['color']}-600 mr-3'></i>";
                    echo "<h2 class='text-xl font-semibold text-{$category['color']}-600'>{$category['name']}</h2>";
                    echo "</div>";

                    // Check if results exist
                    $hasResults = false;

                    // Output results for each category
                    while ($fila = mysqli_fetch_assoc($category['results'])) {
                        $hasResults = true;
                        $displayName = '';

                        // Special handling for different result types
                        switch ($category['name']) {
                            case 'Openings':
                                $displayName = $fila['Nombre'] . " OP " . $fila['Opening'];
                                $link = $category['link'] . $fila['Nombre'] . "&buscar=";
                                break;
                            case 'Endings':
                                $displayName = $fila['Nombre'] . " ED " . $fila['Ending'];
                                $link = $category['link'] . $fila['Nombre'] . "&buscar=";
                                break;
                            case 'Peliculas':
                                $displayName = $fila['Nombre'] . " " . $fila['nombre_pelicula'];
                                $link = $category['link'];
                                break;
                            case 'Horario':
                                $displayName = $fila['Nombre'] . " - " . $fila['Temporada'] . " " . $fila['Ano'];
                                $link = $category['link'] . $fila['Num'] . "&filtrar=";
                                break;
                            default:
                                $displayName = $fila['Nombre'] ?? '';
                                $link = $category['link'] . $displayName . "&buscar=&accion=Busqueda";
                        }

                        // Output result link
                        echo "<div class='mb-2 pl-8'>";
                        echo "<a href='{$link}' target='_blank' class='text-blue-600 hover:underline'>";
                        echo "<i class='fas fa-link mr-2 text-gray-400'></i>";
                        echo htmlspecialchars($displayName);
                        echo "</a>";
                        echo "</div>";
                    }

                    // Show message if no results
                    if (!$hasResults) {
                        echo "<p class='text-gray-500 pl-8'>No se encontraron resultados.</p>";
                    }

                    echo "</div>";
                endforeach;
                ?>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>