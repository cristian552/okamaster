var tableOrden;

document.addEventListener('DOMContentLoaded', function(){

    tableOrden = $('#tableOrden').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Orden/getOrden",
            "dataSrc":""
        },
        "columns":[
            {"data":"idorden"},
            {"data":"identificacion"},
            {"data":"nombres"},
            {"data":"imei"},
            {"data":"marca"},
            {"data":"modelo"},
            {"data":"observacion"},
            {"data":"contrasena"},
            {"data":"responsable"},
            {"data":"precio"},
            {"data":"status"},
            {"data":"options"}
        ],
        'dom': 'lBfrtip',
        'buttons': [
            {
                "extend": "copyHtml5",
                "text": "<i class='far fa-copy'></i> Copiar",
                "titleAttr":"Copiar",
                "className": "btn btn-secondary"
            },{
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr":"Esportar a Excel",
                "className": "btn btn-success"
            },{
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr":"Esportar a PDF",
                "className": "btn btn-danger"
            },{
                "extend": "csvHtml5",
                "text": "<i class='fas fa-file-csv'></i> CSV",
                "titleAttr":"Esportar a CSV",
                "className": "btn btn-info"
            }
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    });

    fntPersonaUsuario();
    if(document.querySelector("#formOrden")){
        let formOrden = document.querySelector("#formOrden");
        formOrden.onsubmit = function(e) {
            e.preventDefault();
            let intTipousuario = document.querySelector('#listPersonaid').value;
            let strImei = document.querySelector('#txtImei').value;
            let strMarca = document.querySelector('#txtMarca').value;
            let strModelo = document.querySelector('#txtModelo').value;
            let strObservacion = document.querySelector('#txtObservacion').value;
            let strContrasena = document.querySelector('#txtContrasena').value;
            let strResponsable = document.querySelector('#txtResponsable').value;
            let strPrecio = document.querySelector('#txtPrecio').value;
           
            
            if(intTipousuario == '' || strImei == '' || strMarca == '' || strModelo == '' || strObservacion == '' ||  strContrasena == '' ||strResponsable == '' || strPrecio == '')
            {
                swal("Atención", "Todoss los campos son obligatorios." , "error");
                return false;
            }

            let elementsValid = document.getElementsByClassName("valid");
            for (let i = 0; i < elementsValid.length; i++) { 
                if(elementsValid[i].classList.contains('is-invalid')) { 
                    swal("Atención", "Por favor verifique los campos en rojo." , "error");
                    return false;
                } 
            } 
            divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Orden/setOrden'; 
            let formData = new FormData(formOrden);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        $('#modalFormOrden').modal("hide");
                        formOrden.reset();
                        swal("Orden", objData.msg ,"success");
                        tableOrden.api().ajax.reload();
                    }else{
                        swal("Error", objData.msg , "error");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    }
}, false);

function fntPersonaUsuario(){
    if(document.querySelector('#listPersonaid')){
        var ajaxUrl = base_url+'/Clientes/getSelectCliente';
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                document.querySelector('#listPersonaid').innerHTML = request.responseText;
                $('#listPersonaid').selectpicker('render');
            }
        }
    }
}

function fntViewInfo(idorden){
  
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Orden/get_Orden/'+idorden;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status)
            {   var estadoUsuario = objData.data.status == 1 ? 
                '<span class="badge badge-success">Activo</span>' : 
                '<span class="badge badge-danger">Inactivo</span>';

                document.querySelector("#celIdentificacion").innerHTML = objData.data.identificacion;
                document.querySelector("#celNombre").innerHTML = objData.data.nombres;
                document.querySelector("#celImei").innerHTML = objData.data.imei;
                document.querySelector("#celMarca").innerHTML = objData.data.marca;
                document.querySelector("#celModelo").innerHTML = objData.data.modelo;
                document.querySelector("#celObservacion").innerHTML = objData.data.observacion;
                document.querySelector("#celContrasena").innerHTML = objData.data.contrasena;
                document.querySelector("#celResponsable").innerHTML = objData.data.responsable;
                document.querySelector("#celPrecio").innerHTML = objData.data.precio;
                document.querySelector("#celEstado").innerHTML = estadoUsuario;
                document.querySelector("#celFechaRegistro").innerHTML = objData.data.fechaRegistro;
                $('#modalViewOrden').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }
}

function fntEditInfo(element, idorden){
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML ="Actualizar Orden";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="Actualizar";
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Orden/get_Orden/'+idorden;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){

        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status)
            {   
                document.querySelector("#idOrden").value = objData.data.idorden;
                
                document.querySelector("#txtImei").value = objData.data.imei;
                document.querySelector("#txtMarca").value = objData.data.marca;
                document.querySelector("#txtModelo").value = objData.data.modelo;
                document.querySelector("#txtObservacion").value = objData.data.observacion;
                document.querySelector("#txtContrasena").value = objData.data.contrasena;
                document.querySelector("#txtResponsable").value = objData.data.responsable;
                document.querySelector("#txtPrecio").value = objData.data.precio;
                document.querySelector("#listPersonaid").value =objData.data.idpersona;
                $('#listPersonaid').selectpicker('render');

                if(objData.data.status == 1){
                    document.querySelector("#listStatus").value = 1;
                }else{
                    document.querySelector("#listStatus").value = 2;
                }
                $('#listStatus').selectpicker('render');
            }
        }
        $('#modalFormOrden').modal('show');
    }
}

function fntDelInfo(idpersona){
    swal({
        title: "Eliminar Cliente",
        text: "¿Realmente quiere eliminar al cliente?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {
        
        if (isConfirm) 
        {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Clientes/delCliente';
            let strData = "idUsuario="+idpersona;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tableClientes.api().ajax.reload();
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }

    });

}

function openModal()
{
    document.querySelector('#idOrden').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nueva Orden";
    document.querySelector("#formOrden").reset();
    $('#modalFormOrden').modal('show');
}

function openModalPerfil(){
    $('#modalFormPerfil').modal('show');
}