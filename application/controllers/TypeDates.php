<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class TypeDates extends CI_Controller {

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
        $this->load->model('TypeDates_model', 'typedates');
    }	 

	public function index()
	{
		$variaveis['typedates'] = $this->typedates->get();
		$this->load->view('typedates/index', $variaveis);
	}

	public function new()
	{
		$variaveis['titulo'] = 'Novo Tipo de Data';
		$this->load->view('typedates/cadastro', $variaveis);
	}

	public function edit($id = null){
		
		if ($id) {
			
			$typedate = $this->typedates->get($id);
			
			if ($typedate->num_rows() > 0 ) {
				$variaveis['titulo'] = 'Edição de Tipo de Data';
				$variaveis['id'] = $typedate->row()->id;
				$variaveis['name'] = $typedate->row()->name;
				$variaveis['time'] = $typedate->row()->time;
				$this->load->view('typedates/cadastro', $variaveis);
			} else {
				redirect('typedates/index');
			}
			
		}
		
	}

	public function delete($id = null) {
		if ($this->typedates->delete($id)) {
			$retorno = "Registro excluído com sucesso!";
			$this->session->set_flashdata('mensagem', $retorno);
			redirect('typedates/index');
		} else {
			$retorno = "Registro excluído com sucesso!";
			$this->session->set_flashdata('erro', $retorno);
			redirect('typedates/index');

		}
	}

	public function save(){
		
		$this->load->library('form_validation');
		
		$regras = array(
		        array(
		                'field' => 'name',
		                'label' => 'Nome',
		                'rules' => 'trim|required'
				),
		        array(
						'field' => 'time',
						'label' => 'Tempo Base',
						'rules' => 'trim|required'
			)
	);

		$this->form_validation->set_rules($regras);

		if ($this->form_validation->run() == FALSE) {
			$variaveis['titulo'] = 'Novo Registro';
			$this->load->view('typedates/cadastro', $variaveis);
		} else {
			
			$id = $this->input->post('id');


			$dados = array(
			
				"name" => $this->input->post('name'),
				"time" => $this->input->post('time')

			);
			if ($this->typedates->save($dados, $id)) {
				if ($id == null) {
					$retorno = "Cadastro realizado com sucesso";
				} else {
					$retorno = "Cadastro atualizado com sucesso";
				}
				$this->session->set_flashdata('mensagem', $retorno);
				redirect('typedates/index');
			} else {
				$variaveis['mensagem'] = "Ocorreu um erro. Por favor, tente novamente.";
				$this->load->view('typedates/cadastro', $variaveis);
			}
				
		}
	}	
	
}
