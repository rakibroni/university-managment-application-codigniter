<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* @category   FrontPortal
* @package    Portal
* @author     Emdadul Huq <Emdadul@atilimited.net>
* @copyright  2015 ATI Limited Development Group
*/
class Employee extends CI_Controller {

  private $user;
  public $user_id = null;

  public function __construct() {
    parent::__construct();
    if ($this->session->userdata('logged_in') == FALSE) {
      redirect('auth/login', 'refresh');
    }
    $user_session = $this->user = $this->session->userdata("logged_in");
    $this->user_id = $user_session['USER_TYPE'];
    $this->load->model('utilities');
  }
    /**
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
      return $this->security_model->get_all_checked_module_links_by_user($link, $this->user['USERGRP_ID'], $this->user['USERLVL_ID'], $this->user['USER_ID']);
    }
    public function employee(){
      $data['contentTitle'] = 'Employee List';
      $data['breadcrumbs'] = array(
        'Admin' => '#',
        'Employee List' => '#',
        );
      $data["previlages"] = $this->checkPrevilege();
        $data['emp_list'] = $this->employee_model->empInfo(); // select all data from  faculty
        $data['content_view_page'] = 'admin/emp/emp_index';
        $this->admin_template->display($data);
      }
      public function employeeCardList(){
        //echo "ds";exit;

        $data['contentTitle'] = 'Employee Card List';
        $data['breadcrumbs'] = array(
          'Admin' => '#',
          'Employee Card List' => '#',
          );
        
      $data['emp_list'] = $this->employee_model->empInfo(); // select all data from  faculty
      $data['content_view_page'] = 'admin/emp/emp_card_list_all';
      $this->admin_template->display($data);
    }

    function empFormInsert() {
      $data["ac_type"] = 1;
      $this->form_validation->set_rules('FULL_NAME', 'Full name', 'required');


      if ($this->form_validation->run() == FALSE) {
        $data['division'] = $this->utilities->getAll('sa_divisions');
        $data['nationality'] = $this->utilities->getAll('country');            
        $data['dept'] = $this->utilities->findAllByAttribute('ins_dept', array('ACTIVE_STATUS' => 1));
        $data['designation'] = $this->utilities->findAllByAttribute('hr_desig', array('ACTIVE_STATUS' => 1));
        $data['religion'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 3));
        $data['merital_status'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 8));
        $data['blood_group'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 4)); 
        $data['board_name'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 24));
        $data['group_name'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 25));
        $data['occupation'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 21));
        $data['relation'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 40)); 
        $data['content_view_page'] ='admin/emp/add_emp';

      }else{
        require(APPPATH.'views/common/image_upload/class.upload.php');
        $applicant_photo_name='';
        $signature_photo_name='';
        $foo = new Upload($_FILES['photo']);
        if ($foo->uploaded) {
                    // large size image
                    //$foo->file_new_name_body = 'foo';
          $foo->image_border= 1;
                    //$foo->image_border_color    = '#231F20';
          $foo->allowed = array('image/*');
          $foo->Process('upload/employee/photo/');
          if($foo->processed){
            $applicant_photo_name=  $foo->file_src_name;
          }else{
            echo  'error : ' . $foo->error;
          }
        }
        $sig_photo = new Upload($_FILES['signature']);
        if ($sig_photo->uploaded) {
                    // large size image
                    //$foo->file_new_name_body = 'foo';
          $sig_photo->image_border          = 1;
                    //$foo->image_border_color    = '#231F20';
          $sig_photo->allowed = array('image/*');
          $sig_photo->Process('upload/employee/signature/');
          if($sig_photo->processed){
            $signature_photo_name=  $sig_photo->file_src_name;
          }else{
            echo  'error : ' . $sig_photo->error;
          }
        }
         // ### applicant personal information ###


        $emp_info = array(                
          'FULL_ENAME' => $this->input->post('FULL_NAME'),
          'FULL_BNAME' => $this->input->post('FULL_NAME_BN'),
          'FATHER_NAME' => $this->input->post('FATHER_NAME'),
          'MOTHER_NAME' => $this->input->post('MOTHER_NAME'), 
          'DOB' => date('Y-m-d',strtotime($this->input->post('DOB'))),
          'PLACE_OF_BIRTH' => $this->input->post('PLACE_OF_BIRTH'),
          'MOBILE' => $this->input->post('MOBILE_NO'),
          'EMAIL' => $this->input->post('EMAIL'),
          'BLOOD_GROUP' => $this->input->post('BLOOD_GRP'),
          
          'MARITAL_STATUS' => $this->input->post('MARITAL_STATUS'),                                    
          'NATIONALITY' => $this->input->post('NATIONALITY'), 
                                                  
          'RELIGION' => $this->input->post('RELIGION_ID'),  

          'NATIONAL_ID' => $this->input->post('NATIONAL_ID'),
          'BIOMETRIC_ID' => $this->input->post('BIOMETRIC_ID'),
         
          'HIRE_DATE' => date('Y-m-d',strtotime($this->input->post('JOIN_DATE'))),                         
          'HEIGHT_FEET' => $this->input->post('HEIGHT_FEET'),                          
          'HEIGHT_CM' => $this->input->post('HEIGHT_CM'),                          
          'WEIGHT_KG' => $this->input->post('WEIGHT_KG'),                          
          'WEIGHT_LBS' => $this->input->post('WEIGHT_LBS'),
          'EMP_IMG' =>  $applicant_photo_name,
          'EMP_SIG' =>  $signature_photo_name,

          );
             // print_r($emp_info);exit;
        $emp_id= $this->utilities->insert('hr_emp', $emp_info);
        $designation_counter= $this->input->post('designation_counter');

        //var_dump($designation_counter); die();
/*        if(!empty($designation_counter)){
          for ($i = 0; $i < sizeof($designation_counter); $i++) {
            $designation_data=array(
              'DEPT_ID' => $this->input->post('DEPT_ID_' . $designation_counter[$i]),
              'DESIG_ID' => $this->input->post('DESIG_ID_' . $designation_counter[$i]),
              'DEFAULT_FG' => $this->input->post('DEFAULT_FG_' . $designation_counter[$i]) ,
              'EMP_ID' =>$emp_id,
              );

            $this->utilities->insertData($designation_data, 'hr_edeptdesi');

          }

          
        }*/




          $DEPT_ID=$this->input->post('DEPT_ID');
          $DESIG_ID=$this->input->post('DESIG_ID');
          $DEFAULT_FG=$this->input->post('DEFAULT_FG');
          $EDEPTDESI_ID=$this->input->post('EDEPTDESI_ID');
          //update employee department designation
 
          //var_dump($DEFAULT_FG); die();
          if(!empty($DEPT_ID)){
            for ($i = 0; $i < sizeof($DEPT_ID); $i++) {
             
              $designation_data=array( 
                'DEPT_ID' => $DEPT_ID[$i],
                'DESIG_ID' => $DESIG_ID[$i],
                'DEFAULT_FG' => $DEFAULT_FG[$i],
                'EMP_ID'=>$emp_id 
                );
                 
                $this->utilities->insertData($designation_data, 'hr_edeptdesi');
           
            }
            //exit;             
          }

        $this->session->set_flashdata('Success', 'Successfully Inserted');
        redirect('employee/empFormInsert');
      }
      $this->admin_template->display($data); 
    }




    /////////////////////

    // function employeeFormUpdate() {
    //     $data["ac_type"] = 2;
    //     $id = $this->input->post('param'); // employee ID
    //     $data['employee'] = $this->utilities->findByAttribute('hr_emp', array('EMP_ID' => $id)); // select all data from faculty where faculty id
    //     $this->load->view('admin/emp/edit_emp', $data);
    // }

    function empFormUpdate()
    {
      $emp_id = $this->uri->segment(3);
        //$data['emp'] = $this->utilities->findByAttribute('hr_emp', array('EMP_ID' => $emp_id));
      $data['emp'] = $this->employee_model->findEmpById($emp_id);
      $data["ac_type"] = 1;
      $this->form_validation->set_rules('FULL_NAME', 'Full name', 'required'); 
      if ($this->form_validation->run() == FALSE) {
        $data['division'] = $this->utilities->getAll('sa_divisions');
        $data['nationality'] = $this->utilities->getAll('country'); 
        $data['dept'] = $this->utilities->getAll('ins_dept'); 
        $data['religion'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 3));
        $data['merital_status'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 8));
        $data['blood_group'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 4)); 
        $data['board_name'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 24));
        $data['group_name'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 25));
        $data['occupation'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 21));
        $data['relation'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 40));
        $data['designation'] = $this->utilities->findAllByAttribute('hr_desig', array('ACTIVE_STATUS' => 1));
        $data['content_view_page'] ='admin/emp/edit_emp';

      }else{
        require(APPPATH.'views/common/image_upload/class.upload.php');
        $applicant_photo_name='';
        $signature_photo_name='';
        $foo = new Upload($_FILES['photo']);
        if ($foo->uploaded) {
                    // large size image
                    //$foo->file_new_name_body = 'foo';
          $foo->image_border= 1;
                    //$foo->image_border_color    = '#231F20';
          $foo->allowed = array('image/*');
          $foo->Process('upload/employee/photo/');
          if($foo->processed){
            $applicant_photo_name=  $foo->file_src_name;
          }else{
            echo  'error : ' . $foo->error;
          }
        }
        $sig_photo = new Upload($_FILES['signature']);
        if ($sig_photo->uploaded) {
                    // large size image
                    //$foo->file_new_name_body = 'foo';
          $sig_photo->image_border          = 1;
                    //$foo->image_border_color    = '#231F20';
          $sig_photo->allowed = array('image/*');
          $sig_photo->Process('upload/employee/signature/');
          if($sig_photo->processed){
            $signature_photo_name=  $sig_photo->file_src_name;
          }else{
            echo  'error : ' . $sig_photo->error;
          }
        }
          
       
       
        
        
         // ### applicant personal information ### 
        $emp_info = array(                
          'FULL_ENAME' => $this->input->post('FULL_NAME'),
          'FULL_BNAME' => $this->input->post('FULL_NAME_BN'),
          'DOB' => date("Y-m-d",strtotime($this->input->post('DOB'))), 
          'MOTHER_NAME' => $this->input->post('MOTHER_NAME'), 
          'FATHER_NAME' => $this->input->post('FATHER_NAME'),
          'PLACE_OF_BIRTH' => $this->input->post('PLACE_OF_BIRTH'),
          'MOBILE' => $this->input->post('MOBILE_NO'),
          'EMAIL' => $this->input->post('EMAIL'),
          'BLOOD_GROUP' => $this->input->post('BLOOD_GRP'),
          'MARITAL_STATUS' => $this->input->post('MARITAL_STATUS'),                                           
          'NATIONALITY' => $this->input->post('NATIONALITY'),
          'RELIGION' => $this->input->post('RELIGION_ID'),     
          'HIRE_DATE' =>date('Y-m-d',strtotime($this->input->post('JOIN_DATE'))),                                        
                                                 
          'ACTIVE_STATUS' => $this->input->post('ACTIVE_STATUS'),
          'NATIONAL_ID' => $this->input->post('NATIONAL_ID'),                          
          'HEIGHT_FEET' => $this->input->post('HEIGHT_FEET'),                          
          'HEIGHT_CM' => $this->input->post('HEIGHT_CM'),                          
          'WEIGHT_KG' => $this->input->post('WEIGHT_KG'),                          
          'WEIGHT_LBS' => $this->input->post('WEIGHT_LBS'),
          );
      

        if($applicant_photo_name != '')
        {
          $emp_info['EMP_IMG'] = $applicant_photo_name;

        }
        if($signature_photo_name != '')
        {
          $emp_info['EMP_SIG'] = $signature_photo_name;

        }
              // print_r($emp_info);exit;
        $this->utilities->updateData('hr_emp', $emp_info, array('EMP_ID' => $emp_id));

          $DEPT_ID=$this->input->post('DEPT_ID');
          $DESIG_ID=$this->input->post('DESIG_ID');
          $DEFAULT_FG=$this->input->post('DEFAULT_FG');
          $EDEPTDESI_ID=$this->input->post('EDEPTDESI_ID');
          //update employee department designation
 
          //var_dump($DEFAULT_FG); die();
          if(!empty($DEPT_ID)){
            for ($i = 0; $i < sizeof($DEPT_ID); $i++) {
             
              $designation_data=array( 
                'DEPT_ID' => $DEPT_ID[$i],
                'DESIG_ID' => $DESIG_ID[$i],
                'DEFAULT_FG' => $DEFAULT_FG[$i],
                'EMP_ID'=>$emp_id 
                );

                if($EDEPTDESI_ID[$i] !=''){
                 //echo "<pre>";  print_r( $designation_data); echo "</pre>";
                 $this->utilities->updateData('hr_edeptdesi', $designation_data, array('EDEPTDESI_ID' => $EDEPTDESI_ID[$i])); 
               }else{
                 
                $this->utilities->insertData($designation_data, 'hr_edeptdesi');
               }
            }
            //exit;
           
            
          }

        

        $this->session->set_flashdata('Success', 'Successfully Updated');
        redirect('employee/employee');

      }
      $this->admin_template->display($data); 

    }


    function empModal()
    {
      $EMP_ID = $_POST['EMP_ID'];
      $data['emp_id'] = $EMP_ID;
      $data["emp_info"] = $this->employee_model->empPersonalInfo($EMP_ID);
       $data["emp_desi"] = $this->employee_model->getEmployeeDesignation($EMP_ID);
        //echo "<pre>"; print_r($data); exit; echo "</pre>";
       //var_dump($data); die();
      echo $this->load->view('admin/emp/details_modal_view', $data, true);
    }


     function leaveReportsDetails()
    {
      $EMP_ID = $_POST['EMP_ID'];
      $data['emp_id'] = $EMP_ID;
      $data['leaveType'] = $this->utilities->findAllByAttribute('hr_leave_approved_mst', array('EMP_ID' => $EMP_ID )); 
      //echo "<pre>"; print_r($data); exit; echo "</pre>";
      echo $this->load->view('admin/leave_report/view_leave_request', $data, true);
    }


    function empPersonalDetails()
    {
      $EMP_ID = $_POST["EMP_ID"];
      $data["emp_info"] = $this->employee_model->empPersonalInfo($EMP_ID);
      $this->load->view('admin/emp/emp_personal_information', $data);
    }

   function empDesignationDetails()
    {
      $EMP_ID = $_POST["EMP_ID"];

      $data["emp_info"] = $this->employee_model->getEmployeeDesignation($EMP_ID);
      //var_dump($data);
      $this->load->view('admin/emp/emp_single_designation_info.php', $data);
    }


    function employeeListPdf()
    {
      $data['pageTitle'] = 'Print PDF';
      $data['emp_list'] = $this->utilities->findAllFromView('hr_emp');

      include('mpdf/mpdf.php');
      $mpdf = new mPDF();
      $mpdf->SetTitle('Employee Information');
      $mpdf->mirrorMargins = 1;
      $mpdf->useOnlyCoreFonts = true;
      $report = $this->load->view('admin/emp/emp_list_info', $data, TRUE);
        //$footer = $this->load->view('admin/emp/emp_list_info_footer', $data, TRUE);
      $mpdf->WriteHTML("$report");
      $mpdf->SetHTMLFooter("$footer");
      $mpdf->Output();
      exit;
    }
      function employeeCardPdf($emp_id)
    {
      $data['pageTitle'] = 'Print PDF';      
      $data['emp_info'] = $this->employee_model->findEmpById($emp_id);
      include('mpdf/mpdf.php');
      $mpdf = new mPDF();
      $mpdf->SetTitle('Employee Information');
      $mpdf->mirrorMargins = 1;
      $mpdf->useOnlyCoreFonts = true;
      $report = $this->load->view('admin/emp/emp_card_pdf', $data, TRUE);
        //$footer = $this->load->view('admin/emp/emp_list_info_footer', $data, TRUE);
      $mpdf->WriteHTML("$report");
      $mpdf->SetHTMLFooter("$footer");
      $mpdf->Output();
      exit;
    }
    function test()
    {
     $data['contentTitle'] = 'Employee List';
     $data['breadcrumbs'] = array(
      'Admin' => '#',
      'Employee List' => '#',
      );
     $data['content_view_page'] = 'admin/emp/multistep';
     $this->admin_template->display($data);
   }

      /**
     * @methodName addAttendance()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

    function attendance()
    {
        $data['contentTitle'] = 'Attendance';
        $data['breadcrumbs'] = array(
            'Attendance' => '#',
            'Attendance List' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['attendanceList'] = $this->utilities->findAllFromView('hr_attendance'); // select all data from unit
        $data['content_view_page'] = 'admin/attendance/attendance_index';
        $this->admin_template->display($data);
    }


   public function employeeDeleteItem()
    {
        $item_id = $this->input->post('item_id'); //
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

    /*
      * @methodName employeeInfoPdf
      * @access
      * @param  none
      * @author Md.Reazul Islam <reazul@atilimited.net>
      * @return 
      */
  function employeeInfoPdf($EMP_ID = '')
    {

      $data['pageTitle'] = 'Print PDF'; 
      $data["emp_personal_info"] = $this->employee_model->empPersonalInfo($EMP_ID);
      $data["emp_designation_info"] = $this->employee_model->getEmployeeDesignation($EMP_ID);
      include('mpdf/mpdf.php');
      $mpdf = new mPDF('','A4',10,'');
      $mpdf->autoLangToFont = true;
      $mpdf->SetTitle('Employee Information');
      $mpdf->mirrorMargins = 1;
      $mpdf->useOnlyCoreFonts = true;
      $report = $this->load->view('admin/emp/employee_mpdf_info', $data, TRUE);
        $mpdf->WriteHTML("$report");
      $mpdf->SetHTMLFooter("$footer");
      $mpdf->Output();
      exit;
    }


 }

 /* End of file Report.php */
/* Location: ./application/controllers/Report.php */