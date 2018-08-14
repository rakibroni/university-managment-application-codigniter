<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @category   FrontInventory
 * @package    Inventory
 * @author     Md. Reazul Islam <reazul@atilimited.net>
 * @copyright  2017 ATI Limited Development Group
 */
class Inventory extends CI_Controller
{

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
        $this->load->model('prefix_invertory_model');
    }


    /**
     * @methodName checkPrevilege()
     * @access 
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed View
     */
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
     * @methodName unit()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */
    function unit()
    {
        $data['contentTitle'] = 'Inventory';
        $data['breadcrumbs'] = array(
            'Unit' => '#',
            'Unit List' => '#',
            );
        $data["previlages"] = $this->checkPrevilege();
        $data['unit'] = $this->utilities->findAllFromView('inv_unit'); // select all data from unit
        $data['content_view_page'] = 'inventory/unit/unit_index';
        $this->admin_template->display($data);
    }

    /**
     * @methodName addUnit()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

    function unitFormInsert()
    {
        $data["ac_type"] = 1;
        $this->load->view('inventory/unit/add_unit', $data);
    }

      /**
     * @methodName getUnit()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */


      function unitList()
      {
        $data["previlages"] = $this->checkPrevilege("Inventory/unit");
        $data['unit'] = $this->utilities->findAllFromView('inv_unit'); // select all data from unit
        $this->load->view("inventory/unit/unit_list", $data);
    }

    /**
     * @methodName createUnit()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */


    function createUnit()
    {
        $unitName = $this->input->post('unitName'); // unit name
        $description = $this->input->post('description'); // description
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if Degree with this name is already exist
        $check = $this->utilities->hasInformationByThisId("inv_unit", array("UNIT_NAME" => $unitName));
        if (empty($check)) {// if unit name available
            // preparing data to insert
            $unit = array(
                'UNIT_NAME' => $unitName,
                'DESC' => $description,
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
                );
            if ($this->utilities->insertData($unit, 'inv_unit')) { // if data inserted successfully
                echo "<div class='alert alert-success'>Unit Create successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Unit Name insert failed</div>";
            }
        } else {// if degree name not available
            echo "<div class='alert alert-danger'>Unit Name Already Exist</div>";
        }
    }

      /**
     * @methodName unitFormUpdate()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */


      function unitFormUpdate()
      {
        $data["ac_type"] = 2;
        $id = $this->input->post('param'); // unit ID
        $data['unit'] = $this->utilities->findByAttribute('inv_unit', array('UNIT_ID' => $id)); // select all data from degree where degree id
        $this->load->view('inventory/unit/add_unit', $data);
    }

    /**
     * @methodName updateUnit()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

    function updateUnit()
    {
//        echo "<pre>";
//        print_r($_POST);
//        exit;
        $unit_id = $this->input->post('txtUnitId'); // unit id
        $unitName = $this->input->post('unitName'); // unit name
        $description = $this->input->post('description'); // description
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if unit with this name is already exist
        $check = $this->utilities->hasInformationByThisId("inv_unit", array("UNIT_NAME" => $unitName, "UNIT_ID !=" => $unit_id));

        if (empty($check)) {// if unit name available
            // preparing data to insert
            $unit = array(
                'UNIT_NAME' => $unitName,
                'DESC' => $description,
                'ACTIVE_STATUS' => $status,
                'UPDATED_BY' => $this->user["USER_ID"]
                );
            //var_dump($unit); exit();
            if ($this->utilities->updateData('inv_unit', $unit, array('UNIT_ID' => $unit_id))) { // if data update successfully
                echo "<div class='alert alert-success'>Unit Update successfully</div>";
            } else { // if data update failed
                echo "<div class='alert alert-danger'>Unit Name Update failed</div>";
            }
        } else {// if unit name not available
            echo "<div class='alert alert-danger'>Unit Name Already Exist</div>";
        }
    }

     /**
     * @methodName unitById()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

     function unitById()
     {
        $unit_id = $this->input->post('param'); // unit name
        $data["previlages"] = $this->checkPrevilege("inventory/unit");
        $data['row'] = $this->utilities->findByAttribute('inv_unit', array('UNIT_ID' => $unit_id)); // select all data from unit where unit id
        $this->load->view('inventory/unit/single_unit_row', $data);
    }

     /**
     * @methodName supplier()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

     function supplier()
     {
        $data['contentTitle'] = 'Inventory';
        $data['breadcrumbs'] = array(
            'Supplier' => '#',
            'Supplier List' => '#',
            );
        $data["previlages"] = $this->checkPrevilege();
        $data['supplier'] = $this->utilities->findAllFromView('inv_supplier'); // select all data from supplier
        $data['content_view_page'] = 'inventory/supplier/supplier_index';
        $this->admin_template->display($data);
    }

    /**
     * @methodName supplierFormInsert()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

    function supplierFormInsert()
    {
        $data["ac_type"] = 1;
        $this->load->view('inventory/supplier/add_supplier', $data);
    }

    /**
     * @methodName supplierList()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

    function supplierList()
    {
        $data["previlages"] = $this->checkPrevilege("Inventory/unit");
        $data['supplier'] = $this->utilities->findAllFromView('inv_supplier'); // select all data from supplier
        $this->load->view("inventory/supplier/supplier_list", $data);
    }

    /**
     * @methodName createSupplier()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

    function createSupplier()
    {
        $supplierNameEng = $this->input->post('supplierNameEng'); // supplier name
        $supplierNameBn = $this->input->post('supplierNameBn'); // supplier name bangla
        $shortName = $this->input->post('shortName'); // supplier name english
        $email = $this->input->post('email'); // email
        $mobileNo = $this->input->post('mobileNo'); // supplier mobile number
        $nationality = $this->input->post('nationality'); // nationality
        $nationalId = $this->input->post('nationalId'); // national id
        $passportNo = $this->input->post('passportNo'); // passport number
        $businessType = $this->input->post('businessType'); // business type
        $organizationName = $this->input->post('organizationName'); // organization name
        $organizationEmail = $this->input->post('organizationEmail'); // organization name
        $organizationMobile = $this->input->post('organizationMobile'); // supplier organization mobile
        $organizationWeb = $this->input->post('organizationWeb'); // organization website
        $organizationAddress = $this->input->post('organizationAddress'); // supplier organization assress
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if Degree with this name is already exist
        $check = $this->utilities->hasInformationByThisId("inv_supplier", array("FULL_ENAME" => $supplierNameEng));
        if (empty($check)) {// if unit name available
            // preparing data to insert
            $supplier = array(
                'FULL_ENAME' => $supplierNameEng,
                'FULL_BNAME' => $supplierNameBn,
                'SHORT_NAME' => $shortName,
                'EMAIL' => $email,
                'MOBILE' => $mobileNo,
                'NATIONALITY' => $nationality,
                'NATIONAL_ID' => $nationalId,
                'PASSPORT_NO' => $passportNo,
                'BUSINESS_TYPE' => $businessType,
                'ORG_NAME' => $organizationName,
                'ORG_EMAIL' => $organizationEmail,
                'ORG_MOBILE' => $organizationMobile,
                'ORG_WEB' => $organizationWeb,
                'ORG_ADDRESS' => $organizationAddress,
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
                );
            if ($this->utilities->insertData($supplier, 'inv_supplier')) { // if data inserted successfully
                echo "<div class='alert alert-success'>Supplier Create successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Supplier Name insert failed</div>";
            }
        } else {// if degree name not available
            echo "<div class='alert alert-danger'>Supplier Name Already Exist</div>";
        }
    }

    /**
     * @methodName supplierFormUpdate()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

    function supplierFormUpdate()
    {
        $data["ac_type"] = 2;
        $id = $this->input->post('param'); // degree ID
        $data['supplier'] = $this->utilities->findByAttribute('inv_supplier', array('SUPPLIER_ID' => $id)); // select all data from degree where degree id
        $this->load->view('inventory/supplier/add_supplier', $data);
    }

    /**
     * @methodName updateSupplier()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

    function updateSupplier()
    {
//        echo "<pre>";
//        print_r($_POST);
//        exit;
        $supplier_id = $this->input->post('txtSupplierId'); // supplier id
        $supplierNameEng = $this->input->post('supplierNameEng'); // supplier name
        $supplierNameBn = $this->input->post('supplierNameBn'); // supplier name bangla
        $shortName = $this->input->post('shortName'); // supplier name english
        $email = $this->input->post('email'); // email
        $mobileNo = $this->input->post('mobileNo'); // supplier mobile number
        $nationality = $this->input->post('nationality'); // nationality
        $nationalId = $this->input->post('nationalId'); // national id
        $passportNo = $this->input->post('passportNo'); // passport number
        $businessType = $this->input->post('businessType'); // business type
        $organizationName = $this->input->post('organizationName'); // organization name
        $organizationEmail = $this->input->post('organizationEmail'); // organization name
        $organizationMobile = $this->input->post('organizationMobile'); // supplier organization mobile
        $organizationWeb = $this->input->post('organizationWeb'); // organization website
        $organizationAddress = $this->input->post('organizationAddress'); // supplier organization assress
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if Degree with this name is already exist
        $check = $this->utilities->hasInformationByThisId("inv_supplier", array("FULL_ENAME" => $supplierNameEng, "SUPPLIER_ID !=" => $supplier_id));

        if (empty($check)) {// if supplier name available
            // preparing data to insert
            $supplier = array(
                'FULL_ENAME' => $supplierNameEng,
                'FULL_BNAME' => $supplierNameBn,
                'SHORT_NAME' => $shortName,
                'EMAIL' => $email,
                'MOBILE' => $mobileNo,
                'NATIONALITY' => $nationality,
                'NATIONAL_ID' => $nationalId,
                'PASSPORT_NO' => $passportNo,
                'BUSINESS_TYPE' => $businessType,
                'ORG_NAME' => $organizationName,
                'ORG_EMAIL' => $organizationEmail,
                'ORG_MOBILE' => $organizationMobile,
                'ORG_WEB' => $organizationWeb,
                'ORG_ADDRESS' => $organizationAddress,
                'ACTIVE_STATUS' => $status,
                'UPDATED_BY' => $this->user["USER_ID"]
                );
            //var_dump($supplier); exit();
            if ($this->utilities->updateData('inv_supplier', $supplier, array('SUPPLIER_ID' => $supplier_id))) { // if data update successfully
                echo "<div class='alert alert-success'>Supplier Update successfully</div>";
            } else { // if data update failed
                echo "<div class='alert alert-danger'>Supplier Name Update failed</div>";
            }
        } else {// if degree name not available
            echo "<div class='alert alert-danger'>Supplier Name Already Exist</div>";
        }
    }

    /**
     * @methodName supplierById()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */


    function supplierById()
    {
        $supplier_id = $this->input->post('param'); // supplier name
        $data["previlages"] = $this->checkPrevilege("inventory/unit");
        $data['row'] = $this->utilities->findByAttribute('inv_supplier', array('SUPPLIER_ID' => $supplier_id)); // select all data from supplier where supplier id
        $this->load->view('inventory/supplier/single_supplier_row', $data);
    }

    /**
     * @methodName item()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @Modify Nurullah <nurul@atilimited.net>
     * @return Mixed Template
     */


    function item()
    {
        $data['contentTitle'] = 'Inventory';
        $data['breadcrumbs'] = array(
            'Item' => '#',
            'Item List' => '#',
            );
        $data["previlages"] = $this->checkPrevilege();
        $data['item_info'] = $this->utilities->findAllByAttribute("inv_item", array("PARENT_ITEM_ID" => 0));
        $data['content_view_page'] = 'inventory/item/item_index';
        $this->admin_template->display($data);
    }

     /**
     * @methodName itemFormInsert()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @Modify Nurullah <nurul@atilimited.net>
     * @return Mixed Template
     */

     function itemFormInsert()
     {
        $data["ac_type"] = 1;
        $data['parent_id'] = $this->input->post('param');
        $data["unit"] = $this->utilities->findAllByAttribute("inv_unit", array("ACTIVE_STATUS" => 1));
        $this->load->view('inventory/item/add_item', $data);
    }

     /**
     * @methodName itemList()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @Modify Nurullah <nurul@atilimited.net>
     * @return Mixed Template
     */

     function itemList()
     {
        $data["previlages"] = $this->checkPrevilege("Inventory/unit");
        $data['item_info'] = $this->utilities->findAllByAttribute("inv_item", array("PARENT_ITEM_ID" => 0));
        $this->load->view("inventory/item/item_list", $data);
    }

    /**
     * @methodName createItem()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @Modify Nurullah <nurul@atilimited.net>
     * @return Mixed Template
     */

    function createItem()
    {
        $parent_id = $this->input->post('parent_id');
        $itemName = $this->input->post('ItemName'); // item name
        $code = $this->input->post('code'); // code
        $UNIT_ID = $this->input->post('UNIT_ID'); // unit name
        $description = $this->input->post('description'); // description
        $is_item = ((isset($_POST['is_item'])) ? 1 : 0); // Is Item
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if Item with this name is already exist
        $check = $this->utilities->hasInformationByThisId("inv_item", array("ITEM_NAME" => $itemName));
        if (empty($check)) {// if item name available
            // preparing data to insert
            $item = array(
                'PARENT_ITEM_ID' => $parent_id,
                'ITEM_NAME' => $itemName,
                'ITEM_CODE' => $code,
                'UNIT_ID' => $UNIT_ID,
                'DESC' => $description,
                'IS_ITEM' => $is_item,
                'ACTIVE_STATUS' => $status,
                'CREATED_BY' => $this->user["USER_ID"]
                );
            if ($this->utilities->insertData($item, 'inv_item')) { // if data inserted successfully
                echo "<div class='alert alert-success'>Item Create successfully</div>";
            } else { // if data inserted failed
                echo "<div class='alert alert-danger'>Item Name insert failed</div>";
            }
        } else {// if item name not available
            echo "<div class='alert alert-danger'>Item Name Already Exist</div>";
        }
    }

   /**
     * @methodName itemFormUpdate()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @Modify Nurullah <nurul@atilimited.net>
     * @return Mixed Template
     */

   function itemFormUpdate()
   {
    $data["ac_type"] = "edit";
        $item_id = $this->input->post('param'); // item ID
        $data["unit"] = $this->utilities->findAllByAttribute("inv_unit", array("ACTIVE_STATUS" => 1));
        $data["item_info"] = $this->utilities->findByAttribute("inv_item", array("ITEM_ID" => $item_id));
        $this->load->view('inventory/item/add_item', $data);
    }

    /**
     * @methodName updateItem()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @Modify Nurullah <nurul@atilimited.net>
     * @return Mixed Template
     */

    function updateItem()
    {
        $item_id = $this->input->post('txtitemId'); // item id
        $itemName = $this->input->post('ItemName'); // item name
        $code = $this->input->post('code'); // code
        $UNIT_ID = $this->input->post('UNIT_ID'); // unit name
        $description = $this->input->post('description'); // description
        $is_item = ((isset($_POST['is_item'])) ? 1 : 0); // Is Item
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if item with this name is already exist
        $check = $this->utilities->hasInformationByThisId("inv_item", array("ITEM_NAME" => $itemName, "ITEM_ID !=" => $item_id));

        if (empty($check)) {// if item name available
            // preparing data to insert
            $item = array(
                'ITEM_NAME' => $itemName,
                'ITEM_CODE' => $code,
                'UNIT_ID' => $UNIT_ID,
                'DESC' => $description,
                'IS_ITEM' => $is_item,
                'ACTIVE_STATUS' => $status,
                'UPDATED_BY' => $this->user["USER_ID"]
                );
            if ($this->utilities->updateData('inv_item', $item, array('ITEM_ID' => $item_id))) { // if data update successfully
                echo "<div class='alert alert-success'>Item Update successfully</div>";
            } else { // if data update failed
                echo "<div class='alert alert-danger'>Item Name Update failed</div>";
            }
        } else {// if unit name not available
            echo "<div class='alert alert-danger'>Item Name Already Exist</div>";
        }
    }

    /**
     * @methodName itemById()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @Modify Nurullah <nurul@atilimited.net>
     * @return Mixed Template
     */

    function itemById()
    {
        $item_id = $this->input->post('param'); // unit name
        $data["previlages"] = $this->checkPrevilege("inventory/unit");
        $data['row'] = $this->utilities->findAllByAttribute("inv_item", array("ITEM_ID" => $item_id));
        $this->load->view('inventory/item/single_item_row', $data);
    }

     /**
     * @methodName requisition()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

     function requisition()
     {

        $data['contentTitle'] = 'Inventory';
        $data['breadcrumbs'] = array(
            'Requisition' => '#',
            'Requisition List' => '#',
            );
        $user_id=$this->user["USER_ID"];
        $data["previlages"] = $this->checkPrevilege();
        $data['requisition_info'] = $this->inventory_model->getAllRequisitionSetupInfo($user_id); //
        $data['content_view_page'] = 'inventory/requisition/requisition_index';
        $this->admin_template->display($data);

    }

     /**
     * @methodName requisitionFormInsert()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */


     function requisitionFormInsert()
     {
        $data["ac_type"] = 1;
        $data['item_info'] = $this->inventory_model->getAllItemSetupInfo(); 
        $data["requisition_type"] = $this->utilities->findAllByAttribute("m00_lkpdata a", array("a.GRP_ID" => 80));
        $this->load->view('inventory/requisition/add_requisition_info', $data);
    }

/**
     
     * @access
     * @param  none
     * @author aminul<aminul@atilimited.net>
     * @return Mixed Template
     */


function createRequisition(){
    $re_no=$this->prefix_invertory_model->createRequisitionNo();
    $remarks=$this->input->post('REMARKS');
    $reqDate=$this->input->post('REQ_DT');
    $reqReceiveDate=$this->input->post('REQ_RECEIVE_DT');
    $ReqFor=$this->input->post('REQ_FOR');
    $reqType=$this->input->post('REQ_TYPE');
    $item = $this->input->post('ITEM_NAME');
    $requirement = $this->input->post('REQUIREMENT');
    $req_mst_data=array(
        'REQ_NO'=>$re_no,
        'REMARKS'=>$remarks,
        'REQ_DT'=>date('Y-m-d', strtotime($reqDate)),
        'REQ_RECEIVE_DT'=>date('Y-m-d', strtotime($reqReceiveDate)),
        'REQ_FOR'=>$ReqFor,
        'REQ_TYPE'=>$reqType,
        'CREATED_BY' => $this->user["USER_ID"]

        );
    $REQ_MST_ID=$this->utilities->insert('inv_requisition_mst',$req_mst_data);
    for ($i=0; $i < sizeof($item); $i++) { 
       $requisition_chd_data= array(
        'REQ_MST_ID' => $REQ_MST_ID,
        'ITEM_ID' => $item[$i],
        'REQUIREMENT_QTY' => $requirement[$i],
        'CREATED_BY' => $this->user["USER_ID"]
        );
       $this->utilities->insertData($requisition_chd_data, 'inv_requisition_chd');

   }
   redirect('inventory/requisition');
}




/**
* @this controller user for purchase order
* @param None
* @author aminul<aminul@atilimited.net>
*/

public function purchaseOrder(){
    $data["previlages"] = $this->checkPrevilege();
    $data['poLIst']=$this->inventory_model->getPurchaseOrderList();
    $data['content_view_page'] = 'inventory/purchaseOrder/purchase_order_index';
    $this->admin_template->display($data);
}
/**
* @this controller user for create new purchase order
* @param None
* @author aminul<aminul@atilimited.net>
*/
public function createPurchaseOrder(){
   $data["ac_type"] = 2;
   $data['item_info'] = $this->inventory_model->getAllItemSetupInfo(); 
   $data['supplier']=$this->inventory_model->getAllSupplier();
   $this->load->view('inventory/purchaseOrder/createPurchaseOrder',$data);

}
/**
* @this controller user for save new purchase order
* @param None
* @author aminul<aminul@atilimited.net>
*/

public function savePurchaseOrder(){ 
    $po_no=$this->prefix_invertory_model->createPurchaseOrderNo();
    $PO_DATE=$this->input->post('PO_DATE');
    $REMARKS=$this->input->post('REMARKS');
    $purOrderMaster=array(
        'PO_NO' => $po_no,
        'PO_DATE' => date('Y-m-d',strtotime($PO_DATE)),
        'CREATED_BY' => $this->user["USER_ID"],
        'ACTIVE_STATUS'=>1,
        'REMAREK'=>$this->input->post('REMARKS')
        );
    $this->db->insert('inv_po_mst', $purOrderMaster); 

    //insert details table      
    $ITEM_ID=$this->input->post('ITEM_ID');
    $ORDER_QTY=$this->input->post('ORDER_QTY');
    $SUPPLIER_ID=$this->input->post('SUPPLIER_ID');
    $maxid=$this->inventory_model->getPurchaseOrderMaxId();
    $MAX_PO=$maxid->MAX_PO;
    $countITEM_ID=count($this->input->post('ITEM_ID'));
    for($p=0; $p<$countITEM_ID; $p++){
        $purchaseorderDetails=array(
            'PO_MST_ID'=>$MAX_PO,
            'ITEM_ID'=>$ITEM_ID[$p],
            'ORDER_QTY'=>$ORDER_QTY[$p],
            'SUPPLIER_ID'=>$SUPPLIER_ID[$p],
            'CREATED_BY' => $this->user["USER_ID"],
            );
        $this->db->insert('inv_po_chd', $purchaseorderDetails); 
        $this->session->set_flashdata('Success', 'Successfully Inserted');

    }
    redirect('inventory/PurchaseOrder');
}   


   
/**
* @this controller user for Purchase order Report
* @param None
* @author rokibuzzaman<rokibuzzaman@atilimited.net>
*/

function purchaseOrderReport()
{
    $data['contentTitle'] = 'Purchase Order Report';
    $data["breadcrumbs"] = array(
        "Inventory" => "#",
        "Purchase Order Report" => '#'
        );
    $data["previlages"] = $this->checkPrevilege();
    $data['content_view_page'] = 'purchase_order_report/purchase_order_report';
    $this->admin_template->display($data);
}


   /**
     * @this controller user for Purchase order Report Date
     * @param None
     * @author rokibuzzaman<rokibuzzaman@atilimited.net>
    */

   function purchaseOrderReportData()
   {
        //$this->pr($_POST);
    $fromDate = date('Y-m-d', strtotime($this->input->post('fromDate')));
    $toDate =  date('Y-m-d', strtotime($this->input->post('toDate')));
        //$data['issue_info_report'] = $this->inventory_model->getAllIssueReqReportInfo($fromDate,$toDate);
    $data['purchaseorder_item_info_report'] = $this->inventory_model->getAllPurchaseOrderItemReport($fromDate,$toDate);
        //print_r($data['requisition_info_report']);exit();
         //echo "<pre>"; print_r($data['requisition_info_report']); exit;
    $this->load->view('purchase_order_report/purchase_order_report_data', $data);
   }


   /**
* @this controller user for Purchase order Receive Report
* @param None
* @author rokibuzzaman<rokibuzzaman@atilimited.net>
*/

function purchaseOrderReceiveReport()
{
    $data['contentTitle'] = 'PO Receive Report';
    $data["breadcrumbs"] = array(
        "Inventory" => "#",
        "PO Order Report" => '#'
        );
    $data["previlages"] = $this->checkPrevilege();
    $data['content_view_page'] = 'purchase_order_receive_report/purchase_order_receive_report';
    $this->admin_template->display($data);
}
   /**
     * @this controller user for Purchase order Receive Report Data
     * @param None
     * @author rokibuzzaman<rokibuzzaman@atilimited.net>
     */

   function purchaseOrderReceiveReportData()
   {
        //$this->pr($_POST);
    $fromDate = date('Y-m-d', strtotime($this->input->post('fromDate')));
    $toDate =  date('Y-m-d', strtotime($this->input->post('toDate')));
        //$data['issue_info_report'] = $this->inventory_model->getAllIssueReqReportInfo($fromDate,$toDate);
    $data['purchaseorder_receive_item_info_report'] = $this->inventory_model->getAllPurchaseOrderReceiveItemReport($fromDate,$toDate);
        //print_r($data['requisition_info_report']);exit();
         //echo "<pre>"; print_r($data['requisition_info_report']); exit;
    $this->load->view('purchase_order_report/purchase_order_receive_report_data', $data);
   }


/**
* @this controller user for Purchase order Return Report
* @param None
* @author rokibuzzaman<rokibuzzaman@atilimited.net>
*/

function purchaseOrderReturnReport()
{
    $data['contentTitle'] = 'PO Return Report';
    $data["breadcrumbs"] = array(
        "Inventory" => "#",
        "PO Return Report" => '#'
        );
    $data["previlages"] = $this->checkPrevilege();
    $data['content_view_page'] = 'purchase_order_return_report/purchase_order_return_report';
    $this->admin_template->display($data);
}

    /**
     * @this controller user for Purchase order Return Report Data
     * @param None
     * @author rokibuzzaman<rokibuzzaman@atilimited.net>
     */

   function purchaseOrderReturnReportData()
   {
        //$this->pr($_POST);
    $fromDate = date('Y-m-d', strtotime($this->input->post('fromDate')));
    $toDate =  date('Y-m-d', strtotime($this->input->post('toDate')));
        //$data['issue_info_report'] = $this->inventory_model->getAllIssueReqReportInfo($fromDate,$toDate);
    $data['purchaseorder_return_item_info_report'] = $this->inventory_model->getAllPurchaseOrderReturnItemReport($fromDate,$toDate);
        //print_r($data['requisition_info_report']);exit();
         //echo "<pre>"; print_r($data['requisition_info_report']); exit;
    $this->load->view('purchase_order_return_report/purchase_order_return_report_data', $data);
   }

/**
* @this controller user for Issue Return Report
* @param None
* @author rokibuzzaman<rokibuzzaman@atilimited.net>
*/

function issueReturnReport()
{
    $data['contentTitle'] = 'Issue Return Report';
    $data["breadcrumbs"] = array(
        "Inventory" => "#",
        "Issue Return Report" => '#'
        );
    $data["previlages"] = $this->checkPrevilege();
    $data['content_view_page'] = 'issue_return_report/issue_return_report';
    $this->admin_template->display($data);
}


    /**
     * @this controller user for Issue Return Report Data
     * @param None
     * @author rokibuzzaman<rokibuzzaman@atilimited.net>
     */

   function issueReturnReportData()
   {
        //$this->pr($_POST);
    $fromDate = date('Y-m-d', strtotime($this->input->post('fromDate')));
    $toDate =  date('Y-m-d', strtotime($this->input->post('toDate')));
        //$data['issue_info_report'] = $this->inventory_model->getAllIssueReqReportInfo($fromDate,$toDate);
    $data['issue_return_item_info_report'] = $this->inventory_model->getAllIssueReturnItemReport($fromDate,$toDate);
        //print_r($data['requisition_info_report']);exit();
         //echo "<pre>"; print_r($data['requisition_info_report']); exit;
    $this->load->view('issue_return_report/issue_return_report_data', $data);
   }






    /**

     * @methodName requisitionFormUpdate()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

    public function requisitionFormUpdate()
    {
        $mId = $this->input->post('param');
        $data['ac_type'] = 2;
        $data['item_info'] = $this->inventory_model->getAllItemSetupInfo();
        $data['req_info'] = $this->inventory_model->getAllChildItemlist($mId);
        $data['mst_data_info'] = $this->inventory_model->getAllRequisitionInfoById($mId);
        $data["requisition_type"] = $this->utilities->findAllByAttribute("m00_lkpdata a", array("a.GRP_ID" => 80));
        $this->load->view('inventory/requisition/edit_requisition_info', $data);
    }

     /**
     * @methodName updateRequisition()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */


     function updateRequisition($id)
     {
       // echo $id;exit;
        $req_mst_id = $this->input->post('mstId'); 
        //master table info
        $REQ_DT=date('Y-m-d',strtotime($this->input->post('REQ_DT')));
        $REQ_RECEIVE_DT = date('Y-m-d',strtotime($this->input->post('REQ_RECEIVE_DT'))); 
        $REQ_TYPE = $this->input->post('REQ_TYPE'); 
        $REQ_FOR = $this->input->post('REQ_FOR'); 
        $REMARKS = $this->input->post('REMARKS'); 
        $inRequMaster=array(
            'REQ_DT'=>$REQ_DT,
            'REQ_RECEIVE_DT'=>$REQ_RECEIVE_DT,
            'REQ_TYPE'=>$REQ_TYPE,
            'REQ_FOR'=>$REQ_FOR,
            'REMARKS'=>$REMARKS,
            'UPDATED_BY' => $this->user["USER_ID"],
            'UPDATE_DATE'=>date('Y-m-d')
            );
        $this->db->update('inv_requisition_mst',$inRequMaster,array('REQ_MST_ID'=>$id));
        //requisition details table update
        $ITEM_ID=$this->input->post('ITEM_ID');
        $countItemId=count($ITEM_ID);
        $REQUIREMENT_QTY=$this->input->post('REQUIREMENT_QTY');
        $REQ_CHD_ID=$this->input->post('REQ_CHD_ID');
        for($re=0;$re<$countItemId;$re++){
            if(!isset($REQ_CHD_ID[$re])==''){
                $upRequUP=array(
                    'ITEM_ID' => $ITEM_ID[$re],
                    'REQUIREMENT_QTY' => $REQUIREMENT_QTY[$re],
                    'UPDATED_BY' => $this->user["USER_ID"],
                    'UPDATE_DATE'=>date('Y-m-d')
                    );
            }
           // echo '<pre>';print_r($REQUIREMENT_QTY);exit;
            $this->db->update('inv_requisition_chd',$upRequUP,array('REQ_CHD_ID'=>$REQ_CHD_ID[$re]));
        }

         //insert requisition details table
        $REQ_MST_ID_C=$this->input->post('REQ_MST_ID');
        $ITEM_ID=$this->input->post('ITEM_ID');
        $countItemIdd=count($ITEM_ID);
        $REQUIREMENT_QTY=$this->input->post('REQUIREMENT_QTY');
        $REQ_CHD_ID=$this->input->post('REQ_MST_ID');
        for($red=0;$red<$countItemIdd;$red++){
            if(isset($REQ_CHD_ID[$red])==''){
             $inRequUP=array(
                'REQ_MST_ID'=> $id,
                'ITEM_ID' => $ITEM_ID[$red],
                'REQUIREMENT_QTY' => $REQUIREMENT_QTY[$red],
                'CREATED_BY' => $this->user["USER_ID"],
                );

             $this->db->insert('inv_requisition_chd',$inRequUP);

         }
     }
     $this->session->set_flashdata('Success', 'Congratulation ! Requisition Updated Successfully.');
     redirect('inventory/requisition');


 }


    /**
     * @methodName deleteChdRow()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

    function deleteChdRow()
    {
      $chd_id = $this->input->post('chd_id');

      $this->db->query("DELETE FROM inv_requisition_chd WHERE REQ_CHD_ID = $chd_id");
  }

    /**
     * @methodName deleteMasterRow()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

    function deleteMasterRow()
    {
        $m_id = $this->input->post('m_id');

        $this->db->query("DELETE FROM inv_requisition_chd WHERE REQ_MST_ID = $m_id");
        $this->db->query("DELETE FROM inv_requisition_mst WHERE REQ_MST_ID = $m_id");
        echo "Y";
    }


/**
* @this controller user for edit purchase order
* @param $id
* @author aminul<aminul@atilimited.net>
*/
public function editPurchageOrder($id){
   $data['item_info'] = $this->inventory_model->getAllItemSetupInfo(); 
   $data['supplier']=$this->inventory_model->getAllSupplier();
   $data['pOrder']=$this->inventory_model->getPurchaseOrderListById($id);
   $data['poDetails']=$this->inventory_model->getPurchaseOrderDetailsById($id);
   $data['po']=$this->inventory_model->getPurchaseOrderDetails();
    //echo '<pre>';print_r($data['poDetails']);exit;
   $this->load->view('inventory/purchaseOrder/editPurchageOrder',$data);
}


  /**
     * @methodName purchaseOrderPdf()
     * @access 
     * @param  none
     * @author Md.Rokibuzzaman <rokibuzzaman@atilimited.net>
     * @return Mixed View
     */

    function purchaseOrderPdf($PO_MST_ID = '')
    {
      $data['pageTitle'] = 'Print PDF';      
    if ($PO_MST_ID != '') {
            $id = $PO_MST_ID;
        } else {
            $id = $_POST["PO_MST_ID"];
        }

       $data['PO_MST_ID'] = $id;
       $data['item_info'] = $this->inventory_model->getAllItemSetupInfo(); 
       $data['supplier']=$this->inventory_model->getAllSupplier();
       $data['pOrder']=$this->inventory_model->getPurchaseOrderListById($id);
       $data['poDetails']=$this->inventory_model->getPurchaseOrderDetailsById($id);
       $data['po']=$this->inventory_model->getPurchaseOrderDetails();
          include('mpdf/mpdf.php');

      $mpdf = new mPDF('','A4',10,'');
      $mpdf->autoLangToFont = true;
      $mpdf->SetTitle('Purchase Order');
      $mpdf->mirrorMargins = 1;
      $mpdf->useOnlyCoreFonts = true;
      $report = $this->load->view('inventory/purchaseOrder/showCompletePurchageOrderPdf', $data, TRUE);
      $mpdf->WriteHTML("$report");
      $mpdf->SetHTMLFooter("$footer");
      $mpdf->Output();
      exit;
    }


/**
* @this controller user for edit and new purchase order details
* @param None
* @author aminul<aminul@atilimited.net>
*/

public function editPurchaseOrder($id){
    //update master table 
    $PO_DATE=$this->input->post('PO_DATE');
    $REMARKS=$this->input->post('REMARKS');
    $purOrderMaster=array(
        'PO_DATE' => date('Y-m-d',strtotime($PO_DATE)),
        'CREATED_BY' => $this->user["USER_ID"],
        'ACTIVE_STATUS'=>1,
        'REMAREK'=>$this->input->post('REMARKS'),
        'UPDATED_BY' => $this->user["USER_ID"],
        );
    $this->utilities->updateData('inv_po_mst', $purOrderMaster, array('PO_MST_ID' => $id));
    //$this->db->delete('inv_po_chd', array('PO_MST_ID' => $id)); 
    //insert details table      
    $ITEM_ID=$this->input->post('ITEM_ID');
    $ORDER_QTY=$this->input->post('ORDER_QTY');
    $SUPPLIER_ID=$this->input->post('SUPPLIER_ID');
    $maxid=$this->inventory_model->getPurchaseOrderMaxId();
    $PO_MST_ID=$this->input->post('PO_MST_ID');
    $countITEM_ID=count($ITEM_ID);
    $PO_CHD_ID=$this->input->post('PO_CHD_ID');
    for($u=0; $u<$countITEM_ID; $u++){
        if(!isset($PO_MST_ID[$u]) == ''){
         $purchaseorderUp=array(
            //'PO_MST_ID'=>$id,
            'ITEM_ID'=>$ITEM_ID[$u],
            'ORDER_QTY'=>$ORDER_QTY[$u],
            'SUPPLIER_ID'=>$SUPPLIER_ID[$u],
            'UPDATED_BY' => $this->user["USER_ID"],
            'UPDATE_DATE' => date('Y-m-d'),
            );

         $this->db->update('inv_po_chd',$purchaseorderUp,array('PO_CHD_ID'=>$PO_CHD_ID[$u]));
     }
 }

 $PO_CHD_IDIN=$this->input->post('PO_CHD_ID');
 $ITEM_IDd=$this->input->post('ITEM_ID');
 $countITEM_IDc=count($ITEM_IDd);
 $PO_MST_ID_CHECK=$this->input->post('PO_MST_ID_CHECK');
 $PO_CHD_ID_C=$this->input->post('PO_CHD_ID_C');
 for($q=0; $q<$countITEM_IDc; $q++){
     if(isset($PO_CHD_IDIN[$q]) == ''){    
        $purchaseorderDetails=array(
            'PO_MST_ID'=>$id,
            'ITEM_ID'=>$ITEM_ID[$q],
            'ORDER_QTY'=>$ORDER_QTY[$q],
            'SUPPLIER_ID'=>$SUPPLIER_ID[$q],
            'CREATED_BY' => $this->user["USER_ID"],
            
            );
        $this->db->insert('inv_po_chd',$purchaseorderDetails);
    }
    
}
$this->session->set_flashdata('Success', 'Congratulation ! Purcase Order Updated Successfully.');
redirect('inventory/PurchaseOrder');

}

/**
* @this controller user for delete purchase order details table data
* @param None
* @author aminul<aminul@atilimited.net>
*/
public function deletePerOrderDetials(){
    $po_de_id=$_POST['po_de_id'];
    $this->db->delete('inv_po_chd', array('PO_CHD_ID' => $po_de_id)); 
}
/**
* @this controller user for delete requisition order details table data
* @param None
* @author aminul<aminul@atilimited.net>
*/
public function deleteRequiDetials(){
    $re_id=$_POST['re_id'];
    $this->db->delete('inv_requisition_chd',array('REQ_CHD_ID' => $re_id)); 
}
/**
* @this controller user for purchase order
* @param None
* @author aminul<aminul@atilimited.net>
*/
public function orderReceive(){
    $data['poLIst']=$this->inventory_model->getPurchaseOrderList();
    $data['content_view_page'] = 'inventory/purchaseOrderReceive/order_receive_index';
    $this->admin_template->display($data);

}
/**
* @this controller user for purchase order receive
* @param $id
* @author aminul<aminul@atilimited.net>
*/
public function receivePurchageOrder($id){
    $data['or_re_no']=$this->prefix_invertory_model->createReceivePurchaseOrderNo();
    $data['item'] = $this->inventory_model->getItemById($id); 
    $data['supplier']=$this->inventory_model->getSupplierById($id);
    $data['pOrder']=$this->inventory_model->getPurchaseOrderListById($id);
    $data['poDetails']=$this->inventory_model->getPurchaseOrderDetailsById($id);
    $data['po']=$this->inventory_model->getPurchaseOrderDetails();
    $data['p_r']=$this->inventory_model->getPerReMstNO($id);
   //echo '<pre>';print_r($data['pOrder']);exit;
    $this->load->view('inventory/purchaseOrderReceive/receivePurchageOrder',$data);

}

  /**
     * @methodName receivePurchageOrderPdf()
     * @access 
     * @param  none
     * @author Md.Rokibuzzaman <rokibuzzaman@atilimited.net>
     * @return Mixed View
     */

  function receivePurchageOrderPdf($PO_MST_ID = '')
  {
      $data['pageTitle'] = 'Print PDF';      
      if ($PO_MST_ID != '') {
        $id = $PO_MST_ID;
    } else {
        $id = $_POST["PO_MST_ID"];
    }

    $data['PO_MST_ID'] = $id;
    $data['or_re_no']=$this->prefix_invertory_model->createReceivePurchaseOrderNo();
    $data['item'] = $this->inventory_model->getItemById($id); 
    $data['supplier']=$this->inventory_model->getSupplierById($id);
    $data['pOrder']=$this->inventory_model->getPurchaseOrderListById($id);
    $data['poDetails']=$this->inventory_model->getPurchaseOrderDetailsById($id);
    $data['po']=$this->inventory_model->getPurchaseOrderDetails();
    $data['p_r']=$this->inventory_model->getPerReMstNO($id);
    include('mpdf/mpdf.php');

    $mpdf = new mPDF('','A4',10,'');
    $mpdf->autoLangToFont = true;
    $mpdf->SetTitle('Receive Purchase Order');
    $mpdf->mirrorMargins = 1;
    $mpdf->useOnlyCoreFonts = true;
    $report = $this->load->view('inventory/purchaseOrderReceive/showReceivePurchageOrderPdf', $data, TRUE);
    $mpdf->WriteHTML("$report");
    $mpdf->SetHTMLFooter("$footer");
    $mpdf->Output();
    exit;
}

/**
* @this controller user for purchase order receive
* @param $id
* @author aminul<aminul@atilimited.net>
*/
public function createPurchaseOrderReceive($id){
    $PR_MST_NO=$this->prefix_invertory_model->createReceivePurchaseOrderNo();

    //insrt master table
    $PR_DATE=$this->input->post('PR_DATE');
    $REMARKS=$this->input->post('REMARKS');
    $reOrderMasterTable=array(
        'PR_MST_NO'=>$PR_MST_NO,
        'PO_MST_ID'=>$id,
        
        'CREATED_BY' => $this->user["USER_ID"],
        );
    $this->db->insert('inv_pr_mst',$reOrderMasterTable);

    //insert details table
    $maxid=$this->inventory_model->getReceivePurchaseOrderMaxId();
    $MAX_PR_MST_ID=$maxid->PR_MST_ID;
    $PO_CHD_ID=$this->input->post('PO_CHD_ID');
    $ITEM_ID=$this->input->post('ITEM_ID');
    $SUPPLIER_ID=$this->input->post('SUPPLIER_ID');
    $RECEIVE_QTY=$this->input->post('RECEIVE_QTY');
    $UNIT_PRICE=$this->input->post('UNIT_PRICE');
    $REMARKS=$this->input->post('REMARKS');
    
    $store_id=1;
    $transection_fg='POR';
    $countItemId=count($ITEM_ID);

    for($or=0;$or<$countItemId;$or++){
        $insertReOrderDetails=array(
            'PR_MST_ID'=>$MAX_PR_MST_ID,
            'PO_CHD_ID'=>$PO_CHD_ID[$or],
            'ITEM_ID'=>$ITEM_ID[$or],
            'SUPPLIER_ID'=>$SUPPLIER_ID[$or],
            'RECEIVE_QTY'=>$RECEIVE_QTY[$or],
            'UNIT_PRICE'=>$UNIT_PRICE[$or],
            'REMARKS'=>$REMARKS[$or],
            'CREATED_BY' => $this->user["USER_ID"],
            );
        if($RECEIVE_QTY[$or] !=''){
            $this->db->insert('inv_pr_chd',$insertReOrderDetails);
            $this->inventoryStock($store_id,$ITEM_ID[$or],$transection_fg,$RECEIVE_QTY[$or]);
        }
    }
    $this->session->set_flashdata('Success', 'Congratulation ! Receive Purcase Order Insert Successfully.');
    redirect('Inventory/orderReceive');
   // echo '<pre>';print_r($or_re_no);exit;
}

/**
* @this controller user for Issue Item
* @param None
* @author aminul<aminul@atilimited.net>
*/
public function issueItem(){
   $data['contentTitle'] = 'Inventory';
   $data['breadcrumbs'] = array(
    'Issue Item' => '#',
    'Issue Item List' => '#',
    );
   //$user_id=$this->user["USER_ID"];
   $data["previlages"] = $this->checkPrevilege();
   $data['requisition_info'] = $this->inventory_model->getAllRequisitionSetupInfo();
   $data['content_view_page'] = 'inventory/itemIssue/item_issue_index';
   $this->admin_template->display($data);

}
    /**
    * @param  $Id
     * @author Aminul <aminul@atilimited.net>
     */

    public function issueItemCreate($id)
    {
        $data['item_info'] = $this->inventory_model->getAllItemSetupInfo();
        $data['previousIssue']=$this->inventory_model->previousIssueItem($id);
        $data['req_info'] = $this->inventory_model->getAllChildItemlist($id);
        $data['mst_data_info'] = $this->inventory_model->getAllRequisitionInfoById($id);
        $this->load->view('inventory/itemIssue/issueItemCreate', $data);
    }
/**
* @this controller user for save issue item data
* @param $id
* @author aminul<aminul@atilimited.net>
*/
public function saveIssueItem($id){
    $ISS_NO=$this->prefix_invertory_model->createIssueItemNo();
    $user_id=$this->user["USER_ID"];
    $emp_name=$this->inventory_model->issueEmployee($user_id);
    $dept_name=$this->inventory_model->issueDept($user_id);
    $ISSUE_DT=date('Y-m-d');//$this->input->post('ISSUE_DT');
    $REMARKS=$this->input->post('REMARKS');
    $issueMasterTable=array(
        'ISSUE_NO'=>$ISS_NO,
        'ISSUE_DT'=>date('Y-m-d'),
        'REMARKS'=>$REMARKS,
        'REQ_MST_ID'=>$id,
        'ISSUE_EMP'=>$emp_name->EMP_ID,
        'ISSUE_DEPT'=>$dept_name->DEPT_ID,
        'CREATED_BY' => $this->user["USER_ID"],
        );
    $this->db->insert('inv_issue_mst',$issueMasterTable);
    //insert details table
    $maxid=$this->inventory_model->getIssueItemMaxId();
    $MAX_ISSUE_MST_ID=$maxid->ISSUE_MST_ID;
    $REQ_CHD_ID=$this->input->post('REQ_CHD_ID');
    $ITEM_ID=$this->input->post('ITEM_ID');
    $ISSUED_QTY=$this->input->post('ISSUED_QTY');
    $transection_fg='IS';//issue flag
    $store_id=1;
    $countItemId=count($ITEM_ID);
    for($iss=0;$iss<$countItemId;$iss++){
        $issueDetails=array(
            'ISSUE_MST_ID'=>$MAX_ISSUE_MST_ID,
            'REQ_CHD_ID'=>$REQ_CHD_ID[$iss],
            'ITEM_ID'=>$ITEM_ID[$iss],
            'ISSUED_QTY'=>$ISSUED_QTY[$iss],
            'CREATED_BY' => $this->user["USER_ID"],
            );
        if($ISSUED_QTY[$iss] !=''){            
            $this->db->insert('inv_issue_chd',$issueDetails);             
            $this->inventoryStock($store_id,$ITEM_ID[$iss],$transection_fg,$ISSUED_QTY[$iss]);
            
        }
    }
    $issued_status=array('ISSUED_STATUS'=>1);
    $this->utilities->updateData('inv_requisition_mst', $issued_status, array('REQ_MST_ID' => $id));
    $this->session->set_flashdata('Success', 'Congratulation ! Issue Item Insert Successfully.');
    redirect('Inventory/issueItem');
}
/**
* @this controller user for show complete purchase order
* @param $id
* @author aminul<aminul@atilimited.net>
*/
public function showCompletePurchageOrder($id){
   $data['item_info'] = $this->inventory_model->getAllItemSetupInfo(); 
   $data['supplier']=$this->inventory_model->getAllSupplier();
   $data['pOrder']=$this->inventory_model->getPurchaseOrderListById($id);
   $data['poDetails']=$this->inventory_model->getPurchaseOrderDetailsById($id);
   $data['po']=$this->inventory_model->getPurchaseOrderDetails();
    //echo '<pre>';print_r($data['poDetails']);exit;
   $this->load->view('inventory/purchaseOrder/showCompletePurchageOrder',$data);
}
    /**
     * @param  none
     * @author aminul huq<aminul@atilimited.net>
     * @return Mixed Template
     */

    public function showCompleterequisition()
    {
        $mId = $this->input->post('param');
        $data['ac_type'] = 2;
        $data['item_info'] = $this->inventory_model->getAllItemSetupInfo();
        $data['req_info'] = $this->inventory_model->getAllChildItemlist($mId);
        $data['mst_data_info'] = $this->inventory_model->getAllRequisitionInfoById($mId);
        $data["requisition_type"] = $this->utilities->findAllByAttribute("m00_lkpdata a", array("a.GRP_ID" => 80));
        $this->load->view('inventory/requisition/show_complete_requisition', $data);
    }


      /**
     * @methodName requisitionPdf()
     * @access 
     * @param  none
     * @author Md.Rokibuzzaman <rokibuzzaman@atilimited.net>
     * @return Mixed View
     */

      function requisitionPdf($REQ_MST_ID = '')
      {
          $data['pageTitle'] = 'Print PDF';      
          if ($REQ_MST_ID != '') {
            $mId = $REQ_MST_ID;
        } else {
            $mId = $_POST["REQ_MST_ID"];
        }

        //$mId = $this->input->post('param');
        $data['REQ_MST_ID'] = $mId;
        $data['ac_type'] = 2;
        $data['item_info'] = $this->inventory_model->getAllItemSetupInfo();
        $data['req_info'] = $this->inventory_model->getAllChildItemlist($mId);
        $data['mst_data_info'] = $this->inventory_model->getAllRequisitionInfoById($mId);
        $data["requisition_type"] = $this->utilities->findAllByAttribute("m00_lkpdata a", array("a.GRP_ID" => 80));
        include('mpdf/mpdf.php');

        $mpdf = new mPDF('','A4',10,'');
        $mpdf->autoLangToFont = true;
        $mpdf->SetTitle('Complete Requisition Information');
        $mpdf->mirrorMargins = 1;
        $mpdf->useOnlyCoreFonts = true;
        $report = $this->load->view('inventory/requisition/show_requisition_pdf', $data, TRUE);
        $mpdf->WriteHTML("$report");
        $mpdf->SetHTMLFooter("$footer");
        $mpdf->Output();
        exit;
    }
    /**

     * @param  $Id
     * @author Aminul <aminul@atilimited.net>
     */

    public function showCompleteIssueItem($id)
    {
        $data['item_info'] = $this->inventory_model->getAllItemSetupInfo();
        $data['previousIssue']=$this->inventory_model->previousIssueItem($id);
        $data['req_info'] = $this->inventory_model->getAllChildItemlist($id);
        $data['mst_data_info'] = $this->inventory_model->getAllRequisitionInfoById($id);
        $this->load->view('inventory/itemIssue/show_complete_issue_item', $data);
    }




      /**
     * @methodName issueItemPdf()
     * @access 
     * @param  none
     * @author Md.Rokibuzzaman <rokibuzzaman@atilimited.net>
     * @return Mixed View
     */

      function issueItemPdf($REQ_MST_ID = '')
      {
          $data['pageTitle'] = 'Print PDF';      
          if ($REQ_MST_ID != '') {
            $id = $REQ_MST_ID;
        } else {
            $id = $_POST["REQ_MST_ID"];
        }

        //$mId = $this->input->post('param');
        $data['REQ_MST_ID'] = $id;
        $data['item_info'] = $this->inventory_model->getAllItemSetupInfo();
        $data['previousIssue']=$this->inventory_model->previousIssueItem($id);
        $data['req_info'] = $this->inventory_model->getAllChildItemlist($id);
        $data['mst_data_info'] = $this->inventory_model->getAllRequisitionInfoById($id);
        include('mpdf/mpdf.php');

        $mpdf = new mPDF('','A4',10,'');
        $mpdf->autoLangToFont = true;
        $mpdf->SetTitle('Complete Issue Item Information');
        $mpdf->mirrorMargins = 1;
        $mpdf->useOnlyCoreFonts = true;
        $report = $this->load->view('inventory/itemIssue/show_issue_item_pdf', $data, TRUE);
        $mpdf->WriteHTML("$report");
        $mpdf->SetHTMLFooter("$footer");
        $mpdf->Output();
        exit;
    }





     /**
     * @methodName createIssueItemPdf()
     * @access 
     * @param  none
     * @author Md.Rokibuzzaman <rokibuzzaman@atilimited.net>
     * @return Mixed View
     */

      function createIssueItemPdf($REQ_MST_ID = '')
      {
          $data['pageTitle'] = 'Print PDF';      
          if ($REQ_MST_ID != '') {
            $id = $REQ_MST_ID;
        } else {
            $id = $_POST["REQ_MST_ID"];
        }

        //$mId = $this->input->post('param');
        $data['REQ_MST_ID'] = $id;
        $data['item_info'] = $this->inventory_model->getAllItemSetupInfo();
        $data['previousIssue']=$this->inventory_model->previousIssueItem($id);
        $data['req_info'] = $this->inventory_model->getAllChildItemlist($id);
        $data['mst_data_info'] = $this->inventory_model->getAllRequisitionInfoById($id);
        include('mpdf/mpdf.php');

        $mpdf = new mPDF('','A4',10,'');
        $mpdf->autoLangToFont = true;
        $mpdf->SetTitle('Create Issue Item Information');
        $mpdf->mirrorMargins = 1;
        $mpdf->useOnlyCoreFonts = true;
        $report = $this->load->view('inventory/itemIssue/create_issue_item_pdf', $data, TRUE);
        $mpdf->WriteHTML("$report");
        $mpdf->SetHTMLFooter("$footer");
        $mpdf->Output();
        exit;
    }


/**
* @this controller user for complete purchase order receive
* @param $id
* @author aminul<aminul@atilimited.net>
*/
public function completeRePurchageOrder($id){
    $data['or_re_no']=$this->prefix_invertory_model->createReceivePurchaseOrderNo();
    $data['item'] = $this->inventory_model->getItemById($id); 
    $data['supplier']=$this->inventory_model->getSupplierById($id);
    $data['pOrder']=$this->inventory_model->getPurchaseOrderListById($id);
    $data['poDetails']=$this->inventory_model->getPurchaseOrderDetailsById($id);
    $data['po']=$this->inventory_model->getPurchaseOrderDetails();
    $data['p_r']=$this->inventory_model->getPerReMstNO($id);
   //echo '<pre>';print_r($data['pOrder']);exit;
    $this->load->view('inventory/purchaseOrderReceive/complete_re_purchag_order',$data);

}
    /**
    * @this function use for issue return
    * @param  None
     * @author Aminul <aminul@atilimited.net>
     */

    public function issueReturn()
    {
        $data['issReNo']=$this->prefix_invertory_model->createIssueReturnNo();
        //echo $data['issReNo'];exit;
        $data['allIssue'] = $this->inventory_model->getAllIssueItem();
        $data['content_view_page'] = 'inventory/itemIssue/issue_return_index';
        $this->admin_template->display($data);

    }

/**
* @this controller user for create issue return
* @param $id
* @author aminul<aminul@atilimited.net>
*/
public function createIssueReturn($id){ 
   $data['issueItem']=$this->inventory_model->getAllIssueItemById($id);
   $data['issueItDe']=$this->inventory_model->getAllIssueDetailsItemById($id);
   $data['item_info'] = $this->inventory_model->getAllItemSetupInfo();
   $data['pIssReNo']=$this->inventory_model->previousIssueReturn($id);
    //echo '<pre>';print_r($data['issueItDe']);exit;
   $this->load->view('inventory/itemIssue/issue_return',$data);

}



   /**
     * @methodName returnIssueItemPdf()
     * @access 
     * @param  none
     * @author Md.Rokibuzzaman <rokibuzzaman@atilimited.net>
     * @return Mixed View
     */

      function returnIssueItemPdf($ISSUE_MST_ID = '')
      {
          $data['pageTitle'] = 'Print PDF';      
          if ($ISSUE_MST_ID != '') {
            $id = $ISSUE_MST_ID;
        } else {
            $id = $_POST["ISSUE_MST_ID"];
        }

        //$mId = $this->input->post('param');
        $data['ISSUE_MST_ID'] = $id;
        $data['issueItem']=$this->inventory_model->getAllIssueItemById($id);
        $data['issueItDe']=$this->inventory_model->getAllIssueDetailsItemById($id);
        $data['item_info'] = $this->inventory_model->getAllItemSetupInfo();
        $data['pIssReNo']=$this->inventory_model->previousIssueReturn($id);
        include('mpdf/mpdf.php');

        $mpdf = new mPDF('','A4',10,'');
        $mpdf->autoLangToFont = true;
        $mpdf->SetTitle('Return Issue Item Information');
        $mpdf->mirrorMargins = 1;
        $mpdf->useOnlyCoreFonts = true;
        $report = $this->load->view('inventory/itemIssue/show_issue_item_return_pdf', $data, TRUE);
        $mpdf->WriteHTML("$report");
        $mpdf->SetHTMLFooter("$footer");
        $mpdf->Output();
        exit;
    }

/**
* @this controller user for insert issue return
* @param $id
* @author aminul<aminul@atilimited.net>
*/
public function insertIssueReturn($id){
    $issReNo=$this->prefix_invertory_model->createIssueReturnNo();
    $user_id=$this->user["USER_ID"];
    $getEmpid=$this->inventory_model->issueEmployee($user_id);
    $getDept=$this->inventory_model->issueDept($user_id);
    //insert master table
    $insertMaster=array(
        'ISSUE_RET_NO'=>$issReNo,
        'ISSUE_MST_ID'=>$id,
        'ISSUE_RET_DT'=>date('Y-m-d'),
        'ISSUE_RET_EMP'=>$getEmpid->EMP_ID,
        'ISSUE_RET_DEPT'=>$getDept->DEPT_ID,
        'CREATED_BY'=>$user_id
        );
    $this->db->insert('inv_issue_return_mst',$insertMaster);

    //insert child table
    $maxId=$this->inventory_model->getIssueReturnMaxId();
    $ITEM_ID=$this->input->post('ITEM_ID');
    $store_id=1;
    $transection_fg='IR';
    $countItem=count($ITEM_ID);
    for($rei=0;$rei<$countItem;$rei++){
        $insertChild=array(
            'ISSUE_RET_MST_ID'=>$maxId->ISSUE_RET_MST_ID,
            'ISSUE_CHD_ID'=>$this->input->post('ISSUE_CHD_ID')[$rei],
            'ITEM_ID'=>$ITEM_ID[$rei],
            'ISSUED_RET_QTY'=>$this->input->post('ISSUED_RET_QTY')[$rei],
            'UPDATED_BY'=>$user_id,
            'UPDATE_DATE'=>date('Y-m-d')
            );
        if($this->input->post('ISSUED_RET_QTY')[$rei] !=''){
            $this->db->insert('inv_issue_return_chd',$insertChild);
            $this->inventoryStock($store_id,$ITEM_ID[$rei],$transection_fg,$this->input->post('ISSUED_RET_QTY')[$rei]);
        }
    }
    $this->session->set_flashdata('Success', 'Congratulation ! Issue Return Insert Successfully.');
    redirect('Inventory/issueReturn');
}
    /**
    * @this function use for issue return
    * @param  None
     * @author Aminul <aminul@atilimited.net>
     */
    public function orderReturn(){
       $data['issReNo']=$this->prefix_invertory_model->createIssueReturnNo();
       $data['allPurO'] = $this->inventory_model->getAllPurchaseOrder();
       $data['content_view_page'] = 'inventory/itemIssue/order_return_index';
       $this->admin_template->display($data);
   }
   /**
* @this controller user for create issue return
* @param $id
* @author aminul<aminul@atilimited.net>
*/
public function createPurOrderReturn($id){    
    $data['item_info'] = $this->inventory_model->getAllItemSetupInfo();
    $data['porder']=$this->inventory_model->getPurchaseOrder($id);
    $data['allPurO'] = $this->inventory_model->getAllPurchaseOrderById($id);
    $data['supplier'] = $this->utilities->findAllFromView('inv_supplier'); 
    $data['orderReceiveNo']=$this->inventory_model->previousOrderReturnNo($id);
    $this->load->view('inventory/itemIssue/purchase_order_return',$data);

}


  /**
     * @methodName createOrderReturnItemPdf()
     * @access 
     * @param  none
     * @author Md.Rokibuzzaman <rokibuzzaman@atilimited.net>
     * @return Mixed View
     */

      function createOrderReturnItemPdf($PR_MST_ID = '')
      {
          $data['pageTitle'] = 'Print PDF';      
          if ($PR_MST_ID != '') {
            $id = $PR_MST_ID;
        } else {
            $id = $_POST["PR_MST_ID"];
        }

        //$mId = $this->input->post('param');
        $data['PR_MST_ID'] = $id;
        $data['item_info'] = $this->inventory_model->getAllItemSetupInfo();
        $data['porder']=$this->inventory_model->getPurchaseOrder($id);
        $data['allPurO'] = $this->inventory_model->getAllPurchaseOrderById($id);
        $data['supplier'] = $this->utilities->findAllFromView('inv_supplier'); 
        $data['orderReceiveNo']=$this->inventory_model->previousOrderReturnNo($id);
        include('mpdf/mpdf.php');

        $mpdf = new mPDF('','A4',10,'');
        $mpdf->autoLangToFont = true;
        $mpdf->SetTitle('Return Issue Item Information');
        $mpdf->mirrorMargins = 1;
        $mpdf->useOnlyCoreFonts = true;
        $report = $this->load->view('inventory/itemIssue/show_order_return_item_pdf', $data, TRUE);
        $mpdf->WriteHTML("$report");
        $mpdf->SetHTMLFooter("$footer");
        $mpdf->Output();
        exit;
    }

/**
* @this controller user for insert issue return
* @param $id
* @author aminul<aminul@atilimited.net>
*/
public function insertOrderReturn($id){
    $orderRetNo=$this->prefix_invertory_model->createOrderReturnNo();
    $user_id=$this->user["USER_ID"];
    $getEmpid=$this->inventory_model->issueEmployee($user_id);
    $getDept=$this->inventory_model->issueDept($user_id);
    //insert master table
    $insertMaster=array(
        'PR_RET_MST_NO'=>$orderRetNo,
        'PR_MST_ID'=>$id,
        'PR_RET_DATE'=>date('Y-m-d'),
        'CREATED_BY'=>$user_id
        );
    $this->db->insert('inv_pr_return_mst',$insertMaster);

    //insert child table
    $maxId=$this->inventory_model->getOrderReturnMaxId();
    $ITEM_ID=$this->input->post('ITEM_ID');
    $SUPPLIER_ID=$this->input->post('SUPPLIER_ID');
    $store_id=1;
    $transection_fg='PORR';
    $countItem=count($ITEM_ID);
    for($ore=0;$ore<$countItem;$ore++){
        $insertChild=array(
            'PR_RET_MST_ID'=>$maxId->MAX_PR_RET_MST_ID,
            'PR_CHD_ID'=>$this->input->post('PO_CHD_ID')[$ore],
            'ITEM_ID'=>$ITEM_ID[$ore],
            'RET_RECEIVE_QTY'=>$this->input->post('RET_RECEIVE_QTY')[$ore],
            'SUPPLIER_ID'=>$SUPPLIER_ID[$ore],
            'UPDATED_BY'=>$user_id,
            'UPDATE_DATE'=>date('Y-m-d')
            );
        if($this->input->post('RET_RECEIVE_QTY')[$ore] !=''){
            $this->db->insert('inv_pr_return_chd',$insertChild);
            $this->inventoryStock($store_id,$ITEM_ID[$ore],$transection_fg,$this->input->post('RET_RECEIVE_QTY')[$ore]);
        }
        
    }
    $this->session->set_flashdata('Success', 'Congratulation ! Issue Return Insert Successfully.');
    redirect('Inventory/orderReturn');
}
function inventoryStock($store_id,$item_id,$transection_fg,$qty){

    $last_stock = $this->db->query("select * from inv_stock where STOCK_ID= (select MAX(STOCK_ID) max_stock_id FROM inv_stock where ITEM_ID=$item_id)")->row();
    $opening_balance='';
    $balance ='';
    if(empty($last_stock->BALANCE)){
        $opening_balance=$qty;
        $balance =  $qty;
    }else{
        if($transection_fg =='POR' || $transection_fg =='IR'){
            $opening_balance=$last_stock->BALANCE;
            $balance = $opening_balance + $qty;
        }else if($transection_fg =='IS' || $transection_fg='PORR'){
            $opening_balance=$last_stock->BALANCE;
            $balance = $opening_balance - $qty; 
        }
    }

    $stock_data =array(
        'ITEM_ID'=>$item_id,
        'STORE_ID'=>$store_id,
        'OPENING'=>$opening_balance,                 
        'BALANCE'=>$balance,
        'TRN_TYPE'=>$transection_fg
        );
    if($transection_fg =='POR' || $transection_fg =='IR'){
        $stock_data['STOCK_IN']=$qty;    

    }else if($transection_fg =='IS' || $transection_fg='PORR'){
        $stock_data['STOCK_OUT']=$qty;
    }

    $this->db->insert('inv_stock',$stock_data);

}

/**
* @this function use for issue return
* @param  None
 * @author Aminul <aminul@atilimited.net>
 */
    public function itemStock(){
       
       $data['item_list'] =  $this->inventory_model->getAllItemSetupInfo();
       $data['content_view_page'] = 'inventory/item/item_stock';
       $this->admin_template->display($data);
   }

    /**
     * @methodName  openingBalance()
     * @access
     * @param
     * @author     Md.Reazul Islam <reazul@atilimited.net>
     * @return      balance
     */

   public function openingBalance(){

        $data['contentTitle'] = 'Inventory';
        $data['breadcrumbs'] = array(
            'Opening Balance' => '#',
            'Opening Balance List' => '#',
            );
        $data["previlages"] = $this->checkPrevilege();
        $data['item_info'] = $this->db->query("SELECT i.ITEM_NAME,s.OPENING,s.STOCK_ID,s.ACTIVE_STATUS FROM inv_item i
            LEFT JOIN inv_stock s ON i.ITEM_ID = s.ITEM_ID
            WHERE IS_ITEM = 1 ORDER BY s.STOCK_ID DESC ")->result();
        //echo "<pre>";print_r($data['item_info']);exit();
        $data['content_view_page'] = 'inventory/openingBalance/opening_bln_index';
        $this->admin_template->display($data);

   }

    /**
     * @methodName openingBlnFormInsert()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

    function openingBlnFormInsert()
    {
        $data["ac_type"] = 1;
        $data["item_name"] = $this->utilities->findAllByAttribute("inv_item",array("IS_ITEM"=>1));
        $this->load->view('inventory/openingBalance/add_opening_bln', $data);
    }


    function createOpeningBln()
       {
        $itemId = $this->input->post('ITEM_ID');
        $quantity = $this->input->post('Quantity');
        //echo "<pre>";
        //print_r($quantity);exit();
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        //var_dump($Quantity); die();
                    if ($itemId) { 
                        for ($i = 0; $i < sizeof($itemId); $i++) {
                            if ($quantity[$i]!='') {
                            $openingBalance = array(
                                'ITEM_ID' => $itemId[$i],
                                'OPENING' => $quantity[$i],
                                'BALANCE' => $quantity[$i],
                                'TRN_TYPE' => 'OB',
                                'STORE_ID' => 1,
                                'ACTIVE_STATUS' => $status,
                                'CREATED_BY' => $this->user["USER_ID"]
                                );

                            //print_r($residentChargeRate);
                            $this->utilities->insertData($openingBalance, 'inv_stock');
                        }
                        }
                        echo "<div class='alert alert-success'>Opening Balance Create successfully</div>";
                    }
            
        else{
                 echo "<div class='alert alert-success'>Opening Balance insert failed</div>";
            
            }


 
    }

      /**
     * @methodName openingBlnList()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */


      function openingBlnList()
      {
        $data["previlages"] = $this->checkPrevilege("Inventory/openingBalance");
        $data['item_info'] = $this->db->query("SELECT i.ITEM_NAME,s.OPENING,s.STOCK_ID,s.ACTIVE_STATUS FROM inv_item i
            LEFT JOIN inv_stock s ON i.ITEM_ID = s.ITEM_ID
            WHERE IS_ITEM = 1 ORDER BY s.STOCK_ID DESC ")->result();
        $this->load->view("inventory/openingBalance/opening_bln_list", $data);
    }

     function openingBlnFormUpdate()
      {
        $data["ac_type"] = 2;
        $id = $this->input->post('param'); // unit ID
        $data["item_name"] = $this->utilities->findAllByAttribute("inv_item",array("IS_ITEM"=>1));
        $data['item_info'] = $this->utilities->findByAttribute('inv_stock', array('STOCK_ID' => $id)); // select all data from degree where degree id
        $this->load->view('inventory/openingBalance/add_opening_bln', $data);
    }

    /**
     * @methodName updateOpeningBln()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

    function updateOpeningBln()
    {
        //echo "reazul";exit();
//        echo "<pre>";
//        print_r($_POST);
//        exit;
        $stockId = $this->input->post('txtOpnBlnId');
        $itemName = $this->input->post('itemName'); // unit name
        $quantity = $this->input->post('quantity'); // description
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if unit with this name is already exist
      
        $item = array(
                'ITEM_ID' => $itemName,
                'OPENING' => $quantity,
                'BALANCE' => $quantity,
                'TRN_TYPE' => 'OB',
                'STORE_ID' => 1,
                'ACTIVE_STATUS' => $status,
                'UPDATED_BY' => $this->user["USER_ID"]
                );
            //var_dump($unit); exit();
            if ($this->utilities->updateData('inv_stock', $item, array('STOCK_ID' => $stockId))) { // if data update successfully
                echo "<div class='alert alert-success'>Opening Balance Update successfully</div>";
            } else { // if data update failed
                echo "<div class='alert alert-danger'>Opening Balance Update failed</div>";
            }
       
            }

     /**
     * @methodName openingBlnById()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

     function openingBlnById()
     {
        $stockId = $this->input->post('param'); // unit name
        $data["previlages"] = $this->checkPrevilege("inventory/openingBalance");
         $data['row'] = $this->db->query("SELECT i.ITEM_NAME,s.OPENING,s.STOCK_ID,s.ACTIVE_STATUS FROM inv_item i
            LEFT JOIN inv_stock s ON i.ITEM_ID = s.ITEM_ID
            WHERE IS_ITEM = 1 AND s.STOCK_ID = $stockId")->row();
        $this->load->view('inventory/openingBalance/single_opening_bln_row', $data);
    } 
}
/* End of file Inventory.php */
/* Location: ./application/controllers/inventory.php */
