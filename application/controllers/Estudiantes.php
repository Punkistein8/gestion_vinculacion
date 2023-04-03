<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Estudiantes extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Estudiante');
    $this->load->model('Usuario');
    $this->load->model('Archivo_Vinculacion');
  }

  public function index()
  {
    $data['listadoEstudiantes'] = $this->Estudiante->getEstudiantesUsuarios();
    $this->load->view('admin/pages/estudiantes', $data);
  }

  public function inicio()
  {
    $this->load->view('templates/header');
    $this->load->view('estudiantes/index');
    $this->load->view('templates/footer');
  }

  public function home()
  {
    $this->load->view('estudiantes/pages/home');
  }

  public function verificarVinculacion($id_est)
  {
    $data['listadoArchivosVinculacion'] = $this->Archivo_Vinculacion->getArchivosVinculacionPorIdEstudiante($id_est);
    $this->load->view('estudiantes/pages/verificar_vinculacion', $data);
  }

  public function insertEstudiante()
  {
    $dataUsuario = array(
      'nombres_usu' => $this->input->post('nombres_usu'),
      'apellidos_usu' => $this->input->post('apellidos_usu'),
      'email_usu' => $this->input->post('email_usu'),
      'pass_usu' => $this->input->post('pass_usu'),
      'tipo_usu' => 'ESTUDIANTE',
    );

    // Proceso de subida de fotografía
    $this->load->library("upload");
    $new_name = "docente_" . time() . "_" . rand(1, 5000);
    $config['file_name'] = $new_name;
    $config['upload_path'] = FCPATH . 'assets/fotos_usuarios/estudiantes/';
    $config['allowed_types'] = 'png|jpeg|jpg';
    $config['max_size']  = 2 * 1024;
    $this->upload->initialize($config);
    if ($this->upload->do_upload("foto_usu")) {
      $dataSubida = $this->upload->data();
      $dataUsuario["foto_usu"] = $dataSubida['file_name'];
    }
    // FIN Proceso de subida de fotografía

    $dataEstudiante = array(
      'cedula_est' => $this->input->post('cedula_est'),
      'carrera_est' => $this->input->post('carrera_est'),
    );

    //primero insertar en la tabla usuario
    if ($this->Usuario->insertUsuario($dataUsuario)) {
      //obtener el id del usuario insertado
      $fk_id_usu = $this->db->insert_id();
      //insertar en la tabla estudiante
      $dataEstudiante['fk_id_usu'] = $fk_id_usu;
      if ($this->Estudiante->insertEstudiante($dataEstudiante)) {
        $response = array(
          'status' => 'success',
          'message' => 'Estudiante, ' . $dataUsuario['nombres_usu'] . ' ' . $dataUsuario['apellidos_usu'] . ' insertado correctamente.',
        );
      } else {
        $response = array(
          'status' => 'error',
          'message' => 'Error al insertar el estudiante, ' . $dataUsuario['nombres_usu'] . ' ' . $dataUsuario['apellidos_usu'] . '.',
        );
      }
    } else {
      $response = array(
        'status' => 'error',
        'message' => 'Error al insertar el estudiante, ' . $dataUsuario['nombres_usu'] . ' ' . $dataUsuario['apellidos_usu'] . '.',
      );
    }
    echo json_encode($response);
  }

  public function getEstudiantes()
  {
    if ($this->Estudiante->getEstudiantes()) {
      $response = array(
        'status' => 'success',
        'estudiantes' => $this->Estudiante->getEstudiantes(),
      );
    } else {
      $response = array(
        'status' => 'error',
        'message' => 'Error al obtener los estudiantes.',
      );
    }
    echo json_encode($response);
  }

  public function getEstudiante($id_est)
  {
    if ($this->Estudiante->getEstudiante($id_est)) {
      $response = array(
        'status' => 'success',
        'estudiante' => $this->Estudiante->getEstudiante($id_est)
      );
    } else {
      $response = array(
        'status' => 'error',
        'message' => 'No se pudo obtener el estudiante.'
      );
    }
    echo json_encode($response);
  }

  public function getEstudiantesUsuariosId($id_est)
  {
    if ($this->Estudiante->getEstudiantesUsuariosId($id_est)) {
      $response = array(
        'status' => 'success',
        'estudiante' => $this->Estudiante->getEstudiantesUsuariosId($id_est),
      );
    } else {
      $response = array(
        'status' => 'error',
        'message' => 'Error al obtener el estudiante.',
      );
    }
    echo json_encode($response);
  }

  public function getUsuariosEstudiantesId($id_usu)
  {
    if ($this->Estudiante->getUsuariosEstudiantesId($id_usu)) {
      $response = array(
        'status' => 'success',
        'estudiante' => $this->Estudiante->getUsuariosEstudiantesId($id_usu),
      );
    } else {
      $response = array(
        'status' => 'error',
        'message' => 'Error al obtener el estudiante.',
      );
    }
    echo json_encode($response);
  }


  public function updateEstudiante()
  {
    $id_est = $this->input->post('id_est');
    $dataUsuario = array(
      'nombres_usu' => $this->input->post('nombres_usu'),
      'apellidos_usu' => $this->input->post('apellidos_usu'),
      'email_usu' => $this->input->post('email_usu'),
      'pass_usu' => $this->input->post('pass_usu'),
      'tipo_usu' => 'ESTUDIANTE',
    );

    // Proceso de subida de fotografía
    $this->load->library("upload");
    $new_name = "docente_" . time() . "_" . rand(1, 5000);
    $config['file_name'] = $new_name;
    $config['upload_path'] = FCPATH . 'assets/fotos_usuarios/estudiantes/';
    $config['allowed_types'] = 'png|jpeg|jpg';
    $config['max_size']  = 2 * 1024;
    $this->upload->initialize($config);
    if ($this->upload->do_upload("foto_usu")) {
      $dataSubida = $this->upload->data();
      $dataUsuario["foto_usu"] = $dataSubida['file_name'];
    }
    // FIN Proceso de subida de fotografía

    $dataEstudiante = array(
      'cedula_est' => $this->input->post('cedula_est'),
      'carrera_est' => $this->input->post('carrera_est'),
    );

    $estudiante = $this->Estudiante->getEstudiante($id_est);
    $id_usu = $estudiante->fk_id_usu;

    if ($this->Usuario->updateUsuario($id_usu, $dataUsuario)) {
      if ($this->Estudiante->updateEstudiante($id_est, $dataEstudiante)) {
        $response = array(
          'status' => 'success',
          'message' => 'Estudiante, ' . $dataUsuario['nombres_usu'] . ' ' . $dataUsuario['apellidos_usu'] . ' actualizado correctamente.',
        );
      } else {
        $response = array(
          'status' => 'error',
          'message' => 'Error al actualizar el estudiante',
        );
      }
    } else {
      $response = array(
        'status' => 'error',
        'message' => 'Error al actualizar el usuario',
      );
    }
    echo json_encode($response);
  }

  public function deleteEstudiante($id_est)
  {
    $estudiante = $this->Estudiante->getEstudiante($id_est);
    $id_usu = $estudiante->fk_id_usu;
    if ($this->Estudiante->deleteEstudiante($id_est)) {
      if ($this->Usuario->deleteUsuario($id_usu)) {
        $response = array(
          'status' => 'success',
          'message' => 'Docente #' . $id_est . ', Usuario #' . $id_usu . 'eliminado correctamente.',
        );
      } else {
        $response = array(
          'status' => 'error',
          'message' => 'Error al eliminar el usuario.',
        );
      }
    } else {
      $response = array(
        'status' => 'error',
        'message' => 'Error al eliminar el estudiante.',
      );
    }
    echo json_encode($response);
  }
}
