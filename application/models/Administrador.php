<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administrador extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
}
