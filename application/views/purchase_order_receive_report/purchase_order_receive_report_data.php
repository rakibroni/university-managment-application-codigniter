    <style>
      .ScrollStyle
      {
        max-height: 300px;
        overflow-y: scroll;
      }
    </style>
    <?php
    $organization_info=$this->utilities->findByAttribute('sa_organizations', array('STATUS' => 1));
    $ABBR=$organization_info->ABBR;
    $WEBSITE=$organization_info->WEBSITE;
    $ORG_NAME=$organization_info->ORG_NAME;
    $EMAIL=$organization_info->EMAIL;
    $PHONE=$organization_info->PHONE;
    $org_log= base_url('upload/organization/logo/'.$organization_info->LOGO); 
    ?>
    <div id='printablediv'>
      <div><img src="<?php echo $org_log; ?>" style="position:relative; display:inline-block; top:0; left:0;width:60px; vertical-align:middle;" /><h1 style="display:inline-block;vertical-align:middle; margin-left:20px; "><?php echo $ORG_NAME; ?></h1>
     <hr style="border-color:orange;"><br><p align="center" style="font-size: 16px;"><b>Purchase Order Receive Report</b><br><span style="float:center;font-size: 14px;"><?php echo $fromDate = date('d/M/Y', strtotime($this->input->post('fromDate'))); ?>-<?php echo $toDate = date('d/M/Y', strtotime($this->input->post('toDate'))); ?></span></p></div>
<!-- 
     <table id="" border="1" rules="all" class="table table-striped table-bordered table-hover printable table-sm no-footer centered" cellspacing="0" width="100%" role="grid">
     <h2 align="center"><b>Requisition Report</b><br><small><?php echo $fromDate = date('d/M/Y', strtotime($this->input->post('fromDate'))); ?>-<?php echo $toDate = date('d/M/Y', strtotime($this->input->post('toDate'))); ?></small></h2>

         <?php foreach ($requisition_info_report as $row): ?>
             <tr>
                <td class="col-md-3"><b>Total Requisition: <?php echo count($requisition_info_report);
                    ?></b></td>
                    <td class="col-md-3"><b>Urgent:<?php if ($row->REQ_TYPE=="353") {
                      echo count($row->REQ_TYPE);
                  }

                  ?></b></td>
                  <td class="col-md-3"><b>Normal:<?php if ($row->REQ_TYPE=="354") {
                      echo count($row->REQ_TYPE);
                  }

                  ?></b></td>

              </tr>
          <?php endforeach; ?>



      </table>
    -->

    <table id="" border="1" rules="all" class="table table-striped table-bordered table-hover printable table-sm no-footer centered" cellspacing="0" width="100%" role="grid">
      <thead>

        <tr>
          <th style="text-align: center;">SN</th>
          <th>Item Name</th>
          <th style="text-align: center;">Quantity</th>

        </tr>

      </thead>
      <tbody>
       <?php $sn = 1; ?>
       <?php foreach ($purchaseorder_receive_item_info_report as $row): ?>

       <tr>
         <td style="text-align: center;"><?php echo $sn++; ?></td>
         <td><?php echo $row->ITEM_NAME; ?> </td>
         <td style="text-align: center;"><?php echo $row->TOTAL_RECEIVE_QTY; ?> (<?php echo $row->UNIT_NAME; ?>)</td>
       </tr>
     <?php endforeach; ?>


   </tbody>
 </table>
</div>
<center>
  <button type="button" value="Print" class="btn btn-primary printButton">Print</button>
</center>
