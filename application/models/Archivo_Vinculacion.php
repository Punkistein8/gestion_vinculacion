<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Archivo_Vinculacion extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function getArchivosVinculacion()
  {
    $SQL = "SELECT * FROM archivo_vinculacion";
    $response = $this->db->query($SQL);
    if ($response) {
      return $response->result();
    } else {
      return false;
    }
  }

  public function getArchivoVinculacion($id_arv)
  {
    $SQL = "SELECT * FROM archivo_vinculacion WHERE id_arv = $id_arv";
    $response = $this->db->query($SQL);
    if ($response) {
      return $response->result();
    } else {
      return false;
    }
  }

  public function getArchivosVinculacionPorIdEmpresa($id_emp)
  {
    $SQL = "SELECT * FROM archivo_vinculacion WHERE fk_id_emp = $id_emp";
    $response = $this->db->query($SQL);
    if ($response) {
      return $response->result();
    } else {
      return false;
    }
  }

  public function getArchivosVinculacionPorIdEstudiante($id_est)
  {
    $SQL = "SELECT archivo_vinculacion.*, docente.*, empresa.*, estudiante.*, usuario.* FROM `archivo_vinculacion`
    INNER JOIN docente ON archivo_vinculacion.fk_id_doc = docente.id_doc
    INNER JOIN empresa ON archivo_vinculacion.fk_id_emp = empresa.id_emp
    INNER JOIN estudiante ON archivo_vinculacion.fk_id_est = estudiante.id_est
    INNER JOIN usuario ON usuario.id_usu = docente.fk_id_usu
    WHERE archivo_vinculacion.fk_id_est = $id_est";
    $response = $this->db->query($SQL);
    if ($response) {
      return $response->result();
    } else {
      return false;
    }
  }

  public function insertArchivoVinculacion($data)
  {
    if ($this->db->insert('archivo_vinculacion', $data)) {
      return true;
    } else {
      return false;
    }
  }

  public function asignarEstudianteEmpresa($id_est, $id_arv)
  {
    $SQL = "UPDATE archivo_vinculacion SET fk_id_est = $id_est WHERE id_arv = $id_arv";
    $response = $this->db->query($SQL);
    if ($response) {
      return true;
    } else {
      return false;
    }
  }

  public function updateArchivoVinculacionDocente($id_arv, $data)
  {
    $this->db->where('id_arv', $id_arv);
    if ($this->db->update('archivo_vinculacion', $data)) {
      return true;
    } else {
      return false;
    }
  }

  public function deleteArchivoVinculacion($id_arv)
  {
    $this->db->where('id_arv', $id_arv);
    if ($this->db->delete('archivo_vinculacion')) {
      return true;
    } else {
      return false;
    }
  }
}
