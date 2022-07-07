<?php 

	class OrdenModel extends Mysql
	{
		private $intIdOrden;
        private $intlistPersonaid;
		private $strImei;
		private $strMarca;
		private $strModelo;
		private $strObservacion;
		private $strContrasena;
		private $strResponsable;
		private $strPrecio;
		private $intStatus;

		public function __construct()
		{
			parent::__construct();
		}	

		public function insertOrden(int $personaid, string $imei, string $marca, string $modelo,  string $observacion, string $contrasena, string $responsable, string $precio, int $status){

			$this->intlistPersonaid = $personaid;
			$this->strImei = $imei;
			$this->strMarca = $marca;
			$this->strModelo = $modelo;
			$this->strObservacion = $observacion;
			$this->strContrasena = $contrasena;
            $this->strResponsable = $responsable;
            $this->strPrecio = $precio;
			$this->intStatus = $status;
			$return = 0;

			/*$sql = "SELECT * FROM orden WHERE 
					imei = '{$this->strImei}' or identificacion = '{$this->strIdentificacion}' ";
			$request = $this->select_all($sql);*/

			if(empty($request))
			{
				$query_insert  = "INSERT INTO orden(personaid,imei,marca,modelo,observacion,contrasena,responsable,precio,status) 
								  VALUES(?,?,?,?,?,?,?,?,?)";
	        	$arrData = array($this->intlistPersonaid,
        						$this->strImei,
        						$this->strMarca,
        						$this->strModelo,
        						$this->strObservacion,
        						$this->strContrasena,
        						$this->strResponsable,
                                $this->strPrecio,
        						$this->intStatus);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
	        return $return;
		}

        public function selectOrden()
		{
			$sql = "SELECT o.idorden,p.identificacion,p.nombres,o.imei,o.marca,o.modelo,o.observacion,o.contrasena,o.responsable,o.precio,o.status
					FROM orden o 
					INNER JOIN persona p
					ON o.personaid = p.idpersona
					WHERE p.status != 0 ";
					$request = $this->select_all($sql);
					return $request;
		}

        public function select_Orden(int $idorden){ 
			$this->intIdorden = $idorden;
                $sql = "SELECT o.idorden,p.identificacion,p.nombres,o.imei,o.marca,o.modelo,o.observacion,o.contrasena,o.responsable,o.precio,o.status,
                DATE_FORMAT(o.datecreated, '%d-%m-%Y') as fechaRegistro
                        FROM orden o 
                        INNER JOIN persona p
                        ON o.personaid = p.idpersona
                        WHERE o.idorden = $this->intIdorden";	
                    
			$request = $this->select($sql);
			return $request;
		}	

		public function updateOrden(int $idOrden, int $listPersonaid, string $imei, string $marca, string $modelo, string $observacion, string $contrasena,string $responsable, string $precio,int $status){

			$this->intIdOrden = $idOrden;
			$this->intlistPersonaid = $listPersonaid;
			$this->strImei = $imei;
			$this->strMarca = $marca;
			$this->strModelo = $modelo;
			$this->strObservacion = $observacion;
			$this->strContrasena = $contrasena;
			$this->strResponsable= $responsable;
			$this->strPrecio = $precio;
			$this->intStatus = $status;

			$sql = "SELECT * FROM orden WHERE (imei = '{$this->strImei}' AND idorden != $this->intIdOrden)
										 ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				
					
					$sql = "UPDATE orden SET personaid=?, imei=?, marca=?, modelo=?, observacion=?, contrasena=?, responsable=?, precio=?, status=? 
							WHERE idorden = $this->intIdOrden ";
					$arrData = array($this->intlistPersonaid = $listPersonaid,
					$this->strImei,
					$this->strMarca,
					$this->strModelo,
					$this->strObservacion,
					$this->strContrasena,
					$this->strResponsable,
					$this->strPrecio,
					$this->intStatus);
				}else{
					$request = "exist";
				}
				return $request;
		
		}
    }    
?> 