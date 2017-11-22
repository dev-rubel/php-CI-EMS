<?php
$edit_data = $this->db->get_where('group', array('group_id' => $param2))->result_array();
foreach ($edit_data as $row):
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title" >
                        <i class="entypo-plus-circled"></i>
                        <?php echo get_phrase('edit_group'); ?>
                    </div>
                </div>
                <div class="panel-body">

                    <?php echo form_open(base_url() . 'index.php?admin/groups/do_update/' . $row['group_id'], array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('class'); ?></label>
                        <div class="col-sm-5">                            
                            <select name="class_id" class="form-control">
                                <?php 
                                $classs = $this->db->get('class')->result_array();
                                    foreach ($classs as $key => $value) {
                                        if($value['name_numeric']==9 || $value['name_numeric']==10){
                                ?>
                                <option value="<?php echo $value['class_id'];?>" <?php echo selected($row['class_id'], $value['class_id']); ?>><?php echo $value['name']; ?></option>
                                <?php }}?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('group_name'); ?></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="name" value="<?php echo $row['name']?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"/>
                            </div>
                        </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('update'); ?></button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
endforeach;
?>


