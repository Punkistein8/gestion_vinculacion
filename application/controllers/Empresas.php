<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Empresas extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Empresa');
    $this->load->model('Estudiante');
    $this->load->model('Archivo_Vinculacion');
  }

  public function index()
  {
    $data['listadoEmpresas'] = $this->Empresa->getEmpresas();
    $this->load->view('admin/pages/empresas', $data);
  }

  public function empresasDesdeDocentes()
  {
    $data['listadoEmpresas'] = $this->Empresa->getEmpresas();
    $data['listadoEstudiantes'] = $this->Estudiante->getEstudiantesUsuarios();
    $data['listadoArchivos'] = $this->Archivo_Vinculacion->getArchivosVinculacion();
    $this->load->view('docentes/pages/empresas', $data);
  }

  public function getEmpresa($id_emp)
  {
    if ($this->Empresa->getEmpresa($id_emp)) {
      $response = array(
        'status' => 'success',
        'empresa' => $this->Empresa->getEmpresa($id_emp),
      );
    } else {
      $response = array(
        'status' => 'error',
        'message' => 'Error al obtener la empresa.',
      );
    }
    echo json_encode($response);
  }

  public function insertEmpresa()
  {
    $data = array(
      'nombre_emp' => $this->input->post('nombre_emp'),
      'ruc_emp' => $this->input->post('ruc_emp'),
      'descripcion_emp' => $this->input->post('descripcion_emp'),
    );
    if ($this->Empresa->insertEmpresa($data)) {
      $response = array(
        'status' => 'success',
        'message' => 'Empresa, ' . $data['nombre_emp'] . ' insertada correctamente.',
      );
    } else {
      $response = array(
        'status' => 'error',
        'message' => 'Error al insertar la empresa, ' . $data['nombre_emp'] . '.',
      );
    }
    echo json_encode($response);
  }

  public function updateEmpresa()
  {
    $id_emp = $this->input->post('id_emp');
    $data = array(
      'nombre_emp' => $this->input->post('nombre_emp'),
      'ruc_emp' => $this->input->post('ruc_emp'),
      'descripcion_emp' => $this->input->post('descripcion_emp'),
    );
    if ($this->Empresa->updateEmpresa($id_emp, $data)) {
      $response = array(
        'status' => 'success',
        'message' => 'Empresa, ' . $data['nombre_emp'] . ' actualizada correctamente.',
      );
    } else {
      $response = array(
        'status' => 'error',
        'message' => 'Error al actualizar la empresa, ' . $data['nombre_emp'] . '.',
      );
    }
    echo json_encode($response);
  }

  public function deleteEmpresa($id_emp)
  {
    if ($this->Empresa->deleteEmpresa($id_emp)) {
      $response = array(
        'status' => 'success',
        'message' => 'Empresa eliminada correctamente.',
      );
    } else {
      $response = array(
        'status' => 'error',
        'message' => 'Error al eliminar la empresa.',
      );
    }
    echo json_encode($response);
  }
}
