<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Finance List</h5>
        <?php // if ($previlages->CREATE == 1) { ?>
        <div class="ibox-tools">

        </div>
        <?php // } ?>
    </div>
    <div class="ibox-content">

        <div class="dd" id="nestable">
            <ol class="dd-list">
                <li class="dd-item" data-id="1">
                    <div class="dd-handle">1 - Lorem ipsum</div>
                </li>
                <li class="dd-item" data-id="2">
                    <div class="dd-handle">2 - Dolor sit</div>
                    <ol class="dd-list">
                        <li class="dd-item" data-id="3">
                            <div class="dd-handle">3 - Adipiscing elit</div>
                        </li>
                        <li class="dd-item" data-id="4">
                            <div class="dd-handle">4 - Nonummy nibh</div>
                        </li>
                    </ol>
                </li>
                <li class="dd-item" data-id="5">
                    <div class="dd-handle">5 - Consectetuer</div>
                    <ol class="dd-list">
                        <li class="dd-item" data-id="6">
                            <div class="dd-handle">6 - Aliquam erat</div>
                        </li>
                        <li class="dd-item" data-id="7">
                            <div class="dd-handle">7 - Veniam quis</div>
                        </li>
                    </ol>
                </li>
                <li class="dd-item" data-id="8">
                    <div class="dd-handle">8 - Tation ullamcorper</div>
                </li>
                <li class="dd-item" data-id="9">
                    <div class="dd-handle">9 - Ea commodo</div>
                </li>
            </ol>
        </div>
        
    </div>
</div>
<script>
    $(document).ready(function(){ 
             // activate Nestable for list 1
             $('#nestable').nestable({
                 group: 1
             }); 
                 
         });

</script>
<!-- Nestable List -->
<script src="<?php echo base_url(); ?>assets/js/plugins/nestable/jquery.nestable.js"></script>