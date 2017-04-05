<?php

class Usuario
{

	private $table = "tb_usuarios";
	private $id;
	private $nome;
	private $email;
	private $senha;
	private $nivel;
	private $foto;

	public function getId()
	{
		return $this->id;
	}//getId
	public function getNome()
	{
		return $this->nome;
	}//getNome
	public function getEmail()
	{
		return $this->email;
	}//getEmail
	public function getSenha()
	{
		return $this->senha;
	}//getSenha
	public function getNivel()
	{
		return $this->nivel;
	}//getNivel
	public function getFoto()
	{
		return $this->foto;
	}//getFoto

	public function setId($id)
	{
		$this->id = $id;
	}//setId
	public function setNome($nome)
	{
		$this->nome = $nome;
	}//setNome
	public function setEmail($email)
	{
		$this->email = $email;
	}//setEmail
	public function setSenha($senha)
	{
		$this->senha = $senha;
	}//setSenha
	public function setNivel($nivel)
	{
		$this->nivel = $nivel;
	}//setNivel
	public function setFoto($foto)
	{
		$this->foto = $foto;
	}//setFoto

	public function list()
	{
		$sql = new Sql();
		$query = "SELECT * FROM $this->table ORDER BY id";
		return $sql->select($query);
	}//list

	public function listById($id)
	{
		$sql = new Sql();
		$query = "SELECT * FROM $this->table WHERE id=:id";
		$data = array(':id'=>$id);
		return $sql->select($query, $data);
	}//listById

	public function delete($id)
	{
		$sql = new Sql();
		$query = "DELETE FROM $this->table WHERE id=:id";
		$data = array(':id'=>$id);
		return $sql->select($query, $data);
	}//delete

	public function login($email, $senha)
	{
		$sql = new Sql();
		$query = "SELECT * FROM $this->table WHERE email=:email AND senha=:senha";
		$data = array(':email'=>$email,':senha'=>$senha);
		$result = $sql->select($query, $data);
		if (count($result) > 0)
		{
			$this->setData($result[0]);
			$data = array(
				'id'=>$this->getId(),
				'nome'=>$this->getNome(),
				'email'=>$this->getEmail(),
				'senha'=>$this->getSenha(),
				'nivel'=>$this->getNivel(),
				'foto'=>$this->getFoto()
			);
			$_SESSION["logado"] = json_encode($data);
			header("location: index.php");
		}else {
			throw new Exception("Email ou senha invalidos!");
			
		}//count
	}//login

	public function loadById($id)
	{
		$sql = new Sql();
		$query = "SELECT * FROM $this->table WHERE id=:id";
		$data = array(':id'=>$id);
		$result = $sql->select($query, $data);
		if (count($result) > 0) {
			$this->setData($result[0]);
		}//if
	}//loadById

	public function update($nome, $email, $senha, $nivel, $foto)
	{
		$this->setNome($nome);
		$this->setEmail($email);
		$this->setSenha($senha);
		$this->setNivel($nivel);
		$this->setFoto($foto);

		$sql = new Sql();
		$query = "UPDATE $this->table SET nome=:nome, email=:email, senha=:senha, nivel=:nivel, foto=:foto WHERE id=:id";
		$data = array(
			':nome'=>$this->getNome(),
			':email'=>$this->getEmail(),
			':senha'=>$this->getSenha(),
			':nivel'=>$this->getNivel(),
			':foto'=>$this->getFoto(),
			':id'=>$this->getId()
		);
		$result = $sql->query($query, $data);
		if (count($result) > 0) {
			echo "Editado com sucesso!";
		}else {
			throw new Exception("Falha ao editar!");
		}//if
	}//update

	public function insert()
	{
		$sql = new Sql();
		$query = "INSERT INTO $this->table (nome, email, senha, nivel, foto) VALUES (:nome, :email, :senha, :nivel, :foto)";
		$data = array(
			':nome'=>$this->getNome(),
			':email'=>$this->getEmail(),
			':senha'=>$this->getSenha(),
			':nivel'=>$this->getNivel(),
			':foto'=>$this->getFoto()
		);
		$result = $sql->query($query, $data);
		if (count($result) > 0) {
			echo "Registrado com sucesso!";
		}else {
			throw new Exception("Falha ao registrar!");
			
		}//if
	}//insert

	public function setData($data)
	{
		$this->setId($data['id']);
		$this->setNome($data['nome']);
		$this->setEmail($data['email']);
		$this->setSenha($data['senha']);
		$this->setNivel($data['nivel']);
		$this->setFoto($data['foto']);
	}//setData

	public function __toString()
	{
		return json_encode(array(
			'id'=>$this->getId(),
			'nome'=>$this->getNome(),
			'email'=>$this->getEmail(),
			'senha'=>$this->getSenha(),
			'nivel'=>$this->getNivel(),
			'foto'=>$this->getFoto()
		));//return
	}//toString

	public function verificaOn()
	{
		if (!isset($_SESSION["logado"])) {
			header("location: login.php");
		}//if
	}//verificaOn

	public function verificaOff()
	{
		if (isset($_SESSION["logado"])) {
			header("location: index.php");	
		}//if
	}//verificaOff

}