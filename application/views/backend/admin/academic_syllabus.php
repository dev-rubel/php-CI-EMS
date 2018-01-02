
<hr />
<?php
//pd($classes);
?>
<div class="row">
    <div class="col-md-12">

        <!------ CONTROL TABS START ------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#syllabuslist" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('academic_syllabus'); ?>
                </a></li>
            <li>
                <a href="#syllabusadd" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_syllabus'); ?>
                </a></li>
        </ul>
        <!------ CONTROL TABS END ------>

        <div class="tab-content">
            <br>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="syllabuslist">

                <table class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
							<th>#</th>
							<th><?php echo get_phrase('title');?></th>
							<th><?php echo get_phrase('description');?></th>
							<th><?php echo get_phrase('subject');?></th>
							<th><?php echo get_phrase('uploader');?></th>
							<th><?php echo get_phrase('date');?></th>
							<th><?php echo get_phrase('file');?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
							$count    = 1;
							$syllabus = $this->db->get_where('academic_syllabus', ['year' => $running_year
							])->result_array();
							foreach ($syllabus as $row):
						?>
							<tr>
								<td><?php echo $count++;?></td>
								<td><?php echo $row['title'];?></td>
								<td><?php echo $row['description'];?></td>
                                                                <td>
									<?php 
										echo $this->db->get_where('subject' , array(
											'subject_id' => $row['subject_id']
										))->row()->name;
									?>
								</td>
								<td>
									<?php 
										echo $this->db->get_where($row['uploader_type'] , array(
											$row['uploader_type'].'_id' => $row['uploader_id']
										))->row()->name;
									?>
								</td>
								<td><?php echo date("d/m/Y" , $row['timestamp']);?></td>
								<td>
									<?php echo substr($row['file_name'], 0, 20);?><?php if(strlen($row['file_name']) > 20) echo '...';?>
								</td>
								<td align="center">
									<a class="btn btn-default btn-xs"
										href="<?php echo base_url();?>index.php?admin/download_academic_syllabus/<?php echo $row['academic_syllabus_code'];?>">
										<i class="entypo-download"></i> <?php echo get_phrase('download');?>
									</a>
								</td>
							</tr>
						<?php endforeach;?>
                    </tbody>
                </table>
            </div>
            <!----TABLE LISTING ENDS--->


            <!----CREATION FORM STARTS---->
            <div class="tab-pane box" id="syllabusadd" style="padding: 5px">
                <div class="box-content">

				<?php
                echo form_open(base_url() . 'index.php?admin/upload_academic_syllabus', array(
                    'class' => 'form-horizontal form-groups-bordered', 'target' => '_top', 'enctype' => 'multipart/form-data'
                ));
                ?>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('title'); ?></label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="title"
                               data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>
                    <div class="col-sm-6">
                        <textarea class="form-control" name="description"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('class'); ?></label>
                    <div class="col-sm-6">
                        <select class="form-control" name="class_id" id="class_id" onchange="return get_class_subject(this.value)">
                            <option value=""><?php echo get_phrase('select'); ?></option>
                            <?php
                            $classes = $this->db->get('class')->result_array();
                            foreach ($classes as $row):
                                ?>

                                <option value="<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></option>

                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('subject'); ?></label>
                    <div class="col-sm-5">
                        <select name="subject_id" class="form-control" id="subject_selector_holder">
                            <option value=""><?php echo get_phrase('select_class_first'); ?></option>

                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('file'); ?></label>
                    <div class="col-sm-5">
                        <input type="file" name="file_name" class="form-control inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> Browse" 
                               data-validate="required" data-message-required="<?php echo get_phrase('required'); ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class="btn btn-info">
                            <i class="entypo-upload"></i> <?php echo get_phrase('upload_syllabus'); ?>
                        </button>
                    </div>
                </div>
                <?php echo form_close(); ?>
                
                </div>                
            </div>
            <!----CREATION FORM ENDS-->
        </div>
    </div>
</div>



<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

    jQuery(document).ready(function ($)
    {


        var datatable = $("#table_export").dataTable();

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });
    });

	function get_class_subject(class_id) {

		$.ajax({
			url: '<?php echo base_url(); ?>index.php?admin/get_subject/' + class_id,
			success: function (response)
			{
				jQuery('#subject_selector_holder').html(response);
			}
		});

	}

</script>