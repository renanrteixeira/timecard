<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Roles Model 
 *
 * @author Renan Teixeira
 *
 * @email 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {
  // declare private variable
  private $_userID;
  private $_name;
  private $_email;
  private $_password;
  private $_admin;
  private $_status;
  
  public function setUserID($userID) {
    $this->_userID = $userID;
	}  
	
  public function setEmail($email) {
    $this->_email = $email;
	}
	
  public function setPassword($password) {
    $this->_password = $password;
  }       

  public function getUserInfo() {
    $this->db->select(array('u.user_id', 'u.name', 'u.email'));
    $this->db->from('users as u');
    $this->db->where('u.user_id', $this->_userID);
    $query = $this->db->get();
    return $query->row_array();
	} 
	
  function login() {
	$this -> db -> select('user_id, name, email, admin');
	$this -> db -> from('users');
	$this -> db -> where('email', $this->_email);
	$this -> db -> where('password', $this->_password);
	$this -> db -> where('status', 1);
	$this -> db -> limit(1);
	$query = $this -> db -> get();
	if($query -> num_rows() == 1) {
		return $query->result();
	} else {
		return false;
	}
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
				$this->db->where('user_id', $id);
				if ($this->db->update("users", $dados)) {
					return true;
				} else {
					return false;
				}
			} else {
				if ($this->db->insert("users", $dados)) {
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
			$this->db->where('user_id', $id);
		}
		$this->db->order_by("user_id", 'desc');
		return $this->db->get('users');
	}

	/**
	 * Recupera o registro do banco de dados
	 * @param $email - retorna somente um registro
	 * @return objeto da banco de dados da tabela cadastros
	 */
	public function getEmail($email){
    	$this->db->where('email', $email);
		$this->db->order_by("user_id", 'desc');
		return $this->db->get('users');
	}	
	
	/**
	 * Deleta um registro.
	 * @param $id do registro a ser deletado
	 * @return boolean;
	 */
	public function delete($id = null){
		if ($id) {
			return $this->db->where('user_id', $id)->delete('users');
		}
	}

}
?>
