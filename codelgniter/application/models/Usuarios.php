<?php

	class Usuarios extends CI_Model{
	
	// login
		function login($email, $password){

			$tmp = $this->db
				->where('email',$email)
				->where('password', $password)
				->get('usuarios');

			if($tmp->num_rows() == 0){
				return false;
			}else{
				return $tmp->row_array();
			}
		}

	// datos_usuario
	function datos_usuarios($id){
		$datos = $this->db->where('ID', $id)->get('usuarios');

		return $datos->row_array();
	}

	// crea_usuario
	function crea_usuario($email, $password){
	$array = Array('email' => $email, 'password' => $password);

	$this->db->insert('usuarios', $array);
}
	// actualiza_password
	function actualiza_password($id, $pass1, $pass2){

		if ( strlen($pass1)>8 && $pass1==$pass2 ){
			
			$this->db
			->set('password', $pass1)
			->where('ID', $id)
			->update('usuarios');

		return true;
	}else{
		return false;
	}

	}

	// elimina_cliente
	function elimina_cliente($id){
		$this->db->where('ID',$id)->delete('usuarios');
	}
	}


?>