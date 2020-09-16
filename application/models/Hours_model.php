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
	public function get($id = null, $employee = null, $datebegin = null, $datefinish = null){
		
		if ($id) {
			$this->db->where('hours.id', $id);
		}
		
		if ($employee){
			$this->db->where('hours.employeefk', $employee);
		}

		if (($datebegin) && ($datefinish)) {
			$this->db->where('hours.date >=', $datebegin);
			$this->db->where('hours.date <=', $datefinish);
		}
		
		$this->db->select('hours.id, employees.name, hours.date, hours.typedatefk, hours.hour1, hours.hour2, hours.hour3, hours.hour4, hours.hour5, hours.hour6, hours.balance'); 
		$this->db->from('hours');
		$this->db->from('employees');
		$this->db->where('employees.id = hours.employeefk');
		$this->db->where('employees.status = 1');
		$this->db->where('hours.type = 0');
		$this->db->order_by("hours.id", 'desc');
		$this->db->limit(500);
		return $this->db->get();
	}

	public function getPayments( $employee = null, $datebegin = null, $datefinish = null){
		
		if ($employee){
			$this->db->where('hours.employeefk', $employee);
		}

		if (($datebegin) && ($datefinish)) {
			$this->db->where('hours.date >=', $datebegin);
			$this->db->where('hours.date <=', $datefinish);
		}

		$this->db->select('hours.id, employees.name, hours.date, hours.hour1, hours.balance'); 
		$this->db->from('hours');
		$this->db->from('employees');
		$this->db->where('employees.id = hours.employeefk');
		$this->db->where('employees.status = 1');
		$this->db->where('hours.type = 1');
		$this->db->order_by("hours.id", 'desc');
		return $this->db->get();
	}

	public function getCompanies($id = null){
		
		if ($id) {
			$this->db->where('companies.id = '.$id);
		}

		return $this->db->get('companies');

	}

	public function getPersonalStatment($id, $mes){
		
		if (($id) && ($mes)) {
			$query = 'SELECT
						hours.id, 
						NULL AS info, 
						hours.date, 
						hours.typedatefk, 
                        typedates.name as data,
						typedates.time,
						hours.hour1, 
						hours.hour2, 
						hours.hour3, 
						hours.hour4, 
						hours.hour5, 
						hours.hour6, 
						hours.balance
					FROM
						hours,
						employees,
                        typedates
					WHERE
						hours.employeefk = employees.id AND
                        typedates.id = hours.typedatefk AND
						employees.status = 1 AND
						hours.type = 0 AND
						employees.id = '.$id.' AND
						DATE_FORMAT(hours.date, "%Y-%m") = "'.$mes.'"
					UNION
					SELECT
						NULL, 
						"TOTAL", 
						"2300-12-31", 
						NULL, 
						NULL as data, 
						NULL,
						NULL,
						NULL, 
						NULL, 
						NULL, 
						sec_to_time(
							SUM( 
								 (
								   (time_to_sec(hours.hour2) - time_to_sec(hours.hour1)) +
								   (time_to_sec(hours.hour4) - time_to_sec(hours.hour3)) +
								   (time_to_sec(hours.hour6) - time_to_sec(hours.hour5))   
								  )
							   )
						  )  as hour5, 
						sec_to_time(SUM(time_to_sec(typedates.time))) as hour6, 
						sec_to_time(SUM(time_to_sec(balance))) AS balance
					FROM
						hours,
						employees,
                        typedates
					WHERE
						hours.employeefk = employees.id AND
						employees.status = 1 AND
						hours.type = 0 AND
						employees.id = '.$id.' AND
                        typedates.id = hours.typedatefk AND						
						DATE_FORMAT(hours.date, "%Y-%m") = "'.$mes.'"';
			return $this->db->query($query);
		} else {
			return null;
		}
	}	

	public function getHoursExtract(){
		$query = 'SELECT
					employees.name,                   
					(SELECT
						sec_to_time(SUM(time_to_sec(balance)))
					FROM
						hours h
						left join typedates on
							h.typedatefk = typedates.id 
					WHERE
						h.id = h.id AND
						h.employeefk = employees.id AND
						DATE_SUB( DATE_FORMAT(CURDATE(), "%Y-%m-01"), INTERVAL 12 MONTH) > h.date) AS MES_12_SALDO,
					(SELECT
						sec_to_time(SUM(time_to_sec(balance)))
					FROM
						hours h
						left join typedates on
							h.typedatefk = typedates.id 
					WHERE
						h.id = h.id AND
						h.employeefk = employees.id AND
						PERIOD_ADD(DATE_FORMAT(SYSDATE(), "%Y%m"), -12) = DATE_FORMAT(h.date, "%Y%m")) AS MES_12,
					(SELECT
						sec_to_time(SUM(time_to_sec(balance)))
					FROM
						hours h
						left join typedates on
							h.typedatefk = typedates.id 
					WHERE
						h.id = h.id AND
						h.employeefk = employees.id AND
						DATE_SUB( DATE_FORMAT(CURDATE(), "%Y-%m-01"), INTERVAL 11 MONTH) > h.date) AS MES_11_SALDO,
					(SELECT
						sec_to_time(SUM(time_to_sec(balance)))
					FROM
						hours h
						left join typedates on
							h.typedatefk = typedates.id 
					WHERE
						h.id = h.id AND
						h.employeefk = employees.id AND
						PERIOD_ADD(DATE_FORMAT(SYSDATE(), "%Y%m"), -11) = DATE_FORMAT(h.date, "%Y%m")) AS MES_11,
					(SELECT
						sec_to_time(SUM(time_to_sec(balance)))
					FROM
						hours h
						left join typedates on
							h.typedatefk = typedates.id 
					WHERE
						h.id = h.id AND
						h.employeefk = employees.id AND
						DATE_SUB( DATE_FORMAT(CURDATE(), "%Y-%m-01"), INTERVAL 10 MONTH) > h.date) AS MES_10_SALDO,
					(SELECT
						sec_to_time(SUM(time_to_sec(balance)))
					FROM
						hours h
						left join typedates on
							h.typedatefk = typedates.id 
					WHERE
						h.id = h.id AND
						h.employeefk = employees.id AND
						PERIOD_ADD(DATE_FORMAT(SYSDATE(), "%Y%m"), -10) = DATE_FORMAT(h.date, "%Y%m")) AS MES_10,
                                        (SELECT
						sec_to_time(SUM(time_to_sec(balance)))
					FROM
						hours h
						left join typedates on
							h.typedatefk = typedates.id 
					WHERE
						h.id = h.id AND
						h.employeefk = employees.id AND
						DATE_SUB( DATE_FORMAT(CURDATE(), "%Y-%m-01"), INTERVAL 9 MONTH) > h.date) AS MES_9_SALDO,
					(SELECT
						sec_to_time(SUM(time_to_sec(balance)))
					FROM
						hours h
						left join typedates on
							h.typedatefk = typedates.id 
					WHERE
						h.id = h.id AND
						h.employeefk = employees.id AND
						PERIOD_ADD(DATE_FORMAT(SYSDATE(), "%Y%m"), -9) = DATE_FORMAT(h.date, "%Y%m")) AS MES_9,
					(SELECT
						sec_to_time(SUM(time_to_sec(balance)))
					FROM
						hours h
						left join typedates on
							h.typedatefk = typedates.id 
					WHERE
						h.id = h.id AND
						h.employeefk = employees.id AND
						DATE_SUB( DATE_FORMAT(CURDATE(), "%Y-%m-01"), INTERVAL 8 MONTH) > h.date) AS MES_8_SALDO,
					(SELECT
						sec_to_time(SUM(time_to_sec(balance)))
					FROM
						hours h
						left join typedates on
							h.typedatefk = typedates.id 
					WHERE
						h.id = h.id AND
						h.employeefk = employees.id AND
						PERIOD_ADD(DATE_FORMAT(SYSDATE(), "%Y%m"), -8) = DATE_FORMAT(h.date, "%Y%m")) AS MES_8,  
					(SELECT
						sec_to_time(SUM(time_to_sec(balance)))
					FROM
						hours h
						left join typedates on
							h.typedatefk = typedates.id 
					WHERE
						h.id = h.id AND
						h.employeefk = employees.id AND
						DATE_SUB( DATE_FORMAT(CURDATE(), "%Y-%m-01"), INTERVAL 7 MONTH) > h.date) AS MES_7_SALDO,
					(SELECT
						sec_to_time(SUM(time_to_sec(balance)))
					FROM
						hours h
						left join typedates on
							h.typedatefk = typedates.id 
					WHERE
						h.id = h.id AND
						h.employeefk = employees.id AND
						PERIOD_ADD(DATE_FORMAT(SYSDATE(), "%Y%m"), -7) = DATE_FORMAT(h.date, "%Y%m")) AS MES_7,  
					(SELECT
						sec_to_time(SUM(time_to_sec(balance)))
					FROM
						hours h
						left join typedates on
							h.typedatefk = typedates.id 
					WHERE
						h.id = h.id AND
						h.employeefk = employees.id AND
						DATE_SUB( DATE_FORMAT(CURDATE(), "%Y-%m-01"), INTERVAL 6 MONTH) > h.date) AS MES_6_SALDO,
					(SELECT
						sec_to_time(SUM(time_to_sec(balance)))
					FROM
						hours h
						left join typedates on
							h.typedatefk = typedates.id 
					WHERE
						h.id = h.id AND
						h.employeefk = employees.id AND
						PERIOD_ADD(DATE_FORMAT(SYSDATE(), "%Y%m"), -6) = DATE_FORMAT(h.date, "%Y%m")) AS MES_6,  
					(SELECT
						sec_to_time(SUM(time_to_sec(balance)))
					FROM
						hours h
						left join typedates on
							h.typedatefk = typedates.id 
					WHERE
						h.id = h.id AND
						h.employeefk = employees.id AND
						DATE_SUB( DATE_FORMAT(CURDATE(), "%Y-%m-01"), INTERVAL 5 MONTH) > h.date) AS MES_5_SALDO,
					(SELECT
						sec_to_time(SUM(time_to_sec(balance)))
					FROM
						hours h
						left join typedates on
							h.typedatefk = typedates.id
					WHERE
						h.id = h.id AND
						h.employeefk = employees.id AND
						PERIOD_ADD(DATE_FORMAT(SYSDATE(), "%Y%m"), -5) = DATE_FORMAT(h.date, "%Y%m"))  AS MES_5,
					(SELECT
						sec_to_time(SUM(time_to_sec(balance)))
					FROM
						hours h
						left join typedates on
							h.typedatefk = typedates.id 
					WHERE
						h.id = h.id AND
						h.employeefk = employees.id AND
						DATE_SUB( DATE_FORMAT(CURDATE(), "%Y-%m-01"), INTERVAL 4 MONTH) > h.date) AS MES_4_SALDO,
					(SELECT
						sec_to_time(SUM(time_to_sec(balance)))
					FROM
						hours h
						left join typedates on
							h.typedatefk = typedates.id 
					WHERE
						h.id = h.id AND
						h.employeefk = employees.id AND
						PERIOD_ADD(DATE_FORMAT(SYSDATE(), "%Y%m"), -4) = DATE_FORMAT(h.date, "%Y%m"))  AS MES_4,
					(SELECT
						sec_to_time(SUM(time_to_sec(balance)))
					FROM
						hours h
						left join typedates on
							h.typedatefk = typedates.id 
					WHERE
						h.id = h.id AND
						h.employeefk = employees.id AND
						DATE_SUB( DATE_FORMAT(CURDATE(), "%Y-%m-01"), INTERVAL 3 MONTH) > h.date) AS MES_3_SALDO,
					(SELECT
						sec_to_time(SUM(time_to_sec(balance)))								
					FROM
						hours h
						left join typedates on
							h.typedatefk = typedates.id 
					WHERE
						h.id = h.id AND
						h.employeefk = employees.id AND
						PERIOD_ADD(DATE_FORMAT(SYSDATE(), "%Y%m"), -3) = DATE_FORMAT(h.date, "%Y%m"))  AS MES_3,
					(SELECT
						sec_to_time(SUM(time_to_sec(balance)))
					FROM
						hours h
						left join typedates on
							h.typedatefk = typedates.id 
					WHERE
						h.id = h.id AND
						h.employeefk = employees.id AND
						DATE_SUB( DATE_FORMAT(CURDATE(), "%Y-%m-01"), INTERVAL 2 MONTH) > h.date) AS MES_2_SALDO,
					(SELECT
						sec_to_time(SUM(time_to_sec(balance)))
					FROM
						hours h
						left join typedates on
							h.typedatefk = typedates.id 
					WHERE
						h.id = h.id AND
						h.employeefk = employees.id AND
						PERIOD_ADD(DATE_FORMAT(SYSDATE(), "%Y%m"), -2) = DATE_FORMAT(h.date, "%Y%m")) AS MES_2,
					(SELECT
						sec_to_time(SUM(time_to_sec(balance)))
					FROM
						hours h
						left join typedates on
							h.typedatefk = typedates.id 
					WHERE
						h.id = h.id AND
						h.employeefk = employees.id AND
						DATE_SUB( DATE_FORMAT(CURDATE(), "%Y-%m-01"), INTERVAL 1 MONTH) > h.date) AS MES_1_SALDO,
					(SELECT
						sec_to_time(SUM(time_to_sec(balance)))
					FROM
						hours h
						left join typedates on
							h.typedatefk = typedates.id 
					WHERE
						h.id = h.id AND
						h.employeefk = employees.id AND
						PERIOD_ADD(DATE_FORMAT(SYSDATE(), "%Y%m"), -1) = DATE_FORMAT(h.date, "%Y%m"))  AS MES_1,  
					(SELECT
						sec_to_time(SUM(time_to_sec(balance)))
					FROM
						hours h
						left join typedates on
							h.typedatefk = typedates.id 
					WHERE
						h.id = h.id AND
						h.employeefk = employees.id AND
						DATE_SUB( DATE_FORMAT(CURDATE(), "%Y-%m-01"), INTERVAL 0 MONTH) > h.date) AS MES_ATUAL_SALDO,
					(SELECT
						sec_to_time(SUM(time_to_sec(balance)))
					FROM
						hours h
						left join typedates on 
							h.typedatefk = typedates.id 
					WHERE
						h.id = h.id AND
						h.employeefk = employees.id AND
						DATE_FORMAT(h.date, "%m-%Y") = DATE_FORMAT(SYSDATE(),"%m-%Y")) AS MES_ATUAL,
					sec_to_time(SUM(time_to_sec(balance))) AS SALDO
				FROM 
					hours,
					employees
				WHERE
					hours.employeefk = employees.id
				AND 						
					hours.type in (0, 1)
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
		$this->db->where('status = 1');
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
			$this->db->select('employees.id, employees.name as employee, roles.name as role, employees.admission as admission');
			$this->db->from('employees');
			$this->db->from('roles');
			$this->db->where('employees.rolefk = roles.id');
			$this->db->where('employees.id', $id);
			return $this->db->get();
		} else {
			return null;
		}
	}

	public function getMonthsExtract($datebegin, $datefinish){
		if (($datebegin) && ($datefinish)){
			$query = 'SELECT TIMESTAMPDIFF(MONTH,"'.$datebegin.'","'.$datefinish.'") + 1 as meses';
			return $this->db->query($query);
		} else {
			return null;
		}
	}

	public function getHoursPeriod($datebegin, $datefinish){
		if (($datebegin) && ($datefinish)){
			$query = 'SELECT
						employees.ID AS ID,
						MAX(employees.name) AS NAME,
  						MAX(roles.name) as ROLESNAME,
						(SELECT
							sec_to_time(SUM(time_to_sec(balance)))
						FROM
							hours h
							left join typedates on
								h.typedatefk = typedates.id 
						WHERE
							h.id = h.id AND
							h.employeefk = employees.id AND
							h.date < "'.$datebegin.'") AS BALANCE_PRIOR
					FROM
						EMPLOYEES
						LEFT JOIN HOURS ON
						  HOURS.EMPLOYEEFK = EMPLOYEES.ID AND
						  HOURS.DATE between "'.$datebegin.'" AND "'.$datefinish.'"
						INNER JOIN ROLES ON
						  ROLES.ID = EMPLOYEES.ROLEFK
					WHERE
						STATUS = 1
					GROUP BY
						EMPLOYEES.ID
					ORDER BY
						2,3';
			return $this->db->query($query);
		} else {
			return null;
		}
	}

	public function getHoursIdIntervalMonth($id, $monthYear){
		if (($id) && ($monthYear)){
			$date = '01/'.$monthYear;
			$explode = explode('/', $date);
			$date = $explode[2].'-'.$explode[1].'-'.$explode[0];
			$date = date('Y-m-d', strtotime($date.' +1 month'));
			$query = 'SELECT 
						(SELECT
							sec_to_time(SUM(time_to_sec(balance)))
						FROM
							hours h
							left join typedates on
								h.typedatefk = typedates.id 
						WHERE
							h.id = h.id AND
							h.employeefk = '.$id.' AND
							h.date < "'.$date.'") AS SALDO,
						(SELECT
							sec_to_time(SUM(time_to_sec(balance)))
						FROM
							hours h
							left join typedates on 
								h.typedatefk = typedates.id 
						WHERE
							h.id = h.id AND
							h.employeefk = '.$id.' AND
							DATE_FORMAT(h.date, "%m/%Y") = "'.$monthYear.'") AS TOTAL';
			return $this->db->query($query);
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
