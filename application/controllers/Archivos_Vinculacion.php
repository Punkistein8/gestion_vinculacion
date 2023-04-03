<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Archivos_Vinculacion extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Archivo_Vinculacion');
  }

  public function getArchivosVinculacion()
  {
    $response = $this->Archivo_Vinculacion->getArchivosVinculacion();
    if ($response) {
      echo json_encode($response);
    } else {
      echo json_encode(false);
    }
  }

  public function getArchivosVinculacionPorIdEmpresa($id_emp)
  {
    if ($this->Archivo_Vinculacion->getArchivosVinculacionPorIdEmpresa($id_emp)) {
      $response = array(
        'status' => 'success',
        'data' => $this->Archivo_Vinculacion->getArchivosVinculacionPorIdEmpresa($id_emp)
      );
    } else {
      $response = array(
        'status' => 'error',
        'message' => 'Error al obtener los archivos de vinculación',
      );
    }
    echo json_encode($response);
  }

  public function getArchivosVinculacionPorIdEstudiante($id_est)
  {
    if ($this->Archivo_Vinculacion->getArchivosVinculacionPorIdEstudiante($id_est)) {
      $response = array(
        'status' => 'success',
        'data' => $this->Archivo_Vinculacion->getArchivosVinculacionPorIdEstudiante($id_est)
      );
    } else {
      $response = array(
        'status' => 'error',
        'message' => 'Error al obtener los archivos de vinculación de este estudiante',
      );
    }
    echo json_encode($response);
  }

  public function insertArchivoVinculacionDocente()
  {
    $data = array(
      'fk_id_doc' => $this->input->post('fk_id_doc'),
      'fk_id_emp' => $this->input->post('fk_id_emp'),
      'nombre_arv' => $this->input->post('nombre_arv'),

    );

    $this->load->library("upload");
    $new_name = "archivo_" . time() . "_" . rand(1, 5000);
    $config['file_name'] = $new_name;
    $config['upload_path'] = FCPATH . 'assets/archivos_vinculacion/';
    $config['allowed_types'] = 'pdf';
    $config['max_size']  = 5 * 1024;
    $this->upload->initialize($config);
    if ($this->upload->do_upload("documento_arv")) {
      $dataSubida = $this->upload->data();
      $data["documento_arv"] = $dataSubida['file_name'];
    }

    if ($this->Archivo_Vinculacion->insertArchivoVinculacion($data)) {
      $response = array(
        'status' => 'success',
        'message' => 'El archivo se ha guardado correctamente',
      );
    } else {
      $response = array(
        'status' => 'error',
        'message' => 'Error al registrar el archivo de vinculación',
      );
    }
    echo json_encode($response);
  }

  public function asignarEstudianteEmpresa()
  {
    $fk_id_est = $this->input->post('fk_id_est');
    $id_arv = $this->input->post('id_arv');
    if ($this->Archivo_Vinculacion->asignarEstudianteEmpresa($fk_id_est, $id_arv)) {
      $response = array(
        'status' => 'success',
        'message' => 'El estudiante se ha asignado correctamente',
      );
    } else {
      $response = array(
        'status' => 'error',
        'message' => 'Error al asignar el estudiante',
      );
    }
    echo json_encode($response);
  }

  public function borrarArchivoVinculacionDocente($id_arv)
  {
    if ($this->Archivo_Vinculacion->deleteArchivoVinculacion($id_arv)) {
      $response = array(
        'status' => 'success',
        'message' => 'El archivo se ha eliminado correctamente'
      );
    } else {
      $response = array(
        'status' => 'error',
        'message' => 'No se pudo eliminar el archivo'
      );
    }
    echo json_encode($response);
  }

  public function updateArchivoVinculacionDocente()
  {
    $id_arv = $this->input->post('id_arv');
    $data = array(
      'fk_id_doc' => $this->input->post('fk_id_doc'),
      'fk_id_emp' => $this->input->post('fk_id_emp'),
      'nombre_arv' => $this->input->post('nombre_arv'),
    );

    $this->load->library("upload");
    $new_name = "archivo_" . time() . "_" . rand(1, 5000);
    $config['file_name'] = $new_name;
    $config['upload_path'] = FCPATH . 'assets/archivos_vinculacion/';
    $config['allowed_types'] = 'pdf';
    $config['max_size']  = 5 * 1024;
    $this->upload->initialize($config);
    if ($this->upload->do_upload("documento_arv")) {
      $dataSubida = $this->upload->data();
      $data["documento_arv"] = $dataSubida['file_name'];
    }

    if ($this->Archivo_Vinculacion->updateArchivoVinculacionDocente($id_arv, $data)) {
      $response = array(
        'status' => 'success',
        'message' => 'El archivo se ha actualizado correctamente',
      );
    } else {
      $response = array(
        'status' => 'error',
        'message' => 'Error al actualizar el archivo de vinculación',
      );
    }
    echo json_encode($response);
  }
}
