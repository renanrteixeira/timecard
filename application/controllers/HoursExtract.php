<?php
defined('BASEPATH') OR exit('No direct script access allowed');


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
		$extracts = $this->hours->getHoursExtract();
		$variaveis['extract'] = $this->hours->getHoursExtract();
		$html = '<html><body>';
		$html .= '<table>';
		$html .= '<thead>';
		$html .= '	<tr>';
		$html .= '		<th></th>';
		$html .= '		<th class="text-center" colspan="2">'.ucfirst(utf8_encode(strftime('%b/%g', strtotime('-12 months', $today)))).'</th> ';
		$html .= '		<th class="text-center" colspan="2">'.ucfirst(utf8_encode(strftime('%b/%g', strtotime('-11 months', $today)))).'</th> ';
		$html .= '		<th class="text-center" colspan="2">'.ucfirst(utf8_encode(strftime('%b/%g', strtotime('-10 months', $today)))).'</th> ';
		$html .= '		<th class="text-center" colspan="2">'.ucfirst(utf8_encode(strftime('%b/%g', strtotime('-9 months', $today)))).'</th> ';
		$html .= '		<th class="text-center" colspan="2">'.ucfirst(utf8_encode(strftime('%b/%g', strtotime('-8 months', $today)))).'</th> ';
		$html .= '		<th class="text-center" colspan="2">'.ucfirst(utf8_encode(strftime('%b/%g', strtotime('-7 months', $today)))).'</th> ';
		$html .= '		<th class="text-center" colspan="2">'.ucfirst(utf8_encode(strftime('%b/%g', strtotime('-6 months', $today)))).'</th> ';
		$html .= '		<th class="text-center" colspan="2">'.ucfirst(utf8_encode(strftime('%b/%g', strtotime('-5 months', $today)))).'</th> ';
		$html .= '		<th class="text-center" colspan="2">'.ucfirst(utf8_encode(strftime('%b/%g', strtotime('-4 months', $today)))).'</th> ';
		$html .= '		<th class="text-center" colspan="2">'.ucfirst(utf8_encode(strftime('%b/%g', strtotime('-3 months', $today)))).'</th> ';
		$html .= '		<th class="text-center" colspan="2">'.ucfirst(utf8_encode(strftime('%b/%g', strtotime('-2 months', $today)))).'</th> ';
		$html .= '		<th class="text-center" colspan="2">'.ucfirst(utf8_encode(strftime('%b/%g', strtotime('-1 months', $today)))).'</th> ';
		$html .= '		<th class="text-center" colspan="2">'.ucfirst(utf8_encode(strftime('%b/%g', $today))).'</th>';
		$html .= '		<th></th>';
		$html .= '	</tr>';
		$html .= '	<tr>';
		$html .= '		<th>Funcionário</th>';
		$html .= '		<th class="text-center">Saldo</th>';
		$html .= '		<th class="text-center">Atual</th>';
		$html .= '		<th class="text-center">Saldo</th>';
		$html .= '		<th class="text-center">Atual</th>';
		$html .= '		<th class="text-center">Saldo</th>';
		$html .= '		<th class="text-center">Atual</th>';
		$html .= '		<th class="text-center">Saldo</th>';
		$html .= '		<th class="text-center">Atual</th>';
		$html .= '		<th class="text-center">Saldo</th>';
		$html .= '		<th class="text-center">Atual</th>';
		$html .= '		<th class="text-center">Saldo</th>';
		$html .= '		<th class="text-center">Atual</th>';
		$html .= '		<th class="text-center">Saldo</th>';
		$html .= '		<th class="text-center">Atual</th>';
		$html .= '		<th class="text-center">Saldo</th>';
		$html .= '		<th class="text-center">Atual</th>';
		$html .= '		<th class="text-center">Saldo</th>';
		$html .= '		<th class="text-center">Atual</th>';
		$html .= '		<th class="text-center">Saldo</th>';
		$html .= '		<th class="text-center">Atual</th>';
		$html .= '		<th class="text-center">Saldo</th>';
		$html .= '		<th class="text-center">Atual</th>';
		$html .= '		<th class="text-center">Saldo</th>';
		$html .= '		<th class="text-center">Atual</th>';
		$html .= '		<th class="text-center">Saldo</th>';
		$html .= '		<th class="text-center">Atual</th>';
		$html .= '		<th class="text-center">Saldo Total</th>';
		$html .= '	</tr>';
		$html .= '</thead>';
		$html .= '<tbody>';
		foreach($extracts->result() as $value){ 
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
		$arquivo = "Planilha_Horas.xls";  
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
}
?>
