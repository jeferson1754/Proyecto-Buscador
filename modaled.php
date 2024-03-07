<div class="modal fade" id="newModaled<?php echo $id_Registros; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar Canciones</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="actualizar_autor.php" method="POST">
                <div class="modal-body">
                    <h1 class="text-center"><?php echo $mostrar['Autor'] ?></h1>
                    <div class="contenedor">
                        <input type="hidden" name="id_autor" value="<?php echo $mostrar['ID_Autor'] ?>">
                        <button class="minus" onclick="decrement('<?php echo $id_Registros; ?>', event)">-</button>
                        <input type="number" name="cantidad" id="quantity_<?php echo $id_Registros; ?>" min="0" value="<?php echo $mostrar['Canciones_Musica'] ?>" />
                        <button class="plus" onclick="increment('<?php echo $id_Registros; ?>', event)">+</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>