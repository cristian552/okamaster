<?php 

class Marcas extends Controllers{
	public function __construct()
	{
		parent::__construct();
		session_start();
		if(empty($_SESSION['login']))
		{
			header('Location: '.base_url().'/login');
		}
		getPermisos(6);
	}

	public function Marcas()
	{
		if(empty($_SESSION['permisosMod']['r'])){
			header("Location:".base_url().'/dashboard');
		}
		$data['page_tag'] = "Marcas";
		$data['page_title'] = "Marcas <small>Okamaster.RM</small>";
		$data['page_name'] = "marcas";
		$data['page_functions_js'] = "functions_marcas.js";
		$this->views->getView($this,"marcas",$data);
	}


	
    public function setMarca(){
		
        $intIdmarca = intval($_POST['idMarca']);
        $strMarca =  strClean($_POST['txtNombre']);

        if($intIdmarca == 0)
        {
            //Crear
            $request_marca = $this->model->insertMarca($strMarca);
            $option = 1;
        }else{
            //Actualizar
            $request_marca = $this->model->updateMarca($intIdmarca, $strMarca);
            $option = 2;
        }

        if($request_marca > 0 )
        {
            if($option == 1)
            {
                $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
            }else{
                $arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
            }
        }else if($request_marca == 'exist'){
            
            $arrResponse = array('status' => false, 'msg' => '¡Atención! La Marca Ya Existe.');
        }else{
            $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
        }
        echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        die();
    }

	public function getMarcas()
	{
		if($_SESSION['permisosMod']['r']){
			$arrData = $this->model->selectMarcas();
			for ($i=0; $i < count($arrData); $i++) {
				$btnView = '';
				$btnEdit = '';
				$btnDelete = '';
				if($_SESSION['permisosMod']['r']){
					$btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo('.$arrData[$i]['idmarca'].')" title="Ver marca"><i class="far fa-eye"></i></button>';
				}
				if($_SESSION['permisosMod']['u']){
					$btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo(this,'.$arrData[$i]['idmarca'].')" title="Editar marca"><i class="fas fa-pencil-alt"></i></button>';
				}
				if($_SESSION['permisosMod']['d']){	
					$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['idmarca'].')" title="Eliminar marca"><i class="far fa-trash-alt"></i></button>';
				}
				$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		}
		die();
	}


	public function getMarca($idmarca){
		if($_SESSION['permisosMod']['r']){
			$intIdmarca = intval(strClean($idmarca));
			if($intIdmarca > 0)
			{
				$arrData = $this->model->selectMarca($intIdmarca);
				if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
				}else{
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
		}	
		die();
	}


	public function delMarca()
		{
			if($_POST){
				if($_SESSION['permisosMod']['d']){
					$intIdmarca = intval($_POST['idMarca']);
					$requestDelete = $this->model->deleteMarca($intIdmarca);
					if($requestDelete == 'ok')
					{
						$arrResponse = array('status' => true, 'msg' => 'Se Ha eliminado La Marca');
					}else if($requestDelete == 'exist'){
						$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar la marca asociado a usuarios.');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar la marca.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}	
			die();
		}

	

}

?>