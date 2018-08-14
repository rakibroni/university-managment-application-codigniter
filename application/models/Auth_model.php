<?php

Class Auth_model extends CI_Model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function login($username)
    {
        $query = $this->db->get_where('sa_users', array('USERNAME' => $username));
        if ($query->num_rows() == 0) {
            return false;
        } else {
            return $query->row();
        }
       // return $query = $this->db->query("select * from sa_users where BINARY USERNAME='$username'")->row();
    }

    public function stuLogin($username, $password)
    {
        //$this->db->join("designations", "designations.DESIGNATION_ID=sa_users.DESIGNATION_ID", "left");

        $query = $this->db->get_where('student_personal_info', array('REGISTRATION_NO' => $username, 'LOGIN_PASSWORD' => $password));
        if ($query->num_rows() == 0) {
            return false;
        } else {
            return $query->row();
        }
    }

    public function parentsLogin($parents_user_name)
    {
        return $query = $this->db->query("select * from parent_profile where BINARY USERNAME='$parents_user_name'")->row();
    }

    public function trLogin($username, $password)
    {
        //$this->db->join("designations", "designations.DESIGNATION_ID=sa_users.DESIGNATION_ID", "left");
        $query = $this->db->get_where('teacher_info', array('USER_NAME' => $username, 'PASSWORD' => $password));
        if ($query->num_rows() == 0) {
            return false;
        } else {
            return $query->row();
        }
    }

    public function applicant_login($appUserCode, $password)
    {
        $query = $this->db->get_where('or_applicant_info', array('CODE' => $appUserCode, 'APPLICANT_PSWD' => $password, 'LSTATUS_FG' => 'A'));
        if ($query->num_rows() == 0) {
            return false;
        } else {
            return $query->row();
        }
    }
    public function applicantLogin($email, $password)
    {
        //$this->db->join("designations", "designations.DESIGNATION_ID=sa_users.DESIGNATION_ID", "left");

        $query = $this->db->get_where('applicant_user', array('EMAIL' => $email, 'PASSWORD' => $password));
        if ($query->num_rows() == 0) {
            return false;
        } else {
            return $query->row();
        }
    }

    public function applicantCredentials($email,$phone_digit)
    {
        //$this->db->join("designations", "designations.DESIGNATION_ID=sa_users.DESIGNATION_ID", "left");

        $query = $this->db->like('MOBILE', $phone_digit, 'before')->get_where('applicant_user', array('EMAIL' => $email));

        if ($query->num_rows() == 0) {
            return false;
        } else {

            return $query->row();
        }
    }

    public function studentCredentials($stu_reg_no, $stu_user_email, $stu_mobile)
    {
        $query = $this->db->like('MOBILE_NO', $stu_mobile, 'before')->get_where('student_personal_info', array('EMAIL_ADRESS' => $stu_user_email, 'REGISTRATION_NO' => $stu_reg_no));

        if ($query->num_rows() == 0) {
            return false;
        } else {

            return $query->row();
        }
    }

    public function userCredentials($user_email, $mobile_digit)
    {
        $query = $this->db->join('hr_emp', 'sa_users.EMP_ID = hr_emp.EMP_ID', 'left')->like('hr_emp.MOBILE', $mobile_digit, 'before')->get_where('sa_users', array('hr_emp.EMAIL' => $user_email));

        //echo "<pre>"; print_r($query1->row()); exit;

        if ($query->num_rows() == 0) {
            return false;
        } else {

            return $query->row();
        }
    }


}
