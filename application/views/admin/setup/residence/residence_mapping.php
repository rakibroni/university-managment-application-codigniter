<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Residence Seat No. Mapping</h5>
        <?php if ($previlages->CREATE == 1) { ?>
        <div class="ibox-tools">
            <span title="Residence Mapping" class="btn btn-primary btn-xs pull-right openModal" data-action="admin/addRoomMapping"> Add New </span>
        </div>
         <?php } ?>
    </div>
    <div class="ibox-content">
        <div class="col-md-2">
            <div class="form-group">
                <select class="form-control" name="BUILDING" id="BUILDING"  >
                    <option value="">--Select--</option>
                    <?php foreach($resident_building as $row): ?>
                        <option value="<?php echo $row->BUILDING_ID ?>"><?php echo $row->BUILDING_NAME ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>        
        <div class="col-md-2">
            <div class="form-group">
             <select class="form-control commonClass" name="FLOOR"
             id="FLOOR"  data-tags="true" data-placeholder="Select Building" data-allow-clear="true">
             <option value="">-- Select Floor --</option>
             <?php foreach ($building_floor as $row): ?>
               <option value="<?php echo $row->FLOOR_SL_NO; ?>"><?php echo $row->FLOOR_NAME; ?></option>
           <?php endforeach; ?>
       </select>

   </div>
</div>
<div class="col-md-2">
   <button class="btn btn-primary btn-xs" id="search_seat_status">Search</button>
</div>
<div class="clearfix"></div>
</div>
<div class="ibox-content">
    <div id="seat_status"></div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#search_seat_status').on('click',function(){
            var BUILDING_ID=$('#BUILDING').val();
            var FLOOR_ID=$('#FLOOR').val();
            var url = '<?php echo site_url('admin/residentSeatStatus'); ?>';

            $.ajax({
                type: 'POST',
                url: url,
                data: {BUILDING_ID: BUILDING_ID,FLOOR_ID:FLOOR_ID},
                success: function (data) {
                    $('#seat_status').html(data);
                }
            });
        });
        $('#seat_booking').on('click',function(){
            var BUILDING_ID=$('#BUILDING').val();
            var FLOOR_ID=$('#FLOOR').val();
            var url = '<?php echo site_url('admin/residentSeatBooking'); ?>';

            $.ajax({
                type: 'POST',
                url: url,
                data: {BUILDING_ID: BUILDING_ID,FLOOR_ID:FLOOR_ID},
                success: function (data) {
                    $('#seat_status').html(data);
                }
            });
        });
    });
</script>
