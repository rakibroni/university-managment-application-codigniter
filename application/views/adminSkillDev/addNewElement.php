<style media="screen">
  .form-control{
    padding: 0px;
  }
  select, select.form-control{

    padding: 2px;
  }
  .urlLink{
    display: none;
  }
  .fileUpload{
    display: none;
  }
</style>

<?php
 $attribute = array('class' => 'form-horizontal', 'id' => '', 'role' => 'form');
 echo form_open_multipart('AdminSkillDev/addNewElement/'.$parentId, $attribute);
 ?>
  <div class="form-group">
      <label class="col-md-3 control-label" for="">Element Title</label>
      <div class="col-sm-9">
          <div class="fg-line">
              <input type="text" name="elementTitle" class="form-control " id=""
              value="" placeholder="Please Enter Title"/ required>
          </div>
      </div>
      <br clear="all"/>
  </div>
  <div class="form-group">
      <label class="col-md-3 control-label" for="">Element Type</label>
      <div class="col-sm-9">
          <div class="fg-line">
              <select class="form-control elementType" name="elementType" style="color:black!important" required>
                <option value="">Select Type</option>
                <option value="F">File</option>
                
              </select>
          </div>
      </div>
      <br clear="all"/>
  </div>
  <div class="form-group urlLink">
      <label class="col-md-3 control-label" for="">Website Link</label>
      <div class="col-sm-9">
          <div class="fg-line">
            <input type="text" name="websiteLink" class="form-control " id="linkId"
            value="" placeholder="Please Enter Website Link"/>
          </div>
      </div>
      <br clear="all"/>
  </div>
  <div class="form-group fileUpload">
      <label class="col-md-3 control-label" for="">Upload File</label>
      <div class="col-sm-9">
          <div class="fg-line">
            <input type="file" name="fileUpload" class="form-control " id="fileId"
            value="" placeholder="Please Enter websiteLink"/>
          </div>
      </div>
      <br clear="all"/>
  </div>
  <div class="form-group">
    <center>
      <button type="submit" class="btn btn-primary btn-sm" name="button">Submit</button>
    </center>
  </div>
<?php echo form_close() ?>
<script type="text/javascript">
$(document).ready(function(){
    $("select.elementType").change(function(){
      var val=  $(this).val();
      if(val=='')
      {
        $("div.fileUpload").hide('slide');
        $("div.urlLink").hide('slide');
      }
      else if(val=='F')
      {
        $("div.fileUpload").show('slide');
        $("div.urlLink").hide('slide');
      }
      else
      {
        $("div.fileUpload").hide('slide');
        $("div.urlLink").show('slide');
      }

    });
});
</script>
