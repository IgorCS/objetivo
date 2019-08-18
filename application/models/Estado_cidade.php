<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estado_cidade extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	public function retornaEstado(){
		$this->db->order_by("id_estado", "asc");
		$consulta = $this->db->get("estado");	
		return $consulta;
	}
	
	public function retornaCidadeEstado() {
		$id_estado = $this->input->post("id_estado");
		$this->db->where("id_estado", $id_estado);
		$this->db->order_by("nom_cidade", "asc");
		$consulta = $this->db->get("cidade");
		return $consulta;
	}
}

