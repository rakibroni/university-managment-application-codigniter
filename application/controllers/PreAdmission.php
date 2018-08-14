<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PreAdmission extends CI_Controller {

    /**
     * @methodName login()
     * @access 
     * @param  
     * @author      Rakib Roni <rakib@atilimited.net>
     * @return      login template
     */
    function index() {
        $degreeList = $this->utilities->findAllFromView('degree');
        $fecultyList = $this->utilities->findAllFromView('faculty');
        $courseList = $this->utilities->findAllFromView('course');
        $this->load->view('preAdmission');
    }
    function login() {

        $this->form_validation->set_rules('user_name', 'Username', 'required|callback_checkDatabase');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
        } else {
            $session_info = $this->session->userdata('logged_in');
            if ($session_info['ORG_ID'] == 1) {
                $this->session->set_flashdata('Info', "Welcome To Student Management System - Admin Panel!");
                redirect('admin/index', 'refresh');
            }
        }
    }

    /**
     * @methodName checkDatabase()
     * @access 
     * @param  
     * @author      Rakib Roni <rakib@atilimited.net>
     * @return      check user
     */
    function checkDatabase($username) {

        $password = $this->input->post('password');
        //var_dump($password); die();
        $hashPassword = $this->utilities->get_field_value_by_attribute('sa_users', 'USERPW', array('USERNAME' => $username));
        if (password_verify($password, $hashPassword)) {
            $result = $this->auth_model->login($username, $hashPassword);
            if (!empty($result)) {
                $sess_array = array(
                    'USERNAME' => $this->input->post('user_name'),
                    'EMAIL' => $this->input->post('email'),
                    'ORG_ID' => 1
                );
                if ($result->ACTIVE_STATUS != 0) {
                    $this->session->set_userdata('logged_in', $sess_array);
                    return TRUE;
                } else {
                    $this->form_validation->set_message('check_database', 'Whoops! We didn\'t recognise your username or password. Please try again.');
                    return false;
                }
            }
        } else {
            $this->form_validation->set_message('check_database', 'Whoops! We didn\'t recognise your username or password. Please try again.');
            return false;
        }
    }

    /**
     * @methodName register()
     * @access 
     * @param  
     * @author     Rakib Roni <rakib@atilimited.net>
     * @return register template
     */
    function register() {

        $this->form_validation->set_rules('user_name', 'user name', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('register');
        } else {
            //Get password from form
            $password = $this->input->post('password'); //adding true runs the XSS filter.
            //Hash Password
            $password = password_hash($password, PASSWORD_BCRYPT);

            $user_information = array(
                'USERNAME' => $this->input->post('user_name'),
                'EMAIL' => $this->input->post('email'),
                'USERPW' => $password,
                'ORG_ID' => 1
            );
            $this->utilities->insertDataWithReturn('sa_users', $user_information);

            $sess_array = array(
                'USERNAME' => $this->input->post('user_name'),
                'EMAIL' => $this->input->post('email'),
                'ORG_ID' => 1
            );
            $this->session->set_userdata('logged_in', $sess_array);
            redirect('admin/index');
        }
    }

    /**
     * @methodName logut()
     * @access 
     * @param  
     * @author     Rakib Roni <rakib@atilimited.net>
     * @return     logut user
     */
    function logout() {
        $this->session->unset_userdata('logged_in');
        redirect('auth/login', 'refresh');
    }

}
