<div id="innerEditGroupHoder">
    <?php 
$edit_data = $this->db->get_where('group' , array('group_id' => $group_id) )->result_array();
foreach ( $edit_data as $row):
?>
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('edit_group');?>
                </div>
            </div>
            <div class="panel-body">

                <form id="updateGroup" action="<?php echo base_url() .'index.php?admin/ajax_update_group/'.$row['group_id']; ?>" class="form-horizontal form-groups-bordered" method="post">

                <div class="padded">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('class'); ?></label>
                        <div class="col-sm-5">                            
                            <select name="class_id" class="form-control">
                                <?php if(in_array_r(9, $classes) || in_array_r(91, $classes) || in_array_r(10, $classes)){
                                    foreach($classes as $list){
                                        if(in_array(9, $list) || in_array(91, $list) || in_array(10, $list)){
                                    ?>
                                <option value="<?php echo $list['class_id'];?>" <?php if($row[ 'class_id'] == $list[ 'class_id'])echo 'selected';?>><?php echo $list['name'];?></option>
                                <?php }}}else{?>
                                <option>Group Only work in class 9 or 10.</option>
                                    
                                <?php }?>
                            </select>
                        </div>
                    </div>
                </div>
                   
                    <div class="padded">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('group_name'); ?></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('update_group'); ?></button>
                        </div>
                    </div>
            
            </form>
        </div>
    </div>
</div>

<?php
endforeach;
?>
</div>

<script>
    $(document).ready(function () {

        $('#updateGroup').ajaxForm({
            beforeSend: function () {
                $('#loading').show();
                $('#overlayDiv').show();
            },
            success: function (data) {
                var jData = JSON.parse(data);

                if (!jData.type) {
                    toastr.error(jData.msg);
                } else {
                    toastr.success(jData.msg);
                    $("#groupList").html(jData.html);
                    $("#table_export").dataTable();
                    $("#innerEditGroupHoder").html('');
                }
                $('body,html').animate({
                    scrollTop: 0
                }, 800);
                $('#loading').fadeOut('slow');
                $('#overlayDiv').fadeOut('slow');
            }
        });

    });
</script>