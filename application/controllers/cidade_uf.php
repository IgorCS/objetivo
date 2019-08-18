<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cidade_uf extends CI_Controller {

	
	public function index() {	
		// $this->load->model("estado_cidade");
		
		// $returnUf = $this->estadoCidade->retornaEstado();
		
		// $option = "<option value=''></option>";
		// foreach($returnUf -> result() as $linha) {
		// 	$option .= "<option value='$linha->sgl_estado' selected='selected'>$linha->sgl_estado</option>";			
		// }
		
		// $variaveis['selecionaEstado'] = $option;
		
		// $this->load->view('welcome_message', $variaveis);
	}
	public function buscaCidadeEstado(){
		
		$this->load->model("estado_cidade");
		
		// $cidades = $this->estadoCidade->retornaCidadeEstado();
		
		// $option = "<option value=''>Selecione a Cidade</option>";
		// foreach($cidades -> result() as $linha) {
		// 	$option .= "<option value='$linha->id_cidade' selected='selected'>$linha->nom_cidade</option>";			
		// }
		
		// echo $option;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */