<?php 
class connection{
	private $con;
	public function __construct(){
		$this->con = new mysqli("localhost","root","","grupo");

	}
	public function get_conection(){
		return $this->con;
	}
}


 ?>
