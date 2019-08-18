<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_cadastros extends CI_Model {
	
	/**
	 * Grava os dados na tabela.
	 * @param $dados. Array que contém os campos a serem inseridos
	 * @param Se for passado o $id via parâmetro, então atualizo o registro em vez de inseri-lo.
	 * @return boolean
	 */
	public function store($dados = null, $id = null) {
		
		if ($dados) {
			if ($id) {
				$this->db->where('id', $id);
				if ($this->db->update("cadastros", $dados)) {
					return true;
				} else {
					return false;
				}
			} else {
				if ($this->db->insert("cadastros", $dados)) {
					return true;
				} else {
					return false;
				}
			}
		}
		
	}
	/**
	 * Recupera o registro do banco de dados
	 * @param $id - Se indicado, retorna somente um registro, caso contário, todos os registros.
	 * @return objeto da banco de dados da tabela cadastros
	 */
	public function get($id = null){
		
		if ($id) {
			$this->db->where('id', $id);
		}

		$this->db->select('*');    
		$this->db->from('cadastros');
		$this->db->join('cidade', 'cadastros.id_cidade = cidade.id_cidade');
		$this->db->join('estado', 'cadastros.id_estado = estado.id_estado');
		
		$this->db->order_by("id", 'desc');
		return $this->db->get();
	}
	/**
	 * Deleta um registro.
	 * @param $id do registro a ser deletado
	 * @return boolean;
	 */
	public function delete($id = null){
		if ($id) {
			return $this->db->where('id', $id)->delete('cadastros');
		}
	}

	public function verificaEmail($email='') {
		$this->db->where("email", $email);
		$consulta = $this->db->get("cadastros");
		return $consulta->num_rows();
	}

	public function verificaCelular($celular='') {
		$this->db->where("celular", $celular);
		$consulta = $this->db->get("cadastros");
		return $consulta->num_rows();
	}

	
}
