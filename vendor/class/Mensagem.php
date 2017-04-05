<?php

class Mensagem
{

	private $table = "tb_mensagens";
	
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

}