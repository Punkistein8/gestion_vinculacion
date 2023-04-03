<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Empresa extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function getEmpresas()
  {
    $SQL = "SELECT * FROM empresa";
    $response = $this->db->query($SQL);
    if ($response) {
      return $response->result();
    } else {
      return false;
    }
  }

  public function getEmpresasDesdeDocentes()
  {
    $SQL = "SELECT empresa.*, archivo_vinculacion.nombre_arv, archivo_vinculacion.documento_arv, archivo_vinculacion.fk_id_est FROM empresa INNER JOIN archivo_vinculacion";
    $response = $this->db->query($SQL);
    if ($response) {
      return $response->result();
    } else {
      return false;
    }
  }

  public function getEmpresa($id_emp)
  {
    $SQL = "SELECT * FROM empresa WHERE id_emp = $id_emp";
    $response = $this->db->query($SQL);
    if ($response) {
      return $response->result();
    } else {
      return false;
    }
  }

  public function insertEmpresa($data)
  {
    if ($this->db->insert('empresa', $data)) {
      return true;
    } else {
      return false;
    }
  }

  public function updateEmpresa($id_emp, $data)
  {
    $this->db->where('id_emp', $id_emp);
    if ($this->db->update('empresa', $data)) {
      return true;
    } else {
      return false;
    }
  }

  public function deleteEmpresa($id_emp)
  {
    $SQL = "DELETE FROM empresa WHERE id_emp = $id_emp";
    $response = $this->db->query($SQL);
    if ($response) {
      return true;
    } else {
      return false;
    }
  }
}
