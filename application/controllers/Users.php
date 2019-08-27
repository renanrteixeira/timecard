<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Users extends CI_Controller {

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
        $this->load->model('Users_model', 'users');
    }	 

	public function index()
	{
		$variaveis['users'] = $this->users->get();
		$this->load->view('users/index', $variaveis);
	}

	public function new()
	{
		$variaveis['titulo'] = 'Novo Usuário';
		$this->load->view('users/cadastro', $variaveis);
	}

	public function edit($id = null){
		
		if ($id) {
			
			$user = $this->users->get($id);
			
			if ($user->num_rows() > 0 ) {
				$variaveis['titulo'] = 'Edição de Usuário';
				$variaveis['user_id'] = $user->row()->user_id;
				$variaveis['name'] = $user->row()->name;
				$variaveis['email'] = $user->row()->email;
				$variaveis['password'] = $user->row()->password;
				$variaveis['confirmpassword'] = $user->row()->password;
				$variaveis['status'] = $user->row()->status;
				$this->load->view('users/cadastro', $variaveis);
			} else {
				redirect('useres/index');
			}
			
		}
		
	}

	public function delete($id = null) {
		if ($this->users->delete($id)) {
			$retorno = "Registro excluído com sucesso!";
			$this->session->set_flashdata('mensagem', $retorno);
			redirect('users/index');
		} else {
			$retorno = "Registro excluído com sucesso!";
			$this->session->set_flashdata('erro', $retorno);
			redirect('users/index');

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
		                'field' => 'email',
		                'label' => 'E-mail',
		                'rules' => 'trim|required|valid_email'		                
		        ),
		        array(
		                'field' => 'password',
		                'label' => 'Password',
						'rules' => 'required'
				),
		        array(
						'field' => 'confirmpassword',
						'label' => 'Confirmação Password',
						'rules' => 'required|matches[password]'
				),
	    		array(
						'field' => 'status',
						'label' => 'Status',
						'rules' => 'trim|required'
					)
		);

		$this->form_validation->set_rules($regras);

		if ($this->form_validation->run() == FALSE) {
			$variaveis['titulo'] = 'Novo Registro';
			$this->load->view('users/cadastro', $variaveis);
		} else {
			
			$id = $this->input->post('user_id');

			$email = $this->input->post('email');
			
			if ($id == NULL){

			   $existe = $this->users->getEmail($email);
			   
			}
			
			if (!IS_NULL($existe)) {
				$variaveis['titulo'] = 'Novo Registro';
				$variaveis['mensagem'] = "E-mail informado já foi cadastrado";
				$this->load->view('users/cadastro', $variaveis);
			} else {

				$dados = array(
				
					"name" => $this->input->post('name'),
					"status" => $this->input->post('status'),
					"email" => $this->input->post('email'),
					"password" => $this->input->post('password')
				
				);
				
				if ($this->users->save($dados, $id)) {
					if ($id == null) {
						$retorno = "Cadastro realizado com sucesso";
					} else {
						$retorno = "Cadastro atualizado com sucesso";
					}
					//$this->load->view('users/index', $variaveis);
					$this->session->set_flashdata('mensagem', $retorno);
					redirect('users/index');
				} else {
					$variaveis['mensagem'] = "Ocorreu um erro. Por favor, tente novamente.";
					$this->load->view('users/cadastro', $variaveis);
				}
			}
				
		}
	}	
	
}

?>
