
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Holiday Information List</h5>
                    <?php if ($previlages->CREATE == 1) { ?>
                        <div class="ibox-tools">
                            <span title="Weekend Create" class="btn btn-primary btn-xs openModal"
                                  data-action="setup/weekendFormInsert"> Add Weekend </span> &nbsp;
                            <span title="Holiday Create" class="btn btn-primary btn-xs openModalHoliday"
                                  data-action="setup/holidayFormInsert"> Add Holiday </span>
                        </div>
                    <?php } ?>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive contentArea">
                        <?php $this->load->view("admin/setup/holiday/holiday_list"); ?>
                    </div>
                </div>
            </div>

<script>
    $(document).on("click", ".openModalHoliday", function () {
        $(".commonModal").modal();
        var param_value = "";
        var action_type = $(this).attr("data-type");
        var action_uri = $(this).attr("data-action");
        var title = $(this).attr("title");
        $.ajax({
            type: "post",
            url: "<?php echo site_url(); ?>/" + action_uri,
            data: {param: param_value},
            beforeSend: function () {
                $(".commonModal .modal-title").html(title);
                $(".commonModal .modal-body").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
            },
            success: function (data) {
                $(".commonModal .modal-body").html(data);
            }
        });
    });
</script>