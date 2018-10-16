<?php 

class Categorias extends model {

	public function getLista(){
	
		$array = array();
		
		$sql = $this->db->query("SELECT * FROM  categorias ORDER BY nome ASC");

		if($sql->rowCount() > 0){
			$array = $sql->fetchAll();
		}
		return $array;
		
	}
}


?>