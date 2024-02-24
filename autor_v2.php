<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://kit.fontawesome.com/8846655159.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/autores.css?v=<?php echo time(); ?>">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Buscador de Canciones</title>
</head>

<body>
    <form action="#" method="GET" class="search-form">
        <input type="search" name="key" placeholder="Buscar...">
        <button type="submit"><i class="fas fa-search"></i></button>
    </form>


    <div class="deudores">
        <?php
        require '../bd.php';

        $limit = 5;

        if (isset($_GET['key'])) {
            // Recuperar el término de búsqueda
            $query = $_GET['key'];
        } else {
            $query = "";
        }


        ?>
        <div class="menu-container">
            <div class="menu-options">
                <div class="menu-option" onclick="showOption(1)">
                    Autores
                    <div class="menu-line"></div>
                </div>
                <div class="menu-option" onclick="showOption(2)">
                    Animes
                </div>
                <div class="menu-option" onclick="showOption(3)">
                    Canciones
                </div>
            </div>
        </div>
        <div class="info-container active" id="info-option-1">
            <h2>Openings</h2>
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

                $sql = "SELECT op.*, autor.Autor FROM `op` JOIN autor ON op.ID_Autor=autor.ID WHERE autor.Autor LIKE '%$query%' ORDER BY `op`.`ID` DESC limit $limit";
                //echo $sql;

                $result = mysqli_query($conexion, $sql);


                while ($mostrar = mysqli_fetch_array($result)) {
                    $id_Registros = $mostrar['ID'];
                ?>


                    <tr>
                        <td><?php echo $mostrar['Nombre'] ?></td>
                        <td>OP <?php echo $mostrar['Opening'] ?></td>
                        <td><?php echo $mostrar['Cancion'] ?></a></td>
                        <td><?php echo $mostrar['Autor'] ?></td>
                        <td>
                            <div class="container" style="width: 100%; height: 100px;">
                                <iframe src="/Anime/OP/ejemplo.php?id=<?php echo $id_Registros; ?>" frameborder="0" ñ style="width: 100%; height: 100%;"></iframe>
                            </div>
                    </tr>
                    <!--Ventana Modal para Actualizar--->
                <?php
                }
                ?>
            </table>
            <br>
            <h2>Endings</h2>
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

                $sql = "SELECT ed.*, autor.Autor FROM `ed` JOIN autor ON ed.ID_Autor=autor.ID WHERE autor.Autor LIKE '%$query%' ORDER BY `ed`.`ID` DESC limit $limit";
                //echo $sql;

                $result = mysqli_query($conexion, $sql);


                while ($mostrar = mysqli_fetch_array($result)) {
                    $id_Registros = $mostrar['ID'];
                ?>


                    <tr>
                        <td><?php echo $mostrar['Nombre'] ?></td>
                        <td>ED <?php echo $mostrar['Ending'] ?></td>
                        <td><?php echo $mostrar['Cancion'] ?></a></td>
                        <td><?php echo $mostrar['Autor'] ?></td>
                        <td>
                            <div class="container" style="width: 100%; height: 100px;">
                                <iframe src="/Anime/ED/ejemplo.php?id=<?php echo $id_Registros; ?>" frameborder="0" ñ style="width: 100%; height: 100%;"></iframe>
                            </div>
                    </tr>
                    <!--Ventana Modal para Actualizar--->
                <?php
                }
                ?>
            </table>
        </div>
        <div class="info-container" id="info-option-2">
            <h2>Openings</h2>
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

                $sql = "SELECT op.*, autor.Autor FROM `op` JOIN autor ON op.ID_Autor=autor.ID WHERE op.Nombre LIKE '%$query%' ORDER BY `op`.`ID` DESC limit $limit";
                //echo $sql;

                $result = mysqli_query($conexion, $sql);


                while ($mostrar = mysqli_fetch_array($result)) {
                    $id_Registros = $mostrar['ID'];
                ?>


                    <tr>
                        <td><?php echo $mostrar['Nombre'] ?></td>
                        <td>OP <?php echo $mostrar['Opening'] ?></td>
                        <td><?php echo $mostrar['Cancion'] ?></a></td>
                        <td><?php echo $mostrar['Autor'] ?></td>
                        <td>
                            <div class="container" style="width: 100%; height: 100px;">
                                <iframe src="/Anime/OP/ejemplo.php?id=<?php echo $id_Registros; ?>" frameborder="0" ñ style="width: 100%; height: 100%;"></iframe>
                            </div>
                    </tr>
                    <!--Ventana Modal para Actualizar--->
                <?php
                }
                ?>
            </table>
            </br>
            <h2>Endings</h2>
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

                $sql = "SELECT ed.*, autor.Autor FROM `ed` JOIN autor ON ed.ID_Autor=autor.ID WHERE ed.Nombre LIKE '%$query%' ORDER BY `ed`.`ID` DESC limit $limit";
                //echo $sql;

                $result = mysqli_query($conexion, $sql);


                while ($mostrar = mysqli_fetch_array($result)) {
                    $id_Registros = $mostrar['ID'];
                ?>


                    <tr>
                        <td><?php echo $mostrar['Nombre'] ?></td>
                        <td>ED <?php echo $mostrar['Ending'] ?></td>
                        <td><?php echo $mostrar['Cancion'] ?></a></td>
                        <td><?php echo $mostrar['Autor'] ?></td>
                        <td>
                            <div class="container" style="width: 100%; height: 100px;">
                                <iframe src="/Anime/ED/ejemplo.php?id=<?php echo $id_Registros; ?>" frameborder="0" ñ style="width: 100%; height: 100%;"></iframe>
                            </div>
                    </tr>
                    <!--Ventana Modal para Actualizar--->
                <?php
                }
                ?>
            </table>
        </div>
        <div class="info-container" id="info-option-3">
            <h2>Openings</h2>
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


                $sql = "SELECT op.*, autor.Autor FROM `op` JOIN autor ON op.ID_Autor=autor.ID WHERE op.Cancion LIKE '%$query%' ORDER BY `op`.`ID` DESC limit $limit";
                //echo $sql;

                $result = mysqli_query($conexion, $sql);


                while ($mostrar = mysqli_fetch_array($result)) {
                    $id_Registros = $mostrar['ID'];
                ?>


                    <tr>
                        <td><?php echo $mostrar['Nombre'] ?></td>
                        <td>OP <?php echo $mostrar['Opening'] ?></td>
                        <td><?php echo $mostrar['Cancion'] ?></a></td>
                        <td><?php echo $mostrar['Autor'] ?></td>
                        <td>
                            <div class="container" style="width: 100%; height: 100px;">
                                <iframe src="/Anime/OP/ejemplo.php?id=<?php echo $id_Registros; ?>" frameborder="0" ñ style="width: 100%; height: 100%;"></iframe>
                            </div>
                    </tr>
                    <!--Ventana Modal para Actualizar--->
                <?php
                }
                ?>
            </table>
            <br>
            <h2>Endings</h2>
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
                $sql = "SELECT ed.*, autor.Autor FROM `ed` JOIN autor ON ed.ID_Autor=autor.ID WHERE ed.Cancion LIKE '%$query%' ORDER BY `ed`.`ID` DESC limit $limit";
                //echo $sql;

                $result = mysqli_query($conexion, $sql);


                while ($mostrar = mysqli_fetch_array($result)) {
                    $id_Registros = $mostrar['ID'];
                ?>


                    <tr>
                        <td><?php echo $mostrar['Nombre'] ?></td>
                        <td>ED <?php echo $mostrar['Ending'] ?></td>
                        <td><?php echo $mostrar['Cancion'] ?></a></td>
                        <td><?php echo $mostrar['Autor'] ?></td>
                        <td>
                            <div class="container" style="width: 100%; height: 100px;">
                                <iframe src="/Anime/ED/ejemplo.php?id=<?php echo $id_Registros; ?>" frameborder="0" ñ style="width: 100%; height: 100%;"></iframe>
                            </div>
                    </tr>

                <?php
                }
                ?>
            </table>
        </div>
    </div>
    <script>
        let selectedOption = 1;

        function showOption(option) {
            if (option !== selectedOption) {
                // Mover la línea debajo de la opción seleccionada
                const menuLine = document.querySelector('.menu-line');
                menuLine.style.transform = `translateX(${(option - 1) * 128}%)`;

                // Ocultar la información de la opción anterior
                const prevInfoContainer = document.querySelector(`#info-option-${selectedOption}`);
                prevInfoContainer.classList.remove('active');

                // Mostrar la información de la opción seleccionada
                const currentInfoContainer = document.querySelector(`#info-option-${option}`);
                currentInfoContainer.classList.add('active');

                selectedOption = option;
            }
        }

        // Al cargar la página, mostrar la primera opción por defecto
        showOption(selectedOption);
    </script>
</body>

</html>