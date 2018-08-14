<?php

Class Resident_model extends CI_Model {
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function getRoomStatus($building_id,$floor_id)
  {
    $result = $this->db->query("SELECT 
      a.*, b.ROOM_NAME
      FROM
      resident_seat_mapping a
      LEFT JOIN
      sa_room b ON a.ROOM_ID = b.ROOM_ID
      WHERE
      a.BUILDING_ID = $building_id AND a.FLOOR_ID = $floor_id
      GROUP BY a.ROOM_ID")->result(); 
        //echo "<pre>"; print_r($result); exit; echo "</pre>";
    return $result;
  }
  public function getResidentApplication()
  {
    $result = $this->db->query("SELECT 
      b.*
      FROM
      resident_application a
      LEFT JOIN
      student_personal_info b ON a.APPLICANT_ID = b.STUDENT_ID
      WHERE
      a.APPROVE_PROVOST_STATUS = 1
      AND a.APPLICATION_TYPE = 'A' AND a.APPLICANT_ID NOT IN (SELECT APPLICANT_ID FROM resident_seat_allocation where ACTIVE_STATUS=1  )")->result();
        //echo "<pre>"; print_r($result); exit; echo "</pre>";
    return $result;
  }    
  public function getResidentStudentInformation($SEAT_MAPPING_ID)
  {
    $query = $this->db->query("SELECT 
      a.*, b.FULL_NAME_EN,b.REGISTRATION_NO
      FROM
      resident_seat_allocation a
      LEFT JOIN
      student_personal_info b ON a.APPLICANT_ID = b.STUDENT_ID
      WHERE
      a.SEAT_MAPPING_ID = $SEAT_MAPPING_ID
      AND a.ACTIVE_STATUS = 1")->row();
        //echo "<pre>"; print_r($result); exit; echo "</pre>";
    return $query;
  }
  public function getResidentStudentList($building_id)
  {
    $query = $this->db->query("SELECT a.*
                                FROM resident_seat_allocation a, resident_seat_mapping b
                               WHERE a.SEAT_MAPPING_ID = b.SEAT_MAPPING_ID AND b.BUILDING_ID = $building_id")->result();
        //echo "<pre>"; print_r($result); exit; echo "</pre>";
    return $query;
  }

}