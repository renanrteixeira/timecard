<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Hours extends CI_Controller {

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
		$variaveis['hours'] = $this->hours->get(null,$this->input->post('employee'), $this->input->post('date'));
		$variaveis['typedates'] = $this->hours->getTypeDates();
		$variaveis['employees'] = $this->hours->getEmployees();
		$this->load->view('hours/index', $variaveis);
	}

	public function new()
	{
		$variaveis['titulo'] = 'Nova Hora';
		$variaveis['employees'] = $this->hours->getEmployees();
		$variaveis['typedates'] = $this->hours->getTypeDates();
		$this->load->view('hours/cadastro', $variaveis);
	}

	public function edit($id = null){
		
		if ($id) {
			
			$hour = $this->hours->getEdit($id);
			
			if ($hour->num_rows() > 0 ) {
				$variaveis['employees'] = $this->hours->getEmployees();
				$variaveis['typedates'] = $this->hours->getTypeDates();
				$variaveis['titulo'] = 'Edição de Horas';
				$variaveis['id'] = $hour->row()->id;
				$variaveis['employee'] = $hour->row()->employeefk;
				$variaveis['date'] = $hour->row()->date;
				$variaveis['typedate'] = $hour->row()->typedatefk;
				$variaveis['hour1'] = $hour->row()->hour1;
				$variaveis['hour2'] = $hour->row()->hour2;
				$variaveis['hour3'] = $hour->row()->hour3;
				$variaveis['hour4'] = $hour->row()->hour4;
				$variaveis['hour5'] = $hour->row()->hour5;
				$variaveis['hour6'] = $hour->row()->hour6;
				$variaveis['balance'] = $hour->row()->balance;
				$this->load->view('hours/cadastro', $variaveis);
			} else {
				redirect('hours/index');
			}
			
		}
		
	}

	public function delete($id = null) {
		if ($this->hours->delete($id)) {
			$retorno = "Registro excluído com sucesso!";
			$this->session->set_flashdata('mensagem', $retorno);
			redirect('hours/index');
		} else {
			$retorno = "Registro excluído com sucesso!";
			$this->session->set_flashdata('erro', $retorno);
			redirect('hours/index');

		}
	}

	//Transforma as horas em "inteiro"
	function toUnixTime($total) {
		$negativo = false;
		if (strpos($total, '-') === 0) {
			$negativo = true;
			$total = str_replace('-', '', $total);
		}

		list($horas, $minutos, $segundos) = explode(':', $total);
		$ut = mktime($horas, $minutos, $segundos);
		if ($negativo) {
			return -$ut;
		}

		return $ut;
	}

	//Gera horarios acima de 24 horas (para calculo total)
	function getFullHour($input) {
		$seconds = intval($input);
		$resp = NULL;//Em caso de receber um valor não suportado retorna nulo

		if (is_int($seconds)) {
			$hours = floor($seconds / 3600);
			$mins = floor(($seconds - ($hours * 3600)) / 60);
			$secs = '00';//floor($seconds % 60);

			$resp = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
		}

		return $resp;
	}	

	public function save(){
		
		$this->load->library('form_validation');
		
		$regras = array(
		        array(
		                'field' => 'employee',
		                'label' => 'Funcionário',
		                'rules' => 'trim|required'
				),
		        array(
						'field' => 'date',
						'label' => 'Data de Lançameto',
						'rules' => 'trim|required'
				),
		        array(
						'field' => 'hour1',
						'label' => 'Entrada Manhã',
						'rules' => 'trim|required'
				)

		);

		$this->form_validation->set_rules($regras);

		if ($this->form_validation->run() == FALSE) {
			$variaveis['titulo'] = 'Nova Hora';
			$variaveis['typedates'] = $this->hours->getTypeDates();
			$variaveis['employees'] = $this->hours->getEmployees();
			$this->load->view('hours/cadastro', $variaveis);
		} else {
			
			$id = $this->input->post('id');

			$existe = $this->hours->get(null, $this->input->post('employee'), $this->input->post('date'));

			if (($existe->result()) && (!$id)){
				$variaveis['titulo'] = 'Nova Hora';
				$variaveis['mensagem'] = "Lançamento já foi cadastrado.";
				$variaveis['typedates'] = $this->hours->getTypeDates();
				$variaveis['employees'] = $this->hours->getEmployees();
				$this->load->view('hours/cadastro', $variaveis);
			} else {

				$time = $this->hours->getTypeDates($this->input->post('typedate'));
				
				$hourbase = $time->row()->time;

				if ($id) {

					$Entradamanha  = $this->input->post('hour1');
					$Saidamanha   = $this->input->post('hour2');
					$Entradatarde = $this->input->post('hour3');
					$Saidatarde   = $this->input->post('hour4');
					$Entradaextra = $this->input->post('hour5');
					$Saidaextra   = $this->input->post('hour6');
				
				} else {

					$Entradamanha  = $this->input->post('hour1').':00';
					$Saidamanha   = $this->input->post('hour2').':00';
					$Entradatarde = $this->input->post('hour3').':00';
					$Saidatarde   = $this->input->post('hour4').':00';
					$Entradaextra = $this->input->post('hour5').':00';
					$Saidaextra   = $this->input->post('hour6').':00';
				}


<<<<<<< HEAD
				$balance = ((strtotime($Saidamanha) - strtotime($Entradamanha))+
						    (strtotime($Saidatarde) - strtotime($Entradatarde))+
							(strtotime($Saidaextra) - strtotime($Entradaextra)));
							
				$balance = date('H:i:s', $balance);

				if (strtotime($balance) < strtotime($hourbase)) {
					$balance = strtotime($hourbase) - strtotime($balance);
					// Encontra as horas trabalhadas
					$hours      = floor($balance / 60 / 60);	
					// Encontra os minutos trabalhados
					$minutes    = round(($balance - ($hours * 60 * 60)) / 60);						

					$balance = $hours.':'.$minutes.':00';
					$balance = '-'.$balance;
				} else {
					$balance = strtotime($balance) - strtotime($hourbase);
					// Encontra as horas trabalhadas
					$hours      = floor($balance / 60 / 60);	
					// Encontra os minutos trabalhados
					$minutes    = round(($balance - ($hours * 60 * 60)) / 60);						

					// Formata a hora e minuto para ficar no formato de 2 números, exemplo 00
					$hours = str_pad($hours, 2, "0", STR_PAD_LEFT);
					$minutes = str_pad($minutes, 2, "0", STR_PAD_LEFT);				

					$balance = $hours.':'.$minutes.':00';
				}			
		

/*
				outra forma

=======
>>>>>>> e1c06f2fd35b812d707f58724b266d1e27ffd9cb
				$balance = ((strtotime($Saidamanha) - strtotime($Entradamanha))+
						    (strtotime($Saidatarde) - strtotime($Entradatarde))+
						    (strtotime($Saidaextra) - strtotime($Entradaextra)));
				
				$balance = date('H:i:s', $balance);
				 
			    if (strtotime($balance) < strtotime($hourbase)) {
					$balance = strtotime($hourbase) - strtotime($balance);
					$balance = date('H:i:s', $balance);
					$balance = '-'.$balance;
				} else {
					$balance = strtotime($balance) - strtotime($hourbase);
					$balance = date('H:i:s', $balance);
				}
			
<<<<<<< HEAD
/*			  
=======
			
	/*		  
>>>>>>> e1c06f2fd35b812d707f58724b266d1e27ffd9cb
			    $h1 = $this->toUnixTime($Entradamanha);
			    $h2 = $this->toUnixTime($Saidamanha);
			    $h3 = $this->toUnixTime($Entradatarde);
			    $h4 = $this->toUnixTime($Saidatarde);
			    $h5 = $this->toUnixTime($Entradaextra);
			    $h6 = $this->toUnixTime($Saidaextra);
			   
				$balance = (($h2 - $h1) +
							($h4 - $h3) +
							($h6 - $h5));

     			$balance = $this->getFullHour($balance);
				
                if ($this->toUnixTime($balance) < $this->toUnixTime($hourbase)) {

					$balance = $this->toUnixTime($hourbase) - $this->toUnixTime($balance);

					$balance = $this->getFullHour($balance);
					
					$balance = '-'.$balance;
	
				} else {
					$balance = $this->toUnixTime($balance) - $this->toUnixTime($hourbase);

					$balance = $this->getFullHour($balance);
				}*/
<<<<<<< HEAD

=======
>>>>>>> e1c06f2fd35b812d707f58724b266d1e27ffd9cb

				//echo  'Base: '.$hourbase.'  -  Convertido: '.strtotime($hourbase).'  -  Entrada: '.$Entradamanha.'  -  Convertido: '.strtotime($Entradamanha).' Balance: '.$balance;
				$dados = array(
					

					"employeefk" => $this->input->post('employee'),
					"date" => $this->input->post('date'),
					"typedatefk" => $this->input->post('typedate'),
					"hour1" => $this->input->post('hour1'),
					"hour2" => $this->input->post('hour2'),
					"hour3" => $this->input->post('hour3'),
					"hour4" => $this->input->post('hour4'),
					"hour5" => $this->input->post('hour5'),
					"hour6" => $this->input->post('hour6'),
					"balance" => $balance
				);

				if ($this->hours->save($dados, $id)) {
					if ($id == null) {
						$retorno = "Cadastro realizado com sucesso";
					} else {
						$retorno = "Cadastro atualizado com sucesso";
					}
					$this->session->set_flashdata('retorno', $retorno);
					redirect('hours/new');
				} else {
					$variaveis['mensagem'] = "Ocorreu um erro. Por favor, tente novamente.";
					$variaveis['typedates'] = $this->hours->getTypeDates();
					$variaveis['employees'] = $this->hours->getEmployees();
					$this->load->view('hours/cadastro', $variaveis);
				}							
			}
				
		}
	}	
	
	
}
?>
