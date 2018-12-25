<?php  

	class Usuario{
		private $idusuario;
		private $deslogin;
		private $dessenha;
		private $dtcadastro;

		//Inicio Get & Set idusuario
		public function getIdusuario(){
			return $this->idusuario;
		}
		public function setIdusuario($value){
			$this->idusuario = $value; 
		}
		//Final Get & Set idusuario
		//Inicio Get & Set deslogin
		public function getDeslogin(){
			return $this->deslogin;
		}
		public function setDeslogin($value){
			$this->deslogin = $value; 
		}
		//Final Get & Set deslogin
		//Inicio Get & Set dessenha
		public function getDessenha(){
			return $this->dessenha;
		}
		public function setDessenha($value){
			$this->dessenha = $value; 
		}
		//Final Get & Set dessenha
		//Inicio Get & Set dtcadastro
		public function getDtcadastro(){
			return $this->dtcadastro;
		}
		public function setDtcadastro($value){
			$this->dtcadastro = $value; 
		}
		//Final Get & Set dtcadastro

		public function loadByid($id){
			$sql = new Sql();
			$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario=:ID", array(":ID"=>$id));
			if (count($results)>0) {
				$row = $results[0];
				$this->setIdusuario($row["idusuario"]);
				$this->setDeslogin($row["deslogin"]);
				$this->setDessenha($row["dessenha"]);
				$this->setDtcadastro(new DateTime($row["dtcadastro"]));
			}
		}

		public function __toString(){
			return json_encode(array(
				"idusuario"=>$this->getIdusuario(),
				"deslogin"=>$this->getDeslogin(),
				"dessenha"=>$this->getDessenha(),
				"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")));
		}
	}

?>