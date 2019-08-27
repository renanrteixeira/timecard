<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Employees extends CI_Controller {

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
        $this->load->model('Employees_model', 'employees');
    }	 

	public function index()
	{
		$variaveis['employees'] = $this->employees->get();
		$this->load->view('employees/index', $variaveis);
	}

	public function new()
	{
		$variaveis['titulo'] = 'Novo Funcionário';
		$variaveis['roles'] = $this->employees->getRoles();
		$this->load->view('employees/cadastro', $variaveis);
	}

	public function edit($id = null){
		
		if ($id) {
			
			$employee = $this->employees->getEdit($id);
			
			if ($employee->num_rows() > 0 ) {
				$variaveis['roles'] = $this->employees->getRoles();
				$variaveis['titulo'] = 'Edição de Funcionário';
				$variaveis['id'] = $employee->row()->id;
				$variaveis['name'] = $employee->row()->name;
				$variaveis['role'] = $employee->row()->rolefk;
				$variaveis['birth'] = $employee->row()->birth;
				$variaveis['gender'] = $employee->row()->gender;
				$variaveis['status'] = $employee->row()->status;
				$this->load->view('employees/cadastro', $variaveis);
			} else {
				redirect('employees/index');
			}
			
		}
		
	}

	public function delete($id = null) {
		if ($this->employees->delete($id)) {
			$retorno = "Registro excluído com sucesso!";
			$this->session->set_flashdata('mensagem', $retorno);
			redirect('employees/index');
		} else {
			$retorno = "Registro excluído com sucesso!";
			$this->session->set_flashdata('erro', $retorno);
			redirect('employees/index');

		}
	}

	public function save(){
		
		$this->load->library('form_validation');
		
         if (is_null($this->input->post('status'))){
			$_POST['status'] = 0;
		 } else {
			$_POST['status'] = 1; 
		 }

        $regras = array(
			array(
					'field' => 'name',
					'label' => 'Nome',
					'rules' => 'trim|required'
			),
			array(
					'field' => 'role',
					'label' => 'Função',
					'rules' => 'trim|required'
			),
			array(
					'field' => 'birth',
					'label' => 'Aniversário',
					'rules' => 'trim|required'
			),
			array(
					'field' => 'gender',
					'label' => 'Sexo',
					'rules' => 'trim|required'
			),
			array(
					'field' => 'status',
					'label' => 'Status',
					'rules' => 'trim|required'
		)

		);

		$this->form_validation->set_rules($regras);

		if ($this->form_validation->run() == FALSE) {
			$variaveis['titulo'] = 'Novo Funcionário';
			$variaveis['employees'] = $this->employees->get();
			$variaveis['roles'] = $this->employees->getRoles();
			$this->load->view('employees/cadastro', $variaveis);
		} else {
			
			$id = $this->input->post('id');


			$dados = array(
			
				"name" => $this->input->post('name'),
				"rolefk" => $this->input->post('role'),
				"birth" => $this->input->post('birth'),
				"gender" => $this->input->post('gender'),
				"status" => $this->input->post('status'),

			);
			if ($this->employees->save($dados, $id)) {
				if ($id == null) {
					$retorno = "Cadastro realizado com sucesso";
				} else {
					$retorno = "Cadastro atualizado com sucesso";
				}
				$this->session->set_flashdata('mensagem', $retorno);
				redirect('employees/index');
			} else {
				$variaveis['mensagem'] = "Ocorreu um erro. Por favor, tente novamente.";
				$variaveis['employees'] = $this->employees->get();
				$variaveis['roles'] = $this->employees->getRoles();
				$this->load->view('employees/cadastro', $variaveis);
			}
				
		}
	}	
	
}
?>
