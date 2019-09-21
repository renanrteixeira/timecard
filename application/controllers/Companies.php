<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Companies extends CI_Controller {

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
        $this->load->model('Companies_model', 'companies');
    }	 

	public function index()
	{
		$variaveis['companies'] = $this->companies->get();
		$this->load->view('companies/index', $variaveis);
	}

	public function new()
	{
		$variaveis['titulo'] = 'Nova Empresa';
		$this->load->view('companies/cadastro', $variaveis);
	}

	public function edit($id = null){
		
		if ($id) {
			
			$company = $this->companies->get($id);
			
			if ($company->num_rows() > 0 ) {
				$variaveis['titulo'] = 'Edição de Empresa';
				$variaveis['id'] = $company->row()->id;
				$variaveis['name'] = $company->row()->name;
				$variaveis['address'] = $company->row()->address;
				$variaveis['telephone'] = $company->row()->telephone;
				$this->load->view('companies/cadastro', $variaveis);
			} else {
				redirect('companies/index');
			}
			
		}
		
	}

	public function delete($id = null) {
		if ($this->companies->delete($id)) {
			$retorno = "Registro excluído com sucesso!";
			$this->session->set_flashdata('mensagem', $retorno);
			redirect('companies/index');
		} else {
			$retorno = "Registro excluído com sucesso!";
			$this->session->set_flashdata('erro', $retorno);
			redirect('companies/index');

		}
	}

	public function save(){
		
		$this->load->library('form_validation');
		
		$regras = array(
		        array(
		                'field' => 'name',
		                'label' => 'Nome',
		                'rules' => 'trim|required',

		                'field' => 'address',
		                'label' => 'Endereço',
		                'rules' => 'trim|required',

		                'field' => 'telephone',
		                'label' => 'Telefone',
		                'rules' => 'trim|required|numeric',
					)
		);

		$this->form_validation->set_rules($regras);

		if ($this->form_validation->run() == FALSE) {
			$variaveis['titulo'] = 'Novo Registro';
			$this->load->view('companies/cadastro', $variaveis);
		} else {
			
			$id = $this->input->post('id');


			$dados = array(
			
				"name" => $this->input->post('name'),
				"address" => $this->input->post('address'),
				"telephone" => $this->input->post('telephone')

			);
			if ($this->companies->save($dados, $id)) {
				if ($id == null) {
					$retorno = "Cadastro realizado com sucesso";
				} else {
					$retorno = "Cadastro atualizado com sucesso";
				}
				$this->session->set_flashdata('mensagem', $retorno);
				redirect('companies/index');
			} else {
				$variaveis['mensagem'] = "Ocorreu um erro. Por favor, tente novamente.";
				$this->load->view('companies/cadastro', $variaveis);
			}
				
		}
	}	
	
}
?>
