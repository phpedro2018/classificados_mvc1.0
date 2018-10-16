<?php 
class model{

	protected $db; //protegendo db data base
	public function __construct(){
		global $db;
		$this->db = $db; 

	}
}

?>