<?php
defined('BASEPATH') OR exit('No direct script access allowed');

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

class HoursExtract extends CI_Controller {

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
		$variaveis['extract'] = $this->hours->getHoursExtract();
		$this->load->view('hoursextract/index', $variaveis);
	}

	public function export()
	{   
		$today = strtotime('first day of this month');
		$hours = $this->hours->getHoursExtract();
		$variaveis['extract'] = $this->hours->getHoursExtract();
		$html = '<html><body>';
		$html .= '<table>';
		$html .= '<thead>';
		$html .= '	<tr>';
		$html .= '		<th></th>';
		$html .= '		<th></th>';
		$html .= '		<th class="text-center" colspan="2">'.ucfirst(utf8_encode(strftime('%b/%y', strtotime('-12 months', $today)))).'</th> ';
		$html .= '		<th class="text-center" colspan="2">'.ucfirst(utf8_encode(strftime('%b/%y', strtotime('-11 months', $today)))).'</th> ';
		$html .= '		<th class="text-center" colspan="2">'.ucfirst(utf8_encode(strftime('%b/%y', strtotime('-10 months', $today)))).'</th> ';
		$html .= '		<th class="text-center" colspan="2">'.ucfirst(utf8_encode(strftime('%b/%y', strtotime('-9 months', $today)))).'</th> ';
		$html .= '		<th class="text-center" colspan="2">'.ucfirst(utf8_encode(strftime('%b/%y', strtotime('-8 months', $today)))).'</th> ';
		$html .= '		<th class="text-center" colspan="2">'.ucfirst(utf8_encode(strftime('%b/%y', strtotime('-7 months', $today)))).'</th> ';
		$html .= '		<th class="text-center" colspan="2">'.ucfirst(utf8_encode(strftime('%b/%y', strtotime('-6 months', $today)))).'</th> ';
		$html .= '		<th class="text-center" colspan="2">'.ucfirst(utf8_encode(strftime('%b/%y', strtotime('-5 months', $today)))).'</th> ';
		$html .= '		<th class="text-center" colspan="2">'.ucfirst(utf8_encode(strftime('%b/%y', strtotime('-4 months', $today)))).'</th> ';
		$html .= '		<th class="text-center" colspan="2">'.ucfirst(utf8_encode(strftime('%b/%y', strtotime('-3 months', $today)))).'</th> ';
		$html .= '		<th class="text-center" colspan="2">'.ucfirst(utf8_encode(strftime('%b/%y', strtotime('-2 months', $today)))).'</th> ';
		$html .= '		<th class="text-center" colspan="2">'.ucfirst(utf8_encode(strftime('%b/%y', strtotime('-1 months', $today)))).'</th> ';
		$html .= '		<th class="text-center" colspan="2">'.ucfirst(utf8_encode(strftime('%b/%y', $today))).'</th>';
		$html .= '	</tr>';
		$html .= '	<tr>';
		$html .= '		<th>Funcionário</th>';
		$html .= '		<th class="text-center">Saldo Anterior</th>';
		$html .= '		<th class="text-center">Total</th>';
		$html .= '		<th class="text-center">Saldo</th>';
		$html .= '		<th class="text-center">Total</th>';
		$html .= '		<th class="text-center">Saldo</th>';
		$html .= '		<th class="text-center">Total</th>';
		$html .= '		<th class="text-center">Saldo</th>';
		$html .= '		<th class="text-center">Total</th>';
		$html .= '		<th class="text-center">Saldo</th>';
		$html .= '		<th class="text-center">Total</th>';
		$html .= '		<th class="text-center">Saldo</th>';
		$html .= '		<th class="text-center">Total</th>';
		$html .= '		<th class="text-center">Saldo</th>';
		$html .= '		<th class="text-center">Total</th>';
		$html .= '		<th class="text-center">Saldo</th>';
		$html .= '		<th class="text-center">Total</th>';
		$html .= '		<th class="text-center">Saldo</th>';
		$html .= '		<th class="text-center">Total</th>';
		$html .= '		<th class="text-center">Saldo</th>';
		$html .= '		<th class="text-center">Total</th>';
		$html .= '		<th class="text-center">Saldo</th>';
		$html .= '		<th class="text-center">Total</th>';
		$html .= '		<th class="text-center">Saldo</th>';
		$html .= '		<th class="text-center">Total</th>';
		$html .= '		<th class="text-center">Saldo</th>';
		$html .= '		<th class="text-center">Total</th>';
		$html .= '		<th class="text-center">Saldo</th>';
		$html .= '	</tr>';
		$html .= '</thead>';
		$html .= '<tbody>';
		foreach($hours->result() as $value){ 
			$html .= '		<tr>';
			$html .= '			<td>'.$value->name.'</td>';
			$html .= '			<td>'.$value->MES_12_SALDO.'</td>';
			$html .= '			<td>'.$value->MES_12.'</td>';
			$html .= '			<td>'.$value->MES_11_SALDO.'</td>';
			$html .= '			<td>'.$value->MES_11.'</td>';
			$html .= '			<td>'.$value->MES_10_SALDO.'</td>';
			$html .= '			<td>'.$value->MES_10.'</td>';
			$html .= '			<td>'.$value->MES_9_SALDO.'</td>';
			$html .= '			<td>'.$value->MES_9.'</td>';
			$html .= '			<td>'.$value->MES_8_SALDO.'</td>';
			$html .= '			<td>'.$value->MES_8.'</td>';
			$html .= '			<td>'.$value->MES_7_SALDO.'</td>';
			$html .= '			<td>'.$value->MES_7.'</td>';
			$html .= '			<td>'.$value->MES_6_SALDO.'</td>';
			$html .= '			<td>'.$value->MES_6.'</td>';
			$html .= '			<td>'.$value->MES_5_SALDO.'</td>';
			$html .= '			<td>'.$value->MES_5.'</td>';
			$html .= '			<td>'.$value->MES_4_SALDO.'</td>';
			$html .= '			<td>'.$value->MES_4.'</td>';
			$html .= '			<td>'.$value->MES_3_SALDO.'</td>';
			$html .= '			<td>'.$value->MES_3.'</td>';
			$html .= '			<td>'.$value->MES_2_SALDO.'</td>';
			$html .= '			<td>'.$value->MES_2.'</td>';
			$html .= '			<td>'.$value->MES_1_SALDO.'</td>';
			$html .= '			<td>'.$value->MES_1.'</td>';
			$html .= '			<td>'.$value->MES_ATUAL_SALDO.'</td>';
			$html .= '			<td>'.$value->MES_ATUAL.'</td>';
			$html .= '			<td>'.$value->SALDO.'</td>';
			$html .= '		</tr>';
		}
		$html .= '</tbody>';
		$html .= '</table>';
		$html .= '</body></html>';

		// Definimos o nome do arquivo que será exportado  
		$arquivo = 'Planilha_Horas_'.date('d-m-Y_H:i:s').'.xls';  
		// Configurações header para forçar o download  
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$arquivo.'"');
		header("Pragma: no-cache"); 
		header("Expires: 0");
		header('Cache-Control: max-age=0');
		// Se for o IE9, isso talvez seja necessário
		header('Cache-Control: max-age=1');
		$this->load->view('hoursextract/index', $variaveis);
		// Envia o conteúdo do arquivo  
		echo $html;  
	}

	function checkDateFormat($date) {
        $d = DateTime::createFromFormat('Y-m-d', $date);
        if(($d && $d->format('Y-m-d') === $date) === FALSE){
            $this->form_validation->set_message('checkDateFormat', ''.$date.' is not a valid date format.');
            return FALSE;
        }else{
            return TRUE;
        }
	}	

	public function exportPeriod(){

		//pegando o registro linha 
		//$time->row()->time;
		$this->load->library('form_validation');
		
		$regras = array(
		        array(
		                'field' => 'datebegin',
		                'label' => 'Data Inicial',
		                'rules' => 'trim|required'
				),
		        array(
						'field' => 'datefinish',
						'label' => 'Data Final',
						'rules' => 'trim|required'
				)
		);

		$this->form_validation->set_rules($regras);

		$this->form_validation->set_rules('datebegin', 'Data Inicial', 'trim|required|callback_checkDateFormat');
		$this->form_validation->set_rules('datefinish', 'Data Final', 'trim|required|callback_checkDateFormat');

		if ($this->form_validation->run()) {

			$dbegin = strtotime($this->input->post('datebegin'));

			$result = $this->hours->getMonthsExtract($this->input->post('datebegin'), $this->input->post('datefinish'));

			foreach ($result->result() as $value) {
				$months = $value->meses;
			}
			//$months = $result->row()->meses;

			$hours = $this->hours->getHoursPeriod($this->input->post('datebegin'), $this->input->post('datefinish'));

			$html = '<html><body>';
			$html .= '<table>';
			$html .= '<thead>';
			$html .= '	<tr>';
			$html .= '		<th></th>';
			$html .= '		<th></th>';
			$html .= '		<th></th>';

			$arrayMonths = array();

			for ($i=0; $i<$months; $i++){
				$html .= '		<th class="text-center" colspan="2">'.ucfirst(utf8_encode(strftime('%b/%y', strtotime('+'.$i.' months', $dbegin)))).'</th> ';
				$arrayMonths[$i] = date('m/Y', strtotime('+'.$i.' months', $dbegin));
			}

			$html .= '	<tr>';
			$html .= '		<th>'.utf8_decode('Funcionário').'</th>';
			$html .= '		<th>'.utf8_decode('Função').'</th>';
			$html .= '		<th class="text-center">Saldo Anterior</th>';
			for ($i=0; $i<$months; $i++){
				$html .= '		<th class="text-center">Total</th>';
				$html .= '		<th class="text-center">Saldo</th>';
			}
			$html .= '	</tr>';
			$html .= '</thead>';

			$html .= '<tbody>';
			$employee = 0;
			$first = True;
			
			foreach ($hours->result() as $value){
				if ($employee != $value->ID){
					if (!$first){
						$html .= '	</tr>';
					}
					$employee = $value->ID;
					$first = False;
					$html .= '	<tr>';
					$html .= '		<th>'.utf8_decode($value->NAME).'</th>';
					$html .= '		<th>'.utf8_decode($value->ROLESNAME).'</th>';
					$html .= '		<th class="text-center">'.$value->BALANCE_PRIOR.'</th>';
					$i = 0;
					$balanceprior = $value->BALANCE_PRIOR;
				}

				$print = false;

				$max = sizeof($arrayMonths);

				for ($i=0; $i<$max; $i++){
					$result = $this->hours->getHoursIdIntervalMonth($value->ID, $arrayMonths[$i]);
					$print = false;
					foreach($result->result() as $total){
						$html .= '		<th class="text-center">'.$total->TOTAL.'</th>';
						$html .= '		<th class="text-center">'.$total->SALDO.'</th>';
						$balanceprior = $total->SALDO;
						$print = true;
					}
					if (!$print) {
						$html .= '		<th class="text-center"></th>';
						$html .= '		<th class="text-center">'.$balanceprior.'</th>';
					}	
				}
			}

			$html .= '</tbody>';
			$html .= '</table>';
			$html .= '</body></html>';
			// Definimos o nome do arquivo que será exportado  
			$arquivo = 'Planilha_Horas_Periodo_'.date('d-m-Y_H:i:s').'.xls';  
			// Configurações header para forçar o download  
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'.$arquivo.'"');
			header("Pragma: no-cache"); 
			header("Expires: 0");
			header('Cache-Control: max-age=0');
			// Se for o IE9, isso talvez seja necessário
			header('Cache-Control: max-age=1');
			// Envia o conteúdo do arquivo  
			echo $html;  
		}

		$variaveis['extract'] = $this->hours->getHoursExtract();
		$this->load->view('hoursextract/index', $variaveis);
	}
}
?>
