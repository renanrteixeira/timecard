<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Roles extends CI_Controller {

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
        $this->load->model('Roles_model', 'roles');
    }	 

	public function index()
	{
		$variaveis['roles'] = $this->roles->get();
		$this->load->view('roles/index', $variaveis);
	}

	public function new()
	{
		$variaveis['titulo'] = 'Nova Função';
		$this->load->view('roles/cadastro', $variaveis);
	}

	public function edit($id = null){
		
		if ($id) {
			
			$role = $this->roles->get($id);
			
			if ($role->num_rows() > 0 ) {
				$variaveis['titulo'] = 'Edição de Função';
				$variaveis['id'] = $role->row()->id;
				$variaveis['name'] = $role->row()->name;
				$this->load->view('roles/cadastro', $variaveis);
			} else {
				redirect('roles/index');
			}
			
		}
		
	}

	public function delete($id = null) {
		if ($this->roles->delete($id)) {
			$retorno = "Registro excluído com sucesso!";
			$this->session->set_flashdata('mensagem', $retorno);
			redirect('roles/index');
		} else {
			$retorno = "Registro excluído com sucesso!";
			$this->session->set_flashdata('erro', $retorno);
			redirect('roles/index');

		}
	}

	public function save(){
		
		$this->load->library('form_validation');
		
		$regras = array(
		        array(
		                'field' => 'name',
		                'label' => 'Nome',
		                'rules' => 'trim|required'
		        )
		);

		$this->form_validation->set_rules($regras);

		if ($this->form_validation->run() == FALSE) {
			$variaveis['titulo'] = 'Novo Registro';
			$this->load->view('roles/cadastro', $variaveis);
		} else {
			
			$id = $this->input->post('id');


			$dados = array(
			
				"name" => $this->input->post('name')

			);
			if ($this->roles->save($dados, $id)) {
				if ($id == null) {
					$retorno = "Cadastro realizado com sucesso";
				} else {
					$retorno = "Cadastro atualizado com sucesso";
				}
				$this->session->set_flashdata('mensagem', $retorno);
				redirect('roles/index');
			} else {
				$variaveis['mensagem'] = "Ocorreu um erro. Por favor, tente novamente.";
				$this->load->view('roles/cadastro', $variaveis);
			}
				
		}
	}	
	
}
