<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AdminSkillDev extends CI_Controller
{
    private $user_session;

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('logged_in') == FALSE) {
            redirect('auth/login', 'refresh');
        }
        $this->user_session = $this->session->userdata('logged_in');
        header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        $this->load->model('utilities');
        $this->load->model('User');
    }
    public function index($parentId=0)
    {
      $userData=$this->session->userdata('logged_in');
      $data['userId']=$userData['USER_ID'];
      $data['contentTitle'] = 'Dashboard';
      $data["breadcrumbs"] = array(
          "Admin" => "admin/index",
          "Dashboard" => '#'
      );
      $data['parentId']=$parentId;
      $data['directories']=$this->db->query("
      SELECT sdd.*,(SELECT COUNT(*)
      FROM skill_dev_directory WHERE PARENT_SD_ID=sdd.SD_ID ) CHILD
      FROM skill_dev_directory sdd WHERE ACTIVE_STATUS='Y'
      AND PARENT_SD_ID=$parentId ORDER BY SD_NAME ASC")->result();
      $m=$data['directoryTree']=$this->db->query("
      SELECT T2.SD_ID, T2.SD_NAME
      FROM (
        SELECT
        @r AS _id,
        (SELECT @r := PARENT_SD_ID FROM skill_dev_directory WHERE SD_ID = _id) AS parent_id,
        @l := @l + 1 AS lvl
        FROM
        (SELECT @r := $parentId, @l := 0) vars,
        skill_dev_directory h
        WHERE @r <> 0) T1
        JOIN skill_dev_directory T2
        ON T1._id = T2.SD_ID
        ORDER BY T1.lvl DESC
        ")->result();
        //  $this->pr($m);
       
        $sql="SELECT sde.ELEMENT_ID,sde.ELEMENT_TITLE,sde.CRE_BY,sde.ELEMENT_EXT,sde.ELEMENT_URL,CONCAT(sdd.DIRECTORY_PATH,'/',sde.ELEMENT_URL) FILE_PATH,sde.ELEMENT_TYPE
        FROM skill_dev_element sde
        LEFT JOIN skill_dev_directory sdd using(SD_ID)
        WHERE SD_ID= ?";
        $data['files'] =$this->db->query($sql, array($parentId))->result();
        //  $this->pr($data['files']);
        $organogramDt=$this->db->query("SELECT * FROM skill_dev_directory ORDER BY SD_NAME ASC")->result();
        $resultArray = json_decode(json_encode($organogramDt), true);
        if(!empty($resultArray))
        {
          $data['tree']  = $this->buildTree($resultArray, 'PARENT_SD_ID','SD_ID');
        }


      $data['content_view_page'] = 'adminSkillDev/index';
      $this->admin_template->display($data);
    }
    public function editDirectory($id,$parentId)
    {
      if(isset($_POST['directoryName']))
      {
        $updData = array(
          'SD_NAME' => $this->input->post('directoryName'),
        );
        $this->utilities->updateData('skill_dev_directory', $updData, array('SD_ID' => $id));
        $this->session->set_flashdata('Success','Directory Name Updated Successfully.');
        redirect('AdminSkillDev/index/'.$parentId);

      }
      //echo "here";
      $data['directory']=$this->db->query("SELECT SD_ID,SD_NAME FROM skill_dev_directory WHERE SD_ID=$id")->row();
      $data['parentId']=$parentId;
      $this->load->view("adminSkillDev/editDirectory",$data);

    }
    public function createDirectory($parentId)
    {
      if(!empty($userProperty=$this->session->userdata['logged_in']))
      {
        $userId=$userProperty['USER_ID'];
        //  $this->pr($_POST);
        if(!empty($_POST['directoryName']))
        {
          if($parentId>0)
          {
            $parentProperty=$this->db->query("SELECT DIRECTORY_PATH FROM skill_dev_directory WHERE SD_ID=$parentId")->row();
            $currDirectory=$parentProperty->DIRECTORY_PATH;
          }
          else
          {
            $currDirectory='';
          }
          if($currDirectory=='')
          {
            $dirString="skillDoc/".$this->input->post('directoryName');
          }
          else
          {
            $dirString=$currDirectory.'/'.$this->input->post('directoryName');
          }
          $dirString=str_replace(" ","-",$dirString);
          $exist=$this->db->query("SELECT COUNT(*) DIR_COUNT FROM skill_dev_directory WHERE DIRECTORY_PATH='$dirString'")->row();
          if($exist->DIR_COUNT<=0)
          {
           // echo $dirString;

            mkdir($dirString);
          //$dirString;


            $inputData=array(
              'SD_NAME'=>$this->input->post('directoryName'),
              'CRE_BY'=>$userId,
              'DIRECTORY_PATH'=>$dirString,
              'PARENT_SD_ID'=>$parentId,
              'CRE_DT'=>date("Y-m-d h:i:s")
            );
            $this->db->insert('skill_dev_directory', $inputData);
            $this->session->set_flashdata('Success','Successfully Created.');
            redirect('AdminSkillDev/index/'.$parentId);
          }
          else
          {
            $this->session->set_flashdata('Error','The Directory Already Exist.');
            redirect('SkillDevelopment/index/'.$parentId);
          }

        }
        $data['parentId']=$parentId;
        $this->load->view("adminSkillDev/createDirectory",$data);
      }
      else
      {
        echo "Please Login To Create Directory";
      }

    }
    private function buildTree($flat, $pidKey, $idKey = null)
    {
      $grouped = array();
      foreach ($flat as $sub) {
        $grouped[$sub[$pidKey]][] = $sub;
      }
      $treeBuilder = function($siblings) use (&$treeBuilder, $grouped, $idKey) {
        foreach ($siblings as $k => $sibling) {
          $id = $sibling[$idKey];
          if (isset($grouped[$id])) {
            $sibling['children'] = $treeBuilder($grouped[$id]);
          }
          $siblings[$k] = $sibling;
        }
        return $siblings;
      };
      $tree = $treeBuilder($grouped[0]);
      return $tree;
    }
    public function deleteDirectoryFile($type,$id,$url)
    {
      $redirect=str_replace("--","/",$url);
      if($type=='d')
      {
          $path=$this->db->query("SELECT DIRECTORY_PATH FROM skill_dev_directory WHERE SD_ID=$id")->row();
        $fullPath=$path->DIRECTORY_PATH;
        foreach (glob($fullPath."/*.*") as $filename) {
          if (is_file($filename)) {
            unlink($filename);
          }
        }
        rmdir($fullPath);

        $this->db->where('SD_ID', $id);
        $this->db->delete('skill_dev_directory');
        $this->session->set_flashdata('Success','Directory Deleted Successfully');
          redirect('AdminSkillDev/index/');
      }
      else
      {
        $file=$this->db->query("SELECT sde.ELEMENT_ID,sde.ELEMENT_TITLE,sde.CRE_BY,sde.ELEMENT_EXT,sde.ELEMENT_URL,CONCAT(sdd.DIRECTORY_PATH,'/',sde.ELEMENT_URL) FILE_PATH,sde.ELEMENT_TYPE
        FROM skill_dev_element sde
        LEFT JOIN skill_dev_directory sdd using(SD_ID)
        WHERE ELEMENT_ID=$id")->row();
        unlink($file->FILE_PATH);
        $this->db->where('ELEMENT_ID', $id);
        $this->db->delete('skill_dev_element');
        $this->session->set_flashdata('Success','Directory Deleted Successfully');
        redirect('AdminSkillDev/index/');
      }
    }
    public function addNewElement($parentId)
    {
      if(!empty($userProperty=$this->session->userdata['logged_in']))
      {
        $userId=$userProperty['USER_ID'];

        if(!empty($_POST['elementTitle']))
        {
          $file=$_FILES['fileUpload']['name'];
          $ext = pathinfo($file, PATHINFO_EXTENSION);

          $picture='';
           $postFileName=$_FILES['fileUpload']['name'];

          $pieces = explode(".", $postFileName);
          $fileType=$ext; // piece2
          if(!empty($postFileName)){

            if($fileType=='pdf' OR $fileType=='doc' OR $fileType=='docx' OR $fileType=='pdf' OR $fileType=='ppt' OR $fileType=='pptx')
            {

              $pathInfo=$this->db->query("SELECT DIRECTORY_PATH FROM skill_dev_directory WHERE SD_ID=$parentId")->row();
              $path=$pathInfo->DIRECTORY_PATH.'/';
              $config['upload_path']   = $path;
              $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx|txt';
              $config['file_name']     = $_FILES['fileUpload']['name'];
              $config['max_size'] = '5120';

              //Load upload library and initialize configuration
              $this->load->library('upload', $config);
              $this->upload->initialize($config);
            }
            else
            {
              $this->session->set_flashdata('Error','You Can Upload Only Word,Pdf Or Ppt File');
              redirect('AdminSkillDev/index/'.$parentId);
            }
          }
          if ($this->upload->do_upload('fileUpload')) {
            $uploadData = $this->upload->data();
            $picture    = $uploadData['file_name'];

          }
          else
          {
            $Error = array('Error' => $this->upload->display_Errors());
            $picture='';
          }
          if($picture=='')
          {
            $urlPath=$this->input->post('websiteLink');
            $extension="";
          }
          else
          {
            $pieces = explode(".", $picture);
            $fileName=$pieces[0]; // piece1
            $extension=$pieces[1]; // piece2
            $urlPath=$picture;
          }
          $inputData=array(
            'ELEMENT_TITLE'=>$this->input->post('elementTitle'),
            'ELEMENT_TYPE'=>$this->input->post('elementType'),
            'SD_ID'=>$parentId,
            'ELEMENT_URL'=>$urlPath,
            'CRE_BY'=>$userId,
            'CRE_DT'=>date("Y-m-d h:i:s"),
            'ELEMENT_EXT'=>$extension
          );
          $this->db->insert('skill_dev_element', $inputData);
          $this->session->set_flashdata('Success','Successfully Created.');
          redirect('AdminSkillDev/index/'.$parentId);
        }

        $data['parentId']=$parentId;
        $this->load->view("adminSkillDev/addNewElement",$data);
      }
    }
    private function pr($data)
    {
      echo "<pre>";
      print_r($data);
      exit;
    }
}
