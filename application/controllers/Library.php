<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* @category   FrontPortal
* @package    Portal
* @author     Abu Nawim <nawim@atilimited.net>
* @copyright  2015 ATI Limited Development Group
*/
class Library extends CI_Controller {

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

  /*
  * @methodName index
  * @access
  * @param  none
  * @author Abu Nawim <nawim@atilimited.net>
  * @return 
  */

    function index()
    {
      $data['contentTitle'] = ' Libray Book ';
      $data['breadcrumbs'] = array(
            'Admin' => '#',
            'Libray Book' => '#',
            );
      $data["previlages"] = $this->checkPrevilege();
        //$data['resident'] = $this->finance_model->residentBillInformation(); // select all data from  
      $data['content_view_page'] = 'admin/libray/add_book.php';
      $this->admin_template->display($data); 

    }
    

  /*
  * @methodName index
  * @access
  * @param  none
  * @author Abu Nawim <nawim@atilimited.net>
  * @return 
  */

    function dashboard()
    {

        $data['contentTitle'] = 'Libary Dashboard ';
        $data["breadcrumbs"] = array(
            "Admin" => "admin/index",
            "Dashboard" => '#'
            );
        $data['pageTitle'] = 'Online University Management System ';
        $current_session= $this->utilities->findByAttribute("adm_ysession", array("IS_CURRENT" => 1));
        $data['currentTotalItem']=$this->library_model->allRowInTable("lib_stock");
        $data['finalAffectedDataForTodayItem']=$this->library_model->todayItem(); 
        $data['finalAffectedDataForTodayBorrow']=$this->library_model->todayBorrow();
        $data['finalAffectedDataForTodayMember']=$this->library_model->todayMember();

        $data['finalAffectedDataForMonthItem']=$this->library_model->thisMonth(date('m-y'),'lib_stock');
        $data['finalAffectedDataForMonthBorrow']=$this->library_model->thisMonth(date('m-y'),'lib_borrowers');
        $data['finalAffectedDataForMonthMember']=$this->library_model->thisMonth(date('m-y'),'lib_members');

        $data['finalAffectedDataForYearItem']=$this->library_model->thisYear(date('-y'),'lib_stock');
        $data['finalAffectedDataForYearBorrow']=$this->library_model->thisYear(date('-y'),'lib_borrowers');
        $data['finalAffectedDataForYearMember']=$this->library_model->thisYear(date('-y'),'lib_members');

        $data['currentTotalActiveMember']=$this->utilities->countRowByAttribute("lib_members",array("ACTIVE_STATUS" => 0));
        $data['currentTotalActiveBorrowItem']=$this->utilities->countRowByAttribute("lib_borrowers",array("ACTIVE_STATUS" => 1));
        $data['dateWiseItemEntry']=$this->library_model->dateWiseItem(date('d-M-y')); 
       
        $data['programs']  = $this->utilities->findAllByAttribute("ins_program", array("ACTIVE_STATUS" => 1)); 
        $data['content_view_page'] = 'admin/libray/libary_dashboard';
        $this->admin_template->display($data);

    }

    /*
    * @methodName addItem
    * @access
    * @param  none
    * @author Abu Nawim <nawim@atilimited.net>
    * @return 
    */


    function addItem()
    {
      $this->form_validation->set_rules('ISBN_NO','ISBN NO','required');
      $data["ac_type"] = 1;

      if ($this->form_validation->run() == FALSE) 
      {
      $data['department'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 15));
      $data['library_item_type'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 82));
      $data['author'] = $this->utilities->findAllByAttribute('lib_author', array('ACTIVE_STATUS' => 1));
      $data['publisher'] = $this->utilities->findAllByAttribute('lib_publisher', array('ACTIVE_STATUS' => 1));
      $data['supplier'] = $this->utilities->findAllByAttribute('inv_supplier', array('ACTIVE_STATUS' => 1));
       $data['content_view_page'] ='admin/libray/add_book';
 
      }
      else{
              require(APPPATH.'views/common/image_upload/class.upload.php');
              $itemPdf='';
              $itemCover='';
              $foo = new Upload($_FILES['PDF_VERSION']);

              if ($foo->uploaded) {
                // large size image                         
                $foo->image_border= 1;       
                $foo->allowed = array('image/*');
                $foo->Process('upload/library/pdf/');
                if($foo->processed){
                  $itemPdf=  $foo->file_src_name;
                }else{
                  echo  'error : ' . $foo->error;
                }
              }
              $sig_photo = new Upload($_FILES['COVER_IMAGE']);
              if ($sig_photo->uploaded) {
                // large size image
                $sig_photo->image_border          = 1;         
                $sig_photo->allowed = array('image/*');
                $sig_photo->Process('upload/library/cover/');
                if($sig_photo->processed){
                  $itemCover=  $sig_photo->file_src_name;
                }else{
                  echo  'error : ' . $sig_photo->error;
                }
              }

             $itemInfo = array(
                    'ISBN_NO' => $this->input->post('ISBN_NO'),
                    'ITEM_NAME' => $this->input->post('ITEM_NAME'),
                    'SUB_TITLE' => $this->input->post('SUB_TITLE'),
                    'DEPARTMENT' => $this->input->post('DEPARTMENT'),
                    'LANGUAGE' => $this->input->post('LANGUAGE'),
                    'AUTHOR_ID' => $this->input->post('AUTHOR_ID'),
                    'EDITOR_NAME' => $this->input->post('EDITOR_NAME'),
                    'EDITION_NO' => $this->input->post('EDITION_NO'),
                    'BOOK_CELL_NO' => $this->input->post('BOOK_CELL_NO'),
                    'BOOK_TYPE_ID' => $this->input->post('BOOK_TYPE_ID'),
                    'SUPPILER_ID' => $this->input->post('SUPPILER_ID'),
                    'PRICE' => $this->input->post('PRICE'),
                    'NUMBER_OF_PAGE' => $this->input->post('NUMBER_OF_PAGE'),
                    'CLUE_PAGE' => $this->input->post('CLUE_PAGE'),
                    'PUBLISHER_ID' => $this->input->post('PUBLISHER_ID'),
                    'PUBLICATION_YEAR' => $this->input->post('PUBLICATION_YEAR'),
                    'PUBLICATION_PLACE' => $this->input->post('PUBLICATION_PLACE'),
                    //'BOOK_SIZE' => $this->input->post('BOOK_SIZE'),
                    'PDF_VERSION' => $itemPdf,
                    'COVER_IMAGE' => $itemCover,
                    'COMMENT' => $this->input->post('COMMENT'),
                );
            // var_dump($itemInfo); die();

              $itemInfoResult= $this->library_model->insert('lib_item', $itemInfo);

              $this->session->set_flashdata('Success', 'Successfully Inserted');
              redirect('library/itemList');
             // echo "string OK Insert";
      }
      $this->admin_template->display($data);   
   
  }

   /*
    * @methodName itemList
    * @access
    * @param  none
    * @author Abu Nawim <nawim@atilimited.net>
    * @return 
    */

    public function itemList() {

        $data['contentTitle'] = 'Item List';
        $data['breadcrumbs'] = array(
          'Admin' => '#',
          'Item List' => '#',
          );
        $data["previlages"] = $this->checkPrevilege();
        $data['item_list'] = $this->library_model->itemInfo(); 
        $data['content_view_page'] = 'admin/libray/libary_list';
        $this->admin_template->display($data);
    }

   /*
    * @methodName itemUpdate
    * @access
    * @param  none
    * @author Abu Nawim <nawim@atilimited.net>
    * @return 
    */
    public function itemUpdate(){
        $ITEM_ID = $this->uri->segment(3);
         $data["ac_type"] = 1;
        //var_dump($ITEM_ID); die();
        // $data['ITEM_ID'] = $this->employee_model->findEmpById($ITEM_ID);
        $data['item'] = $this->utilities->findByAttribute('lib_item', array('ITEM_ID' => $ITEM_ID));
        $this->form_validation->set_rules('ISBN_NO','ISBN NO','required');
        if ($this->form_validation->run() == FALSE) {

         $data['department'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 15));
        $data['library_item_type'] = $this->utilities->findAllByAttribute('m00_lkpdata', array('GRP_ID' => 82));
        $data['author'] = $this->utilities->findAllByAttribute('lib_author', array('ACTIVE_STATUS' => 1));
        $data['publisher'] = $this->utilities->findAllByAttribute('lib_publisher', array('ACTIVE_STATUS' => 1));

        $data['supplier'] = $this->utilities->findAllByAttribute('inv_supplier', array('ACTIVE_STATUS' => 1));

        //$data['supplier'] = $this->utilities->findAllByAttribute('inv_supplier', array('ACTIVE_STATUS' => 1));
        

        $data['content_view_page'] ='admin/libray/edit_item';

        }else{

                require(APPPATH.'views/common/image_upload/class.upload.php');
                $itemPdf='';
                $itemCover='';
                $foo = new Upload($_FILES['PDF_VERSION']);

                if ($foo->uploaded) {
                  // large size image          
                  $foo->image_border= 1;
                  $foo->allowed = array('image/*');
                  $foo->Process('upload/library/pdf/');
                  if($foo->processed){
                    $itemPdf=  $foo->file_src_name;
                  }else{
                    echo  'error : ' . $foo->error;
                  }
                }
                $sig_photo = new Upload($_FILES['COVER_IMAGE']);
                if ($sig_photo->uploaded) {
                  // large size image
                  $sig_photo->image_border = 1;
                  $sig_photo->allowed = array('image/*');
                  $sig_photo->Process('upload/library/cover/');
                  if($sig_photo->processed){
                    $itemCover=  $sig_photo->file_src_name;
                  }else{
                    echo  'error : ' . $sig_photo->error;
                  }
                }

               $itemInfo = array(
                      'ISBN_NO' => $this->input->post('ISBN_NO'),
                      'ITEM_NAME' => $this->input->post('ITEM_NAME'),
                      'SUB_TITLE' => $this->input->post('SUB_TITLE'),
                      'DEPARTMENT' => $this->input->post('DEPARTMENT'),
                      'LANGUAGE' => $this->input->post('LANGUAGE'),
                      'AUTHOR_ID' => $this->input->post('AUTHOR_ID'),
                      //'EDITOR_NAME' => $this->input->post('EDITOR_NAME'),
                      'EDITION_NO' => $this->input->post('EDITION_NO'),
                      'BOOK_CELL_NO' => $this->input->post('BOOK_CELL_NO'),
                      'BOOK_TYPE_ID' => $this->input->post('BOOK_TYPE_ID'),
                      'SUPPILER_ID' => $this->input->post('SUPPILER_ID'),
                      'PRICE' => $this->input->post('PRICE'),
                      'NUMBER_OF_PAGE' => $this->input->post('NUMBER_OF_PAGE'),
                      'CLUE_PAGE' => $this->input->post('CLUE_PAGE'),
                      'PUBLISHER_ID' => $this->input->post('PUBLISHER_ID'),
                      'PUBLICATION_YEAR' => $this->input->post('PUBLICATION_YEAR'),
                      'PUBLICATION_PLACE' => $this->input->post('PUBLICATION_PLACE'),
                      //'BOOK_SIZE' => $this->input->post('BOOK_SIZE'),
                      'PDF_VERSION' => $itemPdf,
                      'COVER_IMAGE' => $itemCover,
                      'COMMENT' => $this->input->post('COMMENT'),
                  );

                $testall=$this->utilities->updateData('lib_item', $itemInfo, array('ITEM_ID' => $ITEM_ID));
                $this->session->set_flashdata('Success', ' Update Successfully ');
                      redirect('library/itemList');
        }
        $this->admin_template->display($data); 
    }

    /*
    * @methodName itemModal
    * @access
    * @param  none
    * @author Abu Nawim <nawim@atilimited.net>
    * @return 
    */


    public function itemModal()
    {
      $ITEM_ID = $_POST['ITEM_ID'];
      $data['ITEM_ID'] = $ITEM_ID;
      $data["item_info"] = $this->library_model->singleItemLiberayInfo($ITEM_ID);
       //$data["emp_desi"] = $this->employee_model->getEmployeeDesignation($EMP_ID);
        //echo "<pre>"; print_r($data); exit; echo "</pre>";
       //var_dump($data); die();
      echo $this->load->view('admin/libray/details_modal_view', $data, true);
    }

    /*
    * @methodName stock
    * @access
    * @param  none
    * @author Abu Nawim <nawim@atilimited.net>
    * @return 
    */


    public function stock()
    {


        $data['contentTitle'] = 'Library Stock Item List';
        $data['breadcrumbs'] = array(
          'Admin' => '#',
          'Library Stock Item List' => '#',
          );
        $data["previlages"] = $this->checkPrevilege();
        $data['item'] = $this->utilities->findAllByAttribute('lib_item', array('ACTIVE_STATUS' =>  1));
        $data['supplier'] = $this->utilities->findAllByAttribute('inv_supplier', array('ACTIVE_STATUS' => 1));
       
       //var_dump($data);
        $data['content_view_page'] = 'admin/libray/add_stock';
        $this->admin_template->display($data);
    }

    /*
    * @methodName addStock
    * @access
    * @param  none
    * @author Abu Nawim <nawim@atilimited.net>
    * @return 
    */


 public function addStock()
    {
          $INVOICE_NO=$this->input->post('INVOICE_NO');
          $ITEM_NAME_ID=$this->input->post('ITEM_NAME_ID');
          $SUPPLIER_ID=$this->input->post('SUPPLIER_ID');
          $REMARKS=$this->input->post('REMARKS');
          $REMARKS1=$this->input->post('REMARKS1');
          
          $QUENTITY=$this->input->post('QUENTITY');
          $RECEIVE_DATE = date('Y-m-d',strtotime($this->input->post('RECEIVE_DATE')));
          //var_dump(sizeof($ITEM_NAME_ID)); die();

          $add_invoice_data=array( 
              'INVOICE_NO' => $INVOICE_NO,
              'SUPPLIER_ID' => $SUPPLIER_ID,
              'REMARKS' => $REMARKS1,
              'RECEIVE_DATE'=>$RECEIVE_DATE
              );
               
          $this->utilities->insertData($add_invoice_data, 'lib_invoice');

          $LIB_INVOICE_ID=$this->db->query("SELECT MAX(LIB_INVOICE_ID) as LIB_INVOICE_ID FROM lib_invoice")->result();
          $test=$LIB_INVOICE_ID;

          if(!empty($ITEM_NAME_ID)){
            for ($i = 0; $i < sizeof($ITEM_NAME_ID); $i++) {
  
              for ($z = 0; $z < $QUENTITY[$i]; $z++) {

                $code[] = rand(10000, 9999999999);
                $itemId[] = $ITEM_NAME_ID[$i];
                $add_stock_data=array( 
                  'ITEM_ID' => $ITEM_NAME_ID[$i],
                  'LIB_INVOICE_ID' => $LIB_INVOICE_ID[0]->LIB_INVOICE_ID,
                  'REMARKS' => $REMARKS[$i],
                  'SKU' => end($code)                                 
                  );
                 $this->utilities->insertData($add_stock_data, 'lib_stock');
                }
            }
          

             $sizeArray=sizeof($code); 

              include("mpdf/mpdf.php");

              $html1= '
              <html>
              <head>
              <style>
              body {font-family: sans-serif;
                  font-size: 9pt;
                  background: transparent url(\'bgbarcode.png\') repeat-y scroll left top;
              }
              h5, p { margin: 0pt;
              }
              table.items {
                  font-size: 9pt; 
                  border-collapse: collapse;
                  border: 3px solid #880000; 
              }
              td { vertical-align: top; 
              }
              table thead td { background-color: #EEEEEE;
                  text-align: center;
              }
              table tfoot td { background-color: #AAFFEE;
                  text-align: center;
              }
              .barcode {
                  padding: 1.5mm;
                  margin: 0;
                  vertical-align: top;
                  color: #000000;
              }
              .barcodecell {
                  text-align: center;
                  vertical-align: middle;
                  padding: 0;
              }
              </style>
              </head>
              <body>
              <!--mpdf
              <htmlpagefooter name="myfooter">
              <div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
              Page {PAGENO} of {nb}
              </div>
              </htmlpagefooter>
              <sethtmlpagefooter name="myfooter" value="on" />
              <h1>Generate Barcode </h1>


              <table class="items" width="100%" cellpadding="8" border="1">
              <thead>
              <tr>
              <td width="40%">Barcode NO</td>
              <td>Item Name</td>
              <td>Barcode NO</td>
              </tr>
              </thead>
              <tbody>
              ';


              foreach ($code as $row) 
              {

              //var_dump($itemId);
              $itemIdValue=array_shift ($itemId);
              $itemName=$this->db->query("select * from lib_item where ITEM_ID=".$itemIdValue)->row();
            // var_dump($itemName);  die();
            // $itemNameITEM_NAME
               
              $html2.='<tr>
              <td class="barcodecell">
              <barcode code="'.$row.'"  text="1" class="barcode" type="C39"/>
              <p>'. $row .'</p>
              </td>
              <td> '. $itemName->ITEM_NAME .' </td>
              <td class="barcodecell">
              <barcode code="'.$row.'"  text="1" class="barcode" type="C39"/>
              <p>'. $row .'</p>
              </td>
              </tr>';

              }


              $html3='
              </tbody>
              </table>
              <br/>
              <div>

              </div>

              <div>

              </div>

              </body>
              </html>
              ';
              $html=$html1.' '.$html2.' '.$html3;

              //==============================================================
              //==============================================================
              //include("../mpdf.php)";
              $mpdf=new mPDF('','','','',20,15,25,25,10,10); 
              $mpdf->WriteHTML($html);
              $mpdf->Output();
               exit;
                              
              }

      
     
        $this->session->set_flashdata('Success', 'Successfully Inserted');
        redirect('library/listStock');
    
    }

    /*
    * @methodName listStock
    * @access
    * @param  none
    * @author Abu Nawim <nawim@atilimited.net>
    * @return 
    */


    public function listStock (){

     $data['contentTitle'] = 'Item List';
            $data['breadcrumbs'] = array(
              'Admin' => '#',
              'Item List' => '#',
              );
            $data["previlages"] = $this->checkPrevilege();
            $data['stock_item_list'] = $this->library_model->stockItemList(); 
            $data['content_view_page'] = 'admin/libray/stock_list';

           // var_dump($data); die();
            $this->admin_template->display($data);
      }



      /**
     * @methodName deleteMasterRow()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

    function deleteItemReceive()
    {
        $m_id = $this->input->post('m_id');
        $this->db->query("DELETE FROM lib_item_receive WHERE LIB_ITEM_NUMBER = $m_id");
        echo "Y";
    }



    /*
    * @methodName applicationForLibraryMember
    * @access
    * @param  none
    * @author Abu Nawim <nawim@atilimited.net>
    * @return 
    */

    public function applicationForLibraryMember() {
        $data['contentTitle'] = 'Library Member List';
        $data['breadcrumbs'] = array(
          'Admin' => '#',
          'Item List' => '#',
          );
        $data["previlages"] = $this->checkPrevilege();
        $data['libray_member'] = $this->library_model->libraryMember(); 


        $data['content_view_page'] = 'admin/libray/libary_member_list';

        //var_dump($data); die();
        $this->admin_template->display($data);
    }


    /*
    * @methodName libraryMemberModel
    * @access
    * @param  none
    * @author Abu Nawim <nawim@atilimited.net>
    * @return 
    */


    public function libraryMemberModel()
    {
      $MEBBER_ID = $_POST['MEBBER_ID'];
      $data['MEBBER_ID'] = $MEBBER_ID;

      $data['student_details'] = $this->student_model->getStudentInfoAll($MEBBER_ID);
      $data['local_present_adddress'] = $this->student_model->getLocalPresentAddress($MEBBER_ID);
      $data['local_permanent_adddress'] = $this->student_model->getLocalPermanentAddress($MEBBER_ID); 
      echo $this->load->view('admin/libray/library_member_details_model_view', $data, true);
    }

    /*
    * @methodName libraryMemberUpdate
    * @access
    * @param  none
    * @author Abu Nawim <nawim@atilimited.net>
    * @return 
    */

    public function libraryMemberUpdate(){

       $MEBBER_ID = $this->uri->segment(3);
       $data['contentTitle'] = 'Library Member Update';
        $data['breadcrumbs'] = array(
            'Library ' => '#',
            'Member Update' => '#',
        );

        $data["previlages"] = $this->checkPrevilege();

       $data['library_member_info'] = $this->utilities->findAllByAttribute('lib_members', array('MEBBER_ID' => $MEBBER_ID));
        $data['content_view_page'] = 'admin/libray/libary_member_update';
        $this->admin_template->display($data);

    }



    /*
    * @methodName libraryMemberUpdateSave
    * @access
    * @param  none
    * @author Abu Nawim <nawim@atilimited.net>
    * @return 
    */

    public function libraryMemberUpdateSave(){


        $MEBBER_ID=$this->input->post('MEBBER_ID');
         
        $library_member_info = array(                
          'MEMBER_NO' => $this->input->post('MEMBER_NO'),
          'ACTIVE_STATUS' => $this->input->post('ACTIVE_STATUS'),
          //'START_DT' => date('Y-m-d',strtotime($this->input->post('START_DT')))
          'START_DT' => date('Y-m-d')
  
          );

       $this->utilities->updateData('lib_members', $library_member_info, array('MEBBER_ID' => $MEBBER_ID));


        $data['contentTitle'] = 'Library Member List';
        $data['breadcrumbs'] = array(
          'Admin' => '#',
          'Item List' => '#',
          );
        $data["previlages"] = $this->checkPrevilege();
        $data['libray_member'] = $this->library_model->libraryMember(); 


        $data['content_view_page'] = 'admin/libray/libary_member_list';

        //var_dump($data); die();
        $this->admin_template->display($data);

    }



    /*
    * @methodName libraryMemberPrint
    * @access
    * @param  none
    * @author Abu Nawim <nawim@atilimited.net>
    * @return 
    */

    public function libraryMemberPrint(){

       $MEBBER_ID = $this->uri->segment(3);
       $data['contentTitle'] = 'Library Member Update';
        $data['breadcrumbs'] = array(
            'Library ' => '#',
            'Member Update' => '#',
        );

        $data["previlages"] = $this->checkPrevilege();

        $data['student_details'] = $this->student_model->getStudentInfoAll($MEBBER_ID);
        $data['local_present_adddress'] = $this->student_model->getLocalPresentAddress($MEBBER_ID);
        $data['local_permanent_adddress'] = $this->student_model->getLocalPermanentAddress($MEBBER_ID); 
        $data['library_policy']=$this->utilities->findAllByAttribute('m00_lkpdata',array('GRP_ID'=>83));
        $data['library_member_info'] = $this->library_model->findAllByAttributeLibrary('lib_members', array('MEBBER_ID' => $MEBBER_ID));
       
        $data['content_view_page'] = 'admin/libray/libary_member_print';

       //var_dump($data); 
        $this->admin_template->display($data);

    }

    /*
    * @methodName libraryMemberPdf
    * @access
    * @param  none
    * @author Abu Nawim <nawim@atilimited.net>
    * @return 
    */


    function libraryMemberPdf()
    {

      
      $STUDENT_ID=$this->input->post('STUDENT_ID');
      var_dump($STUDENT_ID);
      $data['pageTitle'] = 'Print PDF';      
      $data['emp_info'] = $this->employee_model->findEmpById($STUDENT_ID);

      $data['student_details'] = $this->student_model->getStudentInfoAll($STUDENT_ID);
      $data['local_present_adddress'] = $this->student_model->getLocalPresentAddress($STUDENT_ID);
      $data['local_permanent_adddress'] = $this->student_model->getLocalPermanentAddress($STUDENT_ID); 
      $data['library_policy']=$this->utilities->findAllByAttribute('m00_lkpdata',array('GRP_ID'=>83));
      $data['library_member_info'] = $this->library_model->findAllByAttributeLibrary('lib_members', array('MEBBER_ID' => $STUDENT_ID));
      include('mpdf/mpdf.php');
      $mpdf = new mPDF();
      $mpdf->SetTitle('Employee Information');
      $mpdf->mirrorMargins = 1;
      $mpdf->useOnlyCoreFonts = true;
      $report = $this->load->view('admin/libray/library_member_pdf', $data, TRUE);
        //$footer = $this->load->view('admin/emp/emp_list_info_footer', $data, TRUE);
      $mpdf->WriteHTML("$report");
      $mpdf->SetHTMLFooter("$footer");
      $mpdf->Output();
      exit;
    }



    /*
    * @methodName libraryBookBorrow
    * @access
    * @param  none
    * @author Abu Nawim <nawim@atilimited.net>
    * @return 
    */

    public function libraryBookBorrow(){

       $data['contentTitle'] = 'Library Book Borrow';
        $data['breadcrumbs'] = array(
            'Library ' => '#',
            'Book Borrow' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
       $data['content_view_page'] = 'admin/libray/add_borrow_item';

        $this->admin_template->display($data);

    }


    /*
    * @methodName libraryMemberDetails
    * @access
    * @param  none
    * @author Abu Nawim <nawim@atilimited.net>
    * @return 
    */

    public function libraryMemberDetails(){

      $memberId=$_POST['singleValues'];
 
      $libraryMemberInfo=$this->library_model->singleLibraryMemberDetails($memberId);
     // var_dump($libraryMemberInfo); die();
      if ($libraryMemberInfo) {
        
           $member='<div class="ibox-content">
            <div class="table-responsive contentArea">
                <table class="table table-striped table-bordered table-hover gridTable">

                    <tbody>
                        <tr>
                            <th>Student Library Member No</th>
                            <td>:</td>
                            <td>';  $member .= $libraryMemberInfo->MEMBER_NO;
                            $member .='</td>
                        </tr>
                        <tr>
                            <th>Student NAME</th>
                            <td>:</td>
                            <td>';  $member .= $libraryMemberInfo->FULL_NAME_EN;
                            $member .='</td>
                        </tr>
                  
                        <tr>
                            <th>DEPARTMENT</th>
                            <td>:</td>
                            <td>';  $member .= $libraryMemberInfo->DEPT_NAME;
                            $member .='</td>

                        </tr>
                    </tbody>
                </table>
            </div>
         </div>';
         echo $member;
        }

    else{

        echo "<script> alert('Please Entry Valid Value '); </script>";

        } 

  }




  /*
    * @methodName libraryItemDetails
    * @access
    * @param  none
    * @author Abu Nawim <nawim@atilimited.net>
    * @return 
    */

    public function libraryItemDetails(){

      $itemId=$_POST['stockID'];
     // var_dump($itemId); 
      $libraryItemInfo=$this->library_model->singleLibraryItemDetails($itemId);
     // var_dump($libraryMemberInfo);  die();

      if ($libraryItemInfo) {

               $item='<div class="ibox-content">
                <div class="table-responsive contentArea">
                    <table class="table table-striped table-bordered table-hover gridTable">

                        <tbody>
                            <tr>
                                <th> Library Item No</th>
                                <td>:</td>
                                <td>';  $item .= $libraryItemInfo->SKU;
                                $item .='</td>
                            </tr>
                            <tr>
                                <th>Item NAME</th>
                                <td>:</td>
                                <td>';  $item .= $libraryItemInfo->ITEM_NAME;
                                $item .='</td>
                            </tr>
                      
                            <tr>
                                <th>DEPARTMENT</th>
                                <td>:</td>
                                <td>';  $item .= $libraryItemInfo->LKP_NAME;
                                $item .='</td>

                            </tr>
                        </tbody>
                    </table>
                </div>
             </div>';
             echo $item;
            }
        else{
            echo "<script> alert('Please Entry Valid Value '); </script>";
            } 

    }


    /*
    * @methodName libraryAddBookBorrow
    * @access
    * @param  none
    * @author Abu Nawim <nawim@atilimited.net>
    * @return 
    */

    public function libraryAddBookBorrow(){

      $MEMBER_ID=$this->input->post('MEMBER_ID');
      $STOCK_ID=$this->input->post('STOCK_ID');
      $BORROW_DT=date('Y-m-d');

      $checkItemAvaliable=$this->db->query("select * from lib_borrowers where  ACTIVE_STATUS = 1 && STOCK_ID = $STOCK_ID")->result();

      $numberOfItem=sizeof($checkItemAvaliable);

     // var_dump($numberOfItem); 

      if ($numberOfItem==0) {
       
    

    
      $MEMBER_TYPE_DATA=$this->db->query("select MEMBER_TYPE from lib_members where MEMBER_NO =$MEMBER_ID")->row();

      $MEMBER_TYPE = $MEMBER_TYPE_DATA->MEMBER_TYPE;
      $STOCK_ID_DATA=$this->db->query("select ITEM_ID from lib_stock where SKU =$STOCK_ID")->row();
      //var_dump($STOCK_ID_DATA); die();
      $ITEM_ID = $STOCK_ID_DATA->ITEM_ID;
      $RETURN_DT = date('Y-m-d', strtotime("+7 day", strtotime($BORROW_DT)));

       $borrowData= array(
        'MEMBER_ID'=>$MEMBER_ID,
        'MEMBER_TYPE'=>$MEMBER_TYPE,
        'STOCK_ID'=>$STOCK_ID,
        'ITEM_ID'=>$ITEM_ID,
        'BORROW_DT'=>$BORROW_DT,
        'RETURN_DT'=>$RETURN_DT,
        );

       
      $itemInfoResult= $this->library_model->insert('lib_borrowers', $borrowData);

      $data['contentTitle'] = 'Library Book Borrow';
      $data['breadcrumbs'] = array(
          'Library ' => '#',
          'Book Borrow' => '#',
      );
      $data["previlages"] = $this->checkPrevilege();
      $data['content_view_page'] = 'admin/libray/add_borrow_item';
      $this->admin_template->display($data);
      }
      else{
          $this->session->set_flashdata('Error', 'This Item Not Avaliable');
          redirect('library/libraryBookBorrow'); 
         }
   }

    /*
    * @methodName libraryBookBorrowList
    * @access
    * @param  none
    * @author Abu Nawim <nawim@atilimited.net>
    * @return 
    */

    public function libraryBookBorrowList() {
        $data['contentTitle'] = 'Library Book Borrow List';
        $data['breadcrumbs'] = array(
          'Admin' => '#',
          'Book Borrow List' => '#',
          );
        $data["previlages"] = $this->checkPrevilege();
        $data['libray_member'] = $this->library_model->libraryMember(); 
        $data['content_view_page'] = 'admin/libray/libary_member_list';

        //var_dump($data); die();
        $this->admin_template->display($data);
    }

    /*
    * @methodName libraryBookListBarcode
    * @access
    * @param  none
    * @author Abu Nawim <nawim@atilimited.net>
    * @return 
    */

    public function libraryBookListBarcode() {
        $data['contentTitle'] = 'Library All Item List';
        $data['breadcrumbs'] = array(
          'Admin' => '#',
          'All Item List' => '#',
          );
        $data["previlages"] = $this->checkPrevilege();
        $data['libray_all_stock_item'] = $this->library_model->libraryAllStock(); 

        $data['content_view_page'] = 'admin/libray/libary_all_item_list';

        $this->admin_template->display($data);
    }



    /*
    * @methodName borrowList
    * @access
    * @param  none
    * @author Abu Nawim <nawim@atilimited.net>
    * @return 
    */

    public function borrowList() {
        $data['contentTitle'] = 'Library All Item Borrow List';
        $data['breadcrumbs'] = array(
          'Admin' => '#',
          'All Item Borrow List' => '#',
          );
        $data["previlages"] = $this->checkPrevilege();
        $data['libray_all_borrow_item'] = $this->library_model->libraryBorrowList(); 
       // var_dump($data['libray_all_borrow_item']);   
        $data['content_view_page'] = 'admin/libray/borrow_item_list';

        $this->admin_template->display($data);
    }


    /*
    * @methodName libraryBorrowModel
    * @access
    * @param  none
    * @author Abu Nawim <nawim@atilimited.net>
    * @return 
    */

    public function libraryBorrowModel()
    {
      $itemUniqueId = $_POST['itemUniqueId'];
      $data['librarySingleBorrowInfo'] = $this->library_model->libraryBorrowSingleList($itemUniqueId);     
      echo $this->load->view('admin/libray/library_borrow_details_model_view', $data, true);
    }



    /*
    * @methodName libraryItemBorrowUpdate
    * @access
    * @param  none
    * @author Abu Nawim <nawim@atilimited.net>
    * @return 
    */

    public function libraryItemBorrowUpdate(){

       $itemId = $this->uri->segment(3);
       $data['contentTitle'] = 'Library Item Borrow Update';
       $data['breadcrumbs'] = array(
            'Library ' => '#',
            'Member Update' => '#',
        );

       $data["previlages"] = $this->checkPrevilege();
       $data['library_member_info'] = $this->library_model->libraryBorrowSingleList($itemId);
       $data['content_view_page'] = 'admin/libray/libary_item_borrow_update';
        $this->admin_template->display($data);

    }


    /*
    * @methodName libraryItemUpdateSave
    * @access
    * @param  none
    * @author Abu Nawim <nawim@atilimited.net>
    * @return 
    */

    public function libraryItemUpdateSave(){

 
       $itemBorrowId=$this->input->post('itemBorrowId');
       $ACTIVE_STATUS=$this->input->post('ACTIVE_STATUS');
       $RETURN_RECIVE_DT =date("Y/m/d");

       $dataItemBorrowUpdate = array(
        'RETURN_RECIVE_DT' => $ACTIVE_STATUS, 
        'ACTIVE_STATUS' => $RETURN_RECIVE_DT
        );

       $data['contentTitle'] = 'Library Item Borrow Update';
        $data['breadcrumbs'] = array(
            'Library ' => '#',
            'Member Update' => '#',
        );

        $data["previlages"] = $this->checkPrevilege();

      // $data['library_member_info'] = $this->utilities->findAllByAttribute('lib_members', array('MEBBER_ID' => $MEBBER_ID));
        $this->db->update('lib_borrowers', $dataItemBorrowUpdate); die();
        //$data['content_view_page'] = 'admin/libray/libary_member_update';
        $this->admin_template->display($data);

    }


        /*
    * @methodName libraryItemUpdateSave
    * @access
    * @param  none
    * @author Abu Nawim <nawim@atilimited.net>
    * @return 
    */

    public function libraryItemBorrowReturn(){

       $data['contentTitle'] = 'Library Item Borrow Return';
       $data['breadcrumbs'] = array(
            'Library ' => '#',
            'Member Update' => '#',
        );
        $data["previlages"] = $this->checkPrevilege();
        $data['content_view_page'] = 'admin/libray/library_item_borrow_return';
        $this->admin_template->display($data);

    }




  /*
    * @methodName libraryItemBorrowDetails
    * @access
    * @param  none
    * @author Abu Nawim <nawim@atilimited.net>
    * @return 
    */

    public function libraryItemBorrowDetails(){

      $itemId=$_POST['stockID'];
      //var_dump($itemId);  die();
      $libraryItemBorrowInfo=$this->library_model->libraryItemBorrwDetails($itemId);
      //var_dump($libraryItemBorrowInfo); 
      if ($libraryItemBorrowInfo) {
        
       $item='<div class="ibox-content">
        <div class="table-responsive contentArea">
            <table class="table table-striped table-bordered table-hover gridTable">

                <tbody>
                    <tr>
                        <th> Library Item No</th>
                        <td>:</td>
                        <td>';  $item .= $libraryItemBorrowInfo->SKU;
                        $item .='</td>
                    </tr>
                    <tr>
                        <th>Item NAME</th>
                        <td>:</td>
                        <td>';  $item .= $libraryItemBorrowInfo->ITEM_NAME;
                        $item .='</td>
                    </tr>
              
                    <tr>
                        <th>Item DEPARTMENT</th>
                        <td>:</td>
                        <td>';  $item .= $libraryItemBorrowInfo->LKP_NAME;
                        $item .='</td>

                    </tr>

                    <tr>
                        <th> Student Library No</th>
                        <td>:</td>
                        <td>';  $item .= $libraryItemBorrowInfo->MEMBER_ID;
                        $item .='</td>
                    </tr>
                    <tr>
                        <th>Student NAME</th>
                        <td>:</td>
                        <td>';  $item .= $libraryItemBorrowInfo->FULL_NAME_EN;
                        $item .='</td>
                    </tr>
              
                    <tr>
                        <th>Student DEPARTMENT</th>
                        <td>:</td>
                        <td>';  $item .= $libraryItemBorrowInfo->DEPT_NAME;
                        $item .='</td>

                    </tr>
                     <tr>
                        <th>Student Mobile</th>
                        <td>:</td>
                        <td>';  $item .= $libraryItemBorrowInfo->MOBILE_NO;
                        $item .='</td>

                    </tr>
                </tbody>
            </table>
        </div>
     </div>';
     echo $item;

      }

    else{

        echo "<script> alert('Please Entry Valid Value '); </script>";

        } 

    }

    /*
    * @methodName libraryItemBorrowReturen
    * @access
    * @param  none
    * @author Abu Nawim <nawim@atilimited.net>
    * @return 
    */

    public function libraryItemBorrowReturen(){
      
      $STOCK_ID=$this->input->post('STOCK_ID');
      $ACTIVE_STATUS=$this->input->post('ACTIVE_STATUS');
      $RETURN_RECIVE_DT = date('Y-m-d');
 
     $borrowData= array(
      'ACTIVE_STATUS'=>0,
      'RETURN_RECIVE_DT'=>$RETURN_RECIVE_DT
      );

      $this->db->where('STOCK_ID', $STOCK_ID);
      $this->db->update('lib_borrowers', $borrowData);
       
      redirect('library/borrowList');

   }



    /*
    * @methodName libraryItemHistory
    * @access
    * @param  none
    * @author Abu Nawim <nawim@atilimited.net>
    * @return 
    */

    public function libraryItemHistory(){

      $skuCode=$this->input->post('skuCode');


      $data['libraryItemDetailsInfo'] = $this->library_model->libraryItemHistory($skuCode);
      $data['dataItemHistoryStudent'] = $this->library_model->libraryItemHistoryStudent($skuCode);
     // var_dump($data['dataItemHistoryStudent']); die();

      
      //$data['local_present_adddress'] = $this->student_model->getLocalPresentAddress($MEBBER_ID);
      //$data['local_permanent_adddress'] = $this->student_model->getLocalPermanentAddress($MEBBER_ID); 
      echo $this->load->view('admin/libray/library_item_history', $data, true);
   
   }


    /*
    * @methodName listStockCurrent
    * @access
    * @param  none
    * @author Abu Nawim <nawim@atilimited.net>
    * @return 
    */


    public function listStockCurrent (){

     $data['contentTitle'] = 'Item List';
            $data['breadcrumbs'] = array(
              'Admin' => '#',
              'Item List' => '#',
              );
            $data["previlages"] = $this->checkPrevilege();
            $data['stock_item_list'] = $this->library_model->currentStockItemStatus();
            //var_dump($data['stock_item_list']); die();
           //$data['datalibraryBorrowItemWise'] = $this->library_model->libraryBorrowItemWise();
           // var_dump($data); die();
            $data['content_view_page'] = 'admin/libray/library_current_stock_summery.php';

           // var_dump($data); die();
            $this->admin_template->display($data);
      }



  /*
  * @methodName libraryMemberApplicationTeacher
  * @access
  * @param  none
  * @author Abu Nawim <nawim@atilimited.net>
  * @return 
  */

    function libraryMemberApplicationTeacher(){/*
      var_dump($_SESSION['logged_in'][]->EMP_ID);       
      //$test2=$_SESSION['EMP_ID'];

      echo "<script>console.log($_SESSION);</script>";
      //echo $test2; 
      //echo $logged_in['EMP_ID'];
        die();
        $data['contentTitle'] = 'Library Member Application';
        $data['breadcrumbs'] = array(
            'Member' => '#',
            'Applicattion' => '#',
        );  
        $student_id = $this->STUDENT_ID;

        $data['student_details'] = $this->student_model->getStudentInfoAll($student_id);
        $data['local_present_adddress'] = $this->student_model->getLocalPresentAddress($student_id);
        $data['local_permanent_adddress'] = $this->student_model->getLocalPermanentAddress($student_id);
        $studentId=$data['student_details']->STUDENT_ID;
        
         $checkLiberyMemeber=$this->db->query('select ACTIVE_STATUS from lib_members where MEBBER_ID ='.$studentId);
         $avaliable= $this->db->affected_rows($checkLiberyMemeber);

        if($avaliable<1){     
        $data['content_view_page'] = 'student/library/apply_library_member';
        }
        else{

           $data['member']=$this->student_model->checkLibraryMember($data['student_details']->STUDENT_ID);
           $data['content_view_page'] = 'student/library/library_member_available';

        }
        $this->student_portal->display($data);
    
    */}




    /*
    * @methodName allItemInformation
    * @access
    * @param  none
    * @author Abu Nawim <nawim@atilimited.net>
    * @return 
    */

/*    public function allItemInformation(){

        $arrayName = array(
          'a' => '10',
          'b' => '20',
          'c' => '30' );

     //var_dump($arrayName);
        $jasontest=json_encode($arrayName);
        //var_dump($jasontest);
echo "string";
        return $jasontest;
    }*/



}
