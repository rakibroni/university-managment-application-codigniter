<?php
if (isset($_POST['param'])) {
    $DEPT_id = $_POST['param'];
}
?>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-4 padding_0">
            <div class="ibox float-e-margins">
                <div class="ibox-content mailbox-content">
                    <div class="file-manager">
                        <h5>Program Name</h5>
                        <ul class="folder-list m-b-md padding_0">
                            <?php
                            $program = $this->utilities->findAllByAttribute('program', array('DEPT_ID' => $DEPT_id));

                            foreach ($program as $programInfo) {
                                ?>
                                <li><a href="#"><span class="deg_link pointer"
                                                      id="<?php echo $programInfo->PROGRAM_ID; ?>"><i
                                                class="fa fa-forward"></i> <?php echo $programInfo->PROGRAM_NAME; ?></span></a>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 ">
            <div class="ibox float-e-margins">
                <div class="ibox-content mailbox-content">
                    <div class="file-manager">
                        <h5>Course Offer</h5>
                        <ul class="folder-list m-b-md padding_0">
                            <?php
                            $program = $this->utilities->findAllByAttribute('program', array('DEPT_ID' => $DEPT_id));

                            foreach ($program as $programInfo) {
                                ?>
                                <li><a href="#"><span title="Course list accourding to Program"
                                                      class="label label-primary openBigModal"
                                                      dept="<?php echo $DEPT_id; ?>"
                                                      id="<?php echo $programInfo->PROGRAM_ID; ?>"
                                                      data-action="portal/portalCourseOffer" data-type="admission">Course Offered</span></a>
                                </li>


                            <?php
                            }
                            ?>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 animated fadeInRight">
            <div class="ibox float-e-margins">
                <div class="ibox-content mailbox-content">
                    <div class="file-manager">
                        <h5>Instruction</h5>
                        <ul class="folder-list m-b-md padding_0">
                            <?php
                            $program = $this->utilities->findAllByAttribute('program', array('DEPT_ID' => $DEPT_id));

                            foreach ($program as $programInfo) {
                                ?>
                                <li><a href="#"><span class="label label-primary openBigModal"
                                                      id="<?php echo $programInfo->PROGRAM_ID; ?>"
                                                      data-action="portal/applyProg" data-type="edit">Instruction</span></a>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(".prog_value").keyup(function () {
            var find_prog = $('.prog_value').val();

            if (find_prog.length > 2) {

                $('.common_program').hide();
                $('.search_prog').show();
                $.ajax({
                    type: "POST",
                    url: "searchProg",
                    data: 'find_prog=' + find_prog,
                    success: function (result) {
                        $(".search_prog").html(result);
                    }
                });
            } else {
                $('.common_program').show();
                $('.search_prog').hide();
            }
        });
        $(document).on("click", ".deg_link", function () {
            var thisValue = $(this);
            var find_deg_program = thisValue.attr("id");
            $.ajax({
                type: "POST",
                url: "searchProg",
                data: "find_deg_program=" + find_deg_program,
                success: function (result) {
                    $(".common_program").html(result);
                }
            });
        });
    });

</script>
