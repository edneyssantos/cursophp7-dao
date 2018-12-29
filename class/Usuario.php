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
				$this->setData($results[0]);
			}
		}

		public static function getList(){
			$sql = new Sql();
			return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin;");

		}

		public static function search($login){
			$sql = new Sql();
			return $sql->select("SELECT * FROM tb_usuarios where deslogin LIKE :SEARCH ORDER BY deslogin",array(":SEARCH"=>"%".$login."%"));
		}

		public function login($login, $password){
			$sql = new Sql();
			$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin=:LOGIN AND dessenha=:PASSWORD", array(":LOGIN"=>$login, ":PASSWORD"=>$password));
			if (count($results)>0) {
				$this->setData($results[0]);
			} else {
				throw new Exception("Login e/ou senha inválidos");
			}	
		}

		public function setData($data){
			$this->setIdusuario($data["idusuario"]);
			$this->setDeslogin($data["deslogin"]);
			$this->setDessenha($data["dessenha"]);
			$this->setDtcadastro(new DateTime($data["dtcadastro"]));	
		}

		public function insert(){
			$sql = new Sql();
			$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
				":LOGIN"=>$this->getDeslogin(),
				":PASSWORD"=>$this->getDessenha()
			));
			if (count($results)>0){
				$this->setData($results[0]);
			}
		}

		public function update($login, $password){
			$this->setDeslogin($login);
			$this->setDessenha($password);
			$sql = new Sql();
			$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
					":LOGIN"=>$this->getDeslogin(), 
					":PASSWORD"=>$this->getDessenha(), 
					":ID"=>$this->getIdusuario()));
		}

		public function __construct($login="", $password=""){
			$this->setDeslogin($login);
			$this->setDessenha($password);
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