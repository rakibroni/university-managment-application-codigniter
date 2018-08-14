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
        $data['item_info'] = $this->inventory_model->getAllItemSetupInfo(); // select all data from item
        $data['content_view_page'] = 'inventory/item/item_index';
        $this->admin_template->display($data);
    }

     /**
     * @methodName itemFormInsert()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

     function itemFormInsert()
     {
        $data["ac_type"] = 1;
        $data["item_category"] = $this->utilities->findAllByAttribute("inv_item_category", array("ACTIVE_STATUS" => 1));
        $data["unit"] = $this->utilities->findAllByAttribute("inv_unit", array("ACTIVE_STATUS" => 1));
        $this->load->view('inventory/item/add_item', $data);
    }

     /**
     * @methodName itemList()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

     function itemList()
     {
        $data["previlages"] = $this->checkPrevilege("Inventory/unit");
        $data['item_info'] = $this->inventory_model->getAllItemSetupInfo(); // select all data from item
        //echo "<pre>";print_r($data['item_info']);exit();
        $this->load->view("inventory/item/item_list", $data);
    }

    /**
     * @methodName createItem()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

    function createItem()
    {
        $itemName = $this->input->post('ItemName'); // item name
        $code = $this->input->post('code'); // code
        $ITEM_CAT_ID = $this->input->post('ITEM_CAT_ID'); // item category
        $UNIT_ID = $this->input->post('UNIT_ID'); // unit name
        $description = $this->input->post('description'); // description

        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if Item with this name is already exist
        $check = $this->utilities->hasInformationByThisId("inv_item", array("ITEM_NAME" => $itemName));
        if (empty($check)) {// if item name available
            // preparing data to insert
            $item = array(
                'ITEM_NAME' => $itemName,
                'ITEM_CODE' => $code,
                'ITEM_CAT_ID' => $ITEM_CAT_ID,
                'UNIT_ID' => $UNIT_ID,
                'DESC' => $description,
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
     * @return Mixed Template
     */

   function itemFormUpdate()
   {
    $data["ac_type"] = "edit";
        $item_id = $this->input->post('param'); // item ID
        $data["item_category"] = $this->utilities->findAllByAttribute("inv_item_category", array("ACTIVE_STATUS" => 1));
        $data["unit"] = $this->utilities->findAllByAttribute("inv_unit", array("ACTIVE_STATUS" => 1));
        $data['item_info'] = $this->inventory_model->getItemSetupInfoById($item_id); // select all data from item where item id
        //echo "<pre>";print_r($data['item_info']);exit();
        $this->load->view('inventory/item/add_item', $data);
    }

    /**
     * @methodName updateItem()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

    function updateItem()
    {
//        echo "<pre>";
//        print_r($_POST);
//        exit;
        $item_id = $this->input->post('txtitemId'); // item id
        $itemName = $this->input->post('ItemName'); // item name
        $code = $this->input->post('code'); // code
        $ITEM_CAT_ID = $this->input->post('ITEM_CAT_ID'); // item category
        $UNIT_ID = $this->input->post('UNIT_ID'); // unit name
        $description = $this->input->post('description'); // description
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        // checking if item with this name is already exist
        $check = $this->utilities->hasInformationByThisId("inv_item", array("ITEM_NAME" => $itemName, "ITEM_ID !=" => $item_id));

        if (empty($check)) {// if item name available
            // preparing data to insert
            $item = array(
                'ITEM_NAME' => $itemName,
                'ITEM_CODE' => $code,
                'ITEM_CAT_ID' => $ITEM_CAT_ID,
                'UNIT_ID' => $UNIT_ID,
                'DESC' => $description,
                'ACTIVE_STATUS' => $status,
                'UPDATED_BY' => $this->user["USER_ID"]
            );
        //print_r($item); exit();
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
     * @return Mixed Template
     */

    function itemById()
    {
        $item_id = $this->input->post('param'); // unit name
        $data["previlages"] = $this->checkPrevilege("inventory/unit");
        $data['row'] = $this->inventory_model->getItemSetupInfoById($item_id); // select all data from unit where unit id
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
        $data["previlages"] = $this->checkPrevilege();
        $data['requisition_info'] = $this->inventory_model->getAllRequisitionSetupInfo(); // select all data from requisition
        // $this->db->query("SELECT FROM m00_lkpdata WHERE GRP_ID = 80");
        //echo "<pre>";print_r($data['requisition_info']);exit();
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
        $data['item_info'] = $this->inventory_model->getAllItemSetupInfo(); // select all data from requisition 
        $data["requisition_type"] = $this->utilities->findAllByAttribute("m00_lkpdata a", array("a.GRP_ID" => 80));
        $this->load->view('inventory/requisition/add_requisition_info', $data);
    }

/**
     * @methodName createRequisition()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */


    function createRequisition(){
        $remarks=$this->input->post('REMARKS');
        $reqDate=$this->input->post('REQ_DT');
        $reqReceiveDate=$this->input->post('REQ_RECEIVE_DT');
        $ReqFor=$this->input->post('REQ_FOR');
        $reqType=$this->input->post('REQ_TYPE');
        $item = $this->input->post('ITEM_NAME');
        $requirement = $this->input->post('REQUIREMENT');

        $req_mst_data=array(
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

public function PurchaseOrder(){
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
    //create PO_NO using year month
    $date=date('Ym');
    $startNum='0';
    $fourDisit='4';
    $formatpoNo=$date.str_pad($startNum, $fourDisit, '0', STR_PAD_LEFT);
    $maxPoNo=$this->db->query("SELECT MAX(SUBSTRING(pom.PO_NO,9)) AS PO_NO FROM inv_po_mst pom")->row();
    $maxPoNoIncre=$maxPoNo->PO_NO + 1;
    $PO_NO_C=$maxPoNoIncre+$formatpoNo;
    $PO_NO_F='P'.$PO_NO_C;
    $PO_DATE=$this->input->post('PO_DATE');
    $REMARKS=$this->input->post('REMARKS');
    $purOrderMaster=array(
        'PO_NO' => $PO_NO_F,
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

     * @methodName requisitionFormUpdate()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */

    function requisitionFormUpdate()
    {
        $mId = $this->input->post('param');
        $data["ac_type"] = 2;
        $data['reg_mst_info'] = $this->utilities->findByAttribute('inv_requisition_mst', array('REQ_MST_ID' => $mId));
        $data['item_info'] = $this->inventory_model->getAllItemSetupInfo();
        $data['req_info'] = $this->inventory_model->getAllChildItemlist($mId);
        $data['reg_remarks'] = $data['req_info'][0]->REMARKS;
         //echo "<pre>"; print_r($data['reg_mst_info']); exit;

        $this->load->view('inventory/requisition/add_requisition', $data);
    }

     /**
     * @methodName updateRequisition()
     * @access
     * @param  none
     * @author Md. Reazul Islam <reazul@atilimited.net>
     * @return Mixed Template
     */


     function updateRequisition()
     {
//        echo "<pre>";
//        print_r($_POST);
//        exit;
        $req_mst_id = $this->input->post('mstId'); // item id
        //echo $req_mst_id;exit();
        $req_chd_id = $this->input->post('txtReqId'); // item id
        $itemName = $this->input->post('ITEM_NAME'); // item name
        $requirement = $this->input->post('REQUIREMENT'); // code
        $remarks = $this->input->post('REMARKS'); // item category
        $status = ((isset($_POST['status'])) ? 1 : 0); // active status
        //  echo "<pre>";
        // print_r($req_mst_id);
        // exit;

        for ($i=0; $i < sizeof($itemName); $i++) { 

            if(empty($req_chd_id[$i]))
            {
                $requisition_chd_data= array(
                    //'REQ_MST_ID' => $REQ_MST_ID,
                    'REQ_MST_ID' => $req_mst_id,
                    'ITEM_ID' => $itemName[$i],
                    'REQUIREMENT_QTY' => $requirement[$i],
                    'UPDATED_BY' => $this->user["USER_ID"]
                );

                $this->utilities->insertData($requisition_chd_data, 'inv_requisition_chd');

            }
            else {

             $requisition_chd_data= array(
                //'REQ_MST_ID' => $REQ_MST_ID,
                'ITEM_ID' => $itemName[$i],
                'REQUIREMENT_QTY' => $requirement[$i],
                'UPDATED_BY' => $this->user["USER_ID"]
            );
             $this->utilities->updateData('inv_requisition_chd', $requisition_chd_data, array('REQ_CHD_ID' => $req_chd_id[$i]));
         }
     }

     $remarks = array(
        'REMARKS' => $remarks,
        'UPDATED_BY' => $this->user["USER_ID"]
    );
        //print_r($item); exit();
     $this->utilities->updateData('inv_requisition_mst', $remarks, array('REQ_MST_ID' => $req_mst_id));
     redirect('inventory/requisition');
           // $this->utilities->updateData($requisition_chd_data, 'inv_requisition_chd');

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
    $this->db->delete('inv_po_chd', array('PO_MST_ID' => $id)); 
    //insert details table      
    $ITEM_ID=$this->input->post('ITEM_ID');
    $ORDER_QTY=$this->input->post('ORDER_QTY');
    $SUPPLIER_ID=$this->input->post('SUPPLIER_ID');
    $maxid=$this->inventory_model->getPurchaseOrderMaxId();
    $MAX_PO=$maxid->MAX_PO;
    $countITEM_ID=count($this->input->post('ITEM_ID'));
    for($q=0; $q<$countITEM_ID; $q++){
        $purchaseorderDetails=array(
            'PO_MST_ID'=>$id,
            'ITEM_ID'=>$ITEM_ID[$q],
            'ORDER_QTY'=>$ORDER_QTY[$q],
            'SUPPLIER_ID'=>$SUPPLIER_ID[$q],
            'CREATED_BY' => $this->user["USER_ID"],
        );
        $this->db->insert('inv_po_chd',$purchaseorderDetails);
        $this->session->set_flashdata('Success', 'Successfully Inserted');

    }
    redirect('inventory/PurchaseOrder');
}


}
/* End of file Inventory.php */
/* Location: ./application/controllers/inventory.php */
