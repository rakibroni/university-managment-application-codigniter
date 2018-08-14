<link rel="stylesheet" href="<?php echo base_url('portalAssets/tree/default/style.min.css') ?>" />
<?php
$url= 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$actual_link=str_replace("/","--",$url);

?>
<style media="screen">
.customDiv{
	height: 160px;
	overflow: auto;
}
 
.btn-delete{
	width: 100%;
}
h6{
	color:#000; margin-top:3px;font-size:8px
}

.chl-tree a>i{
	display: none !important;
}
.chl-tree a{
	background-color: #ADC801;
	padding: 0px 35px;
	width: 135px;
	text-align: center;
	margin-bottom: 5px;
	color: #fff ! important;
	height: auto;
	font-size: 14px;
}

.chl-tree a:hover{
	background-color: #ADC801;
	font-size: 14px;
}
.jstree-default .jstree-clicked {
	background: #ADC801;
	margin-bottom: 5px;
	padding: 0px 35px;
	transition: none;
	height: auto;
	border-radius: 0px;
	box-shadow: none;
	font-size: 14px;
	width: 135px;
	white-space: none;
}
.chl-tree ul>li a{
	padding: 0px 35px;
	margin-bottom: 5px;
	background-color: #E43434 !important;
}
ol.breadcrumb li a{
	color:#000;
}
</style>
<div class="ibox float-e-margins">
	<div class="ibox-title">
		<h5>File Management List</h5>
	</div>
	<div class="ibox-content">
		<div class="col-md-3">
			<div class="panel panel-info">
				<div class="panel-heading">Folder Directory</div>

				<div class="panel-body">
					<div id="html" class="demo">
						<?php
						function getDocUrl($docType)
						{
							if($docType=='ppt' OR $docType=='pptx')
							{
								$docTypeUrl=base_url('portalAssets/img/fileType/pptDoc.jpg');
							}
							else if($docType=='doc' OR $docType=='docx')
							{
								$docTypeUrl=base_url('portalAssets/img/fileType/wordDoc.jpg');
							}
							else if($docType=='pdf')
							{
								$docTypeUrl=base_url('portalAssets/img/fileType/pdfDoc.jpg');
							}
							else if($docType=='web')
							{
								$docTypeUrl=base_url('portalAssets/img/fileType/websiteDoc.jpg');
							}
							else
							{
								$docTypeUrl='';
							}
							return $docTypeUrl;
						}
						if(!empty($tree))
						{
							$session=1;
							function createTree($tree, $session,$parentId)
							{

								foreach ($tree as $key => $cat) {
									$cat_id = $cat['SD_ID'];
									if($cat_id==$parentId)
									{
										$className='true';
									}
									else
									{
										$className='false';
									}

									$url=base_url('AdminSkillDev/index/'.$cat['SD_ID']);

									if ($session == 1) {
										?>
										<li class="chl-tree " data-jstree='{ "selected" : <?php echo $className; ?>}'><a class="chdCls" href="<?php echo $url; ?>"><?php echo $cat['SD_NAME']; ?></a>
											<?php

										} else {
											echo '<li class=""> <button>'.$cat['SD_NAME'].'</button>';
										}
										if (!empty($cat['children'])) {
											echo "<ul>";
											createTree($cat['children'], $session,$parentId);
											echo "</ul>";
										}
										echo '</li>';
									}

								}
								echo "<ul>";


								createTree($tree, $session,$parentId);
								"</ul>";
							}

							?>
						</div>
					</div>

				</div>
			</div>
			<div class="col-md-9">
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="row">
							<div  class="col-md-9">
								<h3>
								<ol style="background-color: #23c6c8 !important" class="breadcrumb">
									<li><a href="<?php echo base_url("AdminSkillDev/index/0") ?>">Root</a></li>
									<?php
									if(!empty($directoryTree))
									{
										foreach($directoryTree as $dt)
										{
											?>
											<li><a href="<?php echo base_url("AdminSkillDev/index/$dt->SD_ID") ?>"><?php echo $dt->SD_NAME;?></a></li>
											<?php

										}

									}
									$actionUrl='AdminSkillDev/createDirectory/'.$parentId;
									?>
								</ol>
								</h3>
							</div>
							<div class="col-md-3">


								<button type="button"
								class="btn btn-xs btn-warning openModal pull-right"
								data-action=<?php echo $actionUrl; ?>
								title="Create new directory"
								data-modal-size="modal-sm"
								name="button">New Folder</button>

							</div>
						</div>


					</div>
					<div class="panel-body">
						<?php 
						if($parentId>0)
						{
							
							?>

							<div class="col-md-2 customDiv col-sm-4">

								<a class="openModal "
								data-action="AdminSkillDev/addNewElement/<?php echo $parentId; ?>"
								title="Add New Element"
								data-modal-size="modal-md"
								>


								<center>
									<h6 style="color:#000; margin-top:3px">Add File </h6>
									<span class="glyphicon glyphicon-upload" style="font-size:73px; color:white;background-color:green"></span>
								</a></center>
							</center>



						</a>

					</div>
					<?php 
				}
				?>

				<?php

				foreach($directories as $row){ ?>

				<div class="col-md-2 customDiv col-sm-4" style="border:1px dotted gray;padding-top:5px">

					<center>
						<a href="<?php echo base_url("AdminSkillDev/index").'/'.$row->SD_ID; ?>">
							<h6 style=""><?php echo $row->SD_NAME; ?></h6>
							<span class="glyphicon glyphicon-folder-close" style="font-size:73px;color:#D8BA52;"></span>
						</a>
						<?php if($row->CRE_BY==$userId){
							if($row->CHILD==0)
							{
								$left='pull-left';
							}
							else
							{
								$left='text-center';
							}
							?>
							<div class="col-md-12">

								<button type="button" data-action="<?php echo 'AdminSkillDev/editDirectory/'.$row->SD_ID.'/'.$parentId; ?>" title="Edit Directory" data-modal-size="modal-sm"  class="btn btn-warning btn-xs <?php echo $left; ?>  openModal" name="button"><span class="glyphicon glyphicon-edit"></span></button>
								<?php
								if($row->CHILD==0)
								{
									?>
									<a href="<?php echo base_url("AdminSkillDev/deleteDirectoryFile/d/$row->SD_ID/$actual_link") ?>"><button type="button"  class="btn btn-danger btn-xs pull-right" title="Delete Directory"name="button"><span class="glyphicon glyphicon-trash"></span></button></a>

									<?php
								}
								?>
							</div>

							<?php
						}
						?>
					</center>
				</div>
				<?php }
				?>
				<?php foreach($files as $file) {?>
				<div class="col-md-2 customDiv col-sm-4">
					<?php if($file->ELEMENT_TYPE=='F'){ ?>
					<center>

						<a href="<?php echo base_url($file->FILE_PATH)?>" target="blank">
							<h6 style="color:#000; margin-top:3px"><b><?php echo $file->ELEMENT_TITLE; ?></b> <small> (<?php echo $file->ELEMENT_EXT; ?>)</small></h6>
							<img src="<?php echo getDocUrl($file->ELEMENT_EXT); ?>" class="img-responsive" alt="Element Photo">
						</a>
						<?php if($file->CRE_BY==$userId){
							$url=  base_url("AdminSkillDev/deleteDirectoryFile/f/$file->ELEMENT_ID/$actual_link");
							?>

							<a href="<?php echo $url; ?>"><button type="button"  class="btn btn-danger btn-xs btn-delete" title="Delete Directory"name="button"><span class="glyphicon glyphicon-trash"></span></button></a>
							<?php
						}
						?>
					</center>
					<?php
				}
				else
				{
					?>
					<center>
						<a href="<?php echo $file->ELEMENT_URL; ?>" target="blank">
							<h6 style="color:#000; margin-top:3px"><?php echo $file->ELEMENT_TITLE; ?> <small>( URL)</small></h6>
							<img src="<?php echo getDocUrl('web'); ?>" class="img-responsive" alt="Element Photo">

						</a>
						<?php if($file->CRE_BY==$userId){
							$url=  base_url("AdminSkillDev/deleteDirectoryFile/w/$file->ELEMENT_ID/$actual_link");
							?>

							<a href="<?php echo $url; ?>"><button type="button"  class="btn btn-danger btn-xs btn-delete" title="Delete Directory"name="button"><span class="glyphicon glyphicon-trash"></span></button></a>
							<?php
						}
						?>
					</center>
					<?php
				}
				?>
			</div>
			<?php } ?>



		</div>
	</div>
</div>
<div class="clearfix"></div>
</div>
</div>

<script type="text/javascript" src="<?php echo base_url('portalAssets/tree/default/jstree.min.js') ?>">

</script>
<script type="text/javascript">
	$('#html').jstree();
	$(document).on("click", "a.chdCls", function () {
    //alert("okay");
    var url=$(this).attr("href");
    $(this).removeClass('jstree-anchor');
    $(this).removeClass('jstree-clicked');
    window.location.replace(url);
});
  //$("a.chdCls").removeClass('jstree-anchor');
  //$("a.chdCls").removeClass('jstree-clicked');

</script>
