<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Employees Model 
 *
 * @author Renan Teixeira
 *
 * @email 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees_model extends CI_Model {
  // declare private variable
  private $_ID;
  private $_name;
  private $_Role;
  private $_Admission;
  private $_Gender;
  private $_Status;

  public function setRoleID($ID) {
    $this->_ID = $ID;
	}  
	
  public function setName($name) {
    $this->_name = $name;
	}

   public function setRole($role) {
		$this->_Role = $role;
	}	

  public function setAdmission($admission) {
		$this->_Admission = $admission;
	}	

  public function sete($gender) {
		$this->_Gender = $gender;
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
				if ($this->db->update("employees", $dados)) {
					return true;
				} else {
					return false;
				}
			} else {
				if ($this->db->insert("employees", $dados)) {
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
			$this->db->where('employees.id', $id);
		}
		$this->db->select('employees.id, employees.name, roles.name as role, employees.admission, employees.gender'); 
		$this->db->from('employees');
		$this->db->from('roles');
		$this->db->where('employees.rolefk = roles.id');
		$this->db->order_by("employees.id", 'desc');
		return $this->db->get();
	}

	public function getEdit($id = null){
		
		if ($id) {
			$this->db->where('employees.id', $id);
		}
		$this->db->order_by("employees.id", 'desc');
		return $this->db->get('employees');
	}


	public function getRoles(){
		return $this->db->get('roles');
	}

	/**
	 * Deleta um registro.
	 * @param $id do registro a ser deletado
	 * @return boolean;
	 */
	public function delete($id = null){
		if ($id) {
			return $this->db->where('id', $id)->delete('employees');
		}
	}

}
?>
