<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro extends CI_Controller {

	/**
	 * Carrega o formulário para novo cadastro
	 * @param nenhum
	 * @return view
	 */
	public function create(){       
		$this->load->model("estado_cidade");		
		$uf = $this->estado_cidade->retornaEstado();
		$option = "<option value=''>Selecione um Estado</option>";
		foreach($uf->result() as $linha) {
			$option .= "<option value=".$linha->id_estado.">".$linha->sgl_estado."</option>";					
		}		
		
		$variaveis['selecionaEstado'] = $option;
		$variaveis['titulo'] = 'Novo Cadastro';
		$this->load->view('v_cadastro', $variaveis);
	}
	

	public function store(){
		$post = $_POST;
		$post['erro'] = array();
		if (isset($post['nome']) && $post['nome'] !== '' && $post['nome'] !== null) {
			$post['data']['nome'] = $post['nome'];
		} else {
			$post['erro']['nome'] = 'O campo nome precisa ser preenchido';
		}

		if (isset($post['email']) && $post['email'] !== '' && $post['email'] !== null) {
			$post['data']['email'] = $post['email'];
		} else {
			$post['erro']['email'] = 'O campo email precisa ser preenchido';
		}

		if (isset($post['celular']) && $post['celular'] !== '' && $post['celular'] !== null) {
			$post['data']['celular'] = $post['celular'];
		} else {
			$post['erro']['celular'] = 'O campo celular precisa ser preenchido';
		}

		$post['data']['data_cadastro'] = date('Y-m-d h:i:s');

		if (isset($post['estado']) && $post['estado'] !== '' && $post['estado'] !== null) {
			$post['data']['id_estado'] = $post['estado'];
		} else {
			$post['erro']['estado'] = 'O campo estado precisa ser preenchido';
		}

		if (isset($post['cidade']) && $post['cidade'] !== '' && $post['cidade'] !== null) {
			$post['data']['id_cidade'] = $post['cidade'];
		} else {
			$post['erro']['cidade'] = 'O campo cidade precisa ser preenchido';
		}

		

		$verifica = '';
		$success = false;
		$mensagem = 'O email ou celular digitado '.$post['email'].' já existe em nossos cadastros!';
		if (count($post['erro']) > 0) {
			if ($this->m_cadastros->verificaEmail($post['email']) <= 0) {
				$mensagem = '';
			}

			if ($this->m_cadastros->verificaCelular($post['celular']) <= 0) {
				$mensagem = '';
			}

			$verifica = array('erro'=>$post['erro'], 'success' => $success, 'mensagem' => $mensagem);
		} else {
			if ($this->m_cadastros->verificaEmail($post['email']) <= 0&&$this->m_cadastros->verificaCelular($post['celular']) <= 0) {			

				/**/
				$id = $this->input->post('id');			
				$dados = array(			
					"nome" => $post['data']['nome'],	
					"email" => $post['data']['email'],			
					"celular" => $post['data']['celular'],
					"id_estado" => $post['data']['id_estado'],
					"id_cidade" => $post['data']['id_cidade'],
					"data_cadastro"=>$post['data']['data_cadastro']	
				);
				$this->m_cadastros->store($dados);
				 
				/**/

				$success = true;
				$mensagem = 'Dados gravados com sucesso!';
			}			
			$verifica = array('erro'=>$post['erro'], 'success' => $success, 'mensagem' => $mensagem);
		}

		echo json_encode($verifica);
	}	
	
	/**
	 * Função que exclui o registro através do id.
	 * @param $id do registro a ser excluído.
	 * @return boolean;
	*/
	public function delete($id = null) {
		if ($this->m_cadastros->delete($id)) {
			$variaveis['mensagem'] = "Registro excluído com sucesso!";
			$this->load->view('v_sucesso', $variaveis);
		}
	}
}
