<?php 

	class MarcasModel extends Mysql
	{
		public $intIdmarca;
		public $strNombre;

		public function __construct()
		{
			parent::__construct();
		}

		public function selectMarcas()
		{
			//EXTRAE marcas
			$sql = "SELECT * FROM marca";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectMarca(int $idmarca)
		{
			//BUSCAR marca
			$this->intIdmarca = $idmarca;
			$sql = "SELECT * FROM marca WHERE idmarca = $this->intIdmarca";
			$request = $this->select($sql);
			return $request;
		}

		public function insertMarca(string $nombre){

			$return = "";
			$this->strNombre = $nombre;

			$sql = "SELECT * FROM marca WHERE nombre = '{$this->strNombre}' ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO marca(nombre) VALUES(?)";
	        	$arrData = array($this->strNombre);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;
		}	

		public function updateMarca(int $idmarca,  string $nombre){
			$this->intIdmarca = $idmarca;
			$this->strNombre = $nombre;
			

			$sql = "SELECT * FROM marca WHERE nombre = '$this->strNombre' AND idmarca != $this->intIdmarca";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE marca SET nombre = ? WHERE idmarca = $this->intIdmarca ";
				$arrData = array($this->strNombre);
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
		    return $request;			
		}

		public function deleteMarca(int $idmarca)
		{
			$this->intIdmarca = $idmarca;
			
			if(empty($request))
			{		
				$sql = "DELETE FROM marca WHERE idmarca = $this->intIdmarca ";
				$arrData = array(0);
				$request = $this->update($sql,$arrData);
				if($request)
				{
					$request = 'ok';	
				}else{
					$request = 'error';
				}
			}else{
				$request = 'exist';
			}
			return $request;
		}

			
	}

 ?>