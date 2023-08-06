<h1 class="text-center">Formulario para la creación de Aplicaciones</h1>
<div class="row justify-content-center mb-5">
<form class="col-lg-8 border bg-light p-3" id="formularioAplicaciones">
<input type="hidden" name="app_id" id="app_id">      
<div class="row mb-3">
        <div class="col">
          <label for="app_nombre">Ingrese el nombre de la aplicación</label>
          <input type="text" name="app_nombre" id="app_nombre" class="form-control">
        </div>
      </div>
      <div class="row mb-3">
            <div class="col">
                <button type="submit" form="formularioAplicaciones" id="btnGuardar" data-saludo= "hola" data-saludo2="hola2" class="btn btn-primary w-100">Guardar</button>
            </div>
            <div class="col">
                <button type="button" id="btnModificar" class="btn btn-warning w-100">Modificar</button>
            </div>
            <div class="col">
                <button type="button" id="btnBuscar" class="btn btn-info w-100">Buscar</button>
            </div>
            <div class="col">
                <button type="button" id="btnCancelar" class="btn btn-danger w-100">Cancelar</button>
            </div>
        </div>
    </form>
  </div>
  <div class="row justify-content-center" id="divTabla">
    <div class="col-lg-8">
        <h2>Listado de aplicaciones</h2>
        <table class="table table-bordered table-hover" id="tablaAplicaciones">
            <thead class="table-dark">
                <tr>
                    <th>NO. </th>
                    <th>NOMBRE</th>
                    <th>MODIFICAR</th>
                    <th>ELIMINAR</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<script src="<?= asset('./build/js/aplicaciones/index.js')  ?>"></script>