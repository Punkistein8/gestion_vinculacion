<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Docentes extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Docente');
    $this->load->model('Usuario');
  }

  public function index()
  {
    $data['listadoDocentes'] = $this->Docente->getDocentesUsuarios();
    $this->load->view('admin/pages/docentes', $data);
  }

  public function inicio()
  {
    $this->load->view('templates/header');
    $this->load->view('docentes/index');
    $this->load->view('templates/footer');
  }

  public function home()
  {
    $this->load->view('docentes/pages/home');
  }

  public function insertDocente()
  {
    $dataUsuario = array(
      'nombres_usu' => $this->input->post('nombres_usu'),
      'apellidos_usu' => $this->input->post('apellidos_usu'),
      'email_usu' => $this->input->post('email_usu'),
      'pass_usu' => $this->input->post('pass_usu'),
      'tipo_usu' => 'DOCENTE',
    );

    // Proceso de subida de fotografía
    $this->load->library("upload"); //cargamos la libreria upload
    $new_name = "docente_" . time() . "_" . rand(1, 5000); //nombre del archivo
    $config['file_name'] = $new_name; //asignamos el nombre al archivo
    $config['upload_path'] = FCPATH . 'assets/fotos_usuarios/docentes/'; //ruta de la carpeta donde se guardara el archivo, FCPATH es carpeta del proyecto
    $config['allowed_types'] = 'png|jpeg|jpg'; //tipos de archivos permitidos pdf|docx
    $config['max_size']  = 2 * 1024; //tamaño maximo permitido (2mb)
    $this->upload->initialize($config); //inicializamos la configuracion
    if ($this->upload->do_upload("foto_usu")) { //subimos el archivo
      $dataSubida = $this->upload->data(); //
      $dataUsuario["foto_usu"] = $dataSubida['file_name'];
    }
    // FIN Proceso de subida de fotografía

    $dataDocente = array(
      'titulo_doc' => $this->input->post('titulo_doc'),
      'cedula_doc' => $this->input->post('cedula_doc'),
    ); {

      //primero insertar en la tabla usuario
      if ($this->Usuario->insertUsuario($dataUsuario)) {
        //obtener el id del usuario insertado
        $fk_id_usu = $this->db->insert_id();
        //insertar en la tabla docente
        $dataDocente['fk_id_usu'] = $fk_id_usu;
        if ($this->Docente->insertDocente($dataDocente)) {
          $response = array(
            'status' => 'success',
            'message' => 'Docente, ' . $dataUsuario['nombres_usu'] . ' ' . $dataUsuario['apellidos_usu'] . ' insertado correctamente.',
          );
        } else {
          $response = array(
            'status' => 'error',
            'message' => 'Error al insertar docente',
          );
        }
      } else {
        $response = array(
          'status' => 'error',
          'message' => 'Error al insertar usuario',
        );
      }
    }
    echo json_encode($response);
  }

  public function getDocentesUsuariosId($id_doc)
  {
    if ($this->Docente->getDocentesUsuariosId($id_doc)) {
      $response = array(
        'status' => 'success',
        'docente' => $this->Docente->getDocentesUsuariosId($id_doc),
      );
    } else {
      $response = array(
        'status' => 'error',
        'message' => 'Error al obtener docente',
      );
    }
    echo json_encode($response);
  }

  public function getDocentePorIdUsuario($id_usu)
  {
    if ($this->Docente->getDocentePorIdUsuario($id_usu)) {
      $response = array(
        'status' => 'success',
        'docente' => $this->Docente->getDocentePorIdUsuario($id_usu),
      );
    } else {
      $response = array(
        'status' => 'error',
        'message' => 'Error al obtener docente',
      );
    }
    echo json_encode($response);
  }

  public function updateDocente()
  {
    $id_doc = $this->input->post('id_doc');
    $dataUsuario = array(
      'nombres_usu' => $this->input->post('nombres_usu'),
      'apellidos_usu' => $this->input->post('apellidos_usu'),
      'email_usu' => $this->input->post('email_usu'),
      'pass_usu' => $this->input->post('pass_usu'),
      'tipo_usu' => 'DOCENTE',
    );

    // Proceso de subida de fotografía
    $this->load->library("upload"); //cargamos la libreria upload
    $new_name = "docente_" . time() . "_" . rand(1, 5000); //nombre del archivo
    $config['file_name'] = $new_name; //asignamos el nombre al archivo
    $config['upload_path'] = FCPATH . 'assets/fotos_usuarios/docentes/'; //ruta de la carpeta donde se guardara el archivo, FCPATH es carpeta del proyecto
    $config['allowed_types'] = 'png|jpeg|jpg'; //tipos de archivos permitidos pdf|docx
    $config['max_size']  = 2 * 1024; //tamaño maximo permitido (2mb)
    $this->upload->initialize($config); //inicializamos la configuracion
    if ($this->upload->do_upload("foto_usu")) { //subimos el archivo
      $dataSubida = $this->upload->data(); //
      $dataUsuario["foto_usu"] = $dataSubida['file_name'];
    }
    // FIN Proceso de subida de fotografía

    $dataDocente = array(
      'titulo_doc' => $this->input->post('titulo_doc'),
      'cedula_doc' => $this->input->post('cedula_doc'),
    );

    $docente = $this->Docente->getDocente($id_doc);
    $id_usu = $docente[0]->fk_id_usu;

    if ($this->Usuario->updateUsuario($id_usu, $dataUsuario)) {
      if ($this->Docente->updateDocente($id_doc, $dataDocente)) {
        $response = array(
          'status' => 'success',
          'message' => 'Docente, ' . $dataUsuario['nombres_usu'] . ' ' . $dataUsuario['apellidos_usu'] . ' actualizado correctamente.',
        );
      } else {
        $response = array(
          'status' => 'error',
          'message' => 'Error al actualizar docente',
        );
      }
    } else {
      $response = array(
        'status' => 'error',
        'message' => 'Error al actualizar usuario',
      );
    }
    echo json_encode($response);
  }

  public function deleteDocente($id_doc)
  {
    $docente = $this->Docente->getDocente($id_doc);
    $id_usu = $docente->fk_id_usu;

    if ($this->Docente->deleteDocente($id_doc)) {
      if ($this->Usuario->deleteUsuario($id_usu)) {
        $response = array(
          'status' => 'success',
          'message' => 'Docente eliminado correctamente.',
        );
      } else {
        $response = array(
          'status' => 'error',
          'message' => 'Error al eliminar usuario',
        );
      }
    } else {
      $response = array(
        'status' => 'error',
        'message' => 'Error al eliminar docente',
      );
    }
    echo json_encode($response);
  }
}
