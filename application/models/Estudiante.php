<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Estudiante extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function getEstudiantes()
  {
    if ($this->db->get('estudiante')->num_rows() > 0) {
      return $this->db->get('estudiante')->result();
    } else {
      return false;
    }
  }

  public function getEstudiante($id_est)
  {
    $this->db->where('id_est', $id_est);
    if ($this->db->get('estudiante')->num_rows() > 0) {
      return $this->db->get('estudiante')->row();
    } else {
      return false;
    }
  }

  public function getEstudiantesUsuarios()
  {
    $SQL = "SELECT estudiante.id_est, estudiante.fk_id_usu, usuario.nombres_usu, usuario.apellidos_usu, estudiante.cedula_est, estudiante.carrera_est, usuario.email_usu, usuario.foto_usu FROM estudiante INNER JOIN usuario ON estudiante.fk_id_usu = usuario.id_usu;";
    $response = $this->db->query($SQL);
    if ($response) {
      return $response->result();
    } else {
      return false;
    }
  }

  public function getEstudiantesUsuariosId($id_est)
  {
    $SQL = "SELECT estudiante.id_est, estudiante.fk_id_usu, usuario.nombres_usu, usuario.apellidos_usu, estudiante.cedula_est, estudiante.carrera_est, usuario.email_usu, usuario.foto_usu FROM estudiante INNER JOIN usuario ON estudiante.fk_id_usu = usuario.id_usu WHERE id_est = $id_est";
    $response = $this->db->query($SQL);
    if ($response) {
      return $response->result();
    } else {
      return false;
    }
  }

  public function getUsuariosEstudiantesId($id_usu)
  {
    $SQL = "SELECT estudiante.id_est, estudiante.fk_id_usu, usuario.nombres_usu, usuario.apellidos_usu, estudiante.cedula_est, estudiante.carrera_est, usuario.email_usu, usuario.foto_usu FROM estudiante INNER JOIN usuario ON estudiante.fk_id_usu = usuario.id_usu WHERE id_usu = $id_usu";
    $response = $this->db->query($SQL);
    if ($response) {
      return $response->result();
    } else {
      return false;
    }
  }

  public function insertEstudiante($data)
  {
    if ($this->db->insert('estudiante', $data)) {
      return true;
    } else {
      return false;
    }
  }

  public function updateEstudiante($id_est, $data)
  {
    $this->db->where('id_est', $id_est);
    if ($this->db->update('estudiante', $data)) {
      return true;
    } else {
      return false;
    }
  }

  public function deleteEstudiante($id_est)
  {
    $this->db->where('id_est', $id_est);
    if ($this->db->delete('estudiante')) {
      return true;
    } else {
      return false;
    }
  }
}
