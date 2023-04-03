<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuario extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function getUsuarios()
  {
    $SQL = "SELECT * FROM usuario";
    $response = $this->db->query($SQL);
    if ($response) {
      return $response->result();
    } else {
      return false;
    }
  }

  public function getUsuario($id_usu)
  {
    $SQL = "SELECT * FROM usuario WHERE id_usu = $id_usu";
    $response = $this->db->query($SQL);
    if ($response) {
      return $response->result();
    } else {
      return false;
    }
  }

  public function insertUsuario($data)
  {
    if ($this->db->insert('usuario', $data)) {
      return true;
    } else {
      return false;
    }
  }

  public function updateUsuario($id_usu, $data)
  {
    $this->db->where('id_usu', $id_usu);
    if ($this->db->update('usuario', $data)) {
      return true;
    } else {
      return false;
    }
  }

  public function deleteUsuario($id_usu)
  {
    $SQL = "DELETE FROM usuario WHERE id_usu = $id_usu";
    $response = $this->db->query($SQL);
    if ($response) {
      return true;
    } else {
      return false;
    }
  }
}
