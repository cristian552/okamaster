<?php 

	class Orden extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			session_regenerate_id(true);
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
			}
			getPermisos(5);
		}

		public function Orden()
		{
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "Orden";
			$data['page_title'] = "ORDEN <small>Okamaster.RM</small>";
			$data['page_name'] = "orden";
			$data['page_functions_js'] = "functions_orden.js";
			$this->views->getView($this,"orden",$data);
		}

        public function setOrden(){
           // dep($_POST);
            //die();
            if($_POST){			
                if(empty($_POST['listPersonaid']) || empty($_POST['txtImei']) || empty($_POST['txtMarca']) || empty($_POST['txtModelo']) || empty($_POST['txtObservacion'])  || empty($_POST['txtContrasena'])  || empty($_POST['txtResponsable'])  || empty($_POST['txtPrecio'])  || empty($_POST['listStatus']))
                {
                    $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
                }else{ 
                            $idOrden = intval($_POST['idOrden']);
                            $intlistPersonaid = intval(strClean($_POST['listPersonaid']));
                            $strImei = ucwords(strClean($_POST['txtImei']));
                            $strMarca = ucwords(strClean($_POST['txtMarca']));
                            $strModelo = ucwords(strClean($_POST['txtModelo']));
                            $strObservacion = ucwords(strClean($_POST['txtObservacion']));
                            $strContrasena = ucwords(strClean($_POST['txtContrasena']));
                            $strResponsable = ucwords(strClean($_POST['txtResponsable']));
                            $strPrecio = ucwords(strClean($_POST['txtPrecio']));
                            $intStatus = intval(strClean($_POST['listStatus']));
                            $request_user = "";
                    if($idOrden == 0)
                    {
                        $option = 1;
                        if($_SESSION['permisosMod']['w']){
                            $request_user = $this->model->insertOrden($intlistPersonaid,
                                                                                        $strImei,
                                                                                        $strMarca, 
                                                                                        $strModelo, 
                                                                                        $strObservacion, 
                                                                                        $strContrasena,
                                                                                        $strResponsable, 
                                                                                        $strPrecio, 
                                                                                        $intStatus);
                        }
                    }else{
                        $option = 2;
                      
                        if($_SESSION['permisosMod']['u']){
                            $request_user = $this->model->updateOrden($idOrden,
                                                                                    $intlistPersonaid,
                                                                                    $strImei,
                                                                                    $strMarca, 
                                                                                    $strModelo, 
                                                                                    $strObservacion, 
                                                                                    $strContrasena,
                                                                                    $strResponsable, 
                                                                                    $strPrecio, 
                                                                                    $intStatus);
                        }
        
                    }
        
                    if($request_user > 0 )
                    {
                        if($option == 1){
                            $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
                        }else{
                            $arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
                        }
                    }else if($request_user == 'exist'){
                        $arrResponse = array('status' => false, 'msg' => '¡Atención! el email o la identificación ya existe, ingrese otro.');		
                    }else{
                        $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                    }
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function getOrden()
		{
			if($_SESSION['permisosMod']['r']){

				$arrData = $this->model->selectOrden();
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = '';
					$btnEdit = '';
					$btnDelete = '';

					if($arrData[$i]['status'] == 1)
					{
						$arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
					}else{
						$arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
					}

					if($_SESSION['permisosMod']['r']){ 
                        $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo('.$arrData[$i]['idorden'].')" title="Ver orden"><i class="far fa-eye"></i></button>';
                    }
                    if($_SESSION['permisosMod']['u']){
                        $btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo(this,'.$arrData[$i]['idorden'].')" title="Editar orden"><i class="fas fa-pencil-alt"></i></button>';
                    }
                    if($_SESSION['permisosMod']['d']){	
                        $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['idorden'].')" title="Eliminar orden"><i class="far fa-trash-alt"></i></button>';
                    }
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}
       
        public function get_Orden($idorden)
        {
            if($_SESSION['permisosMod']['r']){
				$Idorden = intval($idorden);
				if($Idorden > 0)
				{
					$arrData = $this->model->select_Orden($Idorden);
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
    
    }
?>
			