<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Docente extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function getDocentes()
  {
    $SQL = "SELECT * FROM docente";
    $response = $this->db->query($SQL);
    if ($response) {
      return $response->result();
    } else {
      return false;
    }
  }

  public function getDocente($id_doc)
  {
    $SQL = "SELECT * FROM docente WHERE id_doc = $id_doc";
    $response = $this->db->query($SQL);
    if ($response) {
      return $response->result();
    } else {
      return false;
    }
  }

  public function getDocentePorIdUsuario($id_usu)
  {
    $SQL = "SELECT * FROM docente WHERE fk_id_usu = $id_usu";
    $response = $this->db->query($SQL);
    if ($response) {
      return $response->result();
    } else {
      return false;
    }
  }

  public function getDocentesUsuarios()
  {
    $SQL = "SELECT docente.id_doc, docente.fk_id_usu, usuario.nombres_usu, usuario.apellidos_usu, docente.cedula_doc, docente.titulo_doc, usuario.email_usu, usuario.foto_usu FROM docente INNER JOIN usuario ON docente.fk_id_usu = usuario.id_usu;";
    $response = $this->db->query($SQL);
    if ($response) {
      return $response->result();
    } else {
      return false;
    }
  }

  public function getDocentesUsuariosId($id_doc)
  {
    $SQL = "SELECT docente.id_doc, docente.fk_id_usu, usuario.nombres_usu, usuario.apellidos_usu, docente.cedula_doc, docente.titulo_doc, usuario.email_usu, usuario.foto_usu FROM docente INNER JOIN usuario ON docente.fk_id_usu = usuario.id_usu WHERE id_doc = $id_doc";
    $response = $this->db->query($SQL);
    if ($response) {
      return $response->result();
    } else {
      return false;
    }
  }

  public function insertDocente($data)
  {
    if ($this->db->insert('docente', $data)) {
      return true;
    } else {
      return false;
    }
  }

  public function updateDocente($id_doc, $data)
  {
    $this->db->where('id_doc', $id_doc);
    if ($this->db->update('docente', $data)) {
      return true;
    } else {
      return false;
    }
  }

  public function deleteDocente($id_doc)
  {
    $SQL = "DELETE FROM docente WHERE id_doc = $id_doc";
    $response = $this->db->query($SQL);
    if ($response) {
      return true;
    } else {
      return false;
    }
  }
}
