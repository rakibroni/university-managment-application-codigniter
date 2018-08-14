<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ApplicationSetting extends CI_Controller 
{
    private $user_session;
    
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('logged_in') == FALSE) {
            redirect('auth/login', 'refresh');
        }
        $this->user_session = $this->session->userdata('logged_in');
        $this->user = $this->session->userdata("logged_in");
        // $user_session = $this->user = $this->session->userdata('logged_in');
        // $this->user_id = $user_session['USER_TYPE'];

        header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        $this->load->model('utilities');
    }

    /*
     * @methodName checkPrevilege()
     * @access
     * @param  none
     * @return Mixed View
     */

    public function checkPrevilege($param = "")
    {
        if ($param == "") {
            $controller = $this->uri->segment(1, 'dashboard');
            $action = $this->uri->segment(2, 'index');
            $link = "$controller/$action";
        } else {
            $link = "$param";
        }
        return $this->security_model->get_all_checked_module_links_by_user($link, $this->user_session['USERGRP_ID'], $this->user_session['USERLVL_ID'], $this->user_session['USER_ID']);
    }

    /**
     * @methodName  index()
     * @access
     * @param       None
     * @author      aminul  <aminul@atilimited.net>
     * @return      application setting list
     */
    public function index()
    {

        $data['contentTitle'] = 'Application Setting';
        $data["breadcrumbs"] = array(
            "Application" => "Application/index",
            "Dashboard" => '#'
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['pageTitle'] = 'Online University Management System';
        $data['appli_setting']  = $this->utilities->findAllByAttribute(" application_setting", array("ACTIVE_STATUS" => 1)); 
        //echo '<pre>';print_r($data['appli_setting']);exit;
        $data['content_view_page'] = 'application_setting/application_setting_index';
        $this->admin_template->display($data);
    }
    /**     
     * @access
     * @param       None add_application_setting
     * @author      aminul  <aminul@atilimited.net>
     */
    public function addApplicationSetting()
    {
     $this->load->view('application_setting/add_application_setting');
 }
    /** 
     * @this function use for save application data save    
     * @access
     * @param       None add_application_setting
     * @author      aminul  <aminul@atilimited.net>
     */
    public function saveApplicationSetting()
    {
    //echo '<pre>';print_r($_SESSION);exit;
       $this->user = $this->session->userdata("logged_in");
       $applicnt_personal_info = array(
        'APPLICATION_THEME' => $this->input->post('APPLICATION_THEME'),
        'LOGO_BACKGROUND'   => $this->input->post('LOGO_BACKGROUND'),
        'SIDEBER_M_C'       => $this->input->post('SIDEBER_M_C'),
        'OPEN_M_B_C'        => $this->input->post('OPEN_M_B_C'),
        'ON_CLICK_M_B_C'    => $this->input->post('ON_CLICK_M_B_C'),
        'ON_MOUSE_O_M_C'    => $this->input->post('ON_MOUSE_O_M_C'),
        'ON_MOUSE_O_M_C'    => $this->input->post('ON_MOUSE_O_M_C'),
        'MENUE_FONT_H_C'    => $this->input->post('MENUE_FONT_H_C'),
        'MENUE_FONT_A_C'    => $this->input->post('MENUE_FONT_A_C'),
        'ON_CLICK_T_H_C'    => $this->input->post('ON_CLICK_T_H_C'),
        'MENUE_FONT_C'      => $this->input->post('MENUE_FONT_C'),
        'ACTIVE_BY_AD'      => $this->user["USER_ID"],
        'CREATED_BY'       => $this->input->post('CREATED_BY'),
        "CREATED_BY"       => $this->user["USER_ID"],
        //'APPLICATION_THEME'=> $this->input->post('APPLICATION_THEME'),

    );
            // print_r($applicnt_personal_info);exit;
       $this->utilities->insert('application_setting', $applicnt_personal_info);
       $this->session->set_flashdata('Success', 'Application Setting Information Insert Successfully.');
       redirect('ApplicationSetting/index', 'refresh');
   }

    /** APPLICATION_SETT_ID   
     * @this function use for show application edit form 
     * @access
     * @param       None add_application_setting
     * @author      aminul  <aminul@atilimited.net>
     */
    public function editApplicationForm()
    {
        $id=$this->input->post('param');
        $data['pid']=$id;    
        $data['application_sett'] = $this->utilities->findByAttribute('application_setting', array('APPLICATION_SETT_ID' => $id));
        $this->load->view('application_setting/update_application_setting_form',$data);
    }
/** 
     * @this function use for update application data save    
     * @access
     * @param       None add_application_setting
     * @author      aminul  <aminul@atilimited.net>
     */
public function updateApplicationSetting()
{
    //echo '<pre>';print_r($_SESSION);exit;
   $this->user = $this->session->userdata("logged_in");
   $APPLICATION_SETT_ID=$this->input->post('APPLICATION_SETT_ID');
   $applicnt_personal_info = array(
    'APPLICATION_THEME' => $this->input->post('APPLICATION_THEME'),
    'LOGO_BACKGROUND'   => $this->input->post('LOGO_BACKGROUND'),
    'SIDEBER_M_C'       => $this->input->post('SIDEBER_M_C'),
    'OPEN_M_B_C'        => $this->input->post('OPEN_M_B_C'),
    'ON_CLICK_M_B_C'    => $this->input->post('ON_CLICK_M_B_C'),
    'ON_MOUSE_O_M_C'    => $this->input->post('ON_MOUSE_O_M_C'),
    'ON_MOUSE_O_M_C'    => $this->input->post('ON_MOUSE_O_M_C'),
    'MENUE_FONT_H_C'    => $this->input->post('MENUE_FONT_H_C'),
    'MENUE_FONT_A_C'    => $this->input->post('MENUE_FONT_A_C'),
    'ON_CLICK_T_H_C'    => $this->input->post('ON_CLICK_T_H_C'),
    'MENUE_FONT_C'      => $this->input->post('MENUE_FONT_C'),
    'ACTIVE_BY_AD'      => $this->user["USER_ID"],
    'UPDATE_DATE'       => date('Y-m-d'),
    "UPDATE_BY"       => $this->user["USER_ID"],
   // 'APPLICATION_THEME'=> $this->input->post('APPLICATION_THEME'),

);

   $this->utilities->updateData('application_setting', $applicnt_personal_info, array('APPLICATION_SETT_ID' => $APPLICATION_SETT_ID));
   $this->session->set_flashdata('Success', 'Application Setting Information Updated Successfully.');
   redirect('ApplicationSetting/index', 'refresh');
}

 /**  
     * @this function use for chage application status 
     * @access
     * @param       None add_application_setting
     * @author      aminul  <aminul@atilimited.net>
     */
 public function changeStatus()
 {

    $id=$this->input->post('param');
    echo $id;exit;
    $data['pid']=$id;    
    $this->user = $this->session->userdata("logged_in");
    $applicnt_personal_info = array(
        'ACTIVE_STATUS'     => '0',
        'UPDATE_DATE'       => date('Y-m-d'),
        "UPDATE_BY"         => $this->user["USER_ID"],

    );
    
    $this->utilities->updateData('application_setting', $applicnt_personal_info, array('APPLICATION_SETT_ID' => $id));
    $this->session->set_flashdata('Success', 'Application Setting Information Updated Successfully.');
    redirect('ApplicationSetting/index', 'refresh');
}

}
