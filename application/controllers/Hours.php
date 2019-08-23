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
		$variaveis['employees'] = $this->hours->getEmployees();
		$this->load->view('hours/index', $variaveis);
	}

	public function new()
	{
		$variaveis['titulo'] = 'Nova Hora';
		$variaveis['employees'] = $this->hours->getEmployees();
		$this->load->view('hours/cadastro', $variaveis);
	}

	public function edit($id = null){
		
		if ($id) {
			
			$hour = $this->hours->getEdit($id);
			
			if ($hour->num_rows() > 0 ) {
				$variaveis['employees'] = $this->hours->getEmployees();
				$variaveis['titulo'] = 'Edição de Horas';
				$variaveis['id'] = $hour->row()->id;
				$variaveis['employee'] = $hour->row()->employeefk;
				$variaveis['date'] = $hour->row()->date;
				$variaveis['hour1'] = $hour->row()->hour1;
				$variaveis['hour2'] = $hour->row()->hour2;
				$variaveis['hour3'] = $hour->row()->hour3;
				$variaveis['hour4'] = $hour->row()->hour4;
				$variaveis['hour5'] = $hour->row()->hour5;
				$variaveis['hour6'] = $hour->row()->hour6;
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
			$variaveis['employees'] = $this->hours->getEmployees();
			$this->load->view('hours/cadastro', $variaveis);
		} else {
			
			$id = $this->input->post('id');


			$dados = array(
			
				"employeefk" => $this->input->post('employee'),
				"date" => $this->input->post('date'),
				"hour1" => $this->input->post('hour1'),
				"hour2" => $this->input->post('hour2'),
				"hour3" => $this->input->post('hour3'),
				"hour4" => $this->input->post('hour4'),
				"hour5" => $this->input->post('hour5'),
				"hour6" => $this->input->post('hour6'),

			);
			if ($this->hours->save($dados, $id)) {
				if ($id == null) {
					$retorno = "Cadastro realizado com sucesso";
				} else {
					$retorno = "Cadastro atualizado com sucesso";
				}
				$this->session->set_flashdata('mensagem', $retorno);
				redirect('hours/index');
			} else {
				$variaveis['mensagem'] = "Ocorreu um erro. Por favor, tente novamente.";
				$variaveis['employees'] = $this->hours->getEmployees();
				$this->load->view('hours/cadastro', $variaveis);
			}
				
		}
	}	
	
}
