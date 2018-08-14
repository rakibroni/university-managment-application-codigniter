<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

    /**
     * @methodName index()
     * @access
     * @param
     * @author      Jahid Hasan <jahid@atilimited.net>
     * @return      Payment Template
     */
    function index() {
        $data['contentTitle'] = 'Payment Form';
        $data["breadcrumbs"] = array(
            "Admin" => "admin/index",
            "Payment Form" => '#'
        );
        $student = $this->uri->segment(3);
        if($student){
            $data["student_info"] = $this->db->query("SELECT c.STU_CRS_ID, c.STUDENT_ID,stu.FULL_NAME_EN STUDENT_NAME, stu.ROLL_NO,
                                                        s.SESSION_ID, s.SESSION_NAME,
                                                        c.SEMISTER_ID,(SELECT l.LKP_NAME FROM m00_lkpdata l WHERE l.LKP_ID = c.SEMISTER_ID)SEMISTER,
                                                        c.FACULTY_ID,(SELECT f.FACULTY_NAME FROM faculty f WHERE f.FACULTY_ID = c.FACULTY_ID)FACULTY,
                                                        c.DEPT_ID,(SELECT d.DEPT_NAME FROM department d WHERE d.DEPT_ID = c.DEPT_ID)DEPARTMENT,
                                                        c.PROGRAM_ID,(SELECT p.PROGRAM_NAME FROM program p WHERE p.PROGRAM_ID = c.PROGRAM_ID)PROGRAM, c.IS_CURRENT
                                                        FROM stu_courseinfo c INNER JOIN students_info stu ON c.STUDENT_ID = stu.STUDENT_ID
                                                        INNER JOIN session_view s ON c.SEM_SESSION = s.SESSION_ID
                                                        WHERE c.STUDENT_ID = '$student' AND c.IS_CURRENT = 1 GROUP BY c.STUDENT_ID")->row();
            $exp_cond = array(
                "FACULTY_ID" => $data["student_info"]->FACULTY_ID,
                "DEPT_ID" => $data["student_info"]->DEPT_ID,
                "PROGRAM_ID" => $data["student_info"]->PROGRAM_ID,
                "SESSION_ID" => $data["student_info"]->SESSION_ID,
                "SEMESTER_ID" => $data["student_info"]->SEMISTER_ID,
                "ac_program_particulars.ACTIVE_STATUS" => 1
            );
            $txtFaculty = $data["student_info"]->FACULTY_ID;
            $txtDept = $data["student_info"]->DEPT_ID;
            $txtProgram = $data["student_info"]->PROGRAM_ID;
            $txtSession = $data["student_info"]->SESSION_ID;
            $semester = $data["student_info"]->SEMISTER_ID;
            // all expenses in a semester
            $data["expenses"] = $this->utilities->findAllByAttributeWithJoin("ac_program_particulars", "ac_academic_charge", "PARTICULAR_ID", "CHARGE_ID", "CHARGE_NAME", $exp_cond);
            // getting student current and completed semesters
            $data["semesters"] = $this->db->query("SELECT sm.SEM_SESSION SESSION_ID,s.SESSION_NAME, sm.SEMESTER_ID,
                                                    (SELECT m.NUMB_LKP FROM m00_lkpdata m WHERE m.LKP_ID = sm.SEMESTER_ID)NUMB_LKP,
                                                    (SELECT m.LKP_NAME FROM m00_lkpdata m WHERE m.LKP_ID = sm.SEMESTER_ID)LKP_NAME
                                                    FROM stu_semesterinfo sm
                                                    INNER JOIN session_view s ON sm.SEM_SESSION = s.SESSION_ID
                                                    WHERE sm.STUDENT_ID = '$student'  ORDER BY LKP_NAME DESC")->result();
            // total payment of a student in a semester
            $data["dueAmt"] = $this->db->query("SELECT v.VOUCHER_NO, v.VOUCHER_DT, v.STUDENT_ID, v.ROLL_NO, v.REMARKS, l.TRX_CODE_NO, l.TRX_TRAN_NO, l.CR_AMT, sum(l.DR_AMT) DEBIT
                                                                    FROM bm_vouchermst v INNER JOIN bm_vn_ledgers l ON v.VOUCHER_NO = l.VOUCHER_NO
                                                                    WHERE v.STUDENT_ID = '$student' AND v.SEMESTER_ID = $semester AND l.TRX_CODE_NO = 'PM' GROUP BY v.STUDENT_ID")->row();
            // getting all previous semesters
            $previous_semester_id = $this->db->query("SELECT LKP_ID FROM m00_lkpdata WHERE LKP_ID = (select max(m.LKP_ID) from m00_lkpdata m where LKP_ID < $semester AND GRP_ID = 16)")->row();
            //print_r($previous_semester_id);
            $is_new_payment_data = array(
                "FACULTY_ID" => $data["student_info"]->FACULTY_ID,
                "DEPT_ID" => $data["student_info"]->DEPT_ID,
                "PROGRAM_ID" => $data["student_info"]->PROGRAM_ID,
                "SESSION_ID" => $data["student_info"]->SESSION_ID,
                "SEMESTER_ID" => $data["student_info"]->SEMISTER_ID
            );
            $semester_seq = $this->utilities->findByAttribute("m00_lkpdata", array("LKP_ID" => $data["student_info"]->SEMISTER_ID));
            $data["semester_seq"] = $semester_seq->LKP_NAME;
            $data["total_amt"] = 0;
            // checking if any payment is done by student in a semester
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
        $data['content_view_page'] = 'admin/payment/index';
        $this->admin_template->display($data);
    }

    /**
     * @methodName getExpenseDetails()
     * @access
     * @param  expense_id is an integer defining Expense ID
     * @author      Jahid Hasan <jahid@atilimited.net>
     * @return      Payment Template
     */
    function getExpenseDetails() {
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
            "SEMESTER_ID" => $semester,
            "SESSION_ID" => $txtSession
        );
        $rs = $this->db->query("SELECT aac.CHARGE_NAME, acr.*
                                                    FROM ac_academic_charge_rate acr
                                                    INNER JOIN ac_academic_charge aac on aac.CHARGE_ID = acr.CHARGE_ID
                                                    WHERE acr.RATE_ID = $expense_id AND acr.PROGRAM_ID = $txtProgram")->row();
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
     /**
     * @methodName existing_students()
     * @access
     * @param
     * @author      Emdadul Huq <emdadul@atilimited.net>
     * @return      Payment Template
     */
    function existing_students() {
        $data['contentTitle'] = 'Payment Form';
        $data["breadcrumbs"] = array(
            "Admin" => "admin/index",
            "Payment Form" => '#'
        );
        $student = $this->uri->segment(3);
        if($student){
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
            
           // var_dump($data["student_info"] );exit;
            $txtFaculty = $data["student_info"]->FACULTY_ID;
            $txtDept = $data["student_info"]->DEPT_ID;
            $txtProgram = $data["student_info"]->PROGRAM_ID;
            $txtSession = $data["student_info"]->SESSION_ID;
            $semester = $data["student_info"]->SEMESTER_SL_NO;
            // all expenses in a semester
            $exp_cond = array(
                "FACULTY_ID" => $data["student_info"]->FACULTY_ID,
                "DEPT_ID" => $data["student_info"]->DEPT_ID,
                "PROGRAM_ID" => $data["student_info"]->PROGRAM_ID,
                "SESSION_ID" => $data["student_info"]->SESSION_ID,
                "SEMESTER_ID" => $data["student_info"]->SEMESTER_SL_NO,
                "ac_program_particulars.ACTIVE_STATUS" => 1
            );
            // all expenses in a semester
            //$data["expenses"] = $this->utilities->findAllByAttributeWithJoin("ac_program_particulars", "ac_academic_charge", "PARTICULAR_ID", "CHARGE_ID", "CHARGE_NAME", $exp_cond);
            $data["expenses"] = $this->db->query("SELECT a.*, (SELECT b.CHARGE_NAME FROM ac_academic_charge b WHERE a.CHARGE_ID = b.CHARGE_ID)CHARGE_NAME
                                                                                    FROM ac_academic_charge_rate a
                                                                                    WHERE a.SESSION_ID = $txtSession AND a.PROGRAM_ID = $txtProgram")->result();
            /*$data["expenses"] = $this->db->query("  SELECT aac.CHARGE_NAME, acr.*
                                                    FROM ac_academic_charge aac 
                                                    INNER JOIN ac_academic_charge_rate acr on aac.CHARGE_ID = acr.CHARGE_ID
                                                    WHERE acr.PROGRAM_ID = $txtProgram
                                                    GROUP BY aac.CHARGE_NAME")->result();*/

            // getting all semesters
            $data['allSemester'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 16));
            $data["allSession"] = $this->utilities->admissionSessionList();
            //$data["allSemester"] = $this->utilities->getAll("sav_semester");
            //$data["allSession"] = $this->utilities->getAll("session_view");
            // getting student current and completed semesters
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
            $data["chargeId"] = $this->db->query("SELECT  bv.PRTCULR_NO
                                            FROM bm_vouchermst bm
                                            INNER JOIN bm_voucherchd bv on bv.VOUCHER_NO = bm.VOUCHER_NO
                                            WHERE bm.PROGRAM_ID = $txtProgram AND bm.SESSION_ID = $txtSession AND bm.SEMESTER_ID = $semester")->result();
            
            // getting all previous semesters
            $previous_semester_id = $this->db->query("SELECT LKP_ID FROM m00_lkpdata WHERE LKP_ID = (select max(m.LKP_ID) from m00_lkpdata m where LKP_ID < $semester AND GRP_ID = 16)")->row();
            //print_r($previous_semester_id);
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
            // checking if any payment is done by student in a semester
            $data["is_new_payment"] = $this->utilities->hasInformationByThisId("bm_vouchermst", $is_new_payment_data);
            if (!empty($previous_semester_id)) {
                $ids = array();
                $prev_all_semester_ids = $this->db->query("SELECT LKP_ID FROM m00_lkpdata WHERE LKP_ID IN (select m.LKP_ID from m00_lkpdata m where LKP_ID < $semester AND GRP_ID = 16)")->result();
                foreach ($prev_all_semester_ids as $prev_all_semester_id) {
                    $ids[] = $prev_all_semester_id->LKP_ID;
                }
                $all_ids = implode(",", $ids);
                $data["prevSemesterAmt"] = $this->utilities->getStuPaidAmt($student, $all_ids);
                $data["prev_expenses"] = $this->db->query("SELECT SUM(AMOUNT)PARTICULAR_AMOUNT FROM ac_academic_charge_rate
                                                                            WHERE `FACULTY_ID` = $txtFaculty AND `DEPT_ID` = $txtDept AND `PROGRAM_ID` = $txtProgram
                                                                            AND `SEMISTER_ID` IN ($all_ids)")->row();
            }
        }
        $data['content_view_page'] = 'admin/payment/existing_stu_index';
        $this->admin_template->display($data);

    }
    /**
     * @methodName getExpenseDetails()
     * @access
     * @param  expense_id is an integer defining Expense ID
     * @author      Emdadul Huq <emdadul@atilimited.net>
     * @return      Payment Template
     */
    function getExpenseDetails_existingStu() {

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
        if($last_word == "[current]"){
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
        }else{
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

    /**
     * @param  semester is an integer defining Semester ID
     * @author      Jahid Hasan <jahid@atilimited.net>
     * @return      Payment Template
     */
    function getExpenseDetailsBySemester() {
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
        $data["expenses"] = $this->utilities->findAllByAttributeWithJoin("ac_program_particulars", "ac_academic_charge", "PARTICULAR_ID", "CHARGE_ID", "CHARGE_NAME", $exp_cond);
        $data["dueAmt"] = $this->utilities->getStuPaidAmt($txtStudent, $semester);
        $prev_all_semester_ids = $this->utilities->findAllByAttribute("sav_semester",array("SL_NO < " => $data["semester_seq"]));
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
     * @param  semester is an integer defining Semester ID
     * @author      Emdadul Huq <emdadul@atilimited.net>
     * @return      Payment Template
     */
    function getExpenseDetailsBySemester_existingStu() {
        $txtStudent = $this->input->post("txtStudent");
        $txtFaculty = $this->input->post("txtFaculty");
        $txtDept = $this->input->post("txtDept");
        $txtProgram = $this->input->post("txtProgram");
        $txtSession = $this->input->post("txtSession");
        $semester = $this->input->post("semester");
        $semCurrent = $this->input->post("semCurrent");
        $current = explode(' ', $semCurrent);
        $last_word = array_pop($current);
        
        $data["semester_seq"] = $this->input->post("txtSemesterSeq");
        $exp_cond = array(
            "FACULTY_ID" => $txtFaculty,
            "DEPT_ID" => $txtDept,
            "PROGRAM_ID" => $txtProgram,
            "SESSION_ID" => $txtSession,
            "SEMESTER_ID" =>$semester
        );
        if($last_word == '[current]'){
            $data["expenses"] = $this->utilities->findAllByAttributeWithJoin("ac_program_particulars", "ac_academic_charge", "PARTICULAR_ID", "CHARGE_ID", "CHARGE_NAME", $exp_cond);       
        }else {
            $data["expenses"] = $this->db->query("SELECT a.*, (SELECT b.CHARGE_NAME FROM ac_academic_charge b WHERE a.CHARGE_ID = b.CHARGE_ID)CHARGE_NAME
                                                                                    FROM ac_academic_charge_rate a
                                                                                    WHERE a.SESSION_ID = $txtSession AND a.PROGRAM_ID = $txtProgram")->result();
            
            /*$data["expenses"] = $this->db->query("  SELECT aac.CHARGE_NAME, acr.*
                                                    FROM ac_academic_charge_rate acr
                                                    INNER JOIN ac_academic_charge aac on aac.CHARGE_ID = acr.CHARGE_ID
                                                    WHERE acr.FACULTY_ID = $txtFaculty AND acr.PROGRAM_ID = $txtProgram AND acr.DEPT_ID = $txtDept AND acr.SEMISTER_ID = $semester ")->result();
            */
        }
        $data["chargeId"] = $this->db->query("SELECT  bv.PRTCULR_NO
                                            FROM bm_vouchermst bm
                                            INNER JOIN bm_voucherchd bv on bv.VOUCHER_NO = bm.VOUCHER_NO
                                            WHERE bm.PROGRAM_ID = $txtProgram AND bm.SESSION_ID = $txtSession AND bm.SEMESTER_ID = $semester")->result();
        $data["dueAmt"] = $this->utilities->getStuPaidAmt($txtStudent, $semester);
        $prev_all_semester_ids = $this->utilities->findAllByAttribute("sav_semester",array("SL_NO < " => $data["semester_seq"]));
        if (!empty($previous_semester_id)) {
            $ids = array();
            foreach ($prev_all_semester_ids as $prev_all_semester_id) {
                $ids[] = $prev_all_semester_id->SEMESTER_ID;
            }
            $all_ids = implode(",", $ids);
            $data["prevSemesterAmt"] = $this->utilities->getStuPaidAmt($txtStudent, $all_ids);
            $data["prev_expenses"] = $this->db->query("SELECT SUM(AMOUNT)AMOUNT FROM ac_academic_charge_rate
                                                                            WHERE `FACULTY_ID` = $txtFaculty AND `DEPT_ID` = $txtDept AND `PROGRAM_ID` = $txtProgram
                                                                            AND `SEMISTER_ID` IN ($all_ids)")->row();
        }
        if($last_word == '[current]'){
            echo $this->load->view("admin/payment/stu_expense_details", $data, true);          
        }else{
            echo $this->load->view("admin/payment/existing_stu_expense_details", $data, true);            
        }
    }

    /**
     * @access      public
     * @param
     * @author      Jahid Hasan <jahid@atilimited.net>
     * @return      All Semester Expnense Details
     */
    public function getAllSemesterExpenses() {

        // recieving all form data
        /*$txtStudent = $this->input->post("txtStudent");
        $txtFaculty = $this->input->post("txtFaculty");
        $txtDept = $this->input->post("txtDept");
        $txtProgram = $this->input->post("txtProgram");
        $semester = $this->input->post("semester_id");

        $data['txtStudent'] = $txtStudent;
        $data['txtFaculty'] = $txtFaculty;
        $data['txtDept'] = $txtDept;
        $data['txtProgram'] = $txtProgram;
        $data['semester'] = $semester;
        
        echo $this->load->view("common/payment/stu_all_expense_details", $data, true);*/
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
        $prev_all_semester_ids = $this->db->query("SELECT s.S_SEMESTER_ID, s.STUDENT_ID, s.SEMESTER_ID, sv.SEMESTER_NAME, sv.SL_NO
                                                    FROM stu_semesterinfo s INNER JOIN sav_semester sv ON s.SEMESTER_ID = sv.SEMESTER_ID
                                                    WHERE s.STUDENT_ID = '$txtStudent' AND s.FACULTY_ID = '$txtFaculty' AND s.DEPT_ID = '$txtDept' 
                                                    AND s.PROGRAM_ID = '$txtProgram'")->result();
        $ids = array();
        foreach ($prev_all_semester_ids as $prev_all_semester_id) {
            // pushing all semester ids into array
            $ids[] = $prev_all_semester_id->SEMESTER_ID;
        }
        $all_ids = implode(",", $ids);
        // getting expense details by semester ids
        $data["expenses"] = $this->db->query("SELECT m.LKP_ID,m.LKP_NAME,p.SESSION_ID, s.SESSION_NAME SESSION, SUM(p.PARTICULAR_AMOUNT)EXPENSE_AMT
                                            FROM ac_program_particulars p LEFT JOIN m00_lkpdata m ON p.SEMESTER_ID = m.LKP_ID
                                            INNER JOIN session_view s ON p.SESSION_ID = s.SESSION_ID
                                            WHERE p.FACULTY_ID = $txtFaculty AND p.DEPT_ID = $txtDept AND p.PROGRAM_ID = $txtProgram
                                            AND p.SEMESTER_ID IN ($all_ids) GROUP BY p.SEMESTER_ID ORDER BY p.SEMESTER_ID DESC")->result();
        // total payment of a student in a semester
        $data["dueAmt"] = $this->db->query("SELECT v.VOUCHER_NO, v.VOUCHER_DT, v.STUDENT_ID, v.ROLL_NO, v.REMARKS, l.TRX_CODE_NO, l.TRX_TRAN_NO, l.CR_AMT, sum(l.DR_AMT) DEBIT
                                            FROM bm_vouchermst v INNER JOIN bm_vn_ledgers l ON v.VOUCHER_NO = l.VOUCHER_NO
                                            WHERE v.STUDENT_ID = '$txtStudent' AND l.TRX_CODE_NO = 'PM' GROUP BY v.STUDENT_ID")->row();
        echo $this->load->view("common/payment/stu_all_expense_details", $data, true);
    }

    /**
     * @access      public
     * @param       expense_id is an integer defining Expense ID
     * @author      Jahid Hasan <jahid@atilimited.net>
     * @return      Payment Template
     */
    public function doPayment() {
        if ($_POST) {
            $user_session = $this->session->userdata("logged_in");
            $student_id = $this->input->post("txtStudent");
            $student_roll = $this->input->post("txtRollNo");
            $faculty_id = $this->input->post("txtFaculty");
            $dept_id = $this->input->post("txtDept");
            $program_id = $this->input->post("txtProgram");
            $session_id = $this->input->post("txtSession");
            $semister_id = $this->input->post("cmbSemester");

            $expense_id = $this->input->post("txtExpenseId"); // Expense Charge Head
            $expense_amt = $this->input->post("txtExpenseRate"); // Expense Charge Head Amount

            $payment_amt = $this->input->post("txtPayment");
            $remarks = $this->input->post("txtRemarks", TRUE);

            $txtIsFirstTime = $this->input->post("txtIsFirstTime");

            $v_master_pk = $this->utilities->pk_f('bm_vouchermst'); // get Primary Key
            $voucher_no = $v_master_pk;
            $this->db->trans_start();
            // insert data into Voucher Master Table
            $v_master_data_array = array(
                "VOUCHER_NO" => $v_master_pk,
                "VOUCHER_DT" => date("Y/m/d"),
                "STUDENT_ID" => $student_id,
                "ROLL_NO" => $student_roll,
                "FACULTY_ID" => $faculty_id,
                "DEPT_ID" => $dept_id,
                "PROGRAM_ID" => $program_id,
                "SESSION_ID" => $session_id,
                "SEMESTER_ID" => $semister_id,
                "ORG_ID" => 1,
                "REMARKS" => $remarks,
                "CREATED_BY" => $user_session["USER_ID"]
            );
            $this->db->insert("bm_vouchermst", $v_master_data_array);
            $amount = 0;
            $qty = 0;
            for ($i = 0; $i < sizeof($expense_id); $i++) {
                $amount += $expense_amt[$i];
            }
            // insert data into Payment Master Table
            $p_master_pk = $this->utilities->pk_f('bm_paymentmst'); // get Primary Key
            $trans_no = $p_master_pk;
            $p_master_data_array = array(
                "TRX_TRAN_NO" => $p_master_pk,
                "TRX_TRAN_DT" => date("Y/m/d"),
                "TRAN_AMT" => $amount,
                "COLLECTED_BY" => $user_session["USER_ID"],
                "TRX_CODE_NO" => "PM",
                "REMARKS" => $remarks,
                "CREATED_BY" => $user_session["USER_ID"]
            );
            $this->db->insert("bm_paymentmst", $p_master_data_array);

            // insert data into Payment Amount Table
            for ($i = 0; $i < sizeof($payment_amt); $i++) {
                if ($payment_amt[$i] != "") {
                    if (isset($payment_amt[0])) { // Cash Payment
                        $p_mode = "CS";
                    }
                    if (isset($payment_amt[1])) { // Cheque Payment
                        $p_mode = "CH";
                    }
                    if (isset($payment_amt[2])) { // Debit/Credit Card Payment
                        $p_mode = "CA";
                    }
                    $p_amount_pk = $this->utilities->pk_f('bm_paymodeamt'); // get Primary Key
                    $p_amount_data_array = array(
                        "MR_TRAN_NO" => $p_amount_pk,
                        "MR_TRAN_DT" => date("Y/m/d"),
                        "TRX_TRAN_NO" => $trans_no,
                        "MR_TRAN_AMT" => $payment_amt[$i],
                        "VOUCHER_NO" => $voucher_no,
                        "TRX_CODE_NO" => "PM",
                        "PAYMENT_MODE" => "$p_mode",
                        "REMARKS" => $remarks,
                        "ORG_ID" => 1,
                        "CREATED_BY" => $user_session["USER_ID"]
                    );
                    $this->db->insert("bm_paymodeamt", $p_amount_data_array);
                }
            }
            // insert data into LEDGER Table
            $ledger_pk = $this->utilities->pk_f('bm_vn_ledgers'); // get Primary Key
            $ledger_data_array = array(
                "VLEDGER_NO" => $ledger_pk,
                "VLEDGER_DT" => date("Y/m/d"),
                "TRX_CODE_NO" => "PM",
                "TRX_TRAN_NO" => $trans_no,
                "VOUCHER_NO" => $voucher_no,
                "DR_AMT" => $payment_amt[0],
                "PITEM_TQTY" => 0
            );
            $this->db->insert("bm_vn_ledgers", $ledger_data_array);
            $this->db->trans_complete();
            if ($this->db->trans_status() == TRUE) {
                $this->session->set_flashdata('Success', 'Transaction Processed Successfully');
                redirect("payment/index/$student_id");
            } else {
                $this->session->set_flashdata('Error', 'Sorry this user already exits !');
                redirect("payment/index/$student_id");
            }
        }
    }/**
     * @access      public
     * @param       expense_id is an integer defining Expense ID
     * @author      Emdadul Huq <emdadul@atilimited.net>
     * @return      Payment Template
     */
    public function doPayment_existingStu() {
        //echo "<pre>"; print_r($_POST); exit();
        
        if ($_POST) {
            $user_session = $this->session->userdata("logged_in");
            $student_id = $this->input->post("txtStudent");
            $student_roll = $this->input->post("txtRollNo");
            $faculty_id = $this->input->post("txtFaculty");
            $dept_id = $this->input->post("txtDept");
            $program_id = $this->input->post("txtProgram");
            $sem = $this->input->post("cmbSemester");
            $session_id = $this->input->post("txtSession");
            $semSession = explode(",",$sem);
            $semister_id = $semSession[0];
            $sem_session_id = $semSession[1];

            $expense_id = $this->input->post("txtExpenseId"); // Expense Charge Head
            $expense_amt = $this->input->post("txtExpenseRate"); // Expense Charge Head Amount

            $payment_amt = $this->input->post("txtPayment");
            $remarks = $this->input->post("txtRemarks", TRUE);

            $txtIsFirstTime = $this->input->post("txtIsFirstTime");
            $this->db->trans_start();
            /*Start first Part of bm Payment*/            
            $currStudent = $this->db->query("SELECT ss.IS_CURRENT
                                            FROM student_semesterinfo ss 
                                            WHERE ss.STUDENT_ID = $student_id AND ss.SESSION_ID = $sem_session_id")->row();
            $remarks_ex = "Payment for existing students";
            $voucher_no = $this->utilities->pk_f('bm_vouchermst'); // get Primary Key                        
            // insert data into Voucher Master Table
            $v_master_data_array_1 = array(
                "VOUCHER_NO" => $voucher_no,
                "VOUCHER_DT" => date("Y/m/d"),
                "STUDENT_ID" => $student_id,
                "ROLL_NO" => $student_roll,
                "FACULTY_ID" => $faculty_id,
                "DEPT_ID" => $dept_id,
                "PROGRAM_ID" => $program_id,
                "SESSION_ID" => $sem_session_id,
                "SEMESTER_ID" => $semister_id,
                "ORG_ID" => 1,
                "REMARKS" => $remarks_ex,
                "IS_PREVIOUS" => ($currStudent->IS_CURRENT == 1)? 0:1,
                "CREATED_BY" => $user_session["USER_ID"]
            );
            if ($this->utilities->insertData($v_master_data_array_1, 'bm_vouchermst')) {
                       
                // insert program particular information for each student
                for ($i = 0; $i < sizeof($expense_id); $i++)  {
                    // insert data into Voucher Child Table
                    $trans_no = $this->utilities->pk_f('bm_voucherchd'); // get Primary Key
                    $v_chd_data_array_1 = array(
                        "TRX_TRAN_NO" => $trans_no,
                        "TRX_TRAN_DT" => date("Y/m/d"),
                        "VOUCHER_NO" => $voucher_no,
                        "SESSION_ID" => $sem_session_id,
                        "SEMISTER_ID" => $semister_id, /* 90 equal to 1st semester */
                        "PRTCULR_NO" => $expense_id[$i],
                        "BILL_AMT" => $expense_amt[$i],
                        "PUNIT_PRICE" => $expense_amt[$i],
                        "ORG_ID" => 1,
                        "REMARKS" => $remarks_ex,
                        "CREATED_BY" => $user_session["USER_ID"]
                    );
                    $this->utilities->insertData($v_chd_data_array_1, "bm_voucherchd");
                    // insert data into LEDGER Table
                    $ledger_pk = $this->utilities->pk_f('bm_vn_ledgers'); // get Primary Key
                    $ledger_data_array_1 = array(
                        "VLEDGER_NO" => $ledger_pk,
                        "VLEDGER_DT" => date("Y/m/d"),
                        "TRX_CODE_NO" => "GR",
                        "TRX_TRAN_NO" => $trans_no,
                        "VOUCHER_NO" => $voucher_no,
                        "CR_AMT" => $expense_amt[$i],
                        "PITEM_TQTY" => 1
                    );
                    $this->utilities->insertData($ledger_data_array_1, "bm_vn_ledgers");
                }
                
            }
            /*end first Part of bm Payment*/
            
            /*Start 2nd Part of bm Payment*/
            $v_master_pk = $this->utilities->pk_f('bm_vouchermst'); // get Primary Key
            $voucher_no = $v_master_pk;
            // insert data into Voucher Master Table
            $v_master_data_array = array(
                "VOUCHER_NO" => $v_master_pk,
                "VOUCHER_DT" => date("Y/m/d"),
                "STUDENT_ID" => $student_id,
                "ROLL_NO" => $student_roll,
                "FACULTY_ID" => $faculty_id,
                "DEPT_ID" => $dept_id,
                "PROGRAM_ID" => $program_id,
                "SESSION_ID" => $sem_session_id,
                "SEMESTER_ID" => $semister_id,
                "ORG_ID" => 1,
                "REMARKS" => $remarks,
                "IS_PREVIOUS" => ($currStudent->IS_CURRENT == 1)? 0:1,
                "CREATED_BY" => $user_session["USER_ID"]
            );
            $this->db->insert("bm_vouchermst", $v_master_data_array);
            $amount = 0;
            $qty = 0;
            for ($i = 0; $i < sizeof($expense_id); $i++) {
                $amount += $expense_amt[$i];
            }
            // insert data into Payment Master Table
            $p_master_pk = $this->utilities->pk_f('bm_paymentmst'); // get Primary Key
            $trans_no = $p_master_pk;
            $p_master_data_array = array(
                "TRX_TRAN_NO" => $p_master_pk,
                "TRX_TRAN_DT" => date("Y/m/d"),
                "TRAN_AMT" => $amount,
                "COLLECTED_BY" => $user_session["USER_ID"],
                "TRX_CODE_NO" => "PM",
                "REMARKS" => $remarks,
                "CREATED_BY" => $user_session["USER_ID"]
            );
            $this->db->insert("bm_paymentmst", $p_master_data_array);

            // insert data into Payment Amount Table
            for ($i = 0; $i < sizeof($payment_amt); $i++) {
                if ($payment_amt[$i] != "") {
                    if (isset($payment_amt[0])) { // Cash Payment
                        $p_mode = "CS";
                    }
                    if (isset($payment_amt[1])) { // Cheque Payment
                        $p_mode = "CH";
                    }
                    if (isset($payment_amt[2])) { // Debit/Credit Card Payment
                        $p_mode = "CA";
                    }
                    $p_amount_pk = $this->utilities->pk_f('bm_paymodeamt'); // get Primary Key
                    $p_amount_data_array = array(
                        "MR_TRAN_NO" => $p_amount_pk,
                        "MR_TRAN_DT" => date("Y/m/d"),
                        "TRX_TRAN_NO" => $trans_no,
                        "MR_TRAN_AMT" => $payment_amt[$i],
                        "VOUCHER_NO" => $voucher_no,
                        "TRX_CODE_NO" => "PM",
                        "PAYMENT_MODE" => "$p_mode",
                        "REMARKS" => $remarks,
                        "ORG_ID" => 1,
                        "CREATED_BY" => $user_session["USER_ID"]
                    );
                    $this->db->insert("bm_paymodeamt", $p_amount_data_array);
                }
            }
            // insert data into LEDGER Table
            $ledger_pk = $this->utilities->pk_f('bm_vn_ledgers'); // get Primary Key
            $ledger_data_array = array(
                "VLEDGER_NO" => $ledger_pk,
                "VLEDGER_DT" => date("Y/m/d"),
                "TRX_CODE_NO" => "PM",
                "TRX_TRAN_NO" => $trans_no,
                "VOUCHER_NO" => $voucher_no,
                "DR_AMT" => $payment_amt[0],
                "PITEM_TQTY" => 0
            );
            $this->db->insert("bm_vn_ledgers", $ledger_data_array);
            /*start stu_semesterinfo insert data*/
            $check = $this->utilities->hasInformationByThisId("student_semesterinfo", array('FACULTY_ID' => $faculty_id, "DEPT_ID" => $dept_id, "PROGRAM_ID" => $program_id, "STUDENT_ID" => $student_id, "SESSION_ID" => $sem_session_id, "SEMESTER_SL_NO" => $semister_id));
            if (empty($check)) { /*Check the data already exit*/
                $semterPK = $this->utilities->pk_f('stu_semesterinfo');
                $semInfo = array(
                    "S_SEMESTER_ID" => $semterPK,
                    "STUDENT_ID" => $student_id,
                    "SESSION_ID" => $session_id,
                    "SEM_SESSION" => $sem_session_id,
                    "SEMESTER_ID" => $semister_id,
                    "FACULTY_ID" => $faculty_id,
                    "DEPT_ID" => $dept_id,
                    "PROGRAM_ID" => $program_id,
                    "BATCH_ID" => 0,
                    "IS_CURRENT" => 0,
                    "CREATED_BY" => $user_session["USER_ID"]
                );
                $this->utilities->insertData($semInfo, 'stu_semesterinfo');
            }
            /*end stu_semesterinfo insert data*/

            $this->db->trans_complete();
            if ($this->db->trans_status() == TRUE) {
                $this->session->set_flashdata('Success', 'Transaction Processed Successfully');
                redirect("payment/existing_students/$student_id");
            } else {
                $this->session->set_flashdata('Error', 'Sorry this user already exits !');
                redirect("payment/existing_students/$student_id");
            }
            /*End 2nd part of payment*/
        }
    }

    function paymentForm(){
        $data['contentTitle'] = 'Online Payment';
        $data["breadcrumbs"] = array(
            "Payment" => "payment/paymentForm",
            "Payment" => '#'
        );
        $data['content_view_page'] = 'payment/index';
        $this->admin_template->display($data);
    }
    function success(){
        echo "Payment Successful";
    }

    function fail(){
        echo "Payment Failed";
    }

    function cancel(){
        echo "Payment Canceled";
    }

    /**
     * @access
     * @param  none
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return view
     */
    function getAllApplicant(){ // Clear
        $data['contentTitle'] = 'Passed Applicant List';
        $data['breadcrumbs'] = array(
            'Admin' => 'admin/Passed applicant list',
            'Passed Applicant List' => '#'
        );
        $data['dimention'] = "horizental";
        $data['ac_type'] = '';
        $data['faculty'] = $this->utilities->findAllByAttribute('ins_faculty', array("ACTIVE_STATUS" => 1));
        $data["session"] = $this->utilities->admissionSessionList();
        $data['semester'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 16));
        $data['applicant'] = $this->db->query("SELECT spi.STUDENT_ID, spi.REGISTRATION_NO, spi.FULL_NAME_EN, MOBILE_NO, spi.PHOTO, spi. FACULTY_ID,
                                                                        spi.DEPT_ID,spi.PROGRAM_ID, ssi.SEMESTER_SL_NO, ssi.SESSION_ID, ssi.IS_CURRENT,
                                                                        (SELECT p.PROGRAM_SHORT_NAME FROM ins_program p WHERE p.PROGRAM_ID = spi.PROGRAM_ID)PROGRAM_SHORT_NAME,
                                                                        CONCAT((SELECT s.SESSION_NAME FROM ins_session s WHERE s.SESSION_ID = ys.SESSION_ID), '-' , ys.DINYEAR) SESSION_NAME,
                                                                        (SELECT m.LKP_NAME FROM m00_lkpdata m WHERE m.GRP_ID = 16 AND m.NUMB_LKP = ssi.SEMESTER_SL_NO)SEMESTER_NAME
                                                                        FROM student_personal_info spi
                                                                        INNER JOIN student_semesterinfo ssi ON ssi.STUDENT_ID = spi.STUDENT_ID
                                                                        INNER JOIN ins_ysession ys ON ys.YSESSION_ID = spi.SESSION_ID
                                                                        WHERE PREVIOUS_STU_FG = 0 AND ssi.IS_CURRENT = 1 ")->result();
        $data['content_view_page'] = 'admin/applicant/payment/applicant_list';
        $this->admin_template->display($data);
    }
    /**
     * @access
     * @param  faculty_id, dept_id, program_id
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return view
     */
    function searchNewApplicant(){ // Clear
        $faculty = $this->input->post('faculty');
        $department = $this->input->post('department');
        $program = $this->input->post('program');
        $session = $this->input->post('session');
        $data['applicant'] = $this->db->query("SELECT spi.STUDENT_ID, spi.REGISTRATION_NO, spi.FULL_NAME_EN, MOBILE_NO, spi.PHOTO, spi. FACULTY_ID,
                                                                        spi.DEPT_ID,spi.PROGRAM_ID, ssi.SEMESTER_SL_NO, ssi.SESSION_ID, ssi.IS_CURRENT,
                                                                        (SELECT p.PROGRAM_SHORT_NAME FROM ins_program p WHERE p.PROGRAM_ID = spi.PROGRAM_ID)PROGRAM_SHORT_NAME,
                                                                        CONCAT((SELECT s.SESSION_NAME FROM ins_session s WHERE s.SESSION_ID = ys.SESSION_ID), '-' , ys.DINYEAR) SESSION_NAME,
                                                                        (SELECT m.LKP_NAME FROM m00_lkpdata m WHERE m.GRP_ID = 16 AND m.NUMB_LKP = ssi.SEMESTER_SL_NO)SEMESTER_NAME
                                                                        FROM student_personal_info spi
                                                                        INNER JOIN student_semesterinfo ssi ON ssi.STUDENT_ID = spi.STUDENT_ID
                                                                        INNER JOIN ins_ysession ys ON ys.YSESSION_ID = spi.SESSION_ID
                                                                        WHERE PREVIOUS_STU_FG = 0 AND ssi.IS_CURRENT = 1 AND spi.FACULTY_ID = $faculty
                                                                        AND spi.DEPT_ID = $department AND spi.PROGRAM_ID = $program  AND ssi.SESSION_ID = $session")->result();
        $this->load->view('admin/applicant/payment/search_applicant_list', $data);
    }
    /**
     * @access
     * @param  applicant_id
     * @author Emdadul Huq <Emdadul@atilimited.net>
     * @return view
     */
    function applicant_payment() {
        $data['contentTitle'] = 'Applicant Payment';
        $data["breadcrumbs"] = array(
            "Admin" => "admin/payment",
            "Applicant Payment" => '#'
        );
        $applicant = $this->uri->segment(3);
        $user_session = $this->session->userdata("logged_in");
        if($applicant){
            $data["applicant_info"] = $this->db->query("SELECT spi.STUDENT_ID, spi.REGISTRATION_NO, spi.FULL_NAME_EN, spi.PROGRAM_ID, spi.DEPT_ID,
                                                                                        spi.FACULTY_ID, ssi.SEMESTER_SL_NO, ssi.SESSION_ID,
                                                                                        (SELECT p.PROGRAM_NAME FROM ins_program p WHERE p.PROGRAM_ID = spi.PROGRAM_ID )PROGRAM_NAME,
                                                                                        (SELECT d.DEPT_NAME FROM ins_dept d WHERE d.DEPT_ID = spi.DEPT_ID)DEPT_NAME,
                                                                                        (SELECT f.FACULTY_NAME FROM ins_faculty f WHERE f.FACULTY_ID = spi.FACULTY_ID)FACULTY_NAME,
                                                                                        CONCAT((SELECT s.SESSION_NAME FROM ins_session s WHERE s.SESSION_ID = ys.SESSION_ID), '-', ys.DINYEAR)SESSION_NAME,
                                                                                        (SELECT m.LKP_NAME FROM m00_lkpdata m WHERE m.GRP_ID = 16 AND m.NUMB_LKP = ssi.SEMESTER_SL_NO)SEMESTER_NAME
                                                                                        FROM student_personal_info spi
                                                                                        LEFT JOIN student_semesterinfo ssi ON spi.STUDENT_ID = ssi.STUDENT_ID
                                                                                        LEFT JOIN ins_ysession ys ON ys.YSESSION_ID = ssi.SESSION_ID
                                                                                        WHERE spi.STUDENT_ID = $applicant AND ssi.IS_CURRENT = 1")->row();
            


            //Courase is not add
            $cur_session = $user_session["SESSION_ID"];
            //$data['semester_wise_course'] = $this->student_model->getAllCourseByStudentIdAndSessionWise($applicant, $cur_session);
            //echo "<pre>";print_r($data["semester_wise_course"]);echo "</pre>";exit;
            // course end
            $exp_cond = array(
                "FACULTY_ID" => $data["applicant_info"]->FACULTY_ID,
                "DEPT_ID" => $data["applicant_info"]->DEPT_ID,
                "PROGRAM_ID" => $data["applicant_info"]->PROGRAM_ID,
                "SESSION_ID" => $data["applicant_info"]->SESSION_ID,
                "SEMESTER_ID" => $data["applicant_info"]->SEMESTER_SL_NO,
                //"ac_program_particulars.ACTIVE_STATUS" => 1
            );
            $data['SEMESTER_ID'] =  $data["applicant_info"]->SEMESTER_SL_NO;
            $txtFaculty = $data["applicant_info"]->FACULTY_ID;
            $txtDept = $data["applicant_info"]->DEPT_ID;
            $txtProgram = $data["applicant_info"]->PROGRAM_ID;
            $txtSession = $data["applicant_info"]->SESSION_ID;
            $semester = $data["applicant_info"]->SEMESTER_SL_NO;
            // all expenses in a semester
            $data["expenses"] = $this->db->query("SELECT a.AC_NO,a.BILL_AMT,c.AC_NAME  FROM fn_voucherchd a
                                                        left join  fn_vouchermst b on b.VOUCHER_NO=a.VOUCHER_NO
                                                        left join  fn_achead c on a.AC_NO=c.AC_NO
                                                        where b.STUDENT_ID=$applicant and b.SESSION_ID=$cur_session")->result();
            //$data["expenses"] = $this->utilities->findAllByAttributeWithJoin("ac_program_particulars", "ac_academic_charge", "PARTICULAR_ID", "CHARGE_ID", "CHARGE_NAME", $exp_cond);
            
            // total payment of a applicant in a semester
          /* $data["dueAmt"] = $this->db->query("SELECT v.VOUCHER_NO, v.VOUCHER_DT, v.STUDENT_ID, v.ROLL_NO, v.REMARKS, l.TRX_CODE_NO, l.TRX_TRAN_NO, l.CR_AMT, sum(l.DR_AMT) DEBIT
                                                                            FROM bm_vouchermst v INNER JOIN bm_vn_ledgers l ON v.VOUCHER_NO = l.VOUCHER_NO
                                                                            WHERE v.STUDENT_ID = '$applicant' AND v.SEMESTER_ID = $semester AND l.TRX_CODE_NO = 'PM' GROUP BY v.APPLICANT_ID")->row();
            */// getting all previous semesters
            $previous_semester_id = $this->db->query("SELECT LKP_ID FROM m00_lkpdata WHERE LKP_ID = (select max(m.LKP_ID) from m00_lkpdata m where LKP_ID < $semester AND GRP_ID = 16)")->row();
            //print_r($previous_semester_id);
            $is_new_payment_data = array(
                "FACULTY_ID" => $data["applicant_info"]->FACULTY_ID,
                "DEPT_ID" => $data["applicant_info"]->DEPT_ID,
                "PROGRAM_ID" => $data["applicant_info"]->PROGRAM_ID,
                "SESSION_ID" => $data["applicant_info"]->SESSION_ID,
                "SEMESTER_ID" => $semester
            );
            $semester_seq = $this->utilities->findByAttribute("m00_lkpdata", array("LKP_ID" => $semester));
            $data["semester_seq"] = $semester_seq->LKP_NAME;
            $data["total_amt"] = 0;
            // checking if any payment is done by applicant in a semester
            $data["is_new_payment"] = $this->utilities->hasInformationByThisId("fn_vouchermst", $is_new_payment_data);
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
        $data['content_view_page'] = 'admin/payment/applicant_payment';
        $this->admin_template->display($data);
    }
    /**
     * @access      public
     * @param       expense_id is an integer defining Expense ID
     * @author      Emdadul Huq <Emdadul@atilimited.net>
     * @return      Payment Template
     */
    public function doApplicantPayment() {
        //var_dump($_POST);exit;
        if ($_POST) {
            $user_session = $this->session->userdata("logged_in");
            $applicant_id = $this->input->post("txtApplicant");
            $applicant_roll = $this->input->post("txtRollNo");
            $faculty_id = $this->input->post("txtFaculty");
            $dept_id = $this->input->post("txtDept");
            $program_id = $this->input->post("txtProgram");
            $session_id = $this->input->post("txtSession");
            $semister_id = $this->input->post("txtSemister");
            $expense_id = $this->input->post("txtExpenseId"); // Expense Charge Head
            $expense_amt = $this->input->post("txtExpenseRate"); // Expense Charge Head Amount
            $payment_amt = $this->input->post("txtPayment");
            $remarks = $this->input->post("txtRemarks", TRUE);
            $txtIsFirstTime = $this->input->post("txtIsFirstTime");
            $v_master_pk = $this->utilities->pk_f('bm_vouchermst'); // get Primary Key
            $voucher_no = $v_master_pk;
            $this->db->trans_start();
            $check = $this->utilities->findByAttribute("bm_vouchermst", array("STUDENT_ID" => $applicant_id, "SESSION_ID" => $session_id, "SEMESTER_ID" => $semister_id,));
            //var_dump($check);exit;            
            if(empty($check)){
            // insert data into Voucher Master Table
            $v_master_data_array = array(
                "VOUCHER_NO" => $v_master_pk,
                "VOUCHER_DT" => date("Y/m/d"),
                "STUDENT_ID" => $applicant_id,
                "ROLL_NO" => $applicant_roll,
                "FACULTY_ID" => $faculty_id,
                "DEPT_ID" => $dept_id,
                "PROGRAM_ID" => $program_id,
                "SESSION_ID" => $session_id,
                "SEMESTER_ID" => $semister_id,
                "ORG_ID" => 1,
                "REMARKS" => $remarks,
                "CREATED_BY" => $user_session["USER_ID"]
            );
            //$this->db->insert("bm_vouchermst", $v_master_data_array);
            if ( $this->db->insert("bm_vouchermst", $v_master_data_array)) {
                // insert program particular information for each student
                for ($i = 0; $i < sizeof($expense_id); $i++)  {
                    // insert data into Voucher Child Table
                    $trans_no = $this->utilities->pk_f('bm_voucherchd'); // get Primary Key
                    $v_chd_data_array_1 = array(
                        "TRX_TRAN_NO" => $trans_no,
                        "TRX_TRAN_DT" => date("Y/m/d"),
                        "VOUCHER_NO" => $voucher_no,
                        "SESSION_ID" => $session_id,
                        "SEMISTER_ID" => $semister_id, /* 90 equal to 1st semester */
                        "PRTCULR_NO" => $expense_id[$i],
                        "BILL_AMT" => $expense_amt[$i],
                        "PUNIT_PRICE" => $expense_amt[$i],
                        "ORG_ID" => 1,
                        "REMARKS" => $remarks,
                        "CREATED_BY" => $user_session["USER_ID"]
                    );
                    $this->utilities->insertData($v_chd_data_array_1, "bm_voucherchd");
                    // insert data into LEDGER Table
                    $ledger_pk = $this->utilities->pk_f('bm_vn_ledgers'); // get Primary Key
                    $ledger_data_array_1 = array(
                        "VLEDGER_NO" => $ledger_pk,
                        "VLEDGER_DT" => date("Y/m/d"),
                        "TRX_CODE_NO" => "GS",
                        "TRX_TRAN_NO" => $trans_no,
                        "VOUCHER_NO" => $voucher_no,
                        "CR_AMT" => $expense_amt[$i],
                        "PITEM_TQTY" => 1
                    );
                    $this->utilities->insertData($ledger_data_array_1, "bm_vn_ledgers");
                }
            }
        }
            
            ///////////-------------------
            $amount = 0;
            $qty = 0;
            for ($i = 0; $i < sizeof($expense_id); $i++) {
                $amount += $expense_amt[$i];
            }
            // insert data into Payment Master Table
            $p_master_pk = $this->utilities->pk_f('bm_paymentmst'); // get Primary Key
            $trans_no = $p_master_pk;
            $p_master_data_array = array(
                "TRX_TRAN_NO" => $p_master_pk,
                "TRX_TRAN_DT" => date("Y/m/d"),
                "TRAN_AMT" => $payment_amt[0],
                "COLLECTED_BY" => $user_session["USER_ID"],
                "TRX_CODE_NO" => "PM",
                "REMARKS" => $remarks,
                "CREATED_BY" => $user_session["USER_ID"]
            );
            $this->db->insert("bm_paymentmst", $p_master_data_array);

            // insert data into Payment Amount Table
            for ($i = 0; $i < sizeof($payment_amt); $i++) {
                if ($payment_amt[$i] != "") {
                    if (isset($payment_amt[0])) { // Cash Payment
                        $p_mode = "CS";
                    }
                    if (isset($payment_amt[1])) { // Cheque Payment
                        $p_mode = "CH";
                    }
                    if (isset($payment_amt[2])) { // Debit/Credit Card Payment
                        $p_mode = "CA";
                    }
                    $p_amount_pk = $this->utilities->pk_f('bm_paymodeamt'); // get Primary Key
                    $p_amount_data_array = array(
                        "MR_TRAN_NO" => $p_amount_pk,
                        "MR_TRAN_DT" => date("Y/m/d"),
                        "TRX_TRAN_NO" => $trans_no,
                        "MR_TRAN_AMT" => $payment_amt[$i],
                        "VOUCHER_NO" => $voucher_no,
                        "TRX_CODE_NO" => "PM",
                        "PAYMENT_MODE" => "$p_mode",
                        "REMARKS" => $remarks,
                        "ORG_ID" => 1,
                        "CREATED_BY" => $user_session["USER_ID"]
                    );
                    $this->db->insert("bm_paymodeamt", $p_amount_data_array);
                }
            }
            // insert data into LEDGER Table
            $ledger_pk = $this->utilities->pk_f('bm_vn_ledgers'); // get Primary Key
            $ledger_data_array = array(
                "VLEDGER_NO" => $ledger_pk,
                "VLEDGER_DT" => date("Y/m/d"),
                "TRX_CODE_NO" => "PM",
                "TRX_TRAN_NO" => $trans_no,
                "VOUCHER_NO" => $voucher_no,
                "DR_AMT" => $payment_amt[0],
                "PITEM_TQTY" => 0
            );
            $ledger = $this->db->insert("bm_vn_ledgers", $ledger_data_array);
//            if(!empty($ledger)){
//                /*insert date stu_courseinfo and stu_semesterinfo*/
//                $appInfo = $this->db->query("SELECT * FROM adm_applicant_info WHERE APPLICANT_ID = $applicant_id")->row();
//                $pk = $this->utilities->pk_f('students_info');
//                $addPk = $this->utilities->pk_f('stu_admissioninfo');
//                /*update stuent Id into bm_vouchermst table*/
//                $bm_update = array(
//                    "STUDENT_ID" =>$pk
//                );
//                $update = $this->utilities->updateData('bm_vouchermst', $bm_update, array("APPLICANT_ID" => $applicant_id));
//                /*end update*/
//                $opType = $this->utilities->findByAttribute('adm_applicant_info', array("APPLICANT_ID" => $applicant_id));
//                $courserOffer = $this->db->query("SELECT acs.*, acs.COURSE_ID as course
//                                    FROM aca_semester_course acs
//                                    INNER JOIN aca_course_offer aco on (aco.FACULTY_ID = acs.FACULTY_ID AND aco.DEPT_ID = acs.DEPT_ID AND aco.PROGRAM_ID = acs.PROGRAM_ID)
//                                    WHERE aco.OFFER_TYPE = '$opType->OFFER_TYPE' AND aco.FACULTY_ID = $faculty_id AND aco.DEPT_ID = $dept_id AND aco.PROGRAM_ID = $program_id and acs.SEMESTER_ID = $semister_id group by acs.COURSE_ID ")->result();
//                foreach ($courserOffer as $row) {
//                    $coursePK = $this->utilities->pk_f('stu_courseinfo');
//                    $courseInfo = array(
//                        "STU_CRS_ID" => $coursePK,
//                        "STUDENT_ID" => $pk,
//                        "OFFERED_COURSE_ID" => $row->OFFERED_COURSE_ID,
//                        "SESSION_ID" => $session_id,
//                        "SEM_SESSION" => $session_id,
//                        "SEMISTER_ID" => $semister_id,
//                        "FACULTY_ID" => $faculty_id,
//                        "DEPT_ID" => $dept_id,
//                        "PROGRAM_ID" => $program_id,
//                        "COURSE_ID" => $row->course,
//                        "IS_CURRENT" => 1,
//                        "IS_DROPPED" => 0,
//                        "ACTIVE_STATUS" => 1,
//                        "CREATED_BY" => $user_session["USER_ID"]
//                    );
//                    $this->utilities->insertData($courseInfo, 'stu_courseinfo');
//                }                
//                $semterPK = $this->utilities->pk_f('stu_semesterinfo');
//                $semInfo = array(
//                    "S_SEMESTER_ID" => $semterPK,
//                    "STUDENT_ID" => $pk,
//                    "SESSION_ID" => $session_id,
//                    "SEM_SESSION" => $session_id,
//                    "SEMESTER_ID" => $semister_id,
//                    "FACULTY_ID" => $faculty_id,
//                    "DEPT_ID" => $dept_id,
//                    "PROGRAM_ID" => $program_id,
//                    "BATCH_ID" => 1,
//                    "IS_CURRENT" => 1,
//                    "CREATED_BY" => $user_session["USER_ID"]
//                );
//                $this->utilities->insertData($semInfo, 'stu_semesterinfo');
//                /*end section*/
//
//                /*Applicant data inset into student_info*/
//                /*appliant personal information add adm_appliantion_info to students_info and stu_admissioninfo*/
//                  
//                $stu_roll = $this->db->query("SELECT MAX(si.ROLL_NO)ROLL_NO 
//                                            FROM students_info si
//                                            INNER JOIN stu_semesterinfo ss on si.STUDENT_ID = ss.STUDENT_ID
//                                            WHERE ss.FACULTY_ID = $faculty_id AND ss.DEPT_ID = $dept_id AND ss.PROGRAM_ID = $program_id AND ss.SESSION_ID = $session_id")->row();
//                $num = $stu_roll->ROLL_NO;
//                $jj = substr($num, 10, 3);
//                $sequence = (int)$jj + 1;
//                $ii = substr($num, 0, 4);
//                if($ii < date("Y") ){
//                    $sequence = 1;
//                }
//                $rollNo = date("Y").STR_PAD($session_id, 2, "0", STR_PAD_LEFT).STR_PAD($dept_id, 2, "0", STR_PAD_LEFT).STR_PAD($program_id, 2, "0", STR_PAD_LEFT).STR_PAD($sequence, 3, "00", STR_PAD_LEFT); 
//                /*Roll No Generate*/      
//                /*end Roll no generate*/
//                $GENDER = $appInfo->GENDER;
//                if($GENDER == 4){
//                    $GENDER = 'M';
//                }else if($GENDER == 5){
//                    $GENDER = 'F';
//                }else if($GENDER == 13){
//                    $GENDER = 'T';
//                }else if($GENDER == 207){
//                    $GENDER = 'O';
//                }
//                $SEMESTER_ID = $semister_id ;
//                $applicantInfo = array(
//                    'STUDENT_ID' => $pk,
//                    'ROLL_NO' => $rollNo,
//                    'ADM_SESSION_ID' => $appInfo->SESSION_ID,
//                    'BIOMETRIC_ID' => '',
//                    'PASSWORD' => $appInfo->PASSWORD,
//                    'FIRST_NAME' => $appInfo->FIRST_NAME,
//                    'MIDDLE_NAME' => $appInfo->MIDDLE_NAME,
//                    'LAST_NAME' => $appInfo->LAST_NAME,
//                    'FULL_NAME_EN' => $appInfo->FULL_NAME_EN,
//                    'FULL_NAME_BN' => $appInfo->FULL_NAME_BN,
//                    'STUD_PHOTO' => $appInfo->STUD_PHOTO,
//                    'GENDER' => $GENDER,
//                    'HOME_PHONE' => $appInfo->HOME_PHONE,
//                    'NATIONALITY' => $appInfo->NATIONALITY,
//                    'NATIONAL_ID' => $appInfo->NATIONAL_ID,
//                    'EMAIL_ADRESS' => $appInfo->EMAIL_ADRESS,
//                    'COUNTRY_ID' => $appInfo->COUNTRY_ID,
//                    'FATHER_NAME' => $appInfo->FATHER_NAME,
//                    'MOTHER_NAME' => $appInfo->MOTHER_NAME,
//                    'MARITAL_STATUS' => $appInfo->MARITAL_STATUS,
//                    'SPOUSE_NAME' => $appInfo->SPOUSE_NAME,
//                    'DATH_OF_BIRTH' => $appInfo->DATH_OF_BIRTH,
//                    'PLACE_OF_BIRTH' => $appInfo->PLACE_OF_BIRTH,
//                    'HEIGHT_CM' => $appInfo->HEIGHT_CM,
//                    'BLOOD_GROUP' => $appInfo->BLOOD_GROUP,
//                    'HEIGHT_FEET' => $appInfo->HEIGHT_FEET,
//                    'HEIGHT_INCHES' => $appInfo->HEIGHT_INCHES,
//                    'WEIGHT_KG' => $appInfo->WEIGHT_KG,
//                    'WEIGHT_LBS' => $appInfo->WEIGHT_LBS,
//                    'COLOR_OF_EYES' => $appInfo->COLOR_OF_EYES,
//                    'IDENTIFY_MARK' => $appInfo->IDENTIFY_MARK,
//                    'RELIGION_ID' => $appInfo->RELIGION_ID,
//                    'PASSPORT_NO' => $appInfo->PASSPORT_NO,
//                    /*'ISSUE_DATE' => $appInfo->ISSUE_DATE,
//                    'EXPIRE_DATE' => $appInfo->EXPIRE_DATE,*/
//                    'SSOF_FINANC' => $appInfo->SSOF_FINANC,
//                    'FMLY_INCOME' => $appInfo->FMLY_INCOME,
//                    'SIBLING_EXIST' => $appInfo->SIBLING_EXIST,
//                    'PS_GVN_FG' => $appInfo->PS_GVN_FG,
//                );
//                if($this->utilities->insertData($applicantInfo, 'students_info')){     
//                    $source = "upload/applicant_photo/".$appInfo->STUD_PHOTO;
//                    $dest = "upload/existing_studnet_photo/".$appInfo->STUD_PHOTO;
//                    $success = copy($source, $dest);
//                    if(!empty($success)){
//                        //unlink($source);        
//                    }
//                    $source_sig = "upload/applicant_photo/".$appInfo->SIGNATURE_PHOTO;
//                    $dest_sig = "upload/existing_studnet_photo/".$appInfo->SIGNATURE_PHOTO;
//                    $success_sig = copy($source_sig, $dest_sig);
//                    if(!empty($success_sig)){
//                        //unlink($source_sig);       
//                    }               
//                    $addmissionInfo = array(
//                        'STU_ADMISSION_ID' => $addPk,
//                        'STUDENT_ID' => $pk,
//                        'SESSION_ID' => $appInfo->SESSION_ID,
//                        'FACULTY_ID' => $appInfo->FACULTY_ID,
//                        'DEPT_ID' => $appInfo->DEPT_ID,
//                        'PROGRAM_ID' => $appInfo->PROGRAM_ID,
//                        'SEMISTER_ID' => '',
//                        'ACTIVE_STATUS' => $user_session["USER_ID"]
//                    );
//                    $this->utilities->insertData($addmissionInfo, 'stu_admissioninfo');            
//                }
//                /*end add applicant personal info*/
//
//                /*Applicant parent info insert into stu_parentinfo from from_parentinfo*/
//                $parentInfo = $this->db->query("SELECT * FROM adm_applicant_parentinfo WHERE APPLICANT_ID  = $applicant_id")->result();
//                foreach ($parentInfo as $row) {
//                    $parentPk = $this->utilities->pk_f('stu_parentinfo');
//                    $pInfo = array(
//                        'STU_PARENT_ID' => $parentPk,
//                        'STUDENT_ID' => $pk,
//                        'PARENTS_TYPE' => $row->PARENTS_TYPE,
//                        'GURDIAN_NAME' => $row->GURDIAN_NAME,
//                        'OCCUPATION' => $row->OCCUPATION,
//                        'PARENT_PHOTO' => $row->PARENT_PHOTO,
//                        'NATIONALITY' => $row->NATIONALITY,
//                        'WORKING_ORG' => $row->WORKING_ORG,
//                        'MOBILE_NO' => $row->MOBILE_NO,
//                        'EMAIL_ADRESS' => $row->EMAIL_ADRESS,
//                        'PASSWORD' => $row->PASSWORD,
//                        'ECP_FG' => $row->ECP_FG,
//                        'ORG_ID' => $row->ORG_ID,
//                        'ACTIVE_FLAG' => $user_session["USER_ID"],
//                    );
//                    $ppinfo = $this->utilities->insertData($pInfo, 'stu_parentinfo');
//                    if(!empty($ppinfo)){
//                        $source_pp = "upload/applicant_photo/parents_photo/".$row->PARENT_PHOTO;
//                        $dest_pp = "upload/existing_studnet_photo/parent/".$row->PARENT_PHOTO;
//                        $success_pp = copy($source_pp, $dest_pp);
//                        if(!empty($success_pp)){
//                            //unlink($source_pp);       
//                        }
//                    }
//                }
//                /*end parent info*/
//
//                /*Applicant contact info insert into stu_pgscontract from adm_pgscontract*/
//                $contactInfo = $this->db->query("SELECT * FROM adm_pgscontract WHERE APPLICANT_ID  = $applicant_id")->result();
//                foreach ($contactInfo as $row) {
//                    $pgsPk = $this->utilities->pk_f('stu_pgscontract');
//                    $cInfo = array(
//                        'STU_PGS_ID' => $pgsPk,
//                        'STUDENT_ID' => $pk,
//                        'PGSC_TYPE' => $row->PGSC_TYPE,
//                        'PGSC_ID' => $row->PGSC_ID,
//                        'CONTACTS' => $row->CONTACTS,
//                        'CONTACT_TYPE' => $row->CONTACT_TYPE,
//                        'ORG_ID' => $row->ORG_ID,
//                        'DEFAULT_FG' => $row->DEFAULT_FG,
//                        'ACTIVE_STATUS' => $user_session["USER_ID"],
//                    );
//                    $this->utilities->insertData($cInfo, 'stu_pgscontract');
//                }
//                /*end contact info*/
//                /*subling info add */
//                $sibling = $this->utilities->findByAttribute("adm_applicant_siblings", array("APPLICANT_ID" => $applicant_id));
//                $sbln_pk = $this->utilities->pk_f('stu_siblings');
//                $sblnInfo = array(
//                    'STU_SBLN_ID' => $sbln_pk,
//                    'SBLN_ROLL_NO' => $sibling->SBLN_ROLL_NO,
//                    'STUDENT_ID' => $pk, 
//                    'ACTIVE_STATUS' => $user_session["USER_ID"]          
//                );
//                $this->utilities->insertData($sblnInfo, 'stu_siblings');
//                /*end subling*/
//                /*Applicant address info insert into stu_adressinfo from adm_applicant_adressinfo*/
//                $addressInfo = $this->db->query("SELECT * FROM adm_applicant_adressinfo WHERE APPLICANT_ID  = $applicant_id")->result();
//                foreach ($addressInfo as $row) {
//                    $addressPk = $this->utilities->pk_f('stu_adressinfo');
//                    $addrInfo = array(
//                        'STU_ADRESS_ID' => $addressPk,
//                        'STUDENT_ID' => $pk,
//                        'ADRESS_TYPE' => $row->ADRESS_TYPE,
//                        'SAS_PSORPR' => $row->SAS_PSORPR,
//                        'HOUSE_NO_NAME' => $row->HOUSE_NO_NAME,
//                        'ROAD_AVENO_NAME' => $row->ROAD_AVENO_NAME,
//                        'VILLAGE_WARD' => $row->VILLAGE_WARD,
//                        'UNION_ID' => $row->UNION_ID,
//                        'THANA_ID' => $row->THANA_ID,
//                        'POST_OFFICE_ID' => $row->POST_OFFICE_ID,
//                        'POLICE_STATION_ID' => $row->POLICE_STATION_ID,
//                        'DISTRICT_ID' => $row->DISTRICT_ID,
//                        'DIVISION_ID' => $row->DIVISION_ID,
//                        'ACTIVE_FLAG' => 1,
//                        'CREATED_BY' => $user_session["USER_ID"],
//                    );
//                    $this->utilities->insertData($addrInfo, 'stu_adressinfo');                    
//                }
//                /*end address info*/
//
//                /*Applicant academic info insert into stu_acadimicinfo from adm_applicant_acadimicinfo*/
//                $academicInfo = $this->db->query("SELECT * FROM adm_applicant_acadimicinfo WHERE APPLICANT_ID  = $applicant_id")->result();
//                foreach ($academicInfo as $row) {
//                    $academicPK = $this->utilities->pk_f('stu_acadimicinfo');
//                    $acInfo = array(
//                        'STU_AI_ID' => $academicPK,
//                        'STUDENT_ID' => $pk,
//                        'EXAM_DEGREE_ID' => $row->EXAM_DEGREE_ID,
//                        'MAJOR_GROUP_ID' => $row->MAJOR_GROUP_ID,
//                        'INSTITUTION' => $row->INSTITUTION,
//                        'BOARD' => $row->BOARD,
//                        'RESULT_GRADE' => $row->RESULT_GRADE,
//                        'CGPA_MARKPCT' => $row->CGPA_MARKPCT,
//                        'SCALE_MARKS' => $row->SCALE_MARKS,
//                        'PASSING_YEAR' => $row->PASSING_YEAR,
//                        'DURATION' => $row->DURATION,
//                        'ACHIEVEMENT' => $row->ACHIEVEMENT,
//                        'ACTIVE_FLAG' => $row->ACTIVE_FLAG,
//                        'CREATED_BY' => $user_session["USER_ID"]
//                    );
//                    $sa = $this->utilities->insertData($acInfo, 'stu_acadimicinfo');   
//                    if(!empty($sa)){
//                        $source_pp = "upload/applicant_photo/".$row->ACHIEVEMENT;
//                        $dest_pp = "upload/existing_studnet_photo/".$row->ACHIEVEMENT;
//                        $success_pp = copy($source_pp, $dest_pp);
//                        if(!empty($success_pp)){
//                            //unlink($source_pp);       
//                        }
//                    }                 
//                }
//                /*end academic info*/
//            }

            $this->db->trans_complete();
            if ($this->db->trans_status() == TRUE) {
                $this->session->set_flashdata('Success', 'Transaction Processed Successfully');
                redirect("payment/applicant_payment/$applicant_id");
            } else {
                $this->session->set_flashdata('Error', 'Sorry this user already exits !');
                redirect("payment/applicant_payment/$applicant_id");
            }
        }
    }

}
