<script src="<?= asset('./build/js/shows/index.js')  ?>"></script>  
    <h1>Detalle de las aplicaciones</h1>

    <?php foreach ($detallesAgrupados as $categoria => $detallesCategoria): ?>
        <h2><?php echo $categoria; ?></h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Grado Programador</th>
                    <th>Nombre programador</th>
                    <th>Asignacion Aplicación</th>
                    <th>Descripcion Tarea</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($detallesCategoria as $indice => $detalle): ?>
                    <tr>
                        <td><?php echo $indice + 1; ?></td>
                        <td><?php echo $detalle['prog_grado']; ?></td>
                        <td><?php echo $detalle['prog_nombres']; ?></td>
                        <td><?php echo $detalle['asig_id']; ?></td>
                        <td><?php echo $detalle['tar_descripcion']; ?></td>
                        <td><?php echo $detalle['tar_fecha']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endforeach; ?>

    <a href="/final_IS2_martinez/" class="btn btn-primary">Salir</a>

