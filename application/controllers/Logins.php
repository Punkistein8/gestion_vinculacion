<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Logins extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Login');
	}

	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('login');
		$this->load->view('templates/footer');
	}

	public function validarLogin()
	{
		$email_usu = $this->input->post('email_usu');
		$pass_usu = $this->input->post('pass_usu');
		$usuarioEncontrado = $this->Login->validarLogin($email_usu, $pass_usu);
		if ($usuarioEncontrado) {
			$this->session->set_userdata('usuario', $usuarioEncontrado);
			$response = array(
				'status' => 'success',
				'message' => 'Bienvenido, ' . $usuarioEncontrado->nombres_usu . ' ' . $usuarioEncontrado->apellidos_usu . ' has iniciado sesión como "' . $usuarioEncontrado->tipo_usu . '".',
				'usuario' => $usuarioEncontrado
			);
		} else {
			$response = array(
				'status' => 'error',
				'message' => 'Usuario o contraseña incorrectos'
			);
		}
		echo json_encode($response);
	}

	public function cerrarSesion()
	{
		$this->session->sess_destroy();
		$response = array(
			'status' => 'success',
			'message' => 'Sesión cerrada'
		);
		echo json_encode($response);
	}
}
