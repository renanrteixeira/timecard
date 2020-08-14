<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once  $_SERVER['DOCUMENT_ROOT'] . '/timecard/vendor/autoload.php';
//require_once dirname(dirname(dirname(__FILE__))).'\vendor\autoload.php';
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

class HoursExport extends CI_Controller {

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
		$this->load->view('hoursexport/index');
	}

	public function export(){

		$datebegin = $this->input->post('datebegin');
		$datefinish = $this->input->post('datefinish');

		if (($datebegin) && ($datefinish)) {
			$qry = 'SELECT
						employees.ID AS ID,
						employees.name AS FUNCIONARIO,
						roles.name as FUNCAO,
						DATE_FORMAT(hours.date, "%d-%m-%Y") AS DATA,
						CASE WEEKDAY(hours.date) 
						when 0 then "Segunda-feira"
						when 1 then "Terça-feira"
						when 2 then "Quarta-feira"
						when 3 then "Quinta-feira"
						when 4 then "Sexta-feira"
						when 5 then "Sábado"
						when 6 then "Domingo"
						END AS DiaDaSemana,
						CASE hours.type
						WHEN 0 THEN "Lançamento de Hora"
						WHEN 1 THEN "Pagamento de Hora"
						END as TipoHora,
						typedates.time as HORA_COMPARACAO,
						hours.hour1 AS ENTRADA_MANHA,
						hours.hour2 AS SAIDA_MANHA,
						hours.hour3 AS ENTRADA_TARDE,
						hours.hour4 AS SAIDA_TARDE,
						hours.hour5 AS ENTRADA_EXTRA,
						hours.hour6 AS SAIDA_EXTRA,
						hours.balance AS SALDO_HORAS
					FROM
						EMPLOYEES
						INNER JOIN HOURS ON
						HOURS.EMPLOYEEFK = EMPLOYEES.ID AND
						HOURS.DATE between "'.$datebegin.'" AND "'.$datefinish.'"
						INNER JOIN ROLES ON
						ROLES.ID = EMPLOYEES.ROLEFK
						left join typedates on
						hours.typedatefk = typedates.id
					WHERE
						STATUS = 1
					ORDER BY
						2,4';

    		$rows = $this->db->query($qry);


			$html = '<html><body>';
			$html .= '<table>';
			$html .= '<thead>';
			$html .= '	<tr>';
			$html .= '		<th>'.utf8_decode('Código').'</th>';
			$html .= '		<th>'.utf8_decode('Funcionário').'</th>';
			$html .= '		<th>'.utf8_decode('Função').'</th>';
			$html .= '		<th>Data</th> ';
			$html .= '		<th>Dia Semana</th> ';
			$html .= '		<th>Tipo de Hora</th> ';
			$html .= '		<th>Hora Base</th> ';
			$html .= '		<th>'.utf8_decode('Entrada Manhã').'</th> ';
			$html .= '		<th>'.utf8_decode('Saida Manhã').'</th> ';
			$html .= '		<th>Entrada Tarde</th> ';
			$html .= '		<th>Saida Tarde</th> ';
			$html .= '		<th>Entrada Extra</th> ';
			$html .= '		<th>Saida Extra</th> ';
			$html .= '		<th>Saldo</th> ';
			$html .= '	</tr>';
			$html .= '</thead>';
			$html .= '<tbody>';
			foreach($rows->result() as $value){ 
				$html .= '		<tr>';
				$html .= '			<td>'.$value->ID.'</td>';
				$html .= '			<td>'.utf8_decode($value->FUNCIONARIO).'</td>';
				$html .= '			<td>'.utf8_decode($value->FUNCAO).'</td>';
				$html .= '			<td>'.$value->DATA.'</td>';
				$html .= '			<td>'.utf8_decode($value->DiaDaSemana).'</td>';
				$html .= '			<td>'.utf8_decode($value->TipoHora).'</td>';
				$html .= '			<td>'.$value->HORA_COMPARACAO.'</td>';
				$html .= '			<td>'.$value->ENTRADA_MANHA.'</td>';
				$html .= '			<td>'.$value->SAIDA_MANHA.'</td>';
				$html .= '			<td>'.$value->ENTRADA_TARDE.'</td>';
				$html .= '			<td>'.$value->SAIDA_TARDE.'</td>';
				$html .= '			<td>'.$value->ENTRADA_EXTRA.'</td>';
				$html .= '			<td>'.$value->SAIDA_EXTRA.'</td>';
				$html .= '			<td>'.$value->SALDO_HORAS.'</td>';
				$html .= '		</tr>';
			}
			$html .= '</tbody>';
			$html .= '</table>';
			$html .= '</body></html>';
	
			// Definimos o nome do arquivo que será exportado  
			$arquivo = 'Lançamentos_Horas_'.date('d-m-Y_H:i:s').'.xls';  
			// Configurações header para forçar o download  
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'.$arquivo.'"');
			header("Pragma: no-cache"); 
			header("Expires: 0");
			header('Cache-Control: max-age=0');
			// Se for o IE9, isso talvez seja necessário
			header('Cache-Control: max-age=1');
			$this->load->view('hoursexport/index');
			// Envia o conteúdo do arquivo  
			echo $html;  		
		} 

		$this->load->view('hoursexport/index');
	}	
	
}

?>
