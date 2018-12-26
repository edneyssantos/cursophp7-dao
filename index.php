<?php  

	require_once("config.php");

	$sql = new Sql();

	//$usuarios = $sql->select("SELECT * FROM tb_usuarios");
	//echo json_encode($usuarios);
	//
	//$root = new Usuario();
	//$root->loadbyid(3);
	//echo $root;

	//Carrega uma lista de usuarios
	//$lista = Usuario::getList();

	//echo json_encode($lista);
	//Carregar uma lista de usuarios buscando pelo login
	//$search = Usuario::search("jo");
	//echo json_encode($search);

	//Teste de login
	$usuario = new Usuario();
	$usuario->login("root","123456");
	echo $usuario;


?>