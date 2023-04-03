<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administradores extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Administrador');
  }

  public function index()
  {
    $this->load->view('templates/header');
    $this->load->view('admin/index');
    $this->load->view('templates/footer');
  }

  public function home()
  {
    $this->load->view('admin/pages/home');
  }

  //cambiar esta function
  public function cargarEmpresas()
  {
    $this->load->view('admin/pages/empresas');
  }
}
