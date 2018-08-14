<style type="text/css">
    .error_field {
        border-color: #B94A48 !important;
    }

    .groupLevels {
        display: none;
    }
</style>
<div class="msg">
    <?php
    if (validation_errors() != false) {
        echo '<div class="alert alert-block alert-error fade in">';
        echo '<button data-dismiss="alert" class="close icon-remove" type="button"></button>';
        echo validation_errors();
        echo '</div>';
    }
    ?>
</div>

        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5> User Group List   </h5>
                <div class="ibox-tools">
                    <span class="btn btn-danger btn-xs pull-right create_group" data-toggle="modal"
                       href="#modal_window">Create New Group</span>
                </div>
            </div>
            <div class="ibox-content">
                <table class="table table-striped table-bordered" id="sample_1">
                    <thead>
                    <tr>
                        <th style="width:8px;">#</th>
                        <th>Group Name</th>

                        <th style="width: 70px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (!empty($groups)) {
                        $i = 1;
                        foreach ($groups as $group) {
                            $group_levels = $this->utilities->findAllByAttribute("sa_ug_level", array("USERGRP_ID" => $group->USERGRP_ID, "ACTIVE_STATUS" => 1));
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i++; ?></td>
                                <td>
                                    <div class="collapsibleDivHeader pointer">
                                        <strong><?php echo $group->USERGRP_NAME . " " . (!empty($group_levels) ? "(" . count($group_levels) . ")" : ""); ?>
                                            <span <?php echo (!empty($group_levels)) ? 'class="collapsiblePlus icon-plus" style="font-size: 10px; float:right;"' : '' ?>></span></strong>
                                            <span class="rht rightLabel">
                                                <?php
                                                if (empty($group_levels)) {
                                                    echo "<span style='color:#999999; font-size:10px; font-style:italic; margin-left:20px;'>No Level Created So Far</span>";
                                                }
                                                ?>
                                            </span>
                                    </div>
                                    <?php
                                    if (!empty($group_levels)) {
                                        ?>
                                        <div class="collapsibleDivBody" style="display: none;">
                                            <ol class="collapsibleDivBodyContent arrow_box"
                                                style="margin: 10px 0; padding: 0 20px;">
                                                <?php
                                                foreach ($group_levels as $group_level) {
                                                    ?>
                                                    <li><?php echo $group_level->UGLEVE_NAME; ?></li>
                                                <?php } ?>
                                            </ol>
                                        </div>
                                    <?php } ?>
                                </td>

                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-primary btn-xs addLink create_level" data-toggle="modal"
                                           href="#modal_window" data-id="<?php echo $group->USERGRP_ID; ?>">Add
                                            Level</a>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>

<div id="modal_window" class="modal fade" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel"></h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--script for this page only-->
<script type="text/javascript">
    $(document).ready(function () {
        $('.toggleLevel').click(function () {
            $(this).siblings('.groupLevels').slideToggle(100, function () {
                $(this).siblings('.toggleLevel').toggleClass('test');
            });

            $(this).parent().parent().siblings().find('.groupLevels').hide(100, function () {
                $(this).siblings('.toggleLevel').removeClass('test');
                $(this).find('.answer').hide();
            });
        });
        $('.collapsibleDivHeader').click(function () {
            $(this).siblings('.collapsibleDivBody').slideToggle(100, function () {
                var $iconCon = $(this).siblings('.collapsibleDivHeader').find('.collapsiblePlus');
                if ($iconCon.hasClass('icon-plus')) {
                    $iconCon.addClass('icon-minus').removeClass('icon-plus');
                } else {
                    $iconCon.addClass('icon-plus').removeClass('icon-minus');
                }
            });
        });
        $(document).on("click", ".create_level", function () {
            var group_id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('securityAccess/createLevelModal'); ?>",
                data: {group_id: group_id},
                beforeSend: function () {
                    $("#modal_window .modal-title").html("Create Level");
                    $("#modal_window .modal-body").html("loading...");
                },
                success: function (data) {
                    $("#modal_window .modal-body").html(data);
                }
            });
        });
        $(document).on("click", ".create_group", function () {
            // var h_id = $(this).attr('data-hid');
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('securityAccess/groupModal'); ?>",
                beforeSend: function () {
                    $("#modal_window .modal-title").html("Create Group");
                    $("#modal_window .modal-body").html("loading...");
                },
                success: function (data) {
                    $("#modal_window .modal-body").html(data);
                }
            });
        });
    });
</script>