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

class Hours_model extends CI_Model {
  // declare private variable
  private $_ID;
  private $_Employee;
  private $_Date;
  private $_Typedate;
  private $_Hour1;
  private $_Hour2;
  private $_Hour3;
  private $_Hour4;
  private $_Hour5;
  private $_Hour6;
  private $_Balance;
  
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
				if ($this->db->update("hours", $dados)) {
					return true;
				} else {
					return false;
				}
			} else {
				if ($this->db->insert("hours", $dados)) {
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
	public function get($id = null, $employee = null, $date = null){
		
		if ($id) {
			$this->db->where('hours.id', $id);
		}
		
		if ($employee){
			$this->db->where('hours.employeefk', $employee);
		}

		if ($date){
			$this->db->where('hours.date', $date);
		}
		
		$this->db->select('hours.id, employees.name, hours.date, hours.typedatefk, hours.hour1, hours.hour2, hours.hour3, hours.hour4, hours.hour5, hours.hour6, hours.balance'); 
		$this->db->from('hours');
		$this->db->from('employees');
		$this->db->where('employees.id = hours.employeefk');
		$this->db->where('employees.status = 1');
		$this->db->order_by("hours.id", 'desc');
		return $this->db->get();
	}

	public function getPersonalStatment($id, $mes){
		
		if (($id) && ($mes)) {
       		$this->db->select('hours.id, employees.name, hours.date, hours.typedatefk, hours.hour1, hours.hour2, hours.hour3, hours.hour4, hours.hour5, hours.hour6, hours.balance'); 
			$this->db->from('hours');
			$this->db->from('employees');
			$this->db->where('employees.id = hours.employeefk');
			$this->db->where('employees.status = 1');
			$this->db->where('employees.id', $id);
			$this->db->where('DATE_FORMAT(hours.date, "%Y-%m") = ', $mes);
			return $this->db->get();
		} else {
			return null;
		}
	}	

	public function getHoursExtract(){
		$query = 'SELECT
					employees.name,
					TIME_FORMAT((SELECT
								SUM(TIMEDIFF(ADDTIME(ADDTIME( TIME_FORMAT(TIMEDIFF(hour2,hour1),"%T") ,
									TIME_FORMAT(TIMEDIFF(hour4,hour3), "%T")),
									TIME_FORMAT(TIMEDIFF(hour6,hour5),"%T")),typedates.time))
								FROM
									hours h,
									typedates
								WHERE
									h.id = h.id AND
									h.typedatefk = typedates.id AND
									h.employeefk = employees.id AND
									PERIOD_ADD(DATE_FORMAT(SYSDATE(), "%Y%m"), -6) = DATE_FORMAT(h.date, "%Y%m")), "%T")  AS MES_0,  
					TIME_FORMAT((SELECT
								SUM(TIMEDIFF(ADDTIME(ADDTIME( TIME_FORMAT(TIMEDIFF(hour2,hour1),"%T") ,
									TIME_FORMAT(TIMEDIFF(hour4,hour3), "%T")),
									TIME_FORMAT(TIMEDIFF(hour6,hour5),"%T")),typedates.time))
								FROM
									hours h,
									typedates
								WHERE
									h.id = h.id AND
									h.typedatefk = typedates.id AND
									h.employeefk = employees.id AND
									PERIOD_ADD(DATE_FORMAT(SYSDATE(), "%Y%m"), -5) = DATE_FORMAT(h.date, "%Y%m")), "%T")  AS MES_1,
					TIME_FORMAT((SELECT
								SUM(TIMEDIFF(ADDTIME(ADDTIME( TIME_FORMAT(TIMEDIFF(hour2,hour1),"%T") ,
									TIME_FORMAT(TIMEDIFF(hour4,hour3), "%T")),
									TIME_FORMAT(TIMEDIFF(hour6,hour5),"%T")),typedates.time))
								FROM
									hours h,
									typedates
								WHERE
									h.id = h.id AND
									h.typedatefk = typedates.id AND
									h.employeefk = employees.id AND
									PERIOD_ADD(DATE_FORMAT(SYSDATE(), "%Y%m"), -4) = DATE_FORMAT(h.date, "%Y%m")), "%T")  AS MES_2,
					TIME_FORMAT((SELECT
								SUM(TIMEDIFF(ADDTIME(ADDTIME( TIME_FORMAT(TIMEDIFF(hour2,hour1),"%T") ,
									TIME_FORMAT(TIMEDIFF(hour4,hour3), "%T")),
									TIME_FORMAT(TIMEDIFF(hour6,hour5),"%T")),typedates.time))
								FROM
									hours h,
									typedates
								WHERE
									h.id = h.id AND
									h.typedatefk = typedates.id AND
									h.employeefk = employees.id AND
									PERIOD_ADD(DATE_FORMAT(SYSDATE(), "%Y%m"), -3) = DATE_FORMAT(h.date, "%Y%m")), "%T")  AS MES_3,
					TIME_FORMAT((SELECT
								SUM(TIMEDIFF(ADDTIME(ADDTIME( TIME_FORMAT(TIMEDIFF(hour2,hour1),"%T") ,
									TIME_FORMAT(TIMEDIFF(hour4,hour3), "%T")),
									TIME_FORMAT(TIMEDIFF(hour6,hour5),"%T")),typedates.time))
								FROM
									hours h,
									typedates
								WHERE
									h.id = h.id AND
									h.typedatefk = typedates.id AND
									h.employeefk = employees.id AND
									PERIOD_ADD(DATE_FORMAT(SYSDATE(), "%Y%m"), -2) = DATE_FORMAT(h.date, "%Y%m")), "%T")  AS MES_4,
					TIME_FORMAT((SELECT
								SUM(TIMEDIFF(ADDTIME(ADDTIME( TIME_FORMAT(TIMEDIFF(hour2,hour1),"%T") ,
									TIME_FORMAT(TIMEDIFF(hour4,hour3), "%T")),
									TIME_FORMAT(TIMEDIFF(hour6,hour5),"%T")),typedates.time))
								FROM
									hours h,
									typedates
								WHERE
									h.id = h.id AND
									h.typedatefk = typedates.id AND
									h.employeefk = employees.id AND
									PERIOD_ADD(DATE_FORMAT(SYSDATE(), "%Y%m"), -1) = DATE_FORMAT(h.date, "%Y%m")), "%T")  AS MES_5,  
					TIME_FORMAT((SELECT
									SUM(TIMEDIFF(ADDTIME(ADDTIME( TIME_FORMAT(TIMEDIFF(hour2,hour1),"%T") ,
									TIME_FORMAT(TIMEDIFF(hour4,hour3), "%T")),
									TIME_FORMAT(TIMEDIFF(hour6,hour5),"%T")),typedates.time))
					FROM
						hours h,
						typedates
					WHERE
						h.id = h.id AND
						h.typedatefk = typedates.id AND
						h.employeefk = employees.id AND
						DATE_FORMAT(h.date, "%m-%Y") = DATE_FORMAT(SYSDATE(),"%m-%Y")), "%T") AS MES_ATUAL,
  					TIME_FORMAT(SUM(balance), "%T") AS SALDO
				FROM 
					hours,
					employees
				WHERE
					hours.employeefk = employees.id
				GROUP BY
					hours.employeefk';

		
		return $this->db->query($query);
	}
	
	public function checktime($aux) {
		$aux=explode(':',$aux);
		echo "Permaneceu ".$aux[0]." horas e ".$aux[1]." minutos ".$aux[2]." segundos";
	}

	public function getEdit($id = null){
		
		if ($id) {
			$this->db->where('hours.id', $id);
		}
		$this->db->order_by("hours.id", 'desc');
		return $this->db->get('hours');
	}


	public function getEmployees(){
		return $this->db->get('employees');
	}

	public function getTypeDates($id = null){

		if ($id) {
			$this->db->where('typedates.id', $id);
		}
		return $this->db->get('typedates');
	}


	public function getEmployee($id){
		if ($id){
			$this->db->select('employees.name as employee, roles.name as role');
			$this->db->from('employees');
			$this->db->from('roles');
			$this->db->where('employees.rolefk = roles.id');
			$this->db->where('employees.id', $id);
			return $this->db->get();
		} else {
			return null;
		}
	}

	/**
	 * Deleta um registro.
	 * @param $id do registro a ser deletado
	 * @return boolean;
	 */
	public function delete($id = null){
		if ($id) {
			return $this->db->where('id', $id)->delete('hours');
		}
	}

}
?>
