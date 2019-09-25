<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once  $_SERVER['DOCUMENT_ROOT'] . '/timecard/vendor/autoload.php';
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
									//'orientation' => 'P'
									'default_font_size' => 8,
									'default_font' => 'courier_new'
									]);
			$date = new DateTime;
			$pdf->allow_charset_conversion=true;
			$pdf->charset_in='UTF-8';
			$pdf->SetDisplayMode('fullpage');
			//Cabeçalho: Seta a data/hora completa de quando o PDF foi gerado + um texto no lado direito
			$pdf->SetHeader('{DATE j/m/Y H:i}|{PAGENO}/{nb}|Controle Ponto Web');
			
			//Rodapé: Seta a data/hora completa de quando o PDF foi gerado + um texto no lado direito
			$pdf->SetFooter('{DATE j/m/Y H:i}|{PAGENO}/{nb}|Contole Ponto Web');
			
			$html .= '<b>Empresa: '.$company->row()->name.'</b><br>';
			$html .= '<b>Código: '.$employee->row()->id.'</b><br>';
			$html .= '<b>Funcionário: '.$employee->row()->name.'</b><br>';
			$html .= '<b>Período: '.ucfirst(utf8_encode(strftime('%m/%Y', strtotime($mes)))).'</b><br>';
			//$html .= '----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------<br>';
			$html .= str_pad('-', 196, '-', STR_PAD_LEFT).'<br>';
			$html .= '<table>';
			$html .= '<tr>';
			$html .= '<td>Data</td>';
			$html .= '<td>Tipo</td>';
			$html .= '<td>Tempo</td>';
			$html .= '<td>Entrada Manhã</td>';
			$html .= '<td>Saída Manhã</td>';
			$html .= '<td>Entrada Tarde</td>';
			$html .= '<td>Saída Tarde</td>';
			$html .= '<td>Entrada Extra</td>';
			$html .= '<td>Saída Extra</td>';
			$html .= '<td>Saldo</td>';
			$html .= '</tr>';
			$time = 0;
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
					list($h, $m, $s) = explode(':', $row->time);

					$secounds += $h * 3600;
					$secounds += $m * 60;
					$secounds += $s;
					
					$time += $secounds;

					if ($row->weekend == 'S') {
						$hour = floor($time / 3600);
						$time %= 3600;
						$minutes = floor($time / 3600);
						$time %= 60;

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
						$html .= '<td><b>'.str_pad($hour, 2, '0', STR_PAD_LEFT).':'.str_pad($minutes, 2, '0', STR_PAD_LEFT).':'.str_pad($time, 2, '0', STR_PAD_LEFT).'</b></td>';
						$html .= '<td></td>';
						$html .= '<td></td>';
						$html .= '<td></td>';
						$html .= '<td></td>';
						$html .= '<td></td>';
						$html .= '<td></td>';
						$html .= '</tr>';
						$time = 0;
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
					}
				} else {
					$html .= '</table><p></p>';
					$html .= '&nbsp;<b>Horas a trabalhar: '.$row->hour6.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Horas Trabalhadas: '.$row->hour5.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Saldo: '.$row->balance.'</b>';
				}

			}
			$html .= '</body></html>';

			$pdf->WriteHTML($html);

			// define um nome para o arquivo PDF
			$filename = $employee->row()->name.'.pdf';

			$pdf->Output($filename, 'I');
		}
	}	
	
}

?>
