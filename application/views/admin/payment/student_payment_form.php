<div class="ibox float-e-margins">
    <div class="ibox-title">

        <div class="col-md-9"><b>Payment Details</b>     </div>
        <div class="col-md-3 has-success"> 
            <select class="form-control " id="YSESSION_ID">
                <option value="">-- Select Session --</option>
                <?php if(!empty($session)): foreach($session as $row): ?>
                    <option value="<?php echo $row->YSESSION_ID  ?>"><?php echo $row->SESSION_NAME  ?></option>
                <?php endforeach; endif; ?>
            </select>   
        </div> 
    </div>
    <div class="ibox-content"> 
        <div id="semester_wise_payment_details">
            <div class="panel-body">
                <div class="col-md-8">
                 <div class="panel panel-primary">             
                    <div id="" class="panel-collapse collapse in" aria-expanded="true">
                        <div class="panel-body">

                            <table class="table table-bordered">
                                <tr>
                                    <th>Session</th>
                                    <th>:</th>
                                    <td>Summer-2017</td>
                                    <th>Name</th>
                                    <th>:</th>
                                    <td>Rakib Mostofa</td>
                                </tr>
                                <tr>
                                    <th>Registration No.</th>
                                    <th>:</th>
                                    <td>103106081155</td>
                                    <th>Program</th>
                                    <th>:</th>
                                    <td>Bsc. CSE</td>
                                </tr>
                            </table>                             
                        </div>
                    </div>
                </div>
                <div class="panel panel-primary">             
                    <div id="" class="panel-collapse collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <table class="table table-bordered">
                                <tr class="info">
                                    <th class="text-center">#</th>
                                    <th>Code</th>
                                    <th>Course</th>
                                    <th class="text-center">Credit</th>
                                </tr>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td>CSE 201</td>
                                    <td>Computer Fundamental</td>
                                    <td class="text-center">3</td>
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td>CSE 202</td>
                                    <td>Computer Fundamental</td>
                                    <td class="text-center">3</td>
                                </tr>
                                <tr>
                                    <td class="text-center">3</td>
                                    <td>CSE 203</td>
                                    <td>Computer Fundamental</td>
                                    <td class="text-center">3</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4"  >
                <table class="table">
                    <tr>
                        <td>Admission</td>
                        <td><span class="badge badge-peimary pull-right">5000.00 </span></td>
                    </tr>
                    <tr>
                        <td>Tution Fee</td>
                        <td><span class="badge badge-peimary pull-right">20,000.00 </span></td>
                    </tr>
                    <tr>
                        <td>Lab Fee</td>
                        <td><span class="badge badge-peimary pull-right">2,000.00 </span></td>
                    </tr>
                    <tr>
                        <td>Library Fee</td>
                        <td><span class="badge badge-peimary pull-right">1,000.00 </span></td>
                    </tr>
                    <tr>
                        <td><span class="text-success"><b> Total</b></span> </td>
                        <td><span class="badge badge-peimary pull-right">28,000.00 </span></td>
                    </tr>
                    <tr>
                        <td><span class="text-warning"><b> Deduction</b></span> </td>
                        <td><span class="badge badge-peimary pull-right">0.00 </span></td>
                    </tr>
                    <tr>
                        <td><span class="">  Prev. Balance </span> </td>
                        <td><span class="badge badge-peimary pull-right">0.00 </span></td>
                    </tr>
                    <tr>
                        <td><span class="text-success"><b>Net Total</b></span> </td>
                        <td><span class="badge badge-peimary pull-right">28,000.00 </span></td>
                    </tr>
                    <tr>
                        <td><span class=""><b>Amount Paid</b></span> </td>
                        <td><span class="badge badge-peimary pull-right">0.00 </span></td>
                    </tr>
                    <tr>
                        <td><span class="text-info"><b>Balance</b></span> </td>
                        <td><span class="badge badge-peimary pull-right">28,000.00 </span></td>
                    </tr>
                </table>
            </div>

        </div>  
        <center> <button class="btn btn-sm btn-danger  ">Make Payment</button></center>
        <div class="clearfix"></div>
    </div>
</div>  
</div>  

<script type="text/javascript">
     $(document).on("change", "#YSESSION_ID", function () {
        var YSESSION_ID = $("#YSESSION_ID").val();
        if(YSESSION_ID == '')
        { 
            $("#semester_wise_payment_details").html("<span class='text-warning'><b>No record found</b></sapn>");

        } else {

            $.ajax({
                type: "POST",
                data: {YSESSION_ID:YSESSION_ID},
                url: "<?php echo site_url(); ?>/student/paymentDetailsBySemester",
                beforeSend: function () {
                    $("#semester_wise_payment_details").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    $("#semester_wise_payment_details").html(data);
                }
            });
        }

    });
   

</script>