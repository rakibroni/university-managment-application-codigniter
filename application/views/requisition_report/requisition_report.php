<style type="text/css">
    hr {
        margin-bottom: 0px !important;
        margin-top: 10px !important;
    }

    .alert {
        border: 1px solid transparent !important;
        border-radius: 4px !important;
        margin-bottom: 4px !important;
        padding: 6px !important;
    }
</style>
<div class="wrapper wrapper-content">

   

    <form id="reportFormSubmit" class="reportFormSubmit" action="<?php echo site_url('RequisitionReport/requisitionReportData') ?>"> 

        <div class="ibox float-e-margins">

            <div class="ibox-title">
                <h5>Requisition Report</h5>
            </div>
            <div class="ibox-content">
               <div class="col-md-4">
                <div class="form-group">
                    <label class="col-md-4 control-label">From Date<span class="text-danger">*</span></label>
                    <input name="fromDate" class="form-control datepicker" readonly="readonly" placeholder="dd/mm/yy" type="text">
                </div>
            </div>


            <div class="col-md-4">
                <div class="form-group">
                    <label class="col-md-4 control-label">To Date<span class="text-danger">*</span></label>
                    <input name="toDate" class="form-control datepicker" readonly="readonly" placeholder="dd/mm/yy" type="text">
                </div>
            </div>

            
            <div class="col-md-2">
                <div class="form-group bb"><br>
                    <input type="submit" class="btn btn-primary btn-sm my_submit"
                    value="Search">
                </div>
            </div>
            <div class="clearfix"></div>


            <div class="reportResult">


            </div>

        </div>


    </form>
</div>

</div>
</form>
</div>




