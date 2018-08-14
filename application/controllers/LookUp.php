<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class LookUp extends CI_Controller {

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
    }

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
     * @methodName index()
     * @access 
     * @param  
     * @author      Nurullah <nurul@atilimited.net>
     * @return      login template
     */
    function index() {
        $data['contentTitle'] = 'Group List';
        $data["breadcrumbs"] = array(
            "Admin" => "admin/index",
            "Group List" => '#'
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['group'] = $this->utilities->getAll('m00_lkpgrp');
        $data['content_view_page'] = 'look_up/look_up_index';
        $this->admin_template->display($data);
    }

    /**
     * @methodName lookupGroupForm()
     * @access 
     * @param  
     * @author      Nurullah <nurul@atilimited.net>
     * @return     d
     */
    function lookupGroupForm() {
        $this->load->view('look_up/add_look_group');
    }

    /**
     * @methodName addLookupGroup()
     * @access 
     * @param  
     * @author      Nurullah <nurul@atilimited.net>
     * @return      login template
     */
    function addLookupGroup() {
        $GRP_NAME = $this->input->post('GRP_NAME'); // Group name
        $check = $this->utilities->hasInformationByThisId("m00_lkpgrp", array("GRP_NAME" => $GRP_NAME));
        if (empty($check)) {// if Group name available preparing data to insert
            $group = array(
                'GRP_NAME' => $GRP_NAME
            );
            if ($this->utilities->insertData($group, 'm00_lkpgrp')) { // if data inserted successfully
                echo "<div class='alert alert-success'>Group Create successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Group insert failed</div>";
            }
        } else {// if group name not available
            echo "<div class='alert alert-danger'>Group Name Already Exist</div>";
        }
    }

    /**
     * @methodName lookupDataFormInsert()
     * @access 
     * @param  
     * @author      Nurullah <nurul@atilimited.net>
     * @return      
     */
    function lookupDataFormInsert() {
        $data["ac_type"] = 1; // for insert lookUp data
        $id = $this->uri->segment(3);
        $data['id'] = $id;
        $data['name'] = $this->db->query("SELECT GRP_NAME FROM m00_lkpgrp WHERE GRP_ID=$id")->row()->GRP_NAME;
        $this->load->view('look_up/add_look_up_data', $data);
    }

    /**
     * @methodName saveLookUpData()
     * @access 
     * @param  
     * @author      Nurullah <nurul@atilimited.net>
     * @return      
     */
    public function saveLookUpData() {
        $GRP_ID = $this->input->post('GRP_ID'); // Group ID hidden value
        $LKP_NAME = $this->input->post('LKP_NAME'); // Group lookUp data name
        $status = $this->input->post('status'); // active status
        $check = $this->utilities->hasInformationByThisId("m00_lkpdata", array("GRP_ID" => $GRP_ID, "LKP_NAME" => $LKP_NAME));
        if (empty($check)) {// if LookUp data name available preparing data to insert
            $insert_info = array(
                'LKP_NAME' => $_POST['LKP_NAME'],
                'GRP_ID' => $GRP_ID,
                'ACT_FG' => $status
            );
            if ($this->utilities->insertData($insert_info, 'm00_lkpdata')) { // if data inserted successfully
                echo "<div class='alert alert-success'>LookUp data Add successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>LookUp data insert failed</div>";
            }
        } else {// if LookUp data name not available
            echo "<div class='alert alert-danger'>LookUp data Name Already Exist</div>";
        }
    }

    /**
     * @methodName getLookUpData()
     * @access 
     * @param  
     * @author      Nurullah <nurul@atilimited.net>
     * @return      
     */
    function getLookUpData() {
        $GRP_ID = $this->input->post('param'); // Group id / hidden value
        $data['group_data'] = $this->db->query("select * from m00_lkpdata where GRP_ID=$GRP_ID")->result();
        $this->load->view('look_up/ajax_lookup_data', $data);
    }

    /**
     * @methodName lookupDataFormUpdate()
     * @access 
     * @param  
     * @author      Nurullah <nurul@atilimited.net>
     * @return      
     */
    function lookupDataFormUpdate() {
        $data["ac_type"] = 2; //for update course info
        $look_up_group_id = $this->uri->segment(3, 0); // for group id
        $look_up_id = $this->uri->segment(4, 0); // for lookUP data id
        $data['look_group_up_id'] = $look_up_group_id;
        $data['look_up_id'] = $look_up_id;

        $data['previousInfo'] = $this->utilities->findByAttribute('m00_lkpdata', array('LKP_ID' => $look_up_id));
        $this->load->view('look_up/add_look_up_data', $data);
    }

    /**
     * @methodName getLookUpData()
     * @access 
     * @param  
     * @author      Nurullah <nurul@atilimited.net>
     * @return      
     */
    function updateLookUpData() {
        $GRP_ID = $this->input->post('GRP_ID'); // Group ID hidden value
        $look_up_id = $this->input->post('LKP_ID'); // LookUP data ID hidden value
        $LKP_NAME = $this->input->post('LKP_NAME'); // Group lookUp data name
        $status = $this->input->post('status'); // active status
        // checking if m00_lkpdata with this lookUp name is already exist
        $check = $this->utilities->findByAttribute("m00_lkpdata", array("LKP_ID !=" => $look_up_id, "GRP_ID" => $GRP_ID, "LKP_NAME" => $LKP_NAME));
        if (empty($check)) {// if Group ID, LookUp name available 
            // preparing data to update
            $update = array(
                'LKP_NAME' => $LKP_NAME,
                'GRP_ID' => $GRP_ID,
                'ACT_FG' => $status
            );
            if ($this->utilities->updateData('m00_lkpdata', $update, array('LKP_ID' => $look_up_id))) { // if data update successfully
                echo "<div class='alert alert-success'>LookUp data Update successfully</div>";
            } else { // if data update failed
                echo "<div class='alert alert-danger'>LookUp data Update failed</div>";
            }
        } else {// if course name not available
            echo "<div class='alert alert-danger'>LookUp data Name Already Exist</div>";
        }
    }

    /**
     * @methodName lookUpById()
     * @access 
     * @param  
     * @author      Nurullah <nurul@atilimited.net>
     * @return      
     */
    function lookUpById() {
        $LKP_ID = $this->input->post('param');
        $data["previlages"] = $this->checkPrevilege('LookUp/index');
        $data['group_data'] = $this->db->query("select * from m00_lkpdata where LKP_ID= $LKP_ID")->row();
        $this->load->view('look_up/single_lookup_row', $data);
    }

    /**
     * @methodName edit_look_up_status()
     * @access 
     * @param  
     * @author      Nurullah <nurul@atilimited.net>
     * @return      
     */
    function edit_look_up_status() {
        $status = $_POST['status'];
        $look_up_id = $_POST['look_up_id'];
        $pre_status = $status;
        if ($pre_status == 1) {
            $new_status = 0;
        } else {
            $new_status = 1;
        }
        $update_status = array(
            'ACT_FG' => $new_status
        );
        if ($this->utilities->updateData('m00_lkpdata', $update_status, array('LKP_ID' => $look_up_id))) {
            echo "Y";
        } else {
            echo "N";
        }
    }

    /**
     * @methodName deletelookUp()
     * @access 
     * @param  
     * @author      Nurullah <nurul@atilimited.net>
     * @return      
     */
    function deletelookUp() {
        $item_id = $this->input->post('item_id'); // row
        $data_tbl = $this->input->post('data_tbl'); // table name
        $data_field = $this->input->post('data_field'); // column name
        $attribute = array(
            "$data_field" => $item_id
        );
        $result = $this->utilities->deleteRowByAttribute($data_tbl, $attribute);
        if ($result == TRUE) {
            echo "Y";
        } else {
            echo "N";
        }
    }

}
