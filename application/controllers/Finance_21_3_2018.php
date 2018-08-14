<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @category
 * @package
 * @author     Abhijit M. Abhi <abhijit@atilimited.net>
 * @copyright  2017 ATI Limited Development Group
 */
class Finance extends CI_Controller
{

    private $user;
    public $user_id = null;

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in') == FALSE) {
            //redirect('auth/login', 'refresh');
        }
        $user_session = $this->user = $this->session->userdata("logged_in");
        $this->user_id = $user_session['USER_TYPE'];
        $this->load->model('utilities');
    }

    function checkPrevilege($param = "")
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

    function finance()
    {
        $data['contentTitle'] = 'Finance';
        $data['breadcrumbs'] = array(
            'Finance' => '#',
            'Finance List' => '#',
        );

        $data["previlages"] = $this->checkPrevilege();
        $data['charge'] = $this->utilities->findAllFromView('ac_academic_charge');

        //echo "<pre>"; print_r($data['charge']); exit;

        $data['content_view_page'] = 'admin/setup/finance/finance_index';
        $this->admin_template->display($data);
    }

    function financeFormInsert()
    {
        $data["ac_type"] = 1;
        $this->load->view('admin/setup/finance/add_finance', $data);
    }

    function createFinance()
    {
        $charge_name = $this->input->post('chargeName');
        $app_fee = $this->input->post('app_fee');
        $tution_fee = $this->input->post('tution_fee');
        $status = $this->input->post('status');

        $status = ((isset($_POST['status'])) ? 1 : 0);

        $check = $this->utilities->hasInformationByThisId("ac_academic_charge", array("CHARGE_NAME" => $charge_name));
        if (empty($check)) {

            $finance = array(
                'CHARGE_NAME' => $charge_name,
                'IS_APP_FEE' => $app_fee,
                'IS_TUTOIN_FEE' => $tution_fee,
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->insertData($finance, 'ac_academic_charge')) {
                // if data inserted successfully
                echo "<div class='alert alert-success'>Finance Create successfully</div>";
            } else {
                // if data inserted failed
                echo "<div class='alert alert-danger'>Finance Name insert failed</div>";
            }
        } else {
            // if degree name not available
            echo "<div class='alert alert-danger'>Finance Name Already Exist</div>";
        }
    }

    function financeList()
    {
        $data["previlages"] = $this->checkPrevilege("finance/finance");
        $data['charge'] = $this->utilities->findAllFromView('ac_academic_charge');
        $this->load->view("admin/setup/finance/finance_list", $data);
    }

    function financeFormUpdate()
    {
        $data["ac_type"] = 2;
        $id = $this->input->post('param');
        $data['charge'] = $this->utilities->findByAttribute('ac_academic_charge', array('CHARGE_ID' => $id));
        $this->load->view('admin/setup/finance/add_finance', $data);
    }


    function updateFinance()
    {
        $charge_id = $this->input->post('txtchargeId');
        $charge_Name = $this->input->post('chargeName');
        $app_fee = $this->input->post('app_fee');
        $tution_fee = $this->input->post('tution_fee');
        $status = $this->input->post('status');

        $check = $this->utilities->hasInformationByThisId("ac_academic_charge", array("CHARGE_NAME" => $charge_Name, "CHARGE_ID !=" => $charge_id));

        if (empty($check)) {
            $charge = array(
                'CHARGE_NAME' => $charge_Name,
                'IS_APP_FEE' => $app_fee,
                'IS_TUTOIN_FEE' => $tution_fee,
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );

            if ($this->utilities->updateData('ac_academic_charge', $charge, array('CHARGE_ID' => $charge_id))) {
                echo "<div class='alert alert-success'>Charge Update successfully</div>";
            } else { // if data update failed
                echo "<div class='alert alert-danger'>Charge Name Update failed</div>";
            }
        } else {// if degree name not available
            echo "<div class='alert alert-danger'>Charge Name Already Exist</div>";
        }
    }

    function financeById()
    {
        $charge_id = $this->input->post('param');
        $data["previlages"] = $this->checkPrevilege("finance/finance");
        $data['row'] = $this->utilities->findByAttribute('ac_academic_charge', array('CHARGE_ID' => $charge_id));
        $this->load->view('admin/setup/finance/single_finance_row', $data);
    }

    function deleteItem()
    {
        $item_id = $this->input->post('item_id');
        $data_tbl = $this->input->post('data_tbl');
        $data_field = $this->input->post('data_field');
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

    function statusItem()
    {
        $item_id = $this->input->post('item_id');
        $status = $this->input->post('status');
        $data_tbl = $this->input->post('data_tbl');
        $data_field = $this->input->post('data_field');
        $data_fieldId = $this->input->post('data_fieldId');
        if ($status == 1) {
            $new_status = 0;
        } else {
            $new_status = 1;
        }
        $update_status = array(
            "$data_field" => $new_status
        );
        if ($this->utilities->updateData($data_tbl, $update_status, array("$data_fieldId" => $item_id))) {
            echo "Y";
        } else {
            echo "N";
        }
    }

    function financeRate()
    {

        $data['contentTitle'] = 'Finance';
        $data['breadcrumbs'] = array(
            'Finance' => '#',
            'Finance Charge' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['financeRate'] = $this->finance_model->getRateList();
        $data['content_view_page'] = 'admin/setup/financeRate/finance_rate_index';
        $this->admin_template->display($data);

    }

    function financeRateInsert()
    {
        $data["ac_type"] = 1;
        $data["ac_charge_name"] = $this->utilities->findAllByAttribute("fn_achead", array("AC_TYPE_NO" => 2, "TRANS_FLAG" => 1)); // select all charge name from  ac_academic_charge
        $data["ins_session"] = $this->utilities->academicSessionList();
        $data['program'] = $this->utilities->getAll('ins_program');
        //echo "<pre>"; print_r($data['ins_session']); exit;
        $this->load->view('admin/setup/financeRate/add_finance_rate', $data);
    }

    function financeRateList()
    {
        $data["previlages"] = $this->checkPrevilege("setup/financeRate");
        $data['financeRate'] = $this->finance_model->getRateList();
        $this->load->view("admin/setup/financeRate/finance_rate_list", $data);
    }

    function createFinanceRate()
    {

        $AC_NO = $this->input->post('AC_NO');
        $amount = $this->input->post('AMOUNT');
        $academicSession = $this->input->post('SESSION_ID');
        $program_id = $this->input->post('PROGRAM_ID');
        $status = ((isset($_POST['status'])) ? 1 : 0);
        for ($i = 0; $i < sizeof($AC_NO); $i++) {
            $chargeRate = array(
                'AC_NO' => $AC_NO[$i],
                'AMOUNT' => $amount[$i],
                'SESSION_ID' => $academicSession,
                'PROGRAM_ID' => $program_id,
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            $this->utilities->insertData($chargeRate, 'fn_academic_charge_rate');
        }
        // checking if Program with this name is already exist
        // $check = $this->utilities->hasInformationByThisId("ac_academic_charge_rate", array("CHARGE_ID" => $Charge, "SESSION_ID" => $AcademicSession, "PROGRAM_ID" => $programName));
    }

    function financeRateEdit()
    {
        $data["ac_type"] = 2;
        $id = $this->input->post('param');
        //echo "<pre>"; print_r($id);exit();
        $data["ins_session"] = $this->utilities->academicSessionList();
        $data["charge"] = $this->utilities->findAllByAttribute("fn_achead", array("AC_TYPE_NO" => 2, "TRANS_FLAG" => 1)); // select all charge name from  charge
        $data['program'] = $this->utilities->getAll('ins_program');
        $data['financeRate'] = $this->finance_model->getRateById($id);
        $this->load->view('admin/setup/financeRate/edit_finance_rate', $data);
    }

    function updateFinanceRate()
    {
        $rate_id = $this->input->post('txtRateId');
        $AC_NO = $this->input->post('AC_NO'); // charge
        $Amount = $this->input->post('AMOUNT'); // Amount
        $AcademicSession = $this->input->post('SESSION_ID'); // Session
        $programName = $this->input->post('PROGRAM_ID'); // Program name
        $status = $this->input->post('status');

        // $check = $this->utilities->hasInformationByThisId("ac_academic_charge_rate", array("CHARGE_ID" => $Charge, "SESSION_ID" => $AcademicSession, "RATE_ID !=" => $rate_id));

        $chargeRate = array(
            'AC_NO' => $AC_NO,
            'AMOUNT' => $Amount,
            'SESSION_ID' => $AcademicSession,
            'PROGRAM_ID' => $programName,
            'ACTIVE_STATUS' => $status,
            'CREATED_BY' => $this->user["USER_ID"]
        );

        if ($this->utilities->updateData('fn_academic_charge_rate', $chargeRate, array('RATE_ID' => $rate_id))) {
            echo "<div class='alert alert-success'>Finance Rate Update successfully</div>";
        } else { // if data update failed
            echo "<div class='alert alert-danger'>Finance Rate Update failed</div>";
        }

    }

    function financeRateById()
    {
        $rate_id = $this->input->post('param');
        $data['row'] = $this->finance_model->getRateById($rate_id);
        $this->load->view('admin/setup/financeRate/finance_rate_row', $data);
    }

    function sessionListAlreadyRated()
    {
        $program_id = $this->input->post('program_id');
        $query = $this->finance_model->examSessionRatedList($program_id);
        $returnVal = '<option value="">--Select--</option>';
        if (!empty($query)) {
            foreach ($query as $row) {
                $returnVal .= '<option value="' . $row->YSESSION_ID . '">' . $row->SESSION_NAME . '</option>';
            }
        }
        echo $returnVal;
    }

    function chargeRateProSesWise()
    {
        $PROGRAM_ID = $this->input->post('PROGRAM_ID');
        $PREVIOUS_YSESSION = $this->input->post('PREVIOUS_YSESSION');
        $data['PROGRAM_ID'] = $PROGRAM_ID;
        $data['PREVIOUS_YSESSION'] = $PREVIOUS_YSESSION;
        $data["ac_charge_name"] = $this->utilities->findAllByAttribute("fn_achead", array("AC_TYPE_NO" => 2, "TRANS_FLAG" => 1));
        $data['pre_charge_rate'] = $this->utilities->findAllByAttribute('fn_academic_charge_rate', array('PROGRAM_ID' => $PROGRAM_ID, 'SESSION_ID' => $PREVIOUS_YSESSION));
        $this->load->view('admin/setup/financeRate/previous_finance_rate', $data);

    }

    function payment()
    {
        $data['contentTitle'] = 'Payment';
        $data['breadcrumbs'] = array(
            'Finance' => '#',
            'Payment' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data["registered_student"] = $this->finance_model->getRegistredStudent();

        //echo "<pre>"; print_r($data["registered_student"]); exit;

        $data['content_view_page'] = 'admin/payment/payment_student_list';
        $this->admin_template->display($data);
    }

    function studentPayment($student_id)
    {
        $data['contentTitle'] = 'Payment';
        $data['breadcrumbs'] = array(
            'Finance' => '#',
            'Payment' => '#',
        );


        $data["student_id"] = $student_id;
        $data['student_info'] = $this->student_model->getStudentInfoAll($student_id);
        $data["session"] = $this->student_model->getAllSessionByStudentId($student_id);

//            echo "<pre>"; print_r($data["session"][0]->YSESSION_ID); exit;


        $data["semester_wise_payment"] = $this->student_model->getStudentWiseSemesterPayment($student_id, $data["session"][0]->YSESSION_ID);
        $data["semester_regi_course"] = $this->student_model->getRegCorseListBySession($student_id, $data["session"][0]->YSESSION_ID);

           //echo  "<pre>"; print_r( $data["semester_regi_course"]); exit;

        $data['content_view_page'] = 'admin/payment/admin_student_payment_form';
        $this->admin_template->display($data);
    }

    function fresherStudentPayment($student_id, $session_id, $program_id)
    {
        $data['contentTitle'] = 'Payment';
        $data['breadcrumbs'] = array(
            'Finance' => '#',
            'Payment' => '#',
        );


        $data["student_id"] = $student_id;
        $data['student_info'] = $this->student_model->getStudentInfoAll($student_id);
        $data["session"] = $this->student_model->getAllSessionByStudentId($student_id);

//            echo "<pre>"; print_r($data["session"]); exit;


        $data["semester_wise_payment"] = $this->student_model->getFreshStudentWiseSemesterPayment($session_id, $program_id);
        $data["semester_regi_course"] = $this->student_model->getStudentWiseEnrolledCourse($student_id,$session_id);

//        echo "<pre>"; print_r($data["semester_wise_payment"]); exit;

        $this->load->view('admin/payment/admin_fresh_student_payment_form',$data);
       // $data['content_view_page'] = 'admin/payment/admin_fresh_student_payment_form';
        //$this->admin_template->display($data);
    }

    function myFunction($student_id)
    {


        $data["student_id"] = $student_id;
        $data['student_info'] = $this->student_model->getStudentInfoAll($student_id);
        $data["session"] = $this->student_model->getAllSessionByStudentId($student_id);

//        echo "pre>"; print_r($data['student_info'] ); exit;


        $data["semester_wise_payment"] = $this->student_model->getStudentWiseSemesterPayment($student_id, 6);
        $data["semester_regi_course"] = $this->student_model->getRegCorseListBySession($student_id, 6);

        $this->load->view('admin/payment/payment_details_only', $data);

    }

    function createVoucher()
    {
        $studentId = $this->input->post('studentId');
        $accountNo = $this->input->post('accountNo');
        $payAmount = $this->input->post('payAmount');        
        $billingChildId = $this->input->post('billingChildId');
        $payment_mode = $this->input->post('payment_mode');
        $student_info = $this->student_model->getStudentInfoAll($studentId);
        $v_master_pk = $this->utilities->pk_f('fn_vouchermst');
        $voucher_no = $v_master_pk;

//            print_r($this->input->post()); exit;

        $vouchermstData = array(
            'VOUCHER_NO' => $voucher_no,
            'VOUCHER_DT' => date('Y-m-d', time()),
            'STUDENT_ID' => $student_info->STUDENT_ID,
            'ROLL_NO' => $student_info->REGISTRATION_NO,
            'FACULTY_ID' => $student_info->FACULTY_ID,
            'DEPT_ID' => $student_info->DEPT_ID,
            'PROGRAM_ID' => $student_info->PROGRAM_ID,
            'SESSION_ID' => $student_info->current_session_name,
            'PAYMENT_MODE' => $payment_mode,
            'PAYMENT_DT' => date('Y-m-d', strtotime($this->input->post('payment_date'))),
            'PAYMENT_SL_NO' => $this->input->post('payment_sl_no'),
//                'SEMESTER_ID' =>  $student_info->current_session_name,
//                'STU_SEMINFO_ID' =>
//                'ORG_ID' =>
//                'CREATED_BY' =>
        );

        $this->utilities->insertData($vouchermstData, 'fn_vouchermst');

        $insert_id = $voucher_no;


        for ($i = 0; $i < sizeof($accountNo); $i++) {
            $v_child_pk = $this->utilities->pk_f('fn_voucherchd');
            $TRX_TRAN_NO = $v_child_pk;

            $fn_voucherchdData = array(
                'TRX_TRAN_NO' => $TRX_TRAN_NO,
                'VOUCHER_NO' => $insert_id,
                'AC_NO' => $accountNo[$i],
                'PAID_AMT' => '-' . $payAmount[$i],
                'BILLING_CHD_ID' => $billingChildId[$i],

            );
            if($payAmount[$i] !=''){
                $this->utilities->insertData($fn_voucherchdData, 'fn_voucherchd');
            }
        }

       if ($i == sizeof($accountNo)) {
            $v_child_pk = $this->utilities->pk_f('fn_voucherchd');
            $TRX_TRAN_NO = $v_child_pk;
            $acc_no = $this->db->select('AC_NO')->get_where('fn_default_transection', array('AC_FOR' => $payment_mode))->row();
            $add_this_cal = $this->db->query("SELECT SUM(PAID_AMT) AS PAID_AMT FROM fn_voucherchd WHERE VOUCHER_NO = $insert_id")->result();


            $fn_voucherchdData = array(
                'TRX_TRAN_NO' => $TRX_TRAN_NO,
                'VOUCHER_NO' => $insert_id,
                'AC_NO' => $acc_no->AC_NO,
                'PAID_AMT' => abs($add_this_cal[0]->PAID_AMT),
                'BILLING_CHD_ID' => 0,
            );
            

                $this->utilities->insertData($fn_voucherchdData, 'fn_voucherchd');
            
        }


//            echo "<pre>"; print_r($vouchermst); exit;
    }

    function paymentDetailsBySemester($student_id)
    {

        $ysession_id = $this->input->post('YSESSION_ID');
        $data['student_info'] = $this->utilities->findByAttribute('student_personal_info', array('STUDENT_ID' => $student_id));
        $data['semester_wise_course'] = $this->student_model->getAllCourseByStudentIdAndSessionWise($student_id, $ysession_id);
        $data['charge_rate'] = $this->student_model->getChargeRate($data['student_info']->PROGRAM_ID, $ysession_id);
        $this->load->view('admin/payment/admin_semester_wise_student_payment_form', $data);
    }

    #############################<-------Nurullah----Start------>########################################

    /**
     * @access none
     * @author Nurullah nurul@atilimited.net
     * @param  none
     * @return
     */
    function admissionPayment()
    {
        $data['contentTitle'] = 'Admission Payment';
        $data['breadcrumbs'] = array(
            'Finance' => '#',
            'Payment' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data["faculty"] = $this->utilities->findAllByAttribute("ins_faculty", array('ACTIVE_STATUS' => 1));
        $data['semester'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 16));
        $data["session"] = $this->utilities->admissionSessionList();
        $data["applicant"] = $this->finance_model->getAdmittedStudentList($FACULTY_ID = '', $DEPT_ID = '', $PROGRAM_ID = '');
//            $data['applicant'] = $this->db->query("select a.*,c.FACULTY_NAME,d.DEPT_NAME,e.PROGRAM_NAME,f.SESSION_NAME,g.LKP_NAME from students_info a
//                                                    left join stu_semesterinfo b on a.STUDENT_ID = b.STUDENT_ID
//                                                    left join faculty c on b.FACULTY_ID = c.FACULTY_ID
//                                                    left join department d on b.DEPT_ID=d.DEPT_ID
//                                                    left join program e on b.PROGRAM_ID = e.PROGRAM_ID
//                                                    left join session_view f on b.SEM_SESSION=f.SESSION_ID
//                                                    left join m00_lkpdata g on b.SEMESTER_ID=g.LKP_ID")->result();
        $data['content_view_page'] = 'admin/payment/admission_payment_student_list';
        $this->admin_template->display($data);
    }

    /**
     * @access none
     * @author Nurullah nurul@atilimited.net
     * @param  none
     * @return
     */
    public function getAdmittedStudent()
    {
        $FACULTY_ID = $_POST['FACULTY_ID'];
        $DEPT_ID = $_POST['DEPT_ID'];
        $PROGRAM_ID = $_POST['PROGRAM_ID'];

        $data["registered_student"] = $this->finance_model->getAdmittedStudentList($FACULTY_ID, $DEPT_ID, $PROGRAM_ID);
        $this->load->view('admin/payment/get_admitted_student_list', $data);
    }

    /**
     * @access none
     * @author Nurullah nurul@atilimited.net
     * @param  none
     * @return
     */
    function admittedStudentPayment1($student_id, $program_id)
    {
        $data['contentTitle'] = 'Payment';
        $data['breadcrumbs'] = array(
            'Finance' => '#',
            'Payment' => '#',
        );
        $this->load->library('form_validation');
        $this->form_validation->set_rules('receipt_no', 'Money Receipt No is', 'required');
        $this->form_validation->set_rules('receipt_date', 'Money Receipt Date is', 'required');
        $this->form_validation->set_rules('trx_no', 'Bank Trx No id', 'required');
        $this->form_validation->set_rules('amount', 'Amount of value is', 'required');
        if ($this->form_validation->run() == TRUE) {
            $student_info = $this->utilities->findByAttribute('student_personal_info', array('STUDENT_ID' => $student_id));
            $createVoucher = array(
                'VOUCHER_NO' => 3,
                'VOUCHER_DT' => date("Y-m-d"),
                'STUDENT_ID' => $student_id,
                'ROLL_NO' => $student_info->REGISTRATION_NO,
                'FACULTY_ID' => $student_info->FACULTY_ID,
                'DEPT_ID' => $student_info->DEPT_ID,
                'PROGRAM_ID' => $student_info->PROGRAM_ID,
                'SESSION_ID' => $student_info->SESSION_ID,
                'SEMESTER_ID' => 1,
                'ORG_ID' => 1,
                'CREATED_BY' => $this->user["USER_ID"]
            );
            $this->utilities->insertData($createVoucher, 'bm_vouchermst');
            $voucherid = $this->db->insert_id();
            var_dump($voucherid);
            //var_dump($voucher);exit;
            //$this->db->trans_start();
            //$this->db->trans_complete();
            /*if () {
                $this->utilities->insertData($createVoucher, 'bm_vouchermst')
                $voucherid = $this->db->insert_id();
                var_dump($voucherid);
            // if data inserted successfully
                echo "<div class='alert alert-success'>Payment Complete successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Payment failed</div>";
            }*/
        }

        $cur_session = $this->user["SESSION_ID"];
        $data["session_name"] = $this->utilities->academicSessionById($cur_session);
        $data["student_info"] = $this->finance_model->getStudentInfoByStudentID($student_id);
        $data["charge_info"] = $this->finance_model->getAdmittedStudentFeeInfo($program_id, $cur_session);
        $data['semester_wise_course'] = $this->student_model->getAllCourseByStudentIdAndSessionWise($student_id, $cur_session);
        $data['content_view_page'] = 'admin/payment/admitted_student_payment_form';
        $this->admin_template->display($data);
    }

    function admittedStudentPayment($student, $program_id)
    {
        $data['contentTitle'] = 'Payment Form';
        $data["breadcrumbs"] = array(
            "Admin" => "admin/index",
            "Payment Form" => '#'
        );
        //$student = $this->uri->segment(3);
        if ($student) {
            $data["student_info"] = $this->db->query("select ssi.STU_SEMINFO_ID, ssi.STUDENT_ID, spi.FULL_NAME_EN, spi.REGISTRATION_NO,
                    ssi.SESSION_ID, 
                    ssi.SEMESTER_SL_NO,
                    ssi.FACULTY_ID,(SELECT f.FACULTY_NAME FROM ins_faculty f WHERE f.FACULTY_ID = ssi.FACULTY_ID)FACULTY_NAME,
                    ssi.DEPT_ID,(SELECT d.DEPT_NAME FROM ins_dept d WHERE d.DEPT_ID = ssi.DEPT_ID)DEPT_NAME,
                    ssi.PROGRAM_ID,(SELECT p.PROGRAM_NAME FROM ins_program p WHERE p.PROGRAM_ID = ssi.PROGRAM_ID)PROGRAM_NAME,
                    ssi.IS_CURRENT
                    from student_semesterinfo ssi
                    inner join student_personal_info spi on ssi.STUDENT_ID = spi.STUDENT_ID
                    Where ssi.STUDENT_ID = $student AND ssi.IS_CURRENT = 1 GROUP BY ssi.STUDENT_ID")->row();
            $exp_cond = array(
                "FACULTY_ID" => $data["student_info"]->FACULTY_ID,
                "DEPT_ID" => $data["student_info"]->DEPT_ID,
                "PROGRAM_ID" => $data["student_info"]->PROGRAM_ID,
                "SESSION_ID" => $data["student_info"]->SESSION_ID,
                "SEMESTER_ID" => $data["student_info"]->SEMESTER_SL_NO,
                "ac_program_particulars.ACTIVE_STATUS" => 1
            );
            $txtFaculty = $data["student_info"]->FACULTY_ID;
            $txtDept = $data["student_info"]->DEPT_ID;
            $txtProgram = $data["student_info"]->PROGRAM_ID;
            $txtSession = $data["student_info"]->SESSION_ID;
            $semester = $data["student_info"]->SEMESTER_SL_NO;
            //all expenses in a semester
            //$data["expenses"] = $this->utilities->findAllByAttributeWithJoin("ac_program_particulars", "ac_academic_charge", "PARTICULAR_ID", "CHARGE_ID", "CHARGE_NAME", $exp_cond);
            $data["expenses"] = $this->db->query("SELECT a.*, (SELECT b.CHARGE_NAME FROM ac_academic_charge b WHERE a.CHARGE_ID = b.CHARGE_ID)CHARGE_NAME
                    FROM ac_academic_charge_rate a
                    WHERE a.SESSION_ID = $txtSession AND a.PROGRAM_ID = $txtProgram")->result();
            // getting student current and completed semesters
            //var_dump($data["expenses"]);exit;
            $data["semesters"] = $this->db->query("select a.SEMESTER_SL_NO, b.LKP_NAME, a.SESSION_ID, c.DINYEAR, b.NUMB_LKP,
                    (select d.SESSION_NAME from ins_session d where c.SESSION_ID = d.SESSION_ID)SESSION_NAME
                    from student_semesterinfo a
                    left join m00_lkpdata b on b.NUMB_LKP = a.SEMESTER_SL_NO
                    left join ins_ysession c on c.YSESSION_ID = a.SESSION_ID
                    WHERE b.GRP_ID = 16 AND a.STUDENT_ID = '$student' order by b.LKP_ID")->result();
            // total payment of a student in a semester
            $data["dueAmt"] = $this->db->query("SELECT v.VOUCHER_NO, v.VOUCHER_DT, v.STUDENT_ID, v.ROLL_NO, v.REMARKS, l.TRX_CODE_NO, l.TRX_TRAN_NO, l.CR_AMT, sum(l.DR_AMT) DEBIT
                    FROM bm_vouchermst v INNER JOIN bm_vn_ledgers l ON v.VOUCHER_NO = l.VOUCHER_NO
                    WHERE v.STUDENT_ID = '$student' AND v.SEMESTER_ID = $semester AND l.TRX_CODE_NO = 'PM' GROUP BY v.STUDENT_ID")->row();
//            // getting all previous semesters
            $previous_semester_id = $this->db->query("SELECT LKP_ID FROM m00_lkpdata WHERE LKP_ID = (select max(m.LKP_ID) from m00_lkpdata m where LKP_ID < $semester AND GRP_ID = 16)")->row();
//            //print_r($previous_semester_id);
            $is_new_payment_data = array(
                "FACULTY_ID" => $data["student_info"]->FACULTY_ID,
                "DEPT_ID" => $data["student_info"]->DEPT_ID,
                "PROGRAM_ID" => $data["student_info"]->PROGRAM_ID,
                "SESSION_ID" => $data["student_info"]->SESSION_ID,
                "SEMESTER_ID" => $data["student_info"]->SEMESTER_SL_NO
            );
            $semester_seq = $this->utilities->findByAttribute("m00_lkpdata", array("LKP_ID" => $semester));
            $data["semester_seq"] = $semester_seq->LKP_NAME;
            $data["total_amt"] = 0;
//            // checking if any payment is done by student in a semester
            $data["is_new_payment"] = $this->utilities->hasInformationByThisId("bm_vouchermst", $is_new_payment_data);
            if (!empty($previous_semester_id)) {
                $ids = array();
                $prev_all_semester_ids = $this->db->query("SELECT LKP_ID FROM m00_lkpdata WHERE LKP_ID IN (select m.LKP_ID from m00_lkpdata m where LKP_ID < $semester AND GRP_ID = 16)")->result();
                foreach ($prev_all_semester_ids as $prev_all_semester_id) {
                    $ids[] = $prev_all_semester_id->LKP_ID;
                }
                $all_ids = implode(",", $ids);
                $data["prevSemesterAmt"] = $this->utilities->getStuPaidAmt($student, $all_ids);
                $data["prev_expenses"] = $this->db->query("SELECT SUM(PARTICULAR_AMOUNT)PARTICULAR_AMOUNT FROM ac_program_particulars
                        WHERE `FACULTY_ID` = $txtFaculty AND `DEPT_ID` = $txtDept AND `PROGRAM_ID` = $txtProgram
                        AND `SESSION_ID` = $txtSession AND `SEMESTER_ID` IN ($all_ids)")->row();
            }
        }
        //$data['content_view_page'] = 'admin/payment/index';
        $data['content_view_page'] = 'admin/payment/admitted_student_payment_form';
        $this->admin_template->display($data);
    }

    public function getAllSemesterExpenses()
    {
        // recieving all form data
        $txtStudent = $this->input->post("txtStudent");
        $txtFaculty = $this->input->post("txtFaculty");
        $txtDept = $this->input->post("txtDept");
        $txtProgram = $this->input->post("txtProgram");
        $semester = $this->input->post("semester_id");

        $data['txtStudent'] = $txtStudent;
        $data['txtFaculty'] = $txtFaculty;
        $data['txtDept'] = $txtDept;
        $data['txtProgram'] = $txtProgram;
        $data['semester'] = $semester;
        // getting all semester ids of student
        $prev_all_semester_ids = $this->db->query("SELECT  a.SEMESTER_SL_NO, a.STUDENT_ID, a.SESSION_ID, b.LKP_NAME, b.NUMB_LKP
                FROM student_semesterinfo a 
                INNER JOIN m00_lkpdata b ON b.NUMB_LKP = a.SEMESTER_SL_NO
                WHERE b.GRP_ID = 16 AND a.STUDENT_ID = '$txtStudent' 
                AND a.FACULTY_ID = '$txtFaculty' 
                AND a.DEPT_ID = '$txtDept' 
                AND a.PROGRAM_ID = '$txtProgram'")->result();

        $ids = array();
        foreach ($prev_all_semester_ids as $prev_all_semester_id) {
            // pushing all semester ids into array
            $ids[] = $prev_all_semester_id->SESSION_ID;
        }
        $all_ids = implode(",", $ids);
        // getting expense details by semester ids
        $data["expenses"] = $this->db->query("SELECT m.LKP_ID,m.LKP_NAME,p.SESSION_ID, s.SESSION_NAME SESSION, SUM(p.PARTICULAR_AMOUNT)EXPENSE_AMT
                FROM ac_program_particulars p LEFT JOIN m00_lkpdata m ON p.SEMESTER_ID = m.LKP_ID
                INNER JOIN session_view s ON p.SESSION_ID = s.SESSION_ID
                WHERE p.FACULTY_ID = $txtFaculty AND p.DEPT_ID = $txtDept AND p.PROGRAM_ID = $txtProgram
                AND p.SEMESTER_ID IN ($all_ids) GROUP BY p.SEMESTER_ID ORDER BY p.SEMESTER_ID DESC")->result();
        // total payment of a student in a semester
        //var_dump( $data["expenses"] );exit;
        $data["dueAmt"] = $this->db->query("SELECT v.VOUCHER_NO, v.VOUCHER_DT, v.STUDENT_ID, v.ROLL_NO, v.REMARKS, l.TRX_CODE_NO, l.TRX_TRAN_NO, l.CR_AMT, sum(l.DR_AMT) DEBIT
                FROM bm_vouchermst v INNER JOIN bm_vn_ledgers l ON v.VOUCHER_NO = l.VOUCHER_NO
                WHERE v.STUDENT_ID = '$txtStudent' AND l.TRX_CODE_NO = 'PM' GROUP BY v.STUDENT_ID")->row();
        echo $this->load->view("common/payment/stu_all_expense_details", $data, true);
    }

    /**
     * @param  semester is an integer defining Semester ID
     * @author      Jahid Hasan <jahid@atilimited.net>
     * @return      Payment Template
     */
    function getExpenseDetailsBySemester()
    {
        $txtStudent = $this->input->post("txtStudent");
        $txtFaculty = $this->input->post("txtFaculty");
        $txtDept = $this->input->post("txtDept");
        $txtProgram = $this->input->post("txtProgram");
        $txtSession = $this->input->post("txtSession");
        $semester = $this->input->post("semester");
        $data["semester_seq"] = $this->input->post("txtSemesterSeq");
        $exp_cond = array(
            "FACULTY_ID" => $txtFaculty,
            "DEPT_ID" => $txtDept,
            "PROGRAM_ID" => $txtProgram,
            "SESSION_ID" => $txtSession,
            "SEMESTER_ID" => $semester
        );
        $data["expenses"] = $this->db->query("SELECT a.*, (SELECT b.CHARGE_NAME FROM ac_academic_charge b WHERE a.CHARGE_ID = b.CHARGE_ID)CHARGE_NAME
            FROM ac_academic_charge_rate a
            WHERE a.SESSION_ID = $txtSession AND a.PROGRAM_ID = $txtProgram")->result();
        //$data["expenses"] = $this->utilities->findAllByAttributeWithJoin("ac_program_particulars", "ac_academic_charge", "PARTICULAR_ID", "CHARGE_ID", "CHARGE_NAME", $exp_cond);
        $data["dueAmt"] = $this->utilities->getStuPaidAmt($txtStudent, $semester);
        $prev_all_semester_ids = $this->utilities->findAllByAttribute("sav_semester", array("SL_NO < " => $data["semester_seq"]));
        if (!empty($previous_semester_id)) {
            $ids = array();
            foreach ($prev_all_semester_ids as $prev_all_semester_id) {
                $ids[] = $prev_all_semester_id->SEMESTER_ID;
            }
            $all_ids = implode(",", $ids);
            $data["prevSemesterAmt"] = $this->utilities->getStuPaidAmt($txtStudent, $all_ids);
            $data["prev_expenses"] = $this->db->query("SELECT SUM(PARTICULAR_AMOUNT)PARTICULAR_AMOUNT FROM ac_program_particulars
                WHERE `FACULTY_ID` = $txtFaculty AND `DEPT_ID` = $txtDept AND `PROGRAM_ID` = $txtProgram
                AND `SESSION_ID` = $txtSession AND `SEMESTER_ID` IN ($all_ids)")->row();
        }
        echo $this->load->view("admin/payment/stu_expense_details", $data, true);
    }

    /**
     * @methodName getExpenseDetails()
     * @access
     * @param  expense_id is an integer defining Expense ID
     * @author      Jahid Hasan <jahid@atilimited.net>
     * @return      Payment Template
     */
    function getExpenseDetails()
    {
        $txtFaculty = $this->input->post("faculty");
        $txtDept = $this->input->post("department");
        $txtProgram = $this->input->post("program");
        $semester = $this->input->post("semester");
        $txtSession = $this->input->post("session");
        $expense_id = $this->input->post("expense_id");
        $exp_cond = array(
            "FACULTY_ID" => $txtFaculty,
            "DEPT_ID" => $txtDept,
            "PROGRAM_ID" => $txtProgram,
            "SESSION_ID" => $txtSession,
            "SEMESTER_ID" => $semester
        );
        $rs = $this->db->query("SELECT a.RATE_ID,a.CHARGE_ID,a.AMOUNT,
            (SELECT b.CHARGE_NAME FROM ac_academic_charge b WHERE b.CHARGE_ID = a.CHARGE_ID)CHARGE_NAME 
            FROM ac_academic_charge_rate a
            WHERE PROGRAM_ID = $txtProgram
            AND SESSION_ID = $txtSession
            AND CHARGE_ID = $expense_id")->row();
        if (!empty($rs)) {
            echo '<tr id="row_' . $expense_id . '">
            <td class="text-navy">
                <strong>' . $rs->CHARGE_NAME . '</strong>
                <input type="hidden" class="expense_id" value="' . $expense_id . '" name="txtExpenseId[]" />
                <input type="hidden" class="expense_rate" id="amt_' . $expense_id . '" value="' . $rs->AMOUNT . '" />
                <input type="hidden" id="item_amt_' . $expense_id . '" value="' . $rs->AMOUNT . '" name="txtExpenseRate[]" />
            </td>
            <td id="total_' . $expense_id . '">' . number_format($rs->AMOUNT, 2) . '</td>
        </tr>';
        }
    }

    function getExpenseDetails_existingStu()
    {

        $txtFaculty = $this->input->post("faculty");
        $txtDept = $this->input->post("department");
        $txtProgram = $this->input->post("program");
        $semester = $this->input->post("semester");
        $txtSession = $this->input->post("session");
        $isCurrent = $this->input->post("isCurrent");
        $rate_id = $this->input->post("expense_id");

        $current = explode(' ', $isCurrent);
        $last_word = array_pop($current); /* it's current or not */

        $session_ex = explode(',', $txtSession);
        $session = $session_ex[1]; /*current session*/
        $exp_cond = array(
            "FACULTY_ID" => $txtFaculty,
            "DEPT_ID" => $txtDept,
            "PROGRAM_ID" => $txtProgram,
            "SESSION_ID" => $session,
            "SEMESTER_ID" => $semester
        );
        /*Check is_previous id o or 1*/
        if ($last_word == "[current]") {
            $rs = $this->db->query("SELECT pp.P_PARTICULAR_ID, pp.PARTICULAR_ID, pp.PARTICULAR_AMOUNT, (SELECT c.CHARGE_NAME FROM ac_academic_charge c WHERE c.CHARGE_ID = pp.PARTICULAR_ID)CHARGE_NAME
            FROM ac_program_particulars pp
            WHERE   FACULTY_ID = $txtFaculty AND DEPT_ID = $txtDept
            AND PROGRAM_ID = $txtProgram
            AND SESSION_ID = $session
            AND SEMESTER_ID = $semester AND PARTICULAR_ID = $rate_id")->row();
            if (!empty($rs)) {
                echo '<tr id="row_' . $rate_id . '">
            <td class="text-navy">
                <strong>' . $rs->CHARGE_NAME . '</strong>
                <input type="hidden" class="expense_id" value="' . $rate_id . '" name="txtExpenseId[]" />
                <input type="hidden" class="expense_rate" id="amt_' . $rate_id . '" value="' . $rs->PARTICULAR_AMOUNT . '" />
                <input type="hidden" id="item_amt_' . $rate_id . '" value="' . $rs->PARTICULAR_AMOUNT . '" name="txtExpenseRate[]" />
            </td>
            <td id="total_' . $rate_id . '">' . number_format($rs->PARTICULAR_AMOUNT, 2) . '</td>
        </tr>';
            }
        } else {
            $rs = $this->db->query("SELECT aac.CHARGE_NAME, acr.*
        FROM ac_academic_charge_rate acr
        INNER JOIN ac_academic_charge aac on aac.CHARGE_ID = acr.CHARGE_ID
        WHERE acr.RATE_ID = $rate_id")->row();
            if (!empty($rs)) {
                echo '<tr id="row_' . $rate_id . '">
        <td class="text-navy">
            <strong>' . $rs->CHARGE_NAME . '</strong>
            <input type="hidden" class="expense_id" value="' . $rate_id . '" name="txtExpenseId[]" />
            <input type="hidden" class="expense_rate" id="amt_' . $rate_id . '" value="' . $rs->AMOUNT . '" />
            <input type="hidden" id="item_amt_' . $rate_id . '" value="' . $rs->AMOUNT . '" name="txtExpenseRate[]" />
        </td>
        <td id="total_' . $rate_id . '">' . number_format($rs->AMOUNT, 2) . '</td>
    </tr>';
            }
        }
        exit();
        /*end check*/
    }

    function chartOfAccount()
    {
        $data['contentTitle'] = 'Chart Of Account';
        $data['breadcrumbs'] = array(
            'Finance' => '#',
            'Chart of Account' => '#',
        );
        $data['fn_acctype'] = $this->utilities->getAll('fn_acctype');
        $data['content_view_page'] = 'admin/finance/chart_of_acc_index';
        $this->admin_template->display($data);
    }

//Start Nurullah
    function chartofAccFormInsert()
    {
        $data['ac_type'] = 1;
        $data['parent_id'] = $this->input->post('param');
        $data['bill_type'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 81));
        $this->load->view('admin/finance/add_chartofacc', $data);

    }

    function createAccHead()
    {
        $parent_id = $this->input->post('parent_id');
        $array = explode(',', $parent_id);
        $AC_TYPE_NO = $array[1];
        $PARANT_AC_NO = $array[0];
        $AC_NAME = $this->input->post('AC_NAME');
        $AC_NO_UD = $this->input->post('AC_NO_UD');
        $BILLING_TYPE = $this->input->post('BILLING_TYPE');
        $status = ((isset($_POST['status'])) ? 1 : 0);
        $TRANS_FLAG = ((isset($_POST['TRANS_FLAG'])) ? 1 : 0);

        $check = $this->utilities->hasInformationByThisId("fn_achead", array("AC_NAME" => $AC_NAME, 'AC_TYPE_NO' => $AC_TYPE_NO, 'PARANT_AC_NO' => $PARANT_AC_NO));
        if (empty($check)) {
            $acc_head_data = array(
                'AC_NAME' => $AC_NAME,
                'AC_NO_UD' => $AC_NO_UD,
                'AC_TYPE_NO' => $AC_TYPE_NO,
                'PARANT_AC_NO' => $PARANT_AC_NO,
                'BILLING_TYPE' => $BILLING_TYPE,
                'ACTIVE_STATUS' => $status,
                'TRANS_FLAG' => $TRANS_FLAG,
                'ENTERED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->insertData($acc_head_data, 'fn_achead')) {
                echo "<div class='alert alert-success'> Create successfully</div>";
            } else {
                echo "<div class='alert alert-danger'> Name insert failed</div>";
            }
        } else {
            echo "<div class='alert alert-danger'> Name Already Exist</div>";
        }
    }

    function chartofAccFormUpdate()
    {
        $data['ac_type'] = 2;
        $id = $this->input->post('param');
        $data['bill_type'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 81));
        $data['ac_head'] = $this->utilities->findByAttribute('fn_achead', array('AC_NO' => $id));
        $this->load->view('admin/finance/add_chartofacc', $data);
    }

    function updateAccHead()
    {
        $AC_NO = $this->input->post('AC_NO');
        $AC_NAME = $this->input->post('AC_NAME');
        $AC_NO_UD = $this->input->post('AC_NO_UD');
        $BILLING_TYPE = $this->input->post('BILLING_TYPE');
        $TRANS_FLAG = ((isset($_POST['TRANS_FLAG'])) ? 1 : 0);
        $status = ((isset($_POST['status'])) ? 1 : 0);

        $check = $this->utilities->hasInformationByThisId("fn_achead", array("AC_NO !=" => $AC_NO, "AC_NAME" => $AC_NAME));

        if (empty($check)) {
            $update_acc_head = array(
                'AC_NAME' => $AC_NAME,
                'AC_NO_UD' => $AC_NO_UD,
                'BILLING_TYPE' => $BILLING_TYPE,
                'ACTIVE_STATUS' => $status,
                'TRANS_FLAG' => $TRANS_FLAG,
                'ENTERED_BY' => $this->user["USER_ID"]
            );
            if ($this->utilities->updateData('fn_achead', $update_acc_head, array('AC_NO' => $AC_NO))) {
                echo "<div class='alert alert-success'> Update successfully</div>";
            } else {
                echo "<div class='alert alert-danger'> Name Update failed</div>";
            }
        } else {
            echo "<div class='alert alert-danger'> Name Already Exist</div>";
        }
    }

    //end Nurullah
    function residentBill()
    {
        $data['resident_building'] = $this->utilities->findAllByAttribute('sa_building', array('BUILDING_TYPE' => 347));
        $data['ins_session'] = $this->utilities->academicSessionList();
        $data["ac_charge_name"] = $this->utilities->findAllByAttribute("fn_achead", array("AC_TYPE_NO" => 2, "TRANS_FLAG" => 1, "BILLING_TYPE" => 'R'));
        $data['content_view_page'] = 'admin/finance/bill/add_resident_bill';
        $this->admin_template->display($data);
    }

    function saveResidentBill()
    {
        $session_id = $this->input->post('SESSION_ID');
        $BUILDING_ID = $this->input->post('BUILDING_ID');
        $BILLING_MONTH = $this->input->post('BILLING_MONTH');


        $student_id_list = $this->input->post('STUDENT_ID');

        $AC_NO = $this->input->post('AC_NO');

//        $resident_student_list = $this->resident_model->getResidentStudentList($BUILDING_ID);

        for ($i = 0; $i < sizeof($student_id_list); $i++) {

            $student_info = $this->utilities->findByAttribute('student_semesterinfo', array('STUDENT_ID' => $student_id_list[$i], 'IS_CURRENT' => 1));
            $billing_mst_data = array(
                'BILLING_DT' => date('Y-m-d'),
                'STUDENT_ID' => $student_id_list[$i],
                'FACULTY_ID' => $student_info->FACULTY_ID,
                'DEPT_ID' => $student_info->DEPT_ID,
                'PROGRAM_ID' => $student_info->PROGRAM_ID,
                'SESSION_ID' => $session_id,
                'SEMESTER_ID' => $student_info->SEMESTER_SL_NO,
                'BILL_TYPE' => 'R',
            );
            $billing_mst_id = $this->utilities->insert('fn_billing_mst', $billing_mst_data);
            for ($i = 0; $i < sizeof($AC_NO); $i++) {
                $billing_chd_data = array(
                    'BILLING_MST_ID' => $billing_mst_id,
                    'AC_NO' => $AC_NO[$i],
                    'TOTAL_BILL' => $this->input->post('AMOUNT_' . $AC_NO[$i]),
                    'BILL_AMT' => $this->input->post('AMOUNT_' . $AC_NO[$i]),
                    'BILLING_MONTH' => date('Y-m-d', strtotime('01-' . $BILLING_MONTH)),
                    'CREATED_BY' => $this->user["USER_ID"]
                );

//                echo "<pre>"; print_r($billing_chd_data); exit;

                $this->utilities->insertData($billing_chd_data, 'fn_billing_chd');
            }
        }

    }

    function academicBill()
    {
        $data['ins_session'] = $this->utilities->academicSessionList();
        $data['program'] = $this->utilities->getAll('ins_program');
        $data['content_view_page'] = 'admin/finance/bill/add_academic_bill';
        $this->admin_template->display($data);
    }

    function academicBillingListOfStudent()
    {
        $session_id = $this->input->post('SESSION_ID');
        $program_id = $this->input->post('PROGRAM_ID');
        $billType = 'A';

        $data['registered_student'] = $this->finance_model->acaBullingListOfStudent($session_id, $program_id, $billType);
        $this->load->view('admin/finance/bill/academic_billing_student_list', $data);
    }

    function residenceBillingListOfStudent()
    {
        $session_id = $this->input->post('SESSION_ID');
        $building_id = $this->input->post('BUILDING_ID');
        $billing_month = $this->input->post('BILLING_MONTH');
//        $program_id = $this->input->post('PROGRAM_ID');
        $billType = 'R';

        $data['registered_student'] = $this->finance_model->resiBullingListOfStudent($session_id, $building_id, $billing_month, $billType);

        $this->load->view('admin/finance/bill/residence_billing_student_list', $data);
    }

    function hideThisRow()
    {
        $session_id = $this->input->post('SESSION_ID');
        $program_id = $this->input->post('PROGRAM_ID');

        $billType = 'A';

        $data['registered_student'] = $this->finance_model->acaBullingListOfStudent($session_id, $program_id, $billType);

        $this->load->view('admin/finance/bill/academic_billing_student_list', $data);

    }

    function saveAcademicBill()
    {
        $session_id = $this->input->post('SESSION_ID');
        $program_id = $this->input->post('PROGRAM_ID');
        $student_id_list = $this->input->post('STUDENT_ID');

//    echo "<pre>"; print_r($student_id_list); exit;

//    $total_student=$this->utilities->findAllByAttribute('student_semesterinfo',array('SESSION_ID'=>$session_id,'PROGRAM_ID'=>$program_id));
        for ($i = 0; $i < sizeof($student_id_list); $i++) {
            // student and applicant voucher muster inforlmation insertion
            $total_credit = 0;
            $total_credit += $this->student_model->getStudentTotalCredit($session_id, $program_id, $student_id_list[$i])->total_credit;
            $student_info = $this->utilities->findByAttribute('student_semesterinfo', array('STUDENT_ID' => $student_id_list[$i], 'IS_CURRENT' => 1));
            $student_bill_mst_info = array(
                'BILLING_DT' => date('Y-m-d'),
                'STUDENT_ID' => $student_id_list[$i],
                'FACULTY_ID' => $student_info->FACULTY_ID,
                'DEPT_ID' => $student_info->DEPT_ID,
                'PROGRAM_ID' => $student_info->PROGRAM_ID,
                'SESSION_ID' => $session_id,
                'SEMESTER_ID' => $student_info->SEMESTER_SL_NO,
                'BILL_TYPE' => 'A',
            );
            $BILLING_MST_ID = $this->utilities->insert('fn_billing_mst', $student_bill_mst_info);
            //student and applicant voucher child information insertion
            $academic_chare_rate = $this->utilities->findAllByAttribute('fn_academic_charge_rate', array('PROGRAM_ID' => $program_id, 'SESSION_ID' => $session_id));
            $waiver_info = $this->utilities->findByAttribute('student_waiver_info', array('STUDENT_ID' => $student_id_list[$i], 'SESSION_ID' => $session_id, 'ACTIVE_STATUS' => 1));
//echo "</pre>";print_r($waiver_info);
            foreach ($academic_chare_rate as $row_acr) {
                if ($this->utilities->findByAttribute('fn_achead', array('AC_NO' => $row_acr->AC_NO))->BILLING_TYPE == 'T') {
                    if (!empty($waiver_info)) {
                        $net_bill_amount = $total_credit * $row_acr->AMOUNT;
                        $dis_count_amt = ($net_bill_amount * $waiver_info->PERCENTAGE) / 100;
                         $bill_amount = $net_bill_amount - $dis_count_amt;
                    } else {
                        $bill_amount = $total_credit * $row_acr->AMOUNT;
                        $net_bill_amount = $bill_amount;
                        $dis_count_amt = 0; 
                    }

                } else {
                    $bill_amount = $row_acr->AMOUNT;
                    $net_bill_amount = $bill_amount;
                    $dis_count_amt = 0; 
                }
                 
                $student_bill_chd_info = array(
                    'BILLING_MST_ID' => $BILLING_MST_ID,
                    'AC_NO' => $row_acr->AC_NO,
                    'RATE_ID' => $row_acr->RATE_ID,
                    'RATE_AMT' => $row_acr->AMOUNT,
                    'TOTAL_BILL' => $net_bill_amount,
                    'DISC_AMT' => $dis_count_amt,
                    'BILL_AMT' => $bill_amount,
                    'CREATED_BY' => $this->user["USER_ID"]
                );
                // print_r($student_voucher_chd_info);
                $this->utilities->insert('fn_billing_chd', $student_bill_chd_info);

            }
        }
        exit;
    }


#####################################################################

    /*
   * @methodName fresherBillGenerate
   * @access
   * @param  none
   * @author Abhijit M. Abhi <abhijit@atilimited.net>
   * @return policy add form
   */

    function fresherBillGenerate()
    {
/*        echo "<pre>"; echo $ip= getenv('HTTP_CLIENT_IP')?:
getenv('HTTP_X_FORWARDED_FOR')?:
getenv('HTTP_X_FORWARDED')?:
getenv('HTTP_FORWARDED_FOR')?:
getenv('HTTP_FORWARDED')?:
getenv('REMOTE_ADDR');*/
 
        $data['ins_session'] = $this->utilities->academicSessionList();
        $data['program'] = $this->utilities->getAll('ins_program');
        $data['content_view_page'] = 'admin/finance/fresher_bill/add_academic_bill';
        $this->admin_template->display($data);
    }


    /*
      * @methodName fresherBillingListOfStudent
      * @access
      * @param  none
      * @author Abhijit M. Abhi <abhijit@atilimited.net>
      * @return policy add form
      */

    function fresherBillingListOfStudent()
    {
        $session_id = $this->input->post('SESSION_ID');
        $program_id = $this->input->post('PROGRAM_ID');
        $billType = 'A';

        $data['registered_student'] = $this->finance_model->fresherBillingListOfStudent($session_id, $program_id, $billType);

//        echo "<pre>"; print_r($data['registered_student']); exit;

        $this->load->view('admin/finance/fresher_bill/academic_billing_student_list', $data);
    }


}