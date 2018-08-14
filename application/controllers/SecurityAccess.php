<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @category   SecurityAccess
 * @package    SecurityAccess
 * @author     Jahid Hasan <jahid@atilimited.net>
 * @copyright  2015 ATI Limited Development Group
 */
class SecurityAccess extends CI_Controller
{

    private $user_session;

    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in') == FALSE) {
            redirect('auth/login', 'refresh');
        }
        $this->user_session = $this->session->userdata('logged_in');
        $this->load->model('utilities');
        $this->load->library("form_validation");
    }

    function moduleSetup()
    {

        $data['contentTitle'] = 'Security & Access';
        $data["breadcrumbs"] = array(
            "Security Access" => "admin/index",
            "Modules" => '#'
        );
        $data['all_modules'] = $this->utilities->findAllFromView('ati_modules');
        $data['content_view_page'] = 'security_access/modules/all_module';
        $this->admin_template->display($data);
    }

    function createModule()
    {

        $module = array(
            'MODULE_NAME' => $this->input->post('mod_name'),
            'MODULE_NAME_BN' => $this->input->post('mod_name_bn'),
            'SL_NO' => $this->input->post('sl_no'),
            'MODULE_ICON' => $this->input->post('MODULE_ICON'),
            'ACTIVE_STATUS' => ($this->input->post('status') == 'true') ? 1 : 0,
            'ENTERED_BY' => $this->user_session["USER_ID"]
        );
        if ($this->utilities->insertData($module, 'ati_modules')) {
            $this->session->set_flashdata('Success', ' Module Created succesfully.');
        }
    }

    public function module_data_edit_model($id)
    {
        
        $data["mod_id"] = $id;
        $data['mod_details'] = $this->db->query("SELECT * FROM ati_modules WHERE MODULE_ID = $id")->row();
        $this->load->view('security_access/modules/update_module', $data);
    }

    public function delete_module_from_db()
    {

        $mod_id = $this->input->post('mod_id');
        if ($this->db->query("DELETE FROM ati_modules WHERE MODULE_ID = $mod_id")) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function update_module($id)
    {

        $modules = array(
            'MODULE_NAME' => $this->input->post('MODULE_NAME'),
            'MODULE_NAME_BN' => $this->input->post('MODULE_NAME_BN'),
            'SL_NO' => $this->input->post('SL_NO'),
            'MODULE_ICON' => $this->input->post('MODULE_ICON'),
            'ACTIVE_STATUS' => (isset($_POST['ACTIVE_STATUS'])) ? 1 : 0,
            'UPDATE_BY' => $this->user_session["USER_ID"]
        );
        $query = $this->utilities->updateData('ati_modules', $modules, array('MODULE_ID' => $id));
        if ($query == TRUE) {
            $this->session->set_flashdata('Success', ' Module Updated Successfully.');
            redirect('securityAccess/moduleSetup', 'refresh');
        }
    }

    function createModuleLink()
    {
        $this->form_validation->set_rules('txtmoduleId', 'Module', 'required');
        $this->form_validation->set_rules('txtLinkName', 'Module Link Name', 'required');
        $this->form_validation->set_rules('txtModLink', 'Module URL', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['contentTitle'] = 'Security & Access';
            $data["breadcrumbs"] = array(
                "Security Access" => "admin/index",
                "Create Modules Link" => '#'
            );

            $data['all_modules'] = $this->db->query("SELECT ml.*, (SELECT MODULE_NAME FROM ati_modules WHERE MODULE_ID = ml.MODULE_ID)MODULE_NAME FROM ati_module_links ml")->result();

            $data['content_view_page'] = 'security_access/modules/create_module_link';
            $this->admin_template->display($data);
        } else {
            $pages = implode(",", $this->input->post('chkpages'));
            $page = $this->input->post('chkpages');
            $modulelink = array(
                'MODULE_ID' => $this->input->post('txtmoduleId'),
                'LINK_NAME' => str_replace("'", "''", $this->input->post("txtLinkName")),
                'URL_URI' => str_replace("'", "''", $this->input->post("txtModLink")),
                'ATI_MLINK_PAGES' => "$pages",
                'CREATE' => (array_key_exists(0, $page)) ? 1 : 0,
                'READ' => (array_key_exists(1, $page)) ? 1 : 0,
                'UPDATE' => (array_key_exists(2, $page)) ? 1 : 0,
                'DELETE' => (array_key_exists(3, $page)) ? 1 : 0,
                'STATUS' => (array_key_exists(4, $page)) ? 1 : 0,
                'SL_NO' => $this->input->post('SL_NO'),
                'ACTIVE_STATUS' => (isset($_POST['ACTIVE_STATUS'])) ? 1 : 0,
                'ENTERED_BY' => $this->user_session["USER_ID"]
            );
            $query2 = $this->utilities->insertData($modulelink, 'ati_module_links');
            if ($query2 == TRUE) {
                $this->session->set_flashdata('Success', 'New Module Link Added Successfully.');
                redirect('securityAccess/createModuleLink', 'refresh');
            }
        }
    }

    public function link_data_edit_model($id)
    {

        $data["link_id"] = $id;
        $data['link_details'] = $this->db->query("SELECT ml.*, (SELECT MODULE_NAME FROM ati_modules WHERE MODULE_ID = ml.MODULE_ID)MODULE_NAME FROM ati_module_links ml WHERE LINK_ID = $id")->row();
        $this->load->view('security_access/modules/update_module_link', $data);
    }

    public function delete_row_from_db()
    {

        $data['link_id'] = $link_id = $this->input->post('link_id');
        if ($this->db->query("DELETE FROM ati_module_links WHERE LINK_ID = $link_id")) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function update_module_link($id)
    {
        $pages = implode(",", $this->input->post('chkpages'));
        $page = $this->input->post('chkpages');
        $modulelink = array(
            'MODULE_ID' => $this->input->post('txtmoduleId'),
            'LINK_NAME' => str_replace("'", "''", $this->input->post("txtLinkName")),
            'URL_URI' => str_replace("'", "''", $this->input->post("txtModLink")),
            'ATI_MLINK_PAGES' => "$pages",
            'CREATE' => (array_key_exists(0, $page)) ? 1 : 0,
            'READ' => (array_key_exists(1, $page)) ? 1 : 0,
            'UPDATE' => (array_key_exists(2, $page)) ? 1 : 0,
            'DELETE' => (array_key_exists(3, $page)) ? 1 : 0,
            'STATUS' => (array_key_exists(4, $page)) ? 1 : 0,
            'SL_NO' => $this->input->post('SL_NO'),
            'ACTIVE_STATUS' => (isset($_POST['ACTIVE_STATUS'])) ? 1 : 0,
            'UPDATE_BY' => $this->user_session["USER_ID"]
        );
        $query = $this->utilities->updateData('ati_module_links', $modulelink, array('LINK_ID' => $id));
        if ($query == TRUE) {
            $this->session->set_flashdata('Success', ' Module Link Updated Successfully.');
            redirect('securityAccess/createModuleLink', 'refresh');
        }
    }


    public function orgModuleSetup()
    {
        $data['contentTitle'] = 'Security & Access';
        $data["breadcrumbs"] = array(
            "Security Access" => "admin/index",
            "Organization Module" => '#'
        );
        $data["careProviders"] = $this->utilities->findAllByAttribute("sa_organizations", array("STATUS" => 1));
        $data['content_view_page'] = 'security_access/org/index';
        $this->admin_template->display($data);
    }

    public function createGroupModal()
    {
        $data['pageTitle'] = 'Create New Group';
        echo $this->load->view("security_access/create_group", $data, true);
    }

    public function createGroup()
    {
        $data['pageTitle'] = 'Create Group';
        $session_info = $this->session->userdata('logged_in');
        $insertdata = array(
            'USERGRP_NAME' => $this->input->post('txtGroupName'),
            'ORG_ID' => $session_info["ORG_ID"],
            'CREATED_BY' => $session_info["USER_ID"]
        );
        $this->utilities->insertData($insertdata, 'sa_user_group');
    }

    public function allGroup()
    {
        $data['contentTitle'] = 'Security & Access';
        $data["breadcrumbs"] = array(
            "Security Access" => "admin/index",
            "All Group" => '#'
        );
        $data["groups"] = $this->utilities->findAllByAttribute("sa_user_group", array("ORG_ID" => $this->user_session["ORG_ID"], "ACTIVE_STATUS" => 1)); //organization id should be session value
        $data['content_view_page'] = 'security_access/all_groups';
        $this->admin_template->display($data);
    }

    public function groupModal()
    {
        $data["hid"] = $this->user_session["ORG_ID"];//$session_info['ORG_ID'] //$this->user_session["SES_ORG_ID"]; //organization id should be use from session
        $data["modules"] = $this->utilities->findAllByAttribute("ati_modules", array("ACTIVE_STATUS" => 1));
        $data["active_modules"] = $this->utilities->findAllByAttribute("sa_org_modules", array("ORG_ID" => $data["hid"]));
        echo $this->load->view("security_access/create_group", $data, true);
    }

    public function moduleModal()
    {
        $data["hid"] = $this->input->post('hid');
        $data["modules"] = $this->utilities->findAllByAttribute("ati_modules", array("ACTIVE_STATUS" => 1));
        $data["active_modules"] = $this->utilities->findAllByAttribute("sa_org_modules", array("ORG_ID" => $data["hid"]));
        echo $this->load->view("security_access/org/add_module_to_cp", $data, true);
    }

    public function moduleModalLink()
    {
        $data["hid"] = $this->input->post('hid');
        $data["active_modules"] = $this->utilities->findAllByAttribute("sa_org_modules", array("ORG_ID" => $data["hid"]));
        echo $this->load->view("security_access/org/module_list", $data, true);
    }

    public function addModules()
    {
        $hid = $this->input->post('hid');
        $module_ids = $this->input->post('add_selected_single_id');
        $module_names = $this->input->post('add_selected_single_name');
        $modules = $this->input->post('add_selected_single_id');
        for ($i = 0; $i < sizeof($module_ids); $i++) {
            $attr = array(
                "SA_MODULE_NAME" => $module_names[$i],
                "MODULE_IDS" => $modules[$i],
                "ORG_ID" => $hid
            );
            $this->utilities->insertData($attr, "sa_org_modules");
        }
        $selected_modules = $this->utilities->findAllByAttribute("sa_org_modules", array("ORG_ID" => $hid));
        foreach ($selected_modules as $selected_module) {
            echo '<li class="ui-widget-content rename-module" id="' . $selected_module->SA_MODULE_ID . '" title="' . $selected_module->SA_MODULE_NAME . '">
            <span class="module-name">' . $selected_module->SA_MODULE_NAME . '</span>
            <span class="module-name-input hidden">
                <input type="text" id="txtModuleName" data-hc-module-id="' . $selected_module->SA_MODULE_ID . '" class="txtModuleName" value="' . $selected_module->SA_MODULE_NAME . '" style="width:90%; margin: 1px; float: left;" />
                <span class="iconb rht icon-red remove-module-input" style="font-size: 7px; margin: 8px 6px 0 0;">x</span>
            </span>
            <span class="iconb rht icon-red remove-module" data-icon="&#xe05e;"></span></li>';
        }
    }

    public function updateModule()
    {
        $module_id = $this->input->post('m_id');
        $module_name = $this->input->post('m_name');
        $attr = array(
            "SA_MODULE_NAME" => $module_name
        );
        $rs = $this->utilities->updateData("sa_org_modules", $attr, array("SA_MODULE_ID" => $module_id));
        if ($rs == TRUE) {
            echo "green";
        }
    }

    public function removeHcModule()
    {
        $module_id = $this->input->post('m_id');
        $attr = array(
            "SA_MODULE_ID" => $module_id
        );
        return $this->utilities->deleteRowByAttribute("sa_org_modules", $attr);
    }

    public function getModules()
    {
        $modules = $this->utilities->findAllByAttribute("ati_modules", array("ACTIVE_STATUS" => 1));
        //$data["active_modules"] = $this->global_model->findAllByAttribute("ATI_HC_MODULES", array("HEALTHCARE_ID" => $data["hid"]));
        foreach ($modules as $module) {
            echo '<li class="ui-widget-content" id="' . $module->MODULE_ID . '" title="' . $module->MODULE_NAME . '">' . $module->MODULE_NAME . '</li>';
        }
    }

    function assignModulePage()
    {
        $session_info = $this->session->userdata('logged_in');
        $values = explode(",", $this->input->post("values"));
        //print_r($values); exit;
        $module_id = $values[0];
        $link_id = $values[1];
        $page_type = $values[2];
        $org_id = $values[3];
        $is_checked = $this->input->post("is_checked");
        $check_existance = $this->utilities->findByAttribute("sa_org_mlinks", array("SA_MODULE_ID" => $module_id, "LINK_ID" => $link_id, "ORG_ID" => $org_id));
        if (!empty($check_existance)) {
            $updateData = array(
                'CREATE' => ($page_type == 'C') ? $is_checked : $check_existance->CREATE,
                'READ' => ($page_type == 'R') ? $is_checked : $check_existance->READ,
                'UPDATE' => ($page_type == 'U') ? $is_checked : $check_existance->UPDATE,
                'DELETE' => ($page_type == 'D') ? $is_checked : $check_existance->DELETE,
                'STATUS' => ($page_type == 'S') ? $is_checked : $check_existance->STATUS,
                'UPDATE_BY' => $session_info["USER_ID"],
                'UPDATED_TIMESTAMP' => date("Y-m-d H:i:s")
            );
            $this->utilities->updateData('sa_org_mlinks', $updateData, array("SA_MLINKS_ID" => $check_existance->SA_MLINKS_ID));
            echo "updated";
        } else {
            $insertData = array(
                'LINK_ID' => $link_id,
                'ORG_ID' => $org_id,
                'SA_MODULE_ID' => $module_id,
                'CREATE' => ($page_type == 'C') ? 1 : 0,
                'READ' => ($page_type == 'R') ? 1 : 0,
                'UPDATE' => ($page_type == 'U') ? 1 : 0,
                'DELETE' => ($page_type == 'D') ? 1 : 0,
                'STATUS' => ($page_type == 'S') ? 1 : 0,
                'ENTERED_BY' => $session_info["USER_ID"]
            );
            $this->utilities->insertData($insertData, 'sa_org_mlinks');
            echo "inserted";
        }
    }

    public function addNewGroup()
    {
        $h_id = $this->input->post("txtOrgId");
        $group_name = $this->input->post("txtGroupName");
        $attr = array(
            "ORG_ID" => $h_id,
            "USERGRP_NAME" => $group_name,
            "ENTERED_BY" => $this->user_session["USER_ID"],
        );
        $rs = $this->utilities->insertData($attr, "sa_user_group");
        if ($rs == TRUE) {
            $this->session->set_flashdata('Success', 'User Group Created Successfully.');
            redirect('securityAccess/allGroup', 'refresh');
        } else {
            $this->session->set_flashdata('Error', 'User Group Create Failled.');
            redirect('securityAccess/allGroup', 'refresh');
        }
    }

    public function assignModuleToLevelModal($user_group_id)
    {
        $data["user_group_id"] = $user_group_id;
        $data['pageTitle'] = 'Create Level';
        $data["levels"] = $this->utilities->findAllByAttribute("sa_ug_level", array("USERGRP_ID" => $user_group_id, "ACTIVE_STATUS" => 1));
        $data["group_modules"] = $this->utilities->getLevelModules($user_group_id);
        echo $this->load->view("security_access/assign_module_to_level", $data, true);
    }

    public function createLevelModal()
    {
        $data["user_group_id"] = $this->input->post("group_id");
        $data['pageTitle'] = 'Create Level';
        echo $this->load->view("security_access/create_level", $data, true);
    }

    public function viewAccessChartModal($user_id)
    {
        $data["user_id"] = $user_id;
        $data["user_info"] = $this->utilities->findByAttribute("sa_users", array("USER_ID" => $data["user_id"], "ACTIVE_STATUS" => 1));
        $data['pageTitle'] = 'User Access Chart';
        echo $this->load->view("security_access/view_access_chart", $data, true);
    }

    public function transferGroupUserModal($user_id)
    {
        $session_info = $this->session->userdata('logged_in');
        $data["user_id"] = $user_id;
        $data['pageTitle'] = 'Transfer User To Another Group';
        $data["user_info"] = $this->utilities->findByAttribute("sa_users", array("USER_ID" => $data["user_id"], "ACTIVE_STATUS" => 1));
        $data["groups"] = $this->utilities->dropdownFromTableWithCondition("sa_user_group", "Select A Group", "USERGRP_ID", "USERGRP_NAME", array("ORG_ID" => $session_info["SES_ORG_ID"], "ACTIVE_STATUS" => 1));
        echo $this->load->view("security_access/transfer_group_user", $data, true);
    }

    public function createLevel()
    {
        $session_info = $this->session->userdata('logged_in');
        $insertdata = array(
            'UGLEVE_NAME' => $this->input->post('txtLevelName'),
            'ORG_ID' => $session_info["ORG_ID"],
            'USERGRP_ID' => $this->input->post('txtGroupId'),
            'ENTERED_BY' => $session_info["USER_ID"]
        );
        if ($this->utilities->insertData($insertdata, 'sa_ug_level')) {
            $this->session->set_flashdata('Success', 'User Group Created Successfully.');
            redirect('securityAccess/allGroup', 'refresh');
        } else {
            $this->session->set_flashdata('Error', 'User Group Create Failled.');
            redirect('securityAccess/allGroup', 'refresh');
        }
    }

    public function transferGroup()
    {
        $session_info = $this->session->userdata('logged_in');
        $updatedata = array(
            'USERGRP_ID' => $this->input->post('cmbGroup'),
            'UPDATED_BY' => $session_info["USER_ID"]
        );
        $this->utilities->updateData("sa_users", $updatedata, array("USER_ID" => $this->input->post('txtUserId')));
    }

    public function assignModuleToGroup()
    {
        $data['contentTitle'] = 'Security & Access';
        $data['pageTitle'] = 'Assign Module To Group';
        $data['breadcrumbs'] = array(
            'Security and access' => '#',
            'Assign Module To Group' => '#'
        );
        $session_info = $this->session->userdata('logged_in');
        //$data["departments"] = $this->utilities->dropdownFromTableWithCondition("hr_dept", "Select A Departments", "DEPT_NO", "DEPT_NAME", array("ORG_ID" => $session_info["SES_ORG_ID"], "ACTIVE_FLAG" => 1));
        $data["groups"] = $this->utilities->dropdownFromTableWithCondition("sa_user_group", "Select A Group", "USERGRP_ID", "USERGRP_NAME", array("ORG_ID" => $session_info["ORG_ID"], "ACTIVE_STATUS" => 1)); // ORG_ID should be session value
        $data["org_modules"] = $this->utilities->findAllByAttribute("sa_org_modules", array("ORG_ID" => $session_info["ORG_ID"], "ACTIVE_STATUS" => $session_info["ORG_ID"])); // ORG_ID should be session value
        $data["users"] = $this->utilities->findAllByAttribute("sa_users", array("ORG_ID" => $session_info["ORG_ID"], "ACTIVE_STATUS" => 1)); // ORG_ID should be session value
        //$data["user_info"] = $this->utilities->findByAttribute("sa_users", array("USER_ID" => $user_id, "ACTIVE_STATUS" => 1));
        $data['content_view_page'] = 'security_access/assign_module_to_group';
		
        $this->admin_template->display($data);
    }

    public function assignModuleToGroupAction()
    {
        $session_info = $this->session->userdata('logged_in');
        $group = $this->input->post('group_id');
        $level = $this->input->post('level_id');
        $values = explode(',', $this->input->post('values'));
        $module_id = $values[0];
        $link_id = $values[1];
        $page_type = $values[2];
        $is_checked = $this->input->post("is_checked");
        $check_existance = $this->utilities->findByAttribute("sa_uglw_mlink", array("SA_MLINKS_ID" => $link_id, "USERGRP_ID" => $group, "UG_LEVEL_ID" => $level, "ORG_ID" => $session_info["ORG_ID"]));
		
        if (!empty($check_existance)) {
            $updateData = array(
                'CREATE' => ($page_type == 'C') ? $is_checked : $check_existance->CREATE,
                'READ' => ($page_type == 'R') ? $is_checked : $check_existance->READ,
                'UPDATE' => ($page_type == 'U') ? $is_checked : $check_existance->UPDATE,
                'DELETE' => ($page_type == 'D') ? $is_checked : $check_existance->DELETE,
                'STATUS' => ($page_type == 'S') ? $is_checked : $check_existance->STATUS,
                'CREATED_BY' => $session_info["USER_ID"],
                'UPDATE_DATE' => date("Y-m-d H:i:s")
            );
            $this->utilities->updateData('sa_uglw_mlink', $updateData, array("SA_UGLWM_LINK" => $check_existance->SA_UGLWM_LINK));
        } else {
            $insertData = array(
                'SA_MLINKS_ID' => $link_id,
                'USERGRP_ID' => $group,
                'UG_LEVEL_ID' => $level,
                'SA_MODULE_ID' => $module_id,
                'CREATE' => ($page_type == 'C') ? 1 : 0,
                'READ' => ($page_type == 'R') ? 1 : 0,
                'UPDATE' => ($page_type == 'U') ? 1 : 0,
                'DELETE' => ($page_type == 'D') ? 1 : 0,
                'STATUS' => ($page_type == 'S') ? 1 : 0,
                'ORG_ID' => $session_info["ORG_ID"],
                'UPDATED_BY' => $session_info["USER_ID"],
                'UPDATE_DATE' => date("Y-m-d H:i:s")
            );
            $this->utilities->insertData($insertData, 'sa_uglw_mlink');
        }
    }

    function ajax_permission_change()
    {
        $positionArray = explode(',', $_POST['position_value']);
        $user_group_id = $positionArray[0];
        $page_id = $positionArray[1];
        $module_id = $_POST['module_id'];
        $link_id = $_POST['link_id'];
        $status = $_POST['status'];
        $this->utilities->ajax_permission_change($user_group_id, $page_id, $module_id, $link_id, $status);
    }

    function ajax_permission_change_level()
    {
        $positionArray = explode(',', $_POST['position_value']);
        $user_level_id = $positionArray[0];
        $page_id = $positionArray[1];
        $module_id = $_POST['module_id'];
        $gr_id = $_POST['group_id'];
        $status = $_POST['status'];
        $this->utilities->ajax_permission_change_level($user_level_id, $page_id, $module_id, $gr_id, $status);
    }

    function getLevelsByGroup()
    {
        $group = $this->input->post("group");
        $levels = $this->utilities->dropdownFromTableWithCondition('sa_ug_level', 'Select Level -', 'UG_LEVEL_ID', 'UGLEVE_NAME', array('USERGRP_ID' => $group));
        if (!empty($levels)) {
            echo form_dropdown('cmbLevel', $levels, '', 'id="cmbLevel"');
        } else {
            return FALSE;
        }
    }

    function getUsersByGroup()
    {
        $group = $this->input->post("group");
        $session_info = $this->session->userdata('logged_in');
        $users = $this->utilities->findAllByAttribute("sa_users", array("ORG_ID" => $session_info["ORG_ID"], "USERGRP_ID" => $group, "ACTIVE_STATUS" => 1));
        if (!empty($users)) {
            foreach ($users as $user) {
                echo "<tr>";
                echo "<td>" . $user->FULL_NAME . "</td>";
                echo '<td><a title="Access Chart of ' . $user->FULL_NAME . '" href="#myModal" role="button" data-toggle="modal" data-link="' . base_url("cp/securityAccess/viewAccessChartModal/$user->USER_ID") . '"><span class="actionIcon dialogLink tooltips"  data-placement="top"><i class="icon-sitemap"></i></span></a></td>';
                echo '<td><span class="icon-unlock-alt tooltips actionIcon assignUser" id="' . $user->USER_ID . '" title="Change Access For This user Only" style="cursor: pointer;"></span></td>';
                echo '<td><span class="icon-signout tooltips actionIcon" title="Transfer To Different Group" style="cursor: pointer;"></span></td>';
                echo "</tr>";
            }
        } else {
            echo "<tr>";
            echo "<td>No User Found</td>";
            echo "</tr>";
        }
    }

    function getUsersByLevel()
    {
        $group = $this->input->post("group");
        $level = $this->input->post("level");
        $session_info = $this->session->userdata('logged_in');
        $users = $this->utilities->findAllByAttribute("sa_users", array("ORG_ID" => $session_info["ORG_ID"], "USERGRP_ID" => $group, "USERLVL_ID" => $level, "ACTIVE_STATUS" => 1));
        if (!empty($users)) {
            foreach ($users as $user) {
                echo "<tr>";
                echo "<td>" . $user->FULL_NAME . "</td>";
                echo '<td><a title="Access Chart of ' . $user->FULL_NAME . '" href="#myModal" role="button" data-toggle="modal" data-link="' . base_url("cp/securityAccess/viewAccessChartModal/$user->USER_ID") . '"><span class="actionIcon dialogLink tooltips"  data-placement="top"><i class="icon-sitemap"></i></span></a></td>';
                echo '<td><span class="icon-unlock-alt tooltips actionIcon assignUser" id="' . $user->USER_ID . '" title="Change Access For This user Only" style="cursor: pointer;"></span></td>';
                echo '<td><span class="icon-signout tooltips actionIcon" id="' . $user->USER_ID . '" title="Transfer To Different Group" style="cursor: pointer;"></span></td>';
                echo "</tr>";
            }
        } else {
            echo "<tr>";
            echo "<td>No User Found</td>";
            echo "</tr>";
        }
    }

    function getUsersByDepartment()
    {
        $department = $this->input->post("department");
        $session_info = $this->session->userdata('logged_in');
        $users = $this->utilities->findAllByAttribute("sa_users", array("ORG_ID" => $session_info["ORG_ID"], "DEPT_ID" => $department, "ACTIVE_STATUS" => 1));
        if (!empty($users)) {
            foreach ($users as $user) {
                echo "<tr>";
                echo "<td>" . $user->FULL_NAME . "</td>";
                echo '<td><a title="Access Chart of ' . $user->FULL_NAME . '" href="#myModal" role="button" data-toggle="modal" data-link="' . base_url("cp/securityAccess/viewAccessChartModal/$user->USER_ID") . '"><span class="actionIcon dialogLink tooltips"  data-placement="top"><i class="icon-sitemap"></i></span></a></td>';
                echo '<td><span class="icon-unlock-alt tooltips actionIcon assignUser" id="' . $user->USER_ID . '" title="Change Access For This user Only" style="cursor: pointer;"></span></td>';
                echo '<td><span class="icon-signout tooltips actionIcon" id="' . $user->USER_ID . '" title="Transfer To Different Group" style="cursor: pointer;"></span></td>';
                echo "</tr>";
            }
        } else {
            echo "<tr>";
            echo "<td>No User Found</td>";
            echo "</tr>";
        }
    }

    function getModuleAcceesByGroup()
    {
        $session_info = $this->session->userdata('logged_in');
        $data["group"] = $this->input->post("group");
        $data["org_modules"] = $this->utilities->findAllByAttribute("sa_org_modules", array("ORG_ID" => $session_info["ORG_ID"], "ACTIVE_STATUS" => 1)); //ORG_ID should be session value
		
        echo $this->load->view("security_access/assign_module_by_group_id", $data, true);
    }

    function getModuleAcceesByGroupLevel()
    {
        $session_info = $this->session->userdata('logged_in');
        $data["group"] = $this->input->post("group");
        $data["level"] = $this->input->post("level");
        $data["org_modules"] = $this->utilities->findAllByAttribute("sa_org_modules", array("ORG_ID" => $session_info["ORG_ID"], "ACTIVE_STATUS" => 1));
        echo $this->load->view("security_access/assign_module_by_group_level", $data, true);
    }

    function getModuleAcceesByUser()
    {
        $session_info = $this->session->userdata('logged_in');
        $user_id = $this->input->post("user");
        $data["org_modules"] = $this->utilities->findAllByAttribute("sa_org_modules", array("ORG_ID" => $session_info["ORG_ID"], "ACTIVE_STATUS" => 1));
        $data["user_info"] = $this->utilities->findByAttribute("sa_users", array("USER_ID" => $user_id, "ACTIVE_STATUS" => 1));
        echo $this->load->view("security_access/assign_module_by_user", $data, true);
    }

    function getModuleAcceesByUsers()
    {
        $session_info = $this->session->userdata('logged_in');
        $data["org_modules"] = $this->utilities->findAllByAttribute("sa_org_modules", array("ORG_ID" => $session_info["ORG_ID"], "ACTIVE_STATUS" => 1));
        echo $this->load->view("security_access/assign_module_by_users", $data, true);
    }

    function assignModuleAccessToUsers()
    {
        $users = $this->input->post("chkUser");
        for ($i = 0; $i < sizeof($users); $i++) {
            $group = $this->input->post('group_id');
            $level = $this->input->post('level');
            $sa_uglwm_link = $this->input->post('sa_uglwm_link_id');

            $values = explode(',', $this->input->post('values'));
            $module_id = $values[0];
            $link_id = $values[1];
            $page_type = $values[2];
            $is_checked = $this->input->post("is_checked");
            $check_existance_in_user = $this->utilities->findByAttribute("sa_user_mlink", array("SA_UGLWM_LINK" => $sa_uglwm_link, "SA_MLINKS_ID" => $link_id, "USER_ID" => $users[$i]));

            if (!empty($check_existance_in_user)) {
                $updateExistingUserAccessData = array(
                    'SA_MLINKS_ID' => $link_id,
                    'USER_ID' => $users[$i],
                    'USERGRP_ID' => $group,
                    'UG_LEVEL_ID' => $level,
                    'SA_UGLWM_LINK' => $check_existance_in_user->SA_UGLWM_LINK,
                    'SA_MODULE_ID' => $module_id,
                    'CREATE' => ($page_type == 'C') ? $is_checked : $check_existance_in_user->CREATE,
                    'READ' => ($page_type == 'R') ? $is_checked : $check_existance_in_user->READ,
                    'UPDATE' => ($page_type == 'U') ? $is_checked : $check_existance_in_user->UPDATE,
                    'DELETE' => ($page_type == 'D') ? $is_checked : $check_existance_in_user->DELETE,
                    'UPDATED_BY' => $this->user_session["USER_ID"],
                    'UPDATE_DATE' => date("Y-m-d H:i:s")
                );
                $this->utilities->updateData('sa_user_mlink', $updateExistingUserAccessData, array("SA_UGLWM_LINK" => $sa_uglwm_link, "USER_ID" => $users[$i]));
                $updateExistingGroupAccessData = array(
                    'USER_ID' => $users[$i],
                    'UPDATED_BY' => $this->user_session["USER_ID"],
                    'UPDATE_DATE' => date("Y-m-d H:i:s")
                );
                $this->utilities->updateData('sa_uglw_mlink', $updateExistingGroupAccessData, array("SA_UGLWM_LINK" => $sa_uglwm_link));
            } else {
                $check_existance_in_group = $this->utilities->findByAttribute("sa_uglw_mlink", array("SA_MLINKS_ID" => $link_id, "ORG_ID" => $this->user_session["ORG_ID"], "USERGRP_ID" => $group, "UG_LEVEL_ID" => $level, "SA_MODULE_ID" => $module_id));
                if (!empty($check_existance_in_group)) {
                    $insertData = array(
                        'SA_MLINKS_ID' => $link_id,
                        'USER_ID' => $users[$i],
                        'USERGRP_ID' => $group,
                        'UG_LEVEL_ID' => $level,
                        'SA_UGLWM_LINK' => $check_existance_in_group->SA_UGLWM_LINK,
                        'SA_MODULE_ID' => $module_id,
                        'CREATE' => ($page_type == 'C') ? $is_checked : $check_existance_in_group->CREATE,
                        'READ' => ($page_type == 'R') ? $is_checked : $check_existance_in_group->READ,
                        'UPDATE' => ($page_type == 'U') ? $is_checked : $check_existance_in_group->UPDATE,
                        'DELETE' => ($page_type == 'D') ? $is_checked : $check_existance_in_group->DELETE,
                        'ORG_ID' => $this->user_session["ORG_ID"],
                        'CREATED_BY' => $this->user_session["USER_ID"]
                    );
                    $this->utilities->insertData($insertData, 'sa_user_mlink');
                } else {
                    $insertGroupAccessData = array(
                        'SA_MLINKS_ID' => $link_id,
                        'USER_ID' => $users[$i],
                        'USERGRP_ID' => $group,
                        'UG_LEVEL_ID' => $level,
                        'SA_MODULE_ID' => $module_id,
                        'CREATE' => 0,
                        'READ' => 0,
                        'UPDATE' => 0,
                        'DELETE' => 0,
                        'ORG_ID' => $this->user_session["ORG_ID"],
                        'CREATED_BY' => $this->user_session["USER_ID"]
                    );
                    $this->utilities->insertData($insertGroupAccessData, 'sa_uglw_mlink');
                    $max_group_access_id = $this->utilities->get_max_value("sa_uglw_mlink", "SA_UGLWM_LINK");
                    $insertUserAccess = array(
                        'SA_MLINKS_ID' => $link_id,
                        'USER_ID' => $users[$i],
                        'USERGRP_ID' => $group,
                        'UG_LEVEL_ID' => $level,
                        'SA_UGLWM_LINK' => $max_group_access_id,
                        'SA_MODULE_ID' => $module_id,
                        'CREATE' => ($page_type == 'C') ? $is_checked : 0,
                        'READ' => ($page_type == 'R') ? $is_checked : 0,
                        'UPDATE' => ($page_type == 'U') ? $is_checked : 0,
                        'DELETE' => ($page_type == 'D') ? $is_checked : 0,
                        'STATUS' => ($page_type == 'S') ? $is_checked : 0,
                        'ORG_ID' => $this->user_session["ORG_ID"],
                        'CREATED_BY' => $this->user_session["USER_ID"]
                    );
                    $this->utilities->insertData($insertUserAccess, 'sa_user_mlink');
                }
            }
        }
    }

    public function assignModuleAcceesByUser()
    {
        $group = $this->input->post('group_id');
        $level = $this->input->post('level');
        $user = $this->input->post('user');
        $values = explode(',', $this->input->post('values'));
        $module_id = $values[0];
        $link_id = $values[1];
        $page_type = $values[2];
        $is_checked = $this->input->post("is_checked");
        $check_user_existance = $this->utilities->findByAttribute("sa_uglw_mlink", array("SA_MODULE_ID" => $module_id, "SA_MLINKS_ID" => $link_id, "ORG_ID" => $this->user_session["ORG_ID"], "USER_ID" => $user));
        //$check_user_existance = $this->utilities->findByAttribute("sa_user_mlink", array("SA_UGLWM_LINK" => $sa_uglwm_link, "SA_MLINKS_ID" => $link_id, "USER_ID" => $users[$i]));

        if (!empty($check_user_existance)) {
            $updateExistingUserAccessData = array(
                'CREATE' => ($page_type == 'C') ? $is_checked : $check_user_existance->CREATE,
                'READ' => ($page_type == 'R') ? $is_checked : $check_user_existance->READ,
                'UPDATE' => ($page_type == 'U') ? $is_checked : $check_user_existance->UPDATE,
                'DELETE' => ($page_type == 'D') ? $is_checked : $check_user_existance->DELETE,
                'STATUS' => ($page_type == 'S') ? $is_checked : $check_user_existance->STATUS,
                'UPDATED_BY' => $this->user_session["USER_ID"],
                'UPDATE_DATE' => date("Y-m-d H:i:s")
            );
            $this->utilities->updateData('sa_uglw_mlink', $updateExistingUserAccessData, array("SA_UGLWM_LINK" => $check_user_existance->SA_UGLWM_LINK));
        } else {
            $insertUserAccessData = array(
                'SA_MLINKS_ID' => $link_id,
                'USER_ID' => $user,
                'SA_MODULE_ID' => $module_id,
                'ORG_ID' => $this->user_session["ORG_ID"],
                'CREATE' => ($page_type == 'C') ? $is_checked : 0,
                'READ' => ($page_type == 'R') ? $is_checked : 0,
                'UPDATE' => ($page_type == 'U') ? $is_checked : 0,
                'DELETE' => ($page_type == 'D') ? $is_checked : 0,
                'STATUS' => ($page_type == 'S') ? $is_checked : 0,
                'CREATED_BY' => $this->user_session["USER_ID"],
                'CREATE_DATE' => date("Y-m-d H:i:s")
            );
            $this->utilities->insertData($insertUserAccessData, 'sa_uglw_mlink');
        }
    }

}