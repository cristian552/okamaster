 <!-- Content Header (Page header) -->
 <div class="content-header">
     <div class="container-fluid">
         <div class="row mb-2">
             <div class="col-sm-6">
                 <h1 class="m-0">Equipos</h1>
             </div><!-- /.col -->
             <div class="col-sm-6">
                 <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="#">Home</a></li>
                     <li class="breadcrumb-item active">Equipos</li>
                 </ol>
             </div><!-- /.col -->
         </div><!-- /.row -->
     </div><!-- /.container-fluid -->
 </div>
 <!-- /.content-header -->

 <!-- Main content -->
 <div class="content">
     <div class="container-fluid">

         <!-- row  para criterios de busqueda -->
         <div class="row">
             <div class="col-lg-12">
                 <div class="card card-info">
                     <div class="card-header">
                         <h3 class="card-title">Criterios De Busqueda</h3>
                         <div class="card-tools">
                             <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                 <i class="fas fa-minus"></i>
                             </button>

                             <button type="button" class="btn btn-tool  text-danger" id="btnLimpiarBusqueda">
                                 <i class="fas fa-times"></i>
                             </button>
                         </div>
                     </div>
                     <div class="card-body">
                         <div class="row">
                             <div class="col-lg-12 d-lg-flex">
                                 <div style="width: 20%;" class=" mx-1">
                                     <input type="text" id="iptImei" class="form-control" placeholder="Imei"
                                         data-index="2">
                                 </div>
                                 <div style="width: 20%;" class=" mx-1">
                                     <input type="text" id="iptMarca" class="form-control" placeholder="Marca"
                                         data-index="4">
                                 </div>
                             </div>
                         </div>

                     </div>
                 </div>
             </div>
         </div>

         <div class="row">
             <div class="col-lg-12">
                 <table id="tbl_equipos" class="table table-striped w-100 shadow">
                     <thead class="bg-info">
                         <tr>
                             <th></th>
                             <th>ID</th>
                             <th>imei</th>
                             <th>Imei2</th>
                             <th>Marca</th>
                             <th>Modelo</th>
                             <th>Observacion</th>
                             <th class="text-center">Opciones</th>
                         </tr>
                     </thead>

                 </table>
             </div>
         </div>

     </div><!-- /.container-fluid -->
 </div>

 <!-- /.content -->

 <!-- Ventana Modal Para Ingresar o Modificar un Equipo -->
 <div class="modal fade" id="mdlGestionarEquipo" role="dialog">
     <div class="modal-dialog modal-lg">

         <!-- contenido del modal-->
         <div class="modal-content">
             <!-- contenido del modal-->
             <div class="modal-header bg-gray py-1 align-items-center">
                 <h5 class="modal-title">Agregar Equipo</h5>
                 <button type="button" class="btn btn-outline-primary text-white border-0 fs-5" data-dismiss="modal"
                     id="btnCerrarModal">
                     <i class="fas fa-times-circle"></i>
                 </button>
             </div>
             <!-- contenido del modal-->
             <div class="modal-body">

                 <form class="needs-validation" novalidate>
                     <!-- abrimos una fila-->
                     <div class="row">
                     <input id="iptId_equipo" name="id_equipo" type="hidden" value="">
                         <!-- Columna Para El Registro Del imei-->
                         <div class="col-lg-6">
                             <div class="form-group mb-2">
                                 <label class="" for="iptImeii"><i class="fas fa-file-signature fs-6"> </i>
                                     <span class="small">Imei</span><span class="text-danger">*</span>
                                 </label>
                                 <input type="text" class="form-control form-control-sm" id="iptImeii" name="imei"
                                     placeholder="Imei" required>
                                 <div class="invalid-feedback">Ingresar El Imei Del Equipo</div>

                             </div>
                         </div>
                         <!-- Columna Para El Registro Del imei2-->
                         <div class="col-lg-6">
                             <div class="form-group mb-2">
                                 <label class="" for="iptImei2"><i class="fas fa-file-signature fs-6"></i>
                                     <span class="small">Imei2</span>
                                 </label>
                                 <input type="text" class="form-control form-control-sm" id="iptImei2" name="imei2"
                                     placeholder="Imei2">

                             </div>
                         </div>

                         <!-- Columna Para El Registro De la marca-->
                         <div class="col-lg-6">
                             <div class="form-group mb-2">
                                 <label class="" for="selMarca"><i class="fas fa-dumpster fs-6"></i>
                                     <span class="small">Marca</span><span class="text-danger">*</span>
                                 </label>
                                 <select class="form-control " aria-label=".form-select-sm example" id="selMarca"
                                     name="id_marca" required>
                                 </select>
                                 <div class="invalid-feedback">Ingresar la Marca Del Equipo</div>
                             </div>
                         </div>

                         <!-- Columna Para El Registro Del modelo-->
                         <div class="col-lg-6">
                             <div class="form-group mb-2">
                                 <label class="" for="iptModelo"><i class="fas fa-file-signature fs-6"></i>
                                     <span class="small">Modelo</span><span class="text-danger">*</span>
                                 </label>
                                 <input type="text" class="form-control form-control-sm" id="iptModelo" name="modelo"
                                     placeholder="Modelo" required>
                                 <div class="invalid-feedback">Ingresar El Modelo Del Equipo</div>

                             </div>
                         </div>

                         <!-- Columna Para El Registro De la observacion -->
                         <div class="col-lg-12">
                             <div class="form-group mb-2">
                                 <label class="" for="iptObservacion"><i class="fas fa-file-signature fs-6"></i>
                                     <span class="small">Observacion</span>
                                 </label>
                                 <input type="text" class="form-control form-control-sm" id="iptObservacion"
                                     name="observacion" placeholder="Observacion">

                             </div>
                         </div>
                         <!-- Creacion de botones para cancelar y guardar el Equipo -->
                         <button type="button" class="btn btn-danger mt-3 mx-2" style=" width:170px;"
                             data-dismiss="modal" id="btnCancelarRegistro">Cancelar</button>

                         <button type="button" style="width:170px;" class="btn btn-primary mt-3 mx-2"
                             id="btnGuardarEquipo">Guardar Equipo</button>


                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>


 <script>
var accion;
var table;

/*===================================================================*/
// INICIALIZAMOS EL MENSAJE DE TIPO TOAST (EMERGENTE EN LA PARTE SUPERIOR)
/*===================================================================*/
var Toast = Swal.mixin({
    Toast: true,
    position: 'top',
    showConfirmButton: false,
    timer: 3000
});

$(document).ready(function() {



    $.ajax({
        url: "ajax/equipos.ajax.php",
        type: 'POST',
        data: {
            'accion': 1
        }, //listar equipos
        dataType: 'json',
        success: function(respuesta) {
            console.log("respuesta", respuesta);
        }
    });

    //solicitud ajax para cargar el select de marca
    $.ajax({
        url: "ajax/marcas.ajax.php",
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(respuesta) {

            var options = '<option selected  value="0">Seleccione Una Marca</option>';

            for (let index = 0; index < respuesta.length; index++) {
                options = options + '<option value=' + respuesta[index][0] + '>' + respuesta[index][
                    1
                ] + '</option>';
            }
            $("#selMarca").html(options);
        }
    });


    /*===================================================================*/
    // CARGA DEL LISTADO CON EL PLUGIN DATATABLE JS
    /*===================================================================*/
    table = $("#tbl_equipos").DataTable({

        dom: 'Bfrtip',
        buttons: [{
                text: 'Agregar Equipo',
                className: 'addNewRecord',
                action: function(e, dt, node, config) {

                    //EVENTO PARA LEVENTAR LA VENTANA MODAL 
                    $("#mdlGestionarEquipo").modal('show');
                    accion = 2; //resgistrar
                }
            },
            'excel', 'print', 'pageLength'
        ],
        pageLength: [5, 10, 15, 30, 50, 100],
        pageLength: 10,

        ajax: {
            url: "ajax/equipos.ajax.php",
            dataSrc: '',
            type: 'POST',
            data: {
                'accion': 1
            }, //listar equipos

        },
        responsive: {
            details: {
                type: 'column'
            }
        },
        columnDefs: [{
                targets: 0,
                orderable: false,
                className: 'control'
            },
            {
                targets: 1,
                visible: false,
            },
            {
                targets: 7,
                orderable: false,
                render: function(data, type, full, meta) {
                    return "<center>" +
                        "<span class='btnEditarEquipo text-primary px-1' style='cursor:pointer;'>" +
                        "<i class='fas fa-pencil-alt fs-5'></i>" +
                        "</span>" +

                        "<span class='btnEliminarEquipo text-danger px-1' style='cursor:pointer;'>" +
                        "<i class='fas fa-trash fs-5'></i>" +
                        "</span>" +
                        "</center>"
                }
            }
        ],
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        }
    });

    /*===================================================================*/
    // EVENTOS PARA CRITERIOS DE BUSQUEDA (IMEI, MARCA)
    /*===================================================================*/
    $("#iptImei").keyup(function() {
        table.column($(this).data('index')).search(this.value).draw();
    })
    $("#iptMarca").keyup(function() {
        table.column($(this).data('index')).search(this.value).draw();
    })

    /*===================================================================*/
    // EVENTOS PARA LIMPIAR INPUTS CRITERIOS DE BUSQUEDA
    /*===================================================================*/
    $("#btnLimpiarBusqueda").on('click', function() {

        $("#iptImei").val('')
        $("#iptMarca").val('')
        table.search('').columns().search('').draw();
    })

    $("#btnCancelarRegistro, #btnCerrarModal").on('click', function() {

        $("#validate_imei").css("display", "none");
        $("#validate_id_marca").css("display", "none");
        $("#validate_modelo").css("display", "none");
        $("#validate_observacion").css("display", "none");

        $("#iptImeii").val("");
        $("#iptImei2").val("");
        $("#selMarca").val("0");
        $("#iptModelo").val("");
        $("#iptObservacion").val("");
    });

    /*===================================================================*/
    // EVENTO AL DAR CLICK EN EL BOTON EDITAR EQUIPO
    /*===================================================================*/
    $('#tbl_equipos tbody').on('click', '.btnEditarEquipo', function() {

        accion = 3; //seteamos la accion para editar

        $("#mdlGestionarEquipo").modal('show');

        var data = table.row($(this).parents('tr')).data();

        $("#iptId_equipo").val(data["id_equipo"]);
        $("#iptImeii").val(data["imei"]);
        $("#iptImei2").val(data["imei2"]);
        $("#selMarca").val(data["nombre"]);
        $("#iptModelo").val(data["modelo"]);
        $("#iptObservacion").val(data["observacion"]);
    });

    /*===================================================================*/
    // EVENTO AL DAR CLICK EN EL BOTON Eliminar EQUIPO
    /*===================================================================*/
    $('#tbl_equipos tbody').on('click', '.btnEliminarEquipo', function() {

        accion = 4; //seteamos la accion para eliminar

        var data = table.row($(this).parents('tr')).data();

        var imei = data["imei"];

        Swal.fire({
            title: ' Esta Seguro De Eliminar El Equipo?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            canceluttonColor: '#d33',
            confirmButtonText: 'Si, Deseo Eliminarlo!',
            cancelarButtonText: 'Cancelar',
        }).then((result) => {

            if (result.isConfirmed) {

                var datos = new FormData();

                datos.append("accion", accion);
                datos.append("imei", imei);

                $.ajax({
                    url: "ajax/equipos.ajax.php",
                    method: "POST",
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(respuesta) {
                        //console.log(respuesta);

                        if (respuesta == "ok") {

                            Toast.fire({
                                icon: 'success',
                                title: "El Equipo Se Elimino Correctamente"
                            });

                            table.ajax.reload();

                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: 'El Equipo No Se Pudo Eliminar'
                            });
                        }
                    }
                });

            }
        });


    });
});
/*===================================================================*/
// EVENTO QUE GUARDA LOS DATOS DEL EQUIPO,PREVIA VALIDACION DEL INGRESO DE LOS DATOS OBLIGATORIOS
/*===================================================================*/
document.getElementById("btnGuardarEquipo").addEventListener("click", function() {
    //  
    var forms = document.getElementsByClassName("needs-validation");
    //
    var validation = Array.prototype.filter.call(forms, function(form) {

        if (form.checkValidity() === true) {

            console.log("listo Para Registrar El Equipo")

            if(accion == 2){
                var titulo_msj = "Esta Seguro De Registrar El Equipo?"
                var titulo_confB = "Si, Deseo Registrarlo!"
            }
            if(accion == 3){
                var titulo_msj = " Esta Seguro De Actualizar El Equipo?"
                var titulo_confB = "Aceptar"
            }
            Swal.fire({
                title: titulo_msj,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                canceluttonColor: '#d33',
                confirmButtonText: titulo_confB,
                cancelarButtonText: 'Cancelar',
            }).then((result) => {

                if (result.isConfirmed) {

                    var datos = new FormData();

                    datos.append("accion", accion);
                    datos.append("id_equipo", $("#iptId_equipo").val());
                    datos.append("imei", $("#iptImeii").val());
                    datos.append("imei2", $("#iptImei2").val());
                    datos.append("id_marca", $("#selMarca").val());
                    datos.append("modelo", $("#iptModelo").val());
                    datos.append("observacion", $("#iptObservacion").val());

                    if(accion == 2){
                        var titulo_msj = "El Equipo Se Registro Correctamente"
                    }
                    if(accion == 3){
                        var titulo_msj = "El Equipo Se Actualizo Correctamente"
                    }
                    $.ajax({
                        url: "ajax/equipos.ajax.php",
                        method: "POST",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(respuesta) {
                            //console.log(respuesta);

                            if (respuesta == "ok") {

                                Toast.fire({
                                    icon: 'success',
                                    title: titulo_msj
                                });

                                table.ajax.reload();

                                $("#mdlGestionarEquipo").modal('hide');

                                $("#iptImeii").val("");
                                $("#iptImei2").val("");
                                $("#selMarca").val("");
                                $("#iptModelo").val("");
                                $("#iptObservacion").val("");
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'El Equipo No Se Pudo Registrar'
                                });
                            }
                        }
                    });

                }
            });

        } else {
            console.log("No Paso La Validacion")
        }
        form.classList.add('was-validated');
    });
});

/*===================================================================*/
// EVENTO QUE LIMPIA LOS MENSAJES DE ALERTA DE INGRESO DE DATOS DE CADA INPUT AL CANCELAR LA VENTANA MODAL
/*===================================================================*/
document.getElementById("btnCancelarRegistro").addEventListener("click", function() {
    $(".needs-validation").removeClass("was-validated");
});
/*===================================================================*/
// EVENTO QUE LIMPIA LOS MENSAJES DE ALERTA DE INGRESO DE DATOS DE CADA INPUT AL CERRAR LA VENTANA MODAL
/*===================================================================*/
document.getElementById("btnCerrarModal").addEventListener("click", function() {
    $(".needs-validation").removeClass("was-validated");
});
 </script>