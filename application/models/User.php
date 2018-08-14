<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Model{
 function __construct() {
  $this->tableName = 'users';
  $this->primaryKey = 'userId';
}
public function checkUser($data = array()){
  $this->db->select($this->primaryKey);
  $this->db->from($this->tableName);
  $this->db->where(array('type'=>$data['type'],'facebookId'=>$data['facebookId']));
  $prevQuery = $this->db->get();
  $prevCheck = $prevQuery->num_rows();
  
  if($prevCheck > 0){
   $prevResult = $prevQuery->row_array();
   $data['updated_at'] = date("Y-m-d H:i:s");
   $update = $this->db->update($this->tableName,$data,array('userId'=>$prevResult['userId']));
   $userID = $prevResult['userId'];
 }else{
   $data['date'] = date("Y-m-d H:i:s");
   $insert = $this->db->insert($this->tableName,$data);
   $userID = $this->db->insert_id();
 }

 return $userID?$userID:FALSE;
}

public function userInfo()
{
  $row = $this->db->query("SELECT u.*, ul1.login_time, lst.title  as orgination_title, lst.latitude, lst.longitude 
    FROM users u
    LEFT JOIN listing lst
    ON u.userId = lst.userId 
    LEFT JOIN user_login ul1
    ON u.userId = ul1.user_id
    LEFT OUTER JOIN user_login ul2
    ON u.userId = ul2.user_id
    AND (
      ul1.login_time < ul2.login_time 
      OR ul1.login_time = ul2.login_time AND ul1.id < ul2.id
      )
  WHERE ul2.id IS NULL order by u.userId desc")->result();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
  return $row;
}


public function userPrivilege($groupId,$permission)
{
  $row = $this->db->query("SELECT COUNT(*) PERMSN_EXIST FROM front_module_permission 
                          WHERE USERGRP_ID=$groupId AND PERMISSION='$permission'")->row();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
  return $row;
}

public function get_all_module_list()
{
  $row = $this->db->query("SELECT m.* FROM front_end_module m
    ORDER BY m.MODULE_ID")->result();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
  return $row;
}


public function regOrg()
{
  $row = $this->db->query("SELECT us.*, ls.title as org_title,ls.location, ls.latitude, ls.longitude, ul1.login_time 
    FROM users us 
    LEFT JOIN listing ls 
    ON ls.userId = us.userId
    LEFT JOIN user_login ul1
    ON us.userId = ul1.user_id
    LEFT OUTER JOIN user_login ul2
    ON us.userId = ul2.user_id
    AND (
      ul1.login_time < ul2.login_time 
      OR ul1.login_time = ul2.login_time AND ul1.id < ul2.id
      )
  WHERE ul2.id IS NULL AND us.active='1' and us.type='organization' order by us.userId desc")->result();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
  return $row;
}


public function regIndividual()
{
  $row = $this->db->query("SELECT us.*, ls.title as org_title, ls.latitude, ls.longitude, ul1.login_time 
    FROM users us 
    LEFT JOIN listing ls 
    ON ls.userId = us.userId
    LEFT JOIN user_login ul1
    ON us.userId = ul1.user_id
    LEFT OUTER JOIN user_login ul2
    ON us.userId = ul2.user_id
    AND (
      ul1.login_time < ul2.login_time 
      OR ul1.login_time = ul2.login_time AND ul1.id < ul2.id
      )
  WHERE ul2.id IS NULL AND us.active='1' and us.type='individual' order by us.userId desc")->result();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
  return $row;
}

public function review_org()
{
  $row = $this->db->query("select u.* from users u  where u.active!=1 and u.active!=3 and u.type='organization'
   order by u.userId desc")->result();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
  return $row;
}



public function inclusive_bd_list()
{
  $row = $this->db->query("SELECT bg.*,u.fname,u.oname,u.userId,u.email,u.oemail,u.type, ut.name url_type, ut.value url_data,lk.* FROM inclusive_bd as bg
   LEFT JOIN url_type as ut ON ut.id = bg.url_type_id 
   left join users as u on u.userId=bg.created_by
   LEFT JOIN sa_lookup_data as lk ON lk.LOOKUP_DATA_ID = bg.category_id 
   order by bg.id desc")->result();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
  return $row;
}

public function mediaBlogList()
{
  $row = $this->db->query("SELECT md.*,l.title as Title,ut.name url_type,u.oemail, ut.value url_data, (SELECT COUNT(*) FROM blog_interest where blog_id=md.id ) TOTAL_INT FROM blog as md
   left join listing as l on l.id=md.organization_id
   left join users as u on u.userId=l.userId
   LEFT JOIN url_type as ut ON ut.id = md.url_type_id
   order by md.id desc")->result();
   return $row;
}

public function opportunityList()
{
  $row = $this->db->query("SELECT op.*,l.title as Title,u.oemail,(SELECT COUNT(*) FROM opportunity_interest where opportunity_id=op.id ) TOTAL_EMO,(SELECT COUNT(*) FROM opportunity_interest where opportunity_id=op.id and type is null) TOTAL_INT FROM opportunity as op
   left join listing as l on l.id=op.organization_id
   left join users as u on u.userId=l.userId
   order by op.id desc")->result();
   return $row;
}


public function eventList()
{
  $row = $this->db->query("SELECT e.*,l.title as Title,u.oemail,(SELECT COUNT(*) FROM event_going where event_id=e.id ) TOTAL_GOING,(SELECT COUNT(*) FROM event_interest where event_id=e.id ) TOTAL_EMO,(SELECT COUNT(*) FROM event_interest where event_id=e.id and type is null) TOTAL_INT FROM events as e
   left join listing as l on l.id=e.organization_id
   left join users as u on u.userId=l.userId
   order by e.id desc")->result();
   return $row;
}



public function directoryList()
{
  $row = $this->db->query("SELECT l.*,u.* FROM listing as l
         left join users as u on u.userId=l.userId
         order by l.id desc")->result();
         return $row;
}




public function userList()
{
  $row = $this->db->query("select a.* from admin a
   order by a.admin_id")->result();
        //echo "<pre>"; print_r($row); exit; echo "</pre>";
  return $row;
}

public function slider($slider_id)
{
  $sql="SELECT * FROM inclusive_bd_slider ins_bd WHERE ins_bd.ID = ?";
        return $this->db->query($sql, array($slider_id))->row(); 
 
}


public function deleteSliderImage($opp_id, $image_name)
{
  $result = $this->db->query("SELECT * FROM inclusive_bd_slider WHERE ID = $opp_id")->row();

  $imgPath = 'upload/inclusive_slider/';




  $this->db->query("UPDATE inclusive_bd_slider SET IMAGE_PATH = '' WHERE ID = $result->ID");
  if (file_exists($imgPath . $image_name)) {
    unlink($imgPath . $image_name);
    return array('ack' => true, 'msg' => 'Image deleted');
  } else {
    return array('ack' => false, 'msg' => 'Image not found.');
  }


}

}
