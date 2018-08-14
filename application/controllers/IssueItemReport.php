<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IssueItemReport extends CI_Controller
{

    private $user;
    public $user_id = null;

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in') == FALSE) {
            redirect('auth/login', 'refresh');
        }
        $user_session = $this->user = $this->session->userdata("logged_in");
        $this->user_id = $user_session['USER_TYPE'];
        $this->load->model('utilities');
        $this->load->model('prefix_invertory_model');
    }

    /**
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
        return $this->security_model->get_all_checked_module_links_by_user($link, $this->user['USERGRP_ID'], $this->user['USERLVL_ID'], $this->user['USER_ID']);
    }

    /**
     * @access none
     * @param  none
     * @author Abhijit Mondal Abhi <abhijit@atilimited.net>
     * @return View
     */

    function index()
    {
        $data['content_view_page'] = 'eregistration/welcome.php';
        $this->applicant_portal->display($data);
    }






    function issueItemReport()
    {
        $data['contentTitle'] = 'Issue Item Report';
        $data["breadcrumbs"] = array(
            "Inventory" => "#",
            "Issue Item Report" => '#'
            );
        $data["previlages"] = $this->checkPrevilege('issueitemreport/issueItemReport');
        $data["session"] = $this->utilities->admissionSessionList();
        $data["ins_session"] = $this->utilities->academicSessionList();
        $data['program'] = $this->utilities->getAll('ins_program');
        //echo "<pre>"; print_r($data['ins_session']); exit;
        $data['section'] = $this->db->query("SELECT a.SECTION_ID,a.NAME FROM aca_section a;")->result();
        $data["ac_type"] = '';
        $data['dimention'] = "horizental";
        $data["requisition_type"] = $this->utilities->findAllByAttribute("m00_lkpdata a", array("a.GRP_ID" => 80));
        $data['content_view_page'] = 'issue_item_report/issue_item_report';
        $this->admin_template->display($data);
    }




    function issueItemReportData()
    {
        //$this->pr($_POST);
        $fromDate = date('Y-m-d', strtotime($this->input->post('fromDate')));
        $toDate =  date('Y-m-d', strtotime($this->input->post('toDate')));
        $data['issue_info_report'] = $this->inventory_model->getAllIssueReqReportInfo($fromDate,$toDate);
        $data['issue_item_info_report'] = $this->inventory_model->getAllIssueDetailsItemReport($fromDate,$toDate);
        //print_r($data['requisition_info_report']);exit();
         //echo "<pre>"; print_r($data['requisition_info_report']); exit;
        $this->load->view('issue_item_report/issue_item_report_data', $data);
    }
    private function pr($data)
    {
        echo "<pre>";
        print_r($data);
        exit;
    }



 

}