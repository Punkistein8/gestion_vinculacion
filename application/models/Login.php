<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function validarLogin($email_usu, $pass_usu)
  {
    $this->db->where('email_usu', $email_usu);
    $this->db->where('pass_usu', $pass_usu);
    $query = $this->db->get('usuario');
    if ($query->num_rows() > 0) {
      return $query->row();
    } else {
      return false;
    }
  }
}
