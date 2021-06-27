<?php 

class User{

	private $con;

		function __construct($con){
			$this->con = $con;		
	}

	public function loginUser($user,$password){

		$query="SELECT * FROM users WHERE users_name = '". $user ."' AND password='". $password ."' LIMIT 1;";

		$sqlQuery = $this->con->executeQuery($query);


		if (count($sqlQuery)>0) {
		   $_SESSION["user"] = $sqlQuery[0];
			$resultado["success"]="1";
			$resultado["data"]= $sqlQuery;
		}else {
			# No existe
			$resultado["success"]="0";
		}

		return $resultado;

	}

}



