<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{// QUIERE USAR LA BASE DE DATOS!!!
		$this->load->database();
		$this->load->model("Usuarios", "user");
		//$resultado = $this->user>login("luis@peris.com", "boluda");
		//$resultado = $this->user->datos_usuario(13);
		//$resultado = $this->user->crea_usuario("juan@perez.com", "111221212");
		$resultado = $this->user->actualiza_password(7, "123456789", "123456789");
		//$resultado = $this->user->elimina_cliente(12);



		var_dump($resultado);

		
		$this->load->view('welcome_message');
		
		

		# SELECT
		/*$res= $this->db
		->select('email, password')
		->where('email','joan@boluda.com')
		->get('usuarios')
		->result_array();*/

		# INSERTAR 
		/*$nuevo_usuario= Array('email' => 'maria@vidal.com','password' => '123456');
		$this->db->insert('usuarios',$nuevo_usuario);*/

		#UPDATE
		/*$this->db
			->set('password','1111111')
			->where('email','maria@vidal.com')
			->update('usuarios');*/
		# DELETE
			/*$this->db
				->where('email','maria@vidal.com')
				->delete('usuarios');*/

	}
}
