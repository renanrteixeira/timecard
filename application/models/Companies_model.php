<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of companies Model 
 *
 * @author Renan Teixeira
 *
 * @email 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Companies_model extends CI_Model {
  // declare private variable
  private $_companyID;
  private $_name;
  
  public function setRoleID($companyID) {
    $this->_companyID = $companyID;
	}  
	
  public function setName($name) {
    $this->_name = $name;
	}
	
	/**
	 * Grava os dados na tabela.
	 * @param $dados. Array que contém os campos a serem inseridos
	 * @param Se for passado o $id via parâmetro, então atualizo o registro em vez de inseri-lo.
	 * @return boolean
	 */
	public function save($dados = null, $id = null) {
		
		if ($dados) {
			if ($id) {
				$this->db->where('id', $id);
				if ($this->db->update("companies", $dados)) {
					return true;
				} else {
					return false;
				}
			} else {
				if ($this->db->insert("companies", $dados)) {
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
		$this->db->order_by("id", 'desc');
		return $this->db->get('companies');
	}

	public function count(){
		return $this->db->get('companies');
	}

	/**
	 * Deleta um registro.
	 * @param $id do registro a ser deletado
	 * @return boolean;
	 */
	public function delete($id = null){
		if ($id) {
			return $this->db->where('id', $id)->delete('companies');
		}
	}

}
?>
