<?php

class Galeria
{

	private $table = "tb_galeria";
	private $id;
	private $foto;
	private $descricao;

	public function getId()
	{
		return $this->id;
	}//getId
	public function getFoto()
	{
		return $this->foto;
	}//getFoto
	public function getDescricao()
	{
		return $this->descricao;
	}//getDescricao

	public function setId($id)
	{
		$this->id = $id;
	}//setId
	public function setFoto($foto)
	{
		$this->foto = $foto;
	}//setFoto
	public function setDescricao($descricao)
	{
		$this->descricao = $descricao;
	}//setDescricao

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
		$this->setId($id);
		return $sql->select($query, $data);
	}//listById

	public function delete($id)
	{
		$sql = new Sql();
		$query = "DELETE FROM $this->table WHERE id=:id";
		$data = array(':id'=>$id);
		return $sql->select($query, $data);
	}//delete

	public function insert()
	{
		$sql = new Sql();
		$query = "INSERT INTO $this->table (descricao, foto) VALUES (:descricao, :foto)";
		$data = array(':descricao'=>$this->getDescricao(),':foto'=>$this->getFoto());
		$sql->select($query, $data);
	}//insert

	public function update($descricao, $foto)
	{
		$this->setDescricao($descricao);
		$this->setFoto($foto);

		$sql = new Sql();
		$query = "UPDATE $this->table SET foto=:foto, descricao=:descricao WHERE id=:id";
		$data = array(
			':descricao'=>$this->getDescricao(),
			':foto'=>$this->getFoto(),
			':id'=>$this->getId()
		);
		$result = $sql->query($query, $data);
		if (count($result) > 0) {
			echo "<br>Editado com sucesso!<br>";
		}else {
			throw new Exception("Falha ao editar!");
		}//if
	}//update

}