<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime Song Search</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8846655159.js" crossorigin="anonymous"></script>
    <style>
        .tab-button {
            transition: all 0.3s ease;
        }

        .tab-button.active {
            color: #3B82F6;
            border-bottom: 2px solid #3B82F6;
        }

        .search-input {
            transition: all 0.3s ease;
        }

        .search-input:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.5);
        }

        table {
            width: 100%;
        }

        table th,
        table td {
            padding: 0.5rem;
            border: 1px solid #e5e7eb;
        }

        .iframe-container {
            width: 100%;
            height: 100px;
            overflow: hidden;
        }
    </style>
</head>

<?php

function displayTable_op($sql, $conexion)
{
    $result = mysqli_query($conexion, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
?>
        <table id="example" style="width:100%">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Opening</th>
                    <th>Cancion</th>
                    <th>Autor</th>
                </tr>
            </thead>
            <?php
            while ($mostrar = mysqli_fetch_array($result)) {
                $id_Registros = $mostrar['ID'];
            ?>
                <tr>
                    <td><?php echo $mostrar['anime'] ?> <?php echo $mostrar['Temporada'] ?></td>
                    <td>OP <?php echo $mostrar['Opening'] ?></td>
                    <td><?php echo $mostrar['Cancion'] ?></td>
                    <td><?php echo $mostrar['Autor'] ?></td>

                    <td>
                        <div class="container" style="width: 100%; height: 100px;">
                            <iframe src="/Anime/OP/ejemplo.php?id=<?php echo $id_Registros; ?>" frameborder="0" style="width: 100%; height: 100%;"></iframe>
                        </div>
                    </td>
                </tr>

            <?php
            }
            ?>
        </table>
    <?php
    } else {
        echo "<div style='text-align:center'>No se encontraron resultados en la base de datos.</div>";
    }
}

function displayTable_ed($sql, $conexion)
{
    $result = mysqli_query($conexion, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
    ?>
        <table id="example" style="width:100%">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Ending</th>
                    <th>Cancion</th>
                    <th>Autor</th>
                </tr>
            </thead>
            <?php
            while ($mostrar = mysqli_fetch_array($result)) {
                $id_Registros = $mostrar['ID'];
            ?>

                <tr>
                    <td><?php echo $mostrar['anime'] ?> <?php echo $mostrar['Temporada'] ?></td>
                    <td>ED <?php echo $mostrar['Ending'] ?></td>
                    <td><?php echo $mostrar['Cancion'] ?></td>
                    <td><?php echo $mostrar['Autor'] ?></td>
                    <td>
                        <div class="container" style="width: 100%; height: 100px;">
                            <iframe src="/Anime/ED/ejemplo.php?id=<?php echo $id_Registros; ?>" frameborder="0" style="width: 100%; height: 100%;"></iframe>
                        </div>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
<?php
    } else {
        echo "<div style='text-align:center'>No se encontraron resultados en la base de datos.</div>";
    }
}

function obtenerTotalResultados($sql, $conexion)
{
    $resultTotal = mysqli_query($conexion, $sql);
    $totalRow = mysqli_fetch_assoc($resultTotal);
    return $totalRow['conteo'];
}

?>

<body class="bg-gray-100 min-h-screen">
    <?php
    require 'index.php';
    ?>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-6xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-6">
                <form action="#" method="GET" class="mb-6 flex">
                    <input
                        type="search"
                        name="key"
                        placeholder="Buscar Autores, Animes, Canciones..."
                        class="search-input flex-grow px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none"
                        value="<?php echo isset($_GET['key']) ? htmlspecialchars($_GET['key']) : ''; ?>">
                    <button
                        type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded-r-lg hover:bg-blue-600 transition-colors">
                        <i class="fas fa-search"></i>
                    </button>
                </form>

                <div class="flex justify-center mb-6">
                    <div class="inline-flex rounded-md shadow-sm" role="group">
                        <button
                            onclick="showOption(1)"
                            class="tab-button px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 active">
                            <i class="fas fa-user mr-2"></i>Autores
                        </button>
                        <button
                            onclick="showOption(2)"
                            class="tab-button px-4 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                            <i class="fas fa-tv mr-2"></i>Animes
                        </button>
                        <button
                            onclick="showOption(3)"
                            class="tab-button px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                            <i class="fas fa-music mr-2"></i>Canciones
                        </button>
                    </div>
                </div>

                <?php
                require '../bd.php';
                $limit = 5;
                $query = isset($_GET['key']) ? $_GET['key'] : '';
                if (isset($_GET['key'])): ?>
                    <div class="info-container active" id="info-option-1">
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <?php
                                $sql2 = "SELECT COUNT(*) as conteo FROM op JOIN autor ON op.ID_Autor=autor.ID WHERE autor.Autor LIKE '%$query%' ORDER BY `op`.`ID` DESC;";
                                // Llamada a la función para obtener el conteo total de resultados de 'op' y 'ed'
                                $totalResultadosOP = obtenerTotalResultados($sql2, $conexion);

                                ?>
                                <h2 class="text-xl font-semibold mb-4 text-blue-600">
                                    <i class="fas fa-play-circle mr-2"></i>Openings
                                    <span class="text-gray-500 text-sm">(<?php echo $totalResultadosOP; ?>)</span>
                                </h2>
                                <div class="overflow-x-auto max-h-[500px] overflow-y-auto">
                                    <?php
                                    $sql = "SELECT op.*, autor.Autor, autor.Canciones_Musica, autor.Canciones, anime.Nombre as anime 
                                            FROM `op` 
                                            JOIN autor ON op.ID_Autor=autor.ID 
                                            JOIN anime ON op.ID_Anime= anime.id 
                                            WHERE autor.Autor LIKE '%$query%' 
                                            ORDER BY `op`.`ID` DESC 
                                            LIMIT $limit";
                                    displayTable_op($sql, $conexion);
                                    ?>
                                </div>
                            </div>
                            <div>
                                <?php
                                $sql3 = "SELECT COUNT(*) as conteo FROM ed JOIN autor ON ed.ID_Autor=autor.ID WHERE autor.Autor LIKE '%$query%' ORDER BY `ed`.`ID` DESC;";
                                // Llamada a la función para obtener el conteo total de resultados de 'op' y 'ed'
                                $totalResultadosED = obtenerTotalResultados($sql3, $conexion);
                                ?>
                                <h2 class="text-xl font-semibold mb-4 text-green-600">
                                    <i class="fas fa-stop-circle mr-2"></i>Endings
                                    <span class="text-gray-500 text-sm">(<?php echo $totalResultadosED; ?>)</span>
                                </h2>
                                <div class="overflow-x-auto max-h-[500px] overflow-y-auto">
                                    <?php
                                    $sql = "SELECT ed.*, autor.Autor, autor.Canciones_Musica, autor.Canciones, anime.Nombre as anime 
                                            FROM `ed` 
                                            JOIN autor ON ed.ID_Autor=autor.ID
                                            JOIN anime ON ed.ID_Anime= anime.id 
                                            WHERE autor.Autor LIKE '%$query%' 
                                            ORDER BY `ed`.`ID` DESC 
                                            LIMIT $limit";
                                    displayTable_ed($sql, $conexion);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="info-container hidden" id="info-option-2">
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <h2 class="text-xl font-semibold mb-4 text-blue-600">
                                    <i class="fas fa-play-circle mr-2"></i>Openings
                                    <span class="text-gray-500 text-sm">(<?php echo $totalResultadosOP; ?>)</span>
                                </h2>
                                <div class="overflow-x-auto max-h-[500px] overflow-y-auto">
                                    <?php
                                    $sql = "SELECT op.*, autor.Autor, (autor.Canciones + autor.Canciones_Musica) as suma, anime.Nombre as anime 
                                            FROM `op` 
                                            JOIN autor ON op.ID_Autor=autor.ID 
                                            JOIN anime ON op.ID_Anime= anime.id 
                                            WHERE anime.Nombre LIKE '%$query%' 
                                            ORDER BY `op`.`ID` DESC 
                                            LIMIT $limit";
                                    displayTable_op($sql, $conexion);
                                    ?>
                                </div>
                            </div>
                            <div>
                                <h2 class="text-xl font-semibold mb-4 text-green-600">
                                    <i class="fas fa-stop-circle mr-2"></i>Endings
                                    <span class="text-gray-500 text-sm">(<?php echo $totalResultadosED; ?>)</span>
                                </h2>
                                <div class="overflow-x-auto max-h-[500px] overflow-y-auto">
                                    <?php
                                    $sql = "SELECT ed.*, autor.Autor, (autor.Canciones + autor.Canciones_Musica) as suma, anime.Nombre as anime 
                                            FROM `ed` 
                                            JOIN autor ON ed.ID_Autor=autor.ID 
                                            JOIN anime ON ed.ID_Anime= anime.id 
                                            WHERE anime.Nombre LIKE '%$query%' 
                                            ORDER BY `ed`.`ID` DESC 
                                            LIMIT $limit";
                                    displayTable_ed($sql, $conexion);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="info-container hidden" id="info-option-3">
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <h2 class="text-xl font-semibold mb-4 text-blue-600">
                                    <i class="fas fa-play-circle mr-2"></i>Openings
                                    <span class="text-gray-500 text-sm">(<?php echo $totalResultadosOP; ?>)</span>
                                </h2>
                                <div class="overflow-x-auto max-h-[500px] overflow-y-auto">
                                    <?php
                                    $sql = "SELECT op.*, autor.Autor, (autor.Canciones + autor.Canciones_Musica) as suma , anime.Nombre as anime 
                                            FROM `op` 
                                            JOIN autor ON op.ID_Autor=autor.ID 
                                            JOIN anime ON op.ID_Anime= anime.id 
                                            WHERE op.Cancion LIKE '%$query%' 
                                            ORDER BY `op`.`ID` DESC 
                                            LIMIT $limit";
                                    displayTable_op($sql, $conexion);
                                    ?>
                                </div>
                            </div>
                            <div>
                                <h2 class="text-xl font-semibold mb-4 text-green-600">
                                    <i class="fas fa-stop-circle mr-2"></i>Endings
                                    <span class="text-gray-500 text-sm">(<?php echo $totalResultadosED; ?>)</span>
                                </h2>
                                <div class="overflow-x-auto max-h-[500px] overflow-y-auto">
                                    <?php
                                    $sql = "SELECT ed.*, autor.Autor, (autor.Canciones + autor.Canciones_Musica) as suma , anime.Nombre as anime 
                                            FROM `ed` 
                                            JOIN autor ON ed.ID_Autor=autor.ID
                                            JOIN anime ON ed.ID_Anime= anime.id  
                                            WHERE ed.Cancion LIKE '%$query%' 
                                            ORDER BY `ed`.`ID` DESC 
                                            LIMIT $limit";
                                    displayTable_ed($sql, $conexion);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showOption(option) {
            // Reset all tab buttons
            document.querySelectorAll('.tab-button').forEach(btn => {
                btn.classList.remove('active');
            });

            // Activate current tab button
            document.querySelector(`.tab-button:nth-child(${option})`).classList.add('active');

            // Hide all info containers
            document.querySelectorAll('.info-container').forEach(container => {
                container.classList.add('hidden');
            });

            // Show selected info container
            document.getElementById(`info-option-${option}`).classList.remove('hidden');
        }

        // Existing functions for modal and quantity manipulation
        function increment(inputId, event) {
            event.preventDefault();
            var input = document.getElementById('quantity_' + inputId);
            var value = parseInt(input.value);
            input.value = value + 1;
        }

        function decrement(inputId, event) {
            event.preventDefault();
            var input = document.getElementById('quantity_' + inputId);
            var value = parseInt(input.value);
            if (value > 0) {
                input.value = value - 1;
            }
        }
    </script>
</body>

</html>