<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once  $_SERVER['DOCUMENT_ROOT'] . '/timecard/vendor/autoload.php';
//require_once dirname(dirname(dirname(__FILE__))).'\vendor\autoload.php';
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

class PersonalStatement extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct() {
		parent::__construct();
        $this->load->model('Hours_model', 'hours');
    }	 

	public function index()
	{
		$variaveis['extract'] = $this->hours->getPersonalStatment($this->input->post('employee'), $this->input->post('mes'));
		$variaveis['employee'] = $this->hours->getEmployee($this->input->post('employee'));
		$variaveis['periodo'] = $this->input->post('mes');
		$variaveis['employees'] = $this->hours->getEmployees();
		$variaveis['companies'] = $this->hours->getCompanies();
		$this->load->view('personalstatement/index', $variaveis);
	}

	public function export(){

		$id = $this->input->post('employee');
		$mes = $this->input->post('periodo');

		if ($id && $mes) {

			$query = 'SELECT
						hours.id, 
						NULL AS info, 
						hours.date, 
						hours.typedatefk, 
						typedates.name,
						typedates.time,
						typedates.weekend,
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
						hours.type = 0 AND
						employees.status = 1 AND
						employees.id = '.$id.' AND
						DATE_FORMAT(hours.date, "%Y-%m") = "'.$mes.'"
					UNION
					SELECT
						NULL, 
						"TOTAL", 
						2300-12-31, 
						NULL, 
						NULL as data, 
						NULL,
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
						DATE_FORMAT(hours.date, "%Y-%m") = "'.$mes.'"
					ORDER BY 3';
			
			$rows = $this->db->query($query);

			$this->db->select('*'); 
			$this->db->from('employees');
			$this->db->where('employees.id = '.$id);
			$employee = $this->db->get();

			$company = $this->db->get('companies');

			$html = '<html><body>';

			$pdf  = new \Mpdf\Mpdf([
									'mode' => 'utf-8',
									//'format' => [190, 236],
									// P - Portrait or L - Landspace
									'orientation' => 'P',
									'default_font_size' => 8,
									'default_font' => 'courier_new'
									]);
			$pdf->allow_charset_conversion=true;
			$pdf->charset_in='UTF-8';
			$pdf->SetDisplayMode('fullpage');
			//Cabeçalho: Seta a data/hora completa de quando o PDF foi gerado + um texto no lado direito
			$pdf->SetHeader('Empresa: '.$company->row()->name.'||Período: '.ucfirst(utf8_encode(strftime('%m/%Y', strtotime($mes)))));
			
			//Rodapé: Seta a data/hora completa de quando o PDF foi gerado + um texto no lado direito
			$pdf->SetFooter('{DATE j/m/Y H:i}|{PAGENO}/{nb}|Copyright © 2019 Contole Ponto');
			//$pdf->SetFooter('{DATE j/m/Y H:i}|{PAGENO}/{nb}|Contole Ponto Web');
			
			//$html .= '<b>Empresa: '.$company->row()->name.'&nbsp;&nbsp;&nbsp;&nbsp;Período: '.ucfirst(utf8_encode(strftime('%m/%Y', strtotime($mes)))).'</b><br>';
			$html .= '<b>Código: '.$employee->row()->id.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Funcionário: '.$employee->row()->name.'</b><br>';
			$html .= str_pad('_', 141, '_', STR_PAD_LEFT).'<br>';
			$html .= '<table>';
			$html .= '<tr>';
			$html .= '<td><b>Data</b></td>';
			$html .= '<td><b>Tipo</b></td>';
			$html .= '<td><b>Tempo</b></td>';
			$html .= '<td><b>Entrada Manhã</b></td>';
			$html .= '<td><b>Saída Manhã</b></td>';
			$html .= '<td><b>Entrada Tarde</b></td>';
			$html .= '<td><b>Saída Tarde</b></td>';
			$html .= '<td><b>Entrada Extra</b></td>';
			$html .= '<td><b>Saída Extra</b></td>';
			$html .= '<td><b>Saldo</b></td>';
			$html .= '</tr>';
			$time = 0;
			$worked = 0;
			//
			foreach($rows->result() as $row){
				if ($row->info != 'TOTAL') {
					$secounds = 0;
					$html .= '<tr>';
					$html .= '<td>'.ucfirst(utf8_encode(strftime('%d/%m/%Y', strtotime($row->date)))).'</td>';
					$html .= '<td>'.$row->name.'</td>';
					$html .= '<td>'.$row->time.'</td>';
					$html .= '<td>'.$row->hour1.'</td>';
					$html .= '<td>'.$row->hour2.'</td>';
					$html .= '<td>'.$row->hour3.'</td>';
					$html .= '<td>'.$row->hour4.'</td>';
					$html .= '<td>'.$row->hour5.'</td>';
					$html .= '<td>'.$row->hour6.'</td>';
					$html .= '<td>'.$row->balance.'</td>';
					$html .= '</tr>';
					//Calculando as horas a trabalhar
					list($h, $m, $s) = explode(':', $row->time);

					$secounds += $h * 3600;
					$secounds += $m * 60;
					$secounds += $s;
					
					$time += $secounds;

					//calculando horas trabahadas
					$secounds1 = 0;
					$secounds2 = 0;
					$secounds3 = 0;
					$secounds4 = 0;
					$secounds5 = 0;
					$secounds6 = 0;

					list($h1, $m1, $s1) = explode(':', $row->hour1);
					list($h2, $m2, $s2) = explode(':', $row->hour2);
					list($h3, $m3, $s3) = explode(':', $row->hour3);
					list($h4, $m4, $s4) = explode(':', $row->hour4);
					list($h5, $m5, $s5) = explode(':', $row->hour5);
					list($h6, $m6, $s6) = explode(':', $row->hour6);

					$secounds1 += $h1 * 3600;
					$secounds1 += $m1 * 60;
					$secounds1 += $s1;

					$secounds2 += $h2 * 3600;
					$secounds2 += $m2 * 60;
					$secounds2 += $s2;

					$secounds3 += $h3 * 3600;
					$secounds3 += $m3 * 60;
					$secounds3 += $s3;

					$secounds4 += $h4 * 3600;
					$secounds4 += $m4 * 60;
					$secounds4 += $s4;

					$secounds5 += $h5 * 3600;
					$secounds5 += $m5 * 60;
					$secounds5 += $s5;

					$secounds6 += $h6 * 3600;
					$secounds6 += $m6 * 60;
					$secounds6 += $s6;

					$worked += ($secounds2 - $secounds1); 
					$worked += ($secounds4 - $secounds3); 
					$worked += ($secounds6 - $secounds5); 


					if ($row->weekend == 'S') {
						//Calculando saldo
						$negative = false;
						if ($worked < $time) {
							$balance = $time - $worked;
							$negative = true;
						} else {
							$balance = $worked - $time;
						}

						$resultado = $time;
						$hour = floor($resultado / 3600);
						$resultado = $resultado - ($hour * 3600);
						$minutes = floor($resultado / 60);
						$resultado = $resultado - ($minutes * 60);
						$secounds = $resultado;

						$resultado = $worked;
						$hworked = floor($resultado / 3600);
						$resultado = $resultado - ($hworked * 3600);
						$mworked = floor($resultado / 60);
						$resultado = $resultado - ($mworked * 60);
						$sworked = $resultado;

						$resultado = $balance;
						$hbalance = floor($resultado / 3600);
						$resultado = $resultado - ($hbalance * 3600);
						$mbalance = floor($resultado / 60);
						$resultado = $resultado - ($mbalance * 60);
						$sbalance = $resultado;

						$html .= '<tr>';
						$html .= '<td></td>';
						$html .= '<td></td>';
						$html .= '<td></td>';
						$html .= '<td></td>';
						$html .= '<td></td>';
						$html .= '<td></td>';
						$html .= '<td></td>';
						$html .= '<td></td>';
						$html .= '<td></td>';
						$html .= '<td></td>';
						$html .= '</tr>';
						$html .= '<tr>';
						$html .= '<td><b>Total Semana</b></td>';
						$html .= '<td></td>';
						$html .= '<td><b>Horas a trabalhar</b></td>';
						$html .= '<td><b>'.str_pad($hour, 2, '0', STR_PAD_LEFT).':'.str_pad($minutes, 2, '0', STR_PAD_LEFT).':'.str_pad($secounds, 2, '0', STR_PAD_LEFT).'</b></td>';
						$html .= '<td></td>';
						$html .= '<td><b>Horas Trabalhadas</b></td>';
						$html .= '<td><b>'.str_pad($hworked, 2, '0', STR_PAD_LEFT).':'.str_pad($mworked, 2, '0', STR_PAD_LEFT).':'.str_pad($sworked, 2, '0', STR_PAD_LEFT).'</b></td>';
						$html .= '<td></td>';
						$html .= '<td><b>Saldo</b></td>';
						//$html .= '<td><b>'.$over.'</b></td>';
						if ($negative) {
							$html .= '<td><b>-'.str_pad($hbalance, 2, '0', STR_PAD_LEFT).':'.str_pad($mbalance, 2, '0', STR_PAD_LEFT).':'.str_pad($sbalance, 2, '0', STR_PAD_LEFT).'</b></td>';
						} else {
							$html .= '<td><b>'.str_pad($hbalance, 2, '0', STR_PAD_LEFT).':'.str_pad($mbalance, 2, '0', STR_PAD_LEFT).':'.str_pad($sbalance, 2, '0', STR_PAD_LEFT).'</b></td>';
						}
						$html .= '</tr>';
						$html .= '<tr>';
						$html .= '<td></td>';
						$html .= '<td></td>';
						$html .= '<td></td>';
						$html .= '<td></td>';
						$html .= '<td></td>';
						$html .= '<td></td>';
						$html .= '<td></td>';
						$html .= '<td></td>';
						$html .= '<td></td>';
						$html .= '<td></td>';
						$html .= '</tr>';
						$time = 0;	
						$worked = 0;					
					}
				} else {
					$html .= '</table>';
					$html .= '&nbsp;<b>Horas a trabalhar: '.$row->hour6.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Horas Trabalhadas: '.$row->hour5.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Saldo: '.$row->balance.'</b>';
				}

			}

			//Inserindo as horas pagas, caso exista
			$query = 'SELECT
						hours.id, 
						"" AS info,
						hours.date, 
						hours.hour1, 
						hours.balance
					FROM
						hours,
						employees
					WHERE
						hours.employeefk = employees.id AND
						employees.status = 1 AND
						hours.type = 1 AND
						employees.id = '.$id.' AND
						DATE_FORMAT(hours.date, "%Y-%m") = "'.$mes.'"
					UNION ALL
					SELECT
						null, 
						"TOTAL" AS info,
						2300-12-31 AS date, 
						NULL, 
						sec_to_time(SUM(time_to_sec(balance))) AS balance
					FROM
						hours,
						employees
					WHERE
						hours.employeefk = employees.id AND
						employees.status = 1 AND
						hours.type in (0, 1) AND
						employees.id = '.$id.' AND
						DATE_FORMAT(hours.date, "%Y-%m") = "'.$mes.'"					
					ORDER BY 3';

			$rows = $this->db->query($query);

			if ($rows->num_rows() > 1){
				$html .= '<br><br><b>&nbsp;Horas Pagas</b><table>';
				$html .= '<tr>';
				$html .= '<td><b>Data</b></td>';
				$html .= '<td><b>Horas</b></td>';
				$html .= '</tr>';
				
				foreach($rows->result() as $row){
					if ($row->info != 'TOTAL') {
						$html .= '<tr>';
						$html .= '<td>'.ucfirst(utf8_encode(strftime('%d/%m/%Y', strtotime($row->date)))).'</td>';
						$html .= '<td>'.$row->hour1.'</td>';
						$html .= '</tr>';
					} else {
						$html .= '<tr>';
						$html .= '<td><b>Saldo do Mês</b></td>';
						$html .= '<td><b>'.$row->balance.'</b></td>';
						$html .= '</tr>';
					}
				}
				$html .= '</table>';
			}

			$html .= '<p align="center">'.str_pad('_', 80, '_', STR_PAD_LEFT).'<br>';
			$html .= $employee->row()->name.'</p>';

			$html .= '</body></html>';

			$pdf->WriteHTML($html);

			// define um nome para o arquivo PDF
			$filename = $employee->row()->name.'.pdf';

			// I - Abre no navegador
			// F - Salva no servidor
			// D - Salva no Cliente

			$pdf->Output($filename, 'I');
		}
	}	
	
}

?>
