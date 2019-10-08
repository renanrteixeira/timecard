<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Users Controller
 *
 * @author Team TechArise
 *
 * @email info@techarise.com
 */
   
    public function __construct() {
        parent::__construct();
				$this->load->model('Users_model', 'user');
				$this->load->helper(array('cookie', 'url')); 
    }
  // Dashboard
  public function index()
  {
    if ($this->session->userdata('is_authenticated') == FALSE) {
						redirect('Login/login'); // the user is not logged in, redirect them!
					} else {
      $data['title'] = 'Controle Ponto';
          $data['metaDescription'] = 'Controle';
          $data['metaKeywords'] = 'Ponto';
          $this->user->setUserID($this->session->userdata('user_id'));
					$data['userInfo'] = $this->user->getUserInfo();
					//direcionando para o HomeController
          $this->load->view('dashboard/home', $data);
      }
  }
        // Login
  public function login()
  {
  $data['title'] = 'Login';
        $data['metaDescription'] = 'Login';
        $data['metaKeywords'] = 'Login';
        $this->load->view('users/login', $data);
  }
  // Login Action 
  function doLogin() {
    // Check form  validation
    $this->load->library('form_validation');

    $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'trim|required');

    if($this->form_validation->run() == FALSE) {
      //Field validation failed.  User redirected to login page
      $this->load->view('login/login');
    } else {  
      $sessArray = array();
      //Field validation succeeded.  Validate against database
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      $remember = $this->input->post('rememberme');

      $this->user->setEmail($email);
      //$this->user->setPassword(MD5($password));
			$this->user->setPassword($password);

      //query the database
      $result = $this->user->login();
      
      if($result) {

				if ($this->input->post("rememberme")){                    
          $this->input->set_cookie('timecardlogin', $this->input->post('email'), time() + (86400)); /* 86400 = 1 day */
        } else {
					delete_cookie('timecardlogin');
				}

        foreach($result as $row) {
          $sessArray = array(
            'user_id' => $row->user_id,
            'name' => $row->name,
            'email' => $row->email,
            'admin' => 'S',
            'is_authenticated' => TRUE,
          );
        $this->session->set_userdata($sessArray);
        }

        redirect('dashboard/index');
      } else {
        redirect('Login/login?msg=1');
      } 
    }
  }
  // Logout
  public function logout() {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('name');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('is_authenticated');
        $this->session->sess_destroy();
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        redirect('Login/login');
    }
}
?>
