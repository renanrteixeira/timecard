<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class PersonalStatement extends CI_Controller {

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
		$variaveis['extract'] = $this->hours->getPersonalStatment($this->input->post('employee'), $this->input->post('mes'));
		$variaveis['employee'] = $this->hours->getEmployee($this->input->post('employee'));
		$variaveis['periodo'] = $this->input->post('mes');
		$variaveis['employees'] = $this->hours->getEmployees();
		$variaveis['companies'] = $this->hours->getCompanies();
		$this->load->view('personalstatement/index', $variaveis);
	}
	
}

?>
