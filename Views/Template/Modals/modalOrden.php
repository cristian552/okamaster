<!-- Modal -->
<div class="modal fade" id="modalFormOrden" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nueva Orden</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="formOrden" name="formOrden" class="form-horizontal">
              <input type="hidden" id="idOrden" name="idOrden" value="">
              <p class="text-primary">Todos los campos son obligatorios.</p>

              <div class="form-row">
              <div class="form-group col-md-6">
                    <label for="listPersonaid">Cliente</label>
                    <select class="form-control" data-live-search="true" id="listPersonaid" name="listPersonaid" required="" >
                    </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="txtImei">Imei</label>
                  <input type="text" class="form-control" id="txtImei" name="txtImei" required="">
                </div>
                
              </div>
              <div class="form-row">
              <div class="form-group col-md-6">
                  <label for="txtMarca">Marca</label>
                  <input type="text" class="form-control" id="txtMarca" name="txtMarca" required="">
                </div>
                <div class="form-group col-md-6">
                  <label for="txt,Modelo">Modelo</label>
                  <input type="text" class="form-control " id="txtModelo" name="txtModelo" required="">
                </div>
               
              </div>
              <div class="form-row">
              <div class="form-group col-md-6">
                  <label for="txtObservacion">Observacion</label>
                  <input type="text" class="form-control " id="txtObservacion" name="txtObservacion" required="">
                </div>
                <div class="form-group col-md-6">
                  <label for="txtContrasena">Contraseña</label>
                  <input type="text" class="form-control " id="txtContrasena" name="txtContrasena" required="">
                </div>
                
               
              </div>
              
              <div class="form-row">
              <div class="form-group col-md-6">
                  <label for="txtResponsable">Responsable</label>
                  <input type="text" class="form-control " id="txtResponsable" name="txtResponsable" required="">
                </div>
              <div class="form-group col-md-6">
                  <label for="txtResponsable">Precio</label>
                  <input type="text" class="form-control " id="txtPrecio" name="txtPrecio" required="">
                </div>
             
             </div>
             <div class="form-group col-md-6">
                    <label for="listStatus">Status</label>
                    <select class="form-control selectpicker" id="listStatus" name="listStatus" required >
                        <option value="1">Activo</option>
                        <option value="2">Inactivo</option>
                    </select>
            </div>
            
              <div class="tile-footer">
                <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
              </div>
            </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalViewOrden" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Datos de la orden</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td>Identificación:</td>
              <td id="celIdentificacion">loading...</td>
            </tr>
            <tr>
              <td>Nombres:</td>
              <td id="celNombre">loading...</td>
            </tr>
            <tr>
              <td>imei:</td>
              <td id="celImei">loading...</td>
            </tr>
            <tr>
              <td>Marca:</td>
              <td id="celMarca">loading...</td>
            </tr>
            <tr>
              <td>Modelo (Usuario):</td>
              <td id="celModelo">loading...</td>
            </tr>
            <tr>
              <td>Observacion:</td>
              <td id="celObservacion">loading...</td>
            </tr>
            <tr>
              <td>Contraseña:</td>
              <td id="celContrasena">loading...</td>
            </tr>
            <tr>
              <td>Responsable:</td>
              <td id="celResponsable">loading...</td>
            </tr>
            <tr>
              <td>Precio:</td>
              <td id="celPrecio">loading...</td>
            </tr>
            <tr>
              <td>Estado:</td>
              <td id="celEstado">loading...</td>
            </tr>
            <tr>
              <td>Fecha registro:</td>
              <td id="celFechaRegistro">loading...</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

