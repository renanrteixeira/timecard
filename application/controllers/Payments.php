<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Payments extends CI_Controller {

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
		$variaveis['hours'] = $this->hours->getPayments($this->input->post('employee'), $this->input->post('date'));
		$variaveis['employees'] = $this->hours->getEmployees();
		$this->load->view('payments/index', $variaveis);
	}

	public function new()
	{
		$variaveis['titulo'] = 'Novo Abatimento';
		$variaveis['employees'] = $this->hours->getEmployees();
		$this->load->view('payments/cadastro', $variaveis);
	}

	public function edit($id = null){
		
		if ($id) {
			
			$hour = $this->hours->getEdit($id);
			
			if ($hour->num_rows() > 0 ) {
				$variaveis['employees'] = $this->hours->getEmployees();
				$variaveis['titulo'] = 'Edição de Abatimento';
				$variaveis['id'] = $hour->row()->id;
				$variaveis['employee'] = $hour->row()->employeefk;
				$variaveis['date'] = $hour->row()->date;
				$variaveis['payment'] = $hour->row()->hour1;
				$this->load->view('payments/cadastro', $variaveis);
			} else {
				redirect('payments/index');
			}
			
		}
		
	}

	public function delete($id = null) {
		if ($this->hours->delete($id)) {
			$retorno = "Registro excluído com sucesso!";
			$this->session->set_flashdata('mensagem', $retorno);
			redirect('payments/index');
		} else {
			$retorno = "Erro ao tentar excluir o registro!";
			$this->session->set_flashdata('erro', $retorno);
			redirect('payments/index');

		}
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
						'field' => 'payment',
						'label' => 'Abatimento de Horas',
						'rules' => 'trim|required'
				)

		);

		$this->form_validation->set_rules($regras);

		
		$this->form_validation->set_rules('date', 'Data de Lançameto', 'trim|required|callback_checkDateFormat');

		if ($this->form_validation->run() == FALSE) {
			$variaveis['titulo'] = 'Novo Abatimento';
			$variaveis['employees'] = $this->hours->getEmployees();
			$this->load->view('payments/cadastro', $variaveis);
		} else {
			
			$id = $this->input->post('id');

			$existe = $this->hours->getPayments($this->input->post('employee'), $this->input->post('date'));

			if (($existe->result()) && (!$id)){
				$variaveis['titulo'] = 'Novo Abatimento';
				$variaveis['mensagem'] = "Lançamento já foi cadastrado.";
				$variaveis['employees'] = $this->hours->getEmployees();
				$this->load->view('payments/cadastro', $variaveis);
			} else {

				$time = $this->hours->getTypeDates($this->input->post('typedate'));
				
				$hourbase = $time->row()->time;

				if ($id) {

					$payment  = $this->input->post('payment');
				
				} else {

					$payment  = $this->input->post('payment').':00';
				}


				//$payment = date('H:i:s', $payment);
                //echo $payment;
				$payment = '-'.$payment;
				$string = $this->input->post('employee') . date('d/m/Y H:i:s') . mt_rand();
				$sha1 = sha1($string);			
				//echo  'Base: '.$hourbase.'  -  Convertido: '.strtotime($hourbase).'  -  Entrada: '.$Entadamanha.'  -  Convertido: '.strtotime($Entadamanha);
				$dados = array(

					"id" => $sha1,
					"employeefk" => $this->input->post('employee'),
					"date" => $this->input->post('date'),
					"type" => 1,
					"hour1" => $this->input->post('payment'),
					"balance" => $payment
				);

				if ($this->hours->save($dados, $id)) {
					if ($id == null) {
						$retorno = "Cadastro realizado com sucesso!";
					} else {
						$retorno = "Cadastro atualizado com sucesso!";
					}
					$this->session->set_flashdata('mensagem', $retorno);
					redirect('payments/index');
				} else {
					$variaveis['mensagem'] = "Ocorreu um erro. Por favor, tente novamente.";
					$variaveis['employees'] = $this->hours->getEmployees();
					$this->load->view('payments/cadastro', $variaveis);
				}							
			}
				
		}
	}	
	
	
}
?>
