<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notice extends CI_Controller {

    private $user_session;     
    public $user_id=null; 
    
    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('logged_in') == FALSE) {
            redirect('auth/login', 'refresh');
        }



        $this->user_session = $this->session->userdata('logged_in');
        $user_session= $this->session->userdata('logged_in');
        $this->user_id=$user_session['USER_TYPE'];

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

    public function checkPrevilege($param = "") {
        if ($param == "") {
            $controller = $this->uri->segment(1, 'dashboard');
            $action = $this->uri->segment(2, 'index');
            $link = "$controller/$action";
        } else {
            $link = "$param";
        }
        return $this->security_model->get_all_checked_module_links_by_user($link, $this->user_session['USERGRP_ID'], $this->user_session['USERLVL_ID'], $this->user_session['USER_ID']);
    }
    /*
     * @methodName notice()
     * @access
     * @author      rakib <rakib@atilimited.net>
     * @param        none
     * @return      existing room list
     */

    function academicNotice() {
        $data['contentTitle'] = 'Notice';
        $data['breadcrumbs'] = array(
            'Notice' => '#',
            'Notice list' => '#',
            );
        $data["ac_type"] = 1;
        $data["previlages"] = $this->checkPrevilege();
        $data['notice'] = $this->db->query("SELECT a.*,
            c.FACULTY_NAME,
            d.DEPT_NAME,
            e.PROGRAM_NAME
            FROM notice a

            LEFT JOIN faculty c ON a.FACULTY_ID = c.FACULTY_ID
            LEFT JOIN department d ON a.DEPT_ID = d.DEPT_ID
            LEFT JOIN program e ON a.PROGRAM_ID = e.PROGRAM_ID
            ORDER BY  a.NOTICE_ID desc ")->result();
        $data['content_view_page'] = 'admin/setup/academic_notice/notice_index';
        $this->admin_template->display($data);
    }

    /*
     * @methodName addNotice()
     * @access
     * @author      rakib <rakib@atilimited.net>
     * @param        none
     * @return      existing room list
     */

    function addAcaNotice() {
        $data['contentTitle'] = 'Notice';
        $data['breadcrumbs'] = array(
            'Notice ' => '#',
            'Create Notice ' => '#',
            );
        $data['dimention']='vertical';
         $data["ac_type"] = 'view';//access type two view for common view of faculty,dept and program      
         $data["faculty"] = $this->utilities->findAllFromView('faculty');
         $data["user_type"] = $this->utilities->findAllFromView('user_type_view');         
         $data["user_group"] = $this->utilities->findAllFromView('sa_user_group');
         $data['content_view_page'] = 'admin/setup/academic_notice/add_notice';
         $this->admin_template->display($data);
     }
       /*
     * @methodName saveNotice()
     * @access
     * @author      rakib <rakib@atilimited.net>
     * @param        none
     * @return      program  list by dep id
     */

       function saveAcaNotice() {
        $file_name = "";
        if (!empty($_FILES)) {

            $this->load->library('upload');
            $this->load->helper('string');
            $config['upload_path'] = 'upload/notice/';
            //$config['allowed_types'] = '*';
            $config['allowed_types'] = '*';
            $config['overwrite'] = false;
            $config['remove_spaces'] = true;
            //$config['max_size']   = '100';// in KB
            $this->upload->initialize($config);
            if ($this->upload->do_upload('N_ATTACHMENT')) {
                $file_data = $this->upload->data();
                $file_name = $file_data['file_name'];
            }
        }
        $data_notice = array(
            'USER_TYPE' => $this->input->post('USER_TYPE'),
            'USERGRP_ID' => $this->input->post('USERGRP_ID'),
            'USERLVL_ID' => $this->input->post('USER_GRP_LVL_ID'),
            'N_TITLE' => $this->input->post('NOTICE_TITLE'),
            'N_DESC' => $this->input->post('NOTICE_DESCRIPTION'),
            'N_ATTACHMENT' => $file_name,
            'START_DATE' => date('Y-m-d', strtotime($this->input->post('START_DATE'))),
            'END_DATE' => date('Y-m-d', strtotime($this->input->post('END_DATE'))),
            'PROGRAM_ID' => $this->input->post('PROGRAM_ID'),
            'DEPT_ID' => $this->input->post('DEPT_ID'),
            'FACULTY_ID' => $this->input->post('FACULTY_ID'),            
            'IS_GLOBAL' => $this->input->post('IS_GLOBAL'),
            'IS_IMPORTANT' => $this->input->post('IS_IMPORTANT'),
            'CREATE_DATE' => date('Y-m-d')
            );
       //echo "<pre>"; print_r($data_notice);exit;

        $this->utilities->insertData($data_notice, 'notice');
        $this->session->set_flashdata('Success', 'Congratulation ! Notice saved successfully.');
        redirect('notice/addAcaNotice', 'refresh');

    }

      /*
     * @methodName editNotice()
     * @access
     * @author      rakib <rakib@atilimited.net>
     * @param        none
     * @return      program  list by dep id
     */

      function editAcaNotice($notice_id) {
        $data['contentTitle'] = 'Notice';
        $data['breadcrumbs'] = array(
            'Notice' => '#',
            'Edit Notice' => '#',
            );

          $data['dimention']='vertical';
        $data["ac_type"] ='edit';//access type two for common edit view        
        $data['previous_info'] = $this->utilities->findByAttribute('notice', array('NOTICE_ID' => $notice_id));
        $data["faculty"] = $this->utilities->findAllFromView('faculty');
        $data["program"] = $this->utilities->findAllFromView('program');
        $data["department"] = $this->utilities->findAllFromView('department');
        $data["user_type"] = $this->utilities->findAllFromView('user_type_view');         
        $data["user_group"] = $this->utilities->findAllFromView('sa_user_group');
        $data["user_group_lvl"] = $this->utilities->findAllFromView('sa_ug_level');

        $data['content_view_page'] = 'admin/setup/academic_notice/edit_notice';
        $this->admin_template->display($data);
    }

    /*
     * @methodName updateNotice()
     * @access
     * @author      rakib <rakib@atilimited.net>
     * @param        none
     * @return      program  list by dep id
     */

    function updateAcaNotice() {
        $file_name = "";
        if (!empty($_FILES)) {
            $this->load->library('upload');
            $this->load->helper('string');
            $config['upload_path'] = 'upload/notice/';
            //$config['allowed_types'] = '*';
            $config['allowed_types'] = '*';
            $config['overwrite'] = false;
            $config['remove_spaces'] = true;
            //$config['max_size']   = '100';// in KB
            $this->upload->initialize($config);
            if ($this->upload->do_upload('N_ATTACHMENT')) {
                $file_data = $this->upload->data();
                $file_name = $file_data['file_name'];
            }
        }
        $NOTICE_ID = $this->input->post('NOTICE_ID');
        $PROGRAM = $this->input->post('PROGRAM_ID');
        $DEPARTMENT = $this->input->post('DEPT_ID');
        $FACULTY = $this->input->post('FACULTY_ID');
        
        $update_data_notice = array(
           'USER_TYPE' => $this->input->post('USER_TYPE'),
           'USERGRP_ID' => $this->input->post('USERGRP_ID'),
           'USERLVL_ID' => $this->input->post('USER_GRP_LVL_ID'),
           'N_TITLE' => $this->input->post('N_TITLE'),
           'N_DESC' => $this->input->post('N_DESC'),
           'START_DATE' => date('Y-m-d', strtotime($this->input->post('START_DATE'))),
           'END_DATE' => date('Y-m-d', strtotime($this->input->post('END_DATE'))),
           'PROGRAM_ID' => $PROGRAM,
           'DEPT_ID' => $DEPARTMENT,
           'FACULTY_ID' => $FACULTY,             
           'IS_GLOBAL' => $this->input->post('IS_GLOBAL'),
           'CREATE_DATE' => date('Y-m-d')
           );
        if ($file_name != "") {
            $update_data_notice["N_ATTACHMENT"] = $file_name;
        }
        $this->utilities->updateData('notice', $update_data_notice, array('NOTICE_ID' => $NOTICE_ID));
        $this->session->set_flashdata('Success', 'Congratulation ! Notice updated successfully.');
        redirect('notice/editAcaNotice/' . $NOTICE_ID, 'refresh');
    }

    

//***************************
}
