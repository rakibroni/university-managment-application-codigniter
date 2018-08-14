<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Parents extends CI_Controller
{

    public $pr_id = null;// global parent id variable

    public function __construct()
    {
        parent::__construct();

        /* if ($this->session->userdata('parents_logged_in') == FALSE) {
             redirect('auth/parentsLogin', 'refresh');
         }*/

        $user_session = $this->session->userdata('parents_logged_in');

        $this->pr_id = $user_session['PARENT_PRO_ID'];
        header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        $this->load->model('utilities');
    }

    /**
     * @methodName  index()
     * @access
     * @param
     * @author      Rakib Roni <rakib@atilimited.net>
     * @return      Parents Index
     */
    public function index()
    {
        $student = $this->db->query("select * from parent_childs where PARENT_PRO_ID=$this->pr_id  ")->result();
        //this condition is for parents home page different for single and multiple student
        if (count($student) === 1) {
            $data['contentTitle'] = 'Dashboard';
            $data["breadcrumbs"] = array(
                "Parents" => "parents/index",
                "Dashboard" => '#'
            );
            $data['pageTitle'] = 'Parents Dashboard';
            $student_id = $student[0]->STUDENT_ID;
            $datas = $this->session->userdata('parents_logged_in');
            $datas['STUDENT_ID'] = $student_id;
            $this->session->set_userdata('parents_logged_in', $datas);

            $user_session = $this->session->userdata('parents_logged_in');
            $stu_id = $user_session['STUDENT_ID'];
            $data['st_id']=$stu_id;

            $data['content_view_page'] = 'parents/index';
            $this->parents_template->display($data);
        } else {
            $data['student'] = $this->db->query("select * from parent_childs where PARENT_PRO_ID=$this->pr_id  ")->result();
            $this->load->view('parents/multiple_student_home', $data);

        }
    }

    /**
     * @methodName  parent_registration()
     * @access
     * @param
     * @author      Rakib Roni <rakib@atilimited.net>
     * @return      parents registration form for parent registration.
     */
    public function parent_registration()
    {
        $this->load->view('parents/parent_registration');
    }

    /**
     * @methodName  parents_registration()
     * @access
     * @param
     * @author      Rakib Roni <rakib@atilimited.net>
     * @return      Parents registration form
     */
    function parents_registration()
    {
        $parent_profile = array(
            'PARENTS_NAME' => $this->input->post('PARENTS_NAME'),
            'MOBILE_NO' => $this->input->post('MOBILE_NO'),
            'EMAIL' => $this->input->post('EMAIL'),
            'USERNAME' => $this->input->post('USERNAME'),
            'PASSWORD' => $this->input->post('password'),
            'ACTIVE_STATUS' => 0
        );
        if ($this->utilities->hasInformationByThisId('parent_profile', array('EMAIL' => $this->input->post('EMAIL')))) {
            echo "P";
        } else {
            if ($this->utilities->hasInformationByThisId('parent_childs', array('STUDENT_ID' => $this->input->post('STUDENT_ID')))) {
                echo "S";
            } else {
                $id = $this->utilities->insert('parent_profile', $parent_profile);
                // print_r($id);exit;
                $data_parent_child_data = array(
                    'PARENT_PRO_ID' => $id,
                    'STUDENT_ID' => $this->input->post('STUDENT_ID'),
                    'ACTIVE_STATUS' => 0
                );
                $this->utilities->insert('parent_childs', $data_parent_child_data);
                $this->session->set_flashdata('Info', 'Successful');
            }
        }
    }

    function ActivateChild()
    {
        $childId = $this->input->post("childId");
        $data = $this->session->userdata('parents_logged_in');
        $data['STUDENT_ID'] = $childId;
        $this->session->set_userdata('parents_logged_in', $data);
    }

    function student_details()
    {
        $user_session = $this->session->userdata('parents_logged_in');
        $student_id = $user_session['STUDENT_ID'];
        $data['contentTitle'] = 'Dashboard';
        $data["breadcrumbs"] = array(
            "Parents" => "parents/index",
            "Dashboard" => '#'
        );
        $data['pageTitle'] = 'Parents Dashboard';
        $data['student_id'] = $student_id;

        $data['content_view_page'] = 'parents/parent_stu_dashboard';
        $this->parents_template->display($data);
    }
    function  profile(){
        $data['contentTitle'] = 'Dashboard';
        $data["breadcrumbs"] = array(
            "Parents" => "parents/index",
            "Dashboard" => '#'
        );
        $data['pageTitle'] = 'Parents Dashboard';
        $user_session = $this->session->userdata('parents_logged_in');
        $stu_id = $user_session['STUDENT_ID'];
        $data['st_id']=$stu_id;
        $data['content_view_page']="parents/profile";
        $this->parents_template->display($data);
    }
    function  announcement(){
        $data['contentTitle'] = 'Dashboard';
        $data["breadcrumbs"] = array(
            "Parents" => "parents/index",
            "Dashboard" => '#'
        );
        $data['pageTitle'] = 'Parents Dashboard';
        //$data['content_view_page']="";
        $this->parents_template->display($data);
    }


//***************************
}
